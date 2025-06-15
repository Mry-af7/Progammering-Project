<template>
    <Head title="Company Dashboard" />
    
    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- Welcome Section -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 rounded-3xl p-8 text-white relative overflow-hidden mb-6">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10 flex justify-between items-center">
                    <div>
                        <h1 class="text-5xl font-bold mb-3">Welcome back, {{ company.name }}! 👋</h1>
                        <p class="text-xl text-blue-100 mb-4">Manage your company's recruitment process</p>
                        <div class="flex items-center space-x-6">
                            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 flex items-center space-x-3">
                                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                                    <img :src="company.logo" :alt="company.name" class="w-10 h-10 rounded-full">
                                </div>
                                <div>
                                    <div class="font-semibold">{{ company.name }}</div>
                                    <div class="text-blue-100 text-sm">{{ company.industry }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="text-center">
                                <div class="text-4xl font-bold">{{ stats.activeJobs }}</div>
                                <div class="text-blue-100">Active Jobs</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold">{{ stats.totalApplications }}</div>
                                <div class="text-blue-100">Applications</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold">{{ stats.interviews }}</div>
                                <div class="text-blue-100">Interviews</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-4 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-green-500 text-sm font-medium">+15%</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ stats.newApplications }}</div>
                    <div class="text-gray-600 dark:text-gray-400 text-sm">New Applications</div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span class="text-blue-500 text-sm font-medium">+8</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ stats.activeCandidates }}</div>
                    <div class="text-gray-600 dark:text-gray-400 text-sm">Active Candidates</div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <span class="text-purple-500 text-sm font-medium">+3</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ stats.scheduledInterviews }}</div>
                    <div class="text-gray-600 dark:text-gray-400 text-sm">Scheduled Interviews</div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-orange-500 text-sm font-medium">2h</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ stats.avgResponseTime }}</div>
                    <div class="text-gray-600 dark:text-gray-400 text-sm">Avg. Response Time</div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid lg:grid-cols-3 gap-8 mb-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Job Postings -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Active Job Postings</h3>
                        <Link href="/jobs/create" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Post New Job</Link>
                    </div>
                    
                    <div class="space-y-4">
                        <div v-for="job in activeJobs" :key="job.id" class="border border-gray-200 dark:border-gray-700 rounded-xl p-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-white">{{ job.title }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ job.department }} • Posted {{ job.postedDays }} days ago</div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium" :class="getStatusColor(job.status)">
                                        {{ job.status }}
                                    </span>
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
                                <div class="flex items-center space-x-4">
                                    <span>{{ job.applications }} applications</span>
                                    <span>{{ job.views }} views</span>
                                </div>
                                <Link :href="'/jobs/' + job.id" class="text-blue-600 hover:text-blue-800">View Details</Link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Applications -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Recent Applications</h3>
                        <Link href="/applications" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</Link>
                    </div>
                    
                    <div class="space-y-4">
                        <div v-for="application in recentApplications" :key="application.id" class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                            <div class="flex items-center space-x-4">
                                <img :src="application.candidate.avatar" :alt="application.candidate.name" class="w-12 h-12 rounded-full object-cover">
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-white">{{ application.candidate.name }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ application.job.title }} • Applied {{ application.appliedDays }} days ago</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span :class="getApplicationStatusColor(application.status)" class="px-3 py-1 rounded-full text-xs font-medium">
                                    {{ application.status }}
                                </span>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Upcoming Interviews -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Upcoming Interviews</h3>
                        <Link href="/interviews" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</Link>
                    </div>
                    <div class="space-y-4">
                        <div v-for="interview in upcomingInterviews" :key="interview.id" class="flex items-start space-x-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors"
                             :class="interview.isToday ? 'bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800' : ''">
                            <div :class="interview.isToday ? 'bg-gradient-to-r from-blue-500 to-indigo-500' : 'bg-gradient-to-r from-purple-500 to-pink-500'" 
                                 class="w-10 h-10 rounded-lg flex items-center justify-center text-white text-lg font-bold">
                                {{ interview.icon }}
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 dark:text-white text-sm">{{ interview.candidate.name }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">{{ interview.time }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-500">{{ interview.type }}</div>
                            </div>
                            <div v-if="interview.isToday" class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl p-6 border border-blue-200 dark:border-blue-800">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <button class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all text-left">
                            <div class="text-2xl mb-1">📝</div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">Post Job</div>
                        </button>
                        <button class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all text-left">
                            <div class="text-2xl mb-1">👥</div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">View Candidates</div>
                        </button>
                        <button class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all text-left">
                            <div class="text-2xl mb-1">📊</div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">Analytics</div>
                        </button>
                        <button class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all text-left">
                            <div class="text-2xl mb-1">⚙️</div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">Settings</div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

const breadcrumbs = [{ title: 'Company Dashboard', href: '/company/dashboard' }]

// Company data
const company = {
    name: 'TechCorp',
    industry: 'Information Technology',
    logo: '/images/company-logo.png'
}

// Dashboard statistics
const stats = {
    activeJobs: 12,
    totalApplications: 156,
    interviews: 8,
    newApplications: 23,
    activeCandidates: 45,
    scheduledInterviews: 5,
    avgResponseTime: '2h'
}

// Active job postings
const activeJobs = [
    {
        id: 1,
        title: 'Senior Frontend Developer',
        department: 'Engineering',
        postedDays: 3,
        status: 'Active',
        applications: 15,
        views: 234
    },
    {
        id: 2,
        title: 'UX/UI Designer',
        department: 'Design',
        postedDays: 5,
        status: 'Active',
        applications: 8,
        views: 156
    },
    {
        id: 3,
        title: 'DevOps Engineer',
        department: 'Engineering',
        postedDays: 1,
        status: 'Active',
        applications: 12,
        views: 189
    }
]

// Recent applications
const recentApplications = [
    {
        id: 1,
        candidate: {
            name: 'John Doe',
            avatar: '/images/avatar-1.jpg'
        },
        job: {
            title: 'Senior Frontend Developer'
        },
        status: 'Under Review',
        appliedDays: 2
    },
    {
        id: 2,
        candidate: {
            name: 'Jane Smith',
            avatar: '/images/avatar-2.jpg'
        },
        job: {
            title: 'UX/UI Designer'
        },
        status: 'Interview Scheduled',
        appliedDays: 1
    },
    {
        id: 3,
        candidate: {
            name: 'Mike Johnson',
            avatar: '/images/avatar-3.jpg'
        },
        job: {
            title: 'DevOps Engineer'
        },
        status: 'New',
        appliedDays: 3
    }
]

// Upcoming interviews
const upcomingInterviews = [
    {
        id: 1,
        candidate: {
            name: 'Sarah Wilson'
        },
        time: 'Today 2:00 PM',
        type: 'Technical Interview',
        icon: '💻',
        isToday: true
    },
    {
        id: 2,
        candidate: {
            name: 'David Brown'
        },
        time: 'Tomorrow 10:00 AM',
        type: 'HR Interview',
        icon: '👔',
        isToday: false
    },
    {
        id: 3,
        candidate: {
            name: 'Emma Davis'
        },
        time: 'Friday 3:00 PM',
        type: 'Final Interview',
        icon: '🎯',
        isToday: false
    }
]

// Helper functions
const getStatusColor = (status: string) => {
    const colors = {
        'Active': 'bg-green-100 text-green-800',
        'Draft': 'bg-gray-100 text-gray-800',
        'Closed': 'bg-red-100 text-red-800'
    }
    return colors[status] || 'bg-gray-100 text-gray-800'
}

const getApplicationStatusColor = (status: string) => {
    const colors = {
        'New': 'bg-blue-100 text-blue-800',
        'Under Review': 'bg-yellow-100 text-yellow-800',
        'Interview Scheduled': 'bg-purple-100 text-purple-800',
        'Rejected': 'bg-red-100 text-red-800',
        'Hired': 'bg-green-100 text-green-800'
    }
    return colors[status] || 'bg-gray-100 text-gray-800'
}
</script> 