<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserStats;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Initialize empty stats if they don't exist
        if (!$user->userStats) {
            $stats = new UserStats([
                'profile_completion_percentage' => 0,
                'applications_sent' => 0,
                'applications_pending' => 0,
                'applications_interview' => 0,
                'applications_offers' => 0,
                'profile_views_count' => 0
            ]);
            $user->userStats()->save($stats);
        } else {
            $stats = $user->userStats;
        }

        // Get activities if they exist, otherwise return empty collection
        $activities = UserActivity::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get() ?? collect();

        $tasks = []; // Temporarily disable tasks

        return Inertia::render('Students/Dashboard', [
            'stats' => $stats,
            'activities' => $activities,
            'tasks' => $tasks,
        ]);
    }

    public function getStats()
    {
        $user = auth()->user();
        $stats = $user->userStats;
        
        if (!$stats) {
            $stats = new UserStats([
                'profile_completion_percentage' => 0,
                'applications_sent' => 0,
                'applications_pending' => 0,
                'applications_interview' => 0,
                'applications_offers' => 0,
                'profile_views_count' => 0
            ]);
            $user->userStats()->save($stats);
        }

        return response()->json([
            'profile_completion' => $stats->profile_completion_percentage,
            'applications' => [
                'total' => $stats->applications_sent,
                'pending' => $stats->applications_pending,
                'interview' => $stats->applications_interview,
                'offers' => $stats->applications_offers,
            ],
            'profile_views' => $stats->profile_views_count,
            'messages' => $user->unreadMessages()->count(),
        ]);
    }

    public function getActivities()
    {
        $user = auth()->user();
        $activities = UserActivity::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get() ?? collect();

        return response()->json($activities);
    }

    public function getTasks()
    {
        $user = auth()->user();
        $tasks = $user->tasks()
            ->where('completed', false)
            ->orderBy('due_date')
            ->get() ?? collect();

        return response()->json($tasks);
    }

    public function updateTask(Request $request, $task)
    {
        $task = auth()->user()->tasks()->findOrFail($task);
        $task->update($request->validate([
            'completed' => 'required|boolean',
        ]));

        return response()->json($task);
    }
} 