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
        $stats = $user->userStats;
        $activities = UserActivity::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
        $tasks = []; // Temporarily disable tasks

        return Inertia::render('Dashboard', [
            'stats' => $stats,
            'activities' => $activities,
            'tasks' => $tasks,
        ]);
    }

    public function getStats()
    {
        $user = auth()->user();
        return response()->json([
            'profile_completion' => $user->userStats?->profile_completion_percentage ?? 0,
            'applications' => [
                'total' => $user->userStats?->applications_sent ?? 0,
                'pending' => $user->userStats?->applications_pending ?? 0,
                'interview' => $user->userStats?->applications_interview ?? 0,
                'offers' => $user->userStats?->applications_offers ?? 0,
            ],
            'profile_views' => $user->userStats?->profile_views_count ?? 0,
            'messages' => $user->unreadMessages()->count(),
        ]);
    }

    public function getActivities()
    {
        $user = auth()->user();
        $activities = $user->activities()
            ->latest()
            ->take(10)
            ->get();

        return response()->json($activities);
    }

    public function getTasks()
    {
        $user = auth()->user();
        $tasks = $user->tasks()
            ->where('completed', false)
            ->orderBy('due_date')
            ->get();

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