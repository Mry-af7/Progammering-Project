<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Company;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class JobManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with(['company.user'])
            ->withCount(['applications']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by company
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        // Filter by job type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Search by title or description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('requirements', 'LIKE', "%{$search}%");
            });
        }

        $jobs = $query->latest()->paginate(20);

        $companies = Company::with('user')
            ->where('status', 'approved')
            ->orderBy('name')
            ->get();

        $stats = [
            'totalJobs' => Job::count(),
            'activeJobs' => Job::where('status', 'active')->count(),
            'pendingJobs' => Job::where('status', 'pending')->count(),
            'expiredJobs' => Job::where('expires_at', '<', now())->count(),
            'totalApplications' => JobApplication::count(),
        ];

        return Inertia::render('Admin/JobManagement', [
            'jobs' => $jobs,
            'companies' => $companies,
            'stats' => $stats,
            'filters' => $request->only(['status', 'company_id', 'type', 'search'])
        ]);
    }

    public function show(Job $job)
    {
        $job->load([
            'company.user',
            'applications.student.user',
            'applications' => function($query) {
                $query->latest();
            }
        ]);

        $analytics = [
            'viewCount' => $job->views ?? 0,
            'applicationCount' => $job->applications->count(),
            'averageResponseTime' => $this->calculateAverageResponseTime($job),
            'applicationsByDay' => $this->getApplicationsByDay($job),
        ];

        return Inertia::render('Admin/JobDetails', [
            'job' => $job,
            'analytics' => $analytics
        ]);
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'requirements' => 'sometimes|nullable|string',
            'location' => 'sometimes|nullable|string|max:255',
            'type' => 'sometimes|required|in:full-time,part-time,contract,internship,freelance',
            'status' => 'sometimes|required|in:active,inactive,pending,expired',
            'salary_min' => 'sometimes|nullable|numeric|min:0',
            'salary_max' => 'sometimes|nullable|numeric|min:0|gte:salary_min',
            'expires_at' => 'sometimes|nullable|date|after:today',
            'is_featured' => 'sometimes|boolean',
            'admin_notes' => 'sometimes|nullable|string'
        ]);

        $originalStatus = $job->status;
        
        $job->update($request->only([
            'title', 'description', 'requirements', 'location', 
            'type', 'status', 'salary_min', 'salary_max', 
            'expires_at', 'is_featured', 'admin_notes'
        ]));

        // Log status changes
        if ($request->has('status') && $originalStatus !== $request->status) {
            \Log::info('Job status changed by admin', [
                'admin_id' => auth()->id(),
                'job_id' => $job->id,
                'job_title' => $job->title,
                'old_status' => $originalStatus,
                'new_status' => $request->status,
                'company_id' => $job->company_id
            ]);

            // Notify company of status change (you can implement email notification here)
            if (in_array($request->status, ['active', 'inactive'])) {
                $this->notifyCompanyOfStatusChange($job, $originalStatus, $request->status);
            }
        }

        return back()->with('success', "Job '{$job->title}' updated successfully");
    }

    public function destroy(Job $job)
    {
        $jobTitle = $job->title;
        $companyName = $job->company->name;

        // Delete related applications
        $job->applications()->delete();

        $job->delete();

        // Log the deletion
        \Log::warning('Job deleted by admin', [
            'admin_id' => auth()->id(),
            'job_id' => $job->id,
            'job_title' => $jobTitle,
            'company_name' => $companyName
        ]);

        return back()->with('success', "Job '{$jobTitle}' deleted successfully");
    }

    public function approve(Job $job)
    {
        if ($job->status !== 'pending') {
            return back()->with('error', 'Only pending jobs can be approved');
        }

        $job->update([
            'status' => 'active',
            'approved_at' => now(),
            'approved_by' => auth()->id()
        ]);

        // Log the approval
        \Log::info('Job approved by admin', [
            'admin_id' => auth()->id(),
            'job_id' => $job->id,
            'job_title' => $job->title,
            'company_id' => $job->company_id
        ]);

        // Notify company (implement email notification)
        $this->notifyCompanyOfApproval($job);

        return back()->with('success', "Job '{$job->title}' approved successfully");
    }

    public function reject(Job $job)
    {
        if ($job->status !== 'pending') {
            return back()->with('error', 'Only pending jobs can be rejected');
        }

        $job->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejected_by' => auth()->id()
        ]);

        // Log the rejection
        \Log::info('Job rejected by admin', [
            'admin_id' => auth()->id(),
            'job_id' => $job->id,
            'job_title' => $job->title,
            'company_id' => $job->company_id
        ]);

        // Notify company (implement email notification)
        $this->notifyCompanyOfRejection($job);

        return back()->with('success', "Job '{$job->title}' rejected");
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,activate,deactivate,delete,feature,unfeature',
            'job_ids' => 'required|array',
            'job_ids.*' => 'exists:jobs,id'
        ]);

        $jobIds = $request->job_ids;
        $action = $request->action;
        $affectedCount = 0;

        switch ($action) {
            case 'approve':
                $affectedCount = Job::whereIn('id', $jobIds)
                    ->where('status', 'pending')
                    ->update([
                        'status' => 'active',
                        'approved_at' => now(),
                        'approved_by' => auth()->id()
                    ]);
                break;
                
            case 'reject':
                $affectedCount = Job::whereIn('id', $jobIds)
                    ->where('status', 'pending')
                    ->update([
                        'status' => 'rejected',
                        'rejected_at' => now(),
                        'rejected_by' => auth()->id()
                    ]);
                break;
                
            case 'activate':
                $affectedCount = Job::whereIn('id', $jobIds)
                    ->whereIn('status', ['inactive', 'pending'])
                    ->update(['status' => 'active']);
                break;
                
            case 'deactivate':
                $affectedCount = Job::whereIn('id', $jobIds)
                    ->where('status', 'active')
                    ->update(['status' => 'inactive']);
                break;
                
            case 'delete':
                // First delete applications
                JobApplication::whereIn('job_id', $jobIds)->delete();
                $affectedCount = Job::whereIn('id', $jobIds)->delete();
                break;
                
            case 'feature':
                $affectedCount = Job::whereIn('id', $jobIds)
                    ->update(['is_featured' => true]);
                break;
                
            case 'unfeature':
                $affectedCount = Job::whereIn('id', $jobIds)
                    ->update(['is_featured' => false]);
                break;
        }

        // Log bulk action
        \Log::info('Bulk job action performed', [
            'admin_id' => auth()->id(),
            'action' => $action,
            'job_ids' => $jobIds,
            'affected_count' => $affectedCount
        ]);

        return back()->with('success', "Bulk action '{$action}' performed on {$affectedCount} jobs");
    }

    public function analytics()
    {
        $stats = [
            'jobsByStatus' => Job::selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->get(),
            'jobsByType' => Job::selectRaw('type, COUNT(*) as count')
                ->groupBy('type')
                ->get(),
            'applicationTrends' => $this->getApplicationTrends(),
            'topCompanies' => $this->getTopCompanies(),
            'averageSalaries' => $this->getAverageSalaries(),
        ];

        return Inertia::render('Admin/JobAnalytics', [
            'stats' => $stats
        ]);
    }

    private function calculateAverageResponseTime($job)
    {
        $applications = $job->applications()
            ->whereNotNull('responded_at')
            ->get();

        if ($applications->isEmpty()) {
            return null;
        }

        $totalHours = $applications->sum(function($application) {
            return $application->created_at->diffInHours($application->responded_at);
        });

        return round($totalHours / $applications->count(), 2);
    }

    private function getApplicationsByDay($job)
    {
        return $job->applications()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function getApplicationTrends()
    {
        return JobApplication::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function getTopCompanies()
    {
        return Company::withCount(['jobs', 'jobs as active_jobs_count' => function($query) {
                $query->where('status', 'active');
            }])
            ->orderByDesc('jobs_count')
            ->take(10)
            ->get();
    }

    private function getAverageSalaries()
    {
        return Job::selectRaw('type, AVG(salary_min) as avg_min, AVG(salary_max) as avg_max')
            ->whereNotNull('salary_min')
            ->groupBy('type')
            ->get();
    }

    private function notifyCompanyOfStatusChange($job, $oldStatus, $newStatus)
    {
        // Implement email notification logic here
        // You can use Laravel's notification system or mail system
    }

    private function notifyCompanyOfApproval($job)
    {
        // Implement approval notification logic here
    }

    private function notifyCompanyOfRejection($job)
    {
        // Implement rejection notification logic here
    }
}