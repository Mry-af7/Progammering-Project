<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Company;
use App\Models\Application;
use App\Models\Event;
use App\Models\AdminSetting;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get statistics
        $stats = [
            'totalSales' => 250000,
            'totalOrders' => 180,
            'newCustomers' => User::where('created_at', '>=', now()->startOfMonth())->count(),
            'revenue' => 50330,
            'pendingApplications' => Application::where('status', 'pending')->count(),
        ];

        // Get recent orders (mock data for now)
        $recentOrders = [
            ['id' => 1, 'product' => 'Smart Watch', 'amount' => 89.99, 'status' => 'Delivered', 'date' => '2025-04-29'],
            ['id' => 2, 'product' => 'Bluetooth Speaker', 'amount' => 39.99, 'status' => 'Pending', 'date' => '2025-04-28'],
            ['id' => 3, 'product' => 'Gaming Mouse', 'amount' => 24.99, 'status' => 'Completed', 'date' => '2025-04-27'],
        ];

        // Get products (mock data for now)
        $products = [
            [
                'id' => 1,
                'name' => 'Smart Watch',
                'category' => 'Electronics',
                'stock' => 120,
                'price' => 89.99,
                'rating' => 5,
                'reviews' => 14
            ],
            [
                'id' => 2,
                'name' => 'Bluetooth Speaker',
                'category' => 'Audio',
                'stock' => 75,
                'price' => 39.50,
                'rating' => 4,
                'reviews' => 8
            ],
            [
                'id' => 3,
                'name' => 'Gaming Mouse',
                'category' => 'Accessories',
                'stock' => 0,
                'price' => 24.99,
                'rating' => 5,
                'reviews' => 14
            ],
            [
                'id' => 4,
                'name' => '4K Action Camera',
                'category' => 'Electronics',
                'stock' => 45,
                'price' => 199.99,
                'rating' => 4,
                'reviews' => 23
            ]
        ];

        // Get notifications
        $notifications = [
            ['id' => 1, 'title' => 'New user registered', 'message' => 'Emma Janssen signed up', 'read' => false],
            ['id' => 2, 'title' => 'Order completed', 'message' => 'Order #12345 has been delivered', 'read' => false]
        ];

        return Inertia::render('AdminDashboard', [
            'stats' => $stats,
            'recentOrders' => $recentOrders,
            'products' => $products,
            'notifications' => $notifications,
        ]);
    }

    public function users()
    {
        $users = User::with(['studentProfile', 'companyProfile'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return Inertia::render('Admin/Users/Index', [
            'users' => $users
        ]);
    }

    public function companies()
    {
        $companies = Company::with(['industry', 'companySize'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return Inertia::render('Admin/Companies/Index', [
            'companies' => $companies
        ]);
    }

    public function events()
    {
        $events = Event::orderBy('created_at', 'desc')
            ->paginate(15);

        return Inertia::render('Admin/Events/Index', [
            'events' => $events
        ]);
    }

    public function applications()
    {
        $applications = Application::with(['user', 'company'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return Inertia::render('Admin/Applications/Index', [
            'applications' => $applications
        ]);
    }

    public function settings()
    {
        $settings = AdminSetting::all()->pluck('value', 'key');

        return Inertia::render('Admin/Settings', [
            'settings' => $settings
        ]);
    }

    public function profile()
    {
        $user = auth()->user();

        return Inertia::render('Admin/Profile', [
            'user' => $user
        ]);
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'maintenance_mode' => 'required|in:on,off',
        ]);

        foreach ($request->only(['site_name', 'maintenance_mode']) as $key => $value) {
            AdminSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Settings updated successfully');
    }
} 