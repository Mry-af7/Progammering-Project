<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with(['student', 'company'])
            ->withCount(['student', 'company'])
            ->latest()
            ->paginate(20);

        return Inertia::render('Admin/UserManagement', [
            'users' => $users,
            'stats' => [
                'totalUsers' => User::count(),
                'totalStudents' => Student::count(),
                'totalCompanies' => Company::count(),
                'totalAdmins' => User::where('is_admin', true)->count(),
            ]
        ]);
    }

    public function edit(User $user)
    {
        $user->load(['student', 'company']);
        
        return Inertia::render('Admin/EditUser', [
            'user' => $user,
            'userType' => $user->user_type,
            'profile' => $user->student ?: $user->company
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'user_type' => 'required|in:student,company',
            'is_admin' => 'boolean',
            'password' => 'nullable|confirmed|' . Rules\Password::defaults(),
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'is_admin' => $request->boolean('is_admin'),
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        // Update profile data if provided
        if ($request->has('profile_data')) {
            $profileData = $request->profile_data;
            
            if ($user->user_type === 'student' && $user->student) {
                $user->student->update([
                    'course' => $profileData['course'] ?? null,
                    'year' => $profileData['year'] ?? null,
                    'bio' => $profileData['bio'] ?? null,
                    'skills' => $profileData['skills'] ?? null,
                    'languages' => $profileData['languages'] ?? null,
                    'hobbies' => $profileData['hobbies'] ?? null,
                ]);
            } elseif ($user->user_type === 'company' && $user->company) {
                $user->company->update([
                    'description' => $profileData['description'] ?? null,
                    'industry' => $profileData['industry'] ?? null,
                    'website' => $profileData['website'] ?? null,
                    'size' => $profileData['size'] ?? null,
                    'location' => $profileData['location'] ?? null,
                ]);
            }
        }

        // Log the update
        \Log::info('User updated by admin', [
            'admin_id' => auth()->id(),
            'user_id' => $user->id,
            'changes' => $request->only(['name', 'email', 'user_type', 'is_admin'])
        ]);

        return back()->with('success', "User '{$user->name}' updated successfully");
    }

    public function destroy(User $user)
    {
        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account');
        }

        // Prevent deletion of other admins (optional security measure)
        if ($user->is_admin && auth()->user()->id !== 1) { // Assuming user ID 1 is super admin
            return back()->with('error', 'You cannot delete other admin accounts');
        }

        $userName = $user->name;
        $userType = $user->user_type;

        // Delete related profile data
        if ($user->student) {
            $user->student->delete();
        }
        if ($user->company) {
            $user->company->delete();
        }

        $user->delete();

        // Log the deletion
        \Log::warning('User deleted by admin', [
            'admin_id' => auth()->id(),
            'deleted_user_id' => $user->id,
            'deleted_user_name' => $userName,
            'deleted_user_type' => $userType
        ]);

        return back()->with('success', "User '{$userName}' deleted successfully");
    }

    public function promoteToAdmin(User $user)
    {
        if ($user->is_admin) {
            return back()->with('error', 'User is already an admin');
        }

        $user->update(['is_admin' => true]);

        // Log the promotion
        \Log::info('User promoted to admin', [
            'admin_id' => auth()->id(),
            'promoted_user_id' => $user->id,
            'promoted_user_name' => $user->name
        ]);

        return back()->with('success', "User '{$user->name}' promoted to admin successfully");
    }

    public function revokeAdmin(User $user)
    {
        // Prevent self-demotion
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot revoke your own admin access');
        }

        if (!$user->is_admin) {
            return back()->with('error', 'User is not an admin');
        }

        $user->update(['is_admin' => false]);

        // Log the demotion
        \Log::info('Admin access revoked', [
            'admin_id' => auth()->id(),
            'revoked_user_id' => $user->id,
            'revoked_user_name' => $user->name
        ]);

        return back()->with('success', "Admin access revoked for '{$user->name}'");
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $userType = $request->get('type');

        $users = User::with(['student', 'company'])
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('email', 'LIKE', "%{$query}%");
            })
            ->when($userType, function ($q) use ($userType) {
                $q->where('user_type', $userType);
            })
            ->latest()
            ->paginate(20);

        return response()->json([
            'users' => $users
        ]);
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,promote,demote,activate,deactivate',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        $userIds = $request->user_ids;
        $action = $request->action;
        
        // Remove current admin from bulk actions for safety
        $userIds = array_filter($userIds, function($id) {
            return $id != auth()->id();
        });

        $affectedCount = 0;

        switch ($action) {
            case 'delete':
                $affectedCount = User::whereIn('id', $userIds)
                    ->where('is_admin', false) // Don't delete admins in bulk
                    ->delete();
                break;
                
            case 'promote':
                $affectedCount = User::whereIn('id', $userIds)
                    ->where('is_admin', false)
                    ->update(['is_admin' => true]);
                break;
                
            case 'demote':
                $affectedCount = User::whereIn('id', $userIds)
                    ->where('is_admin', true)
                    ->update(['is_admin' => false]);
                break;
        }

        // Log bulk action
        \Log::info('Bulk action performed', [
            'admin_id' => auth()->id(),
            'action' => $action,
            'user_ids' => $userIds,
            'affected_count' => $affectedCount
        ]);

        return back()->with('success', "Bulk action '{$action}' performed on {$affectedCount} users");
    }
}