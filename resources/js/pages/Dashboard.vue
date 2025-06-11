<template>
    <Head title="Dashboard" />
    
    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- Welcome Section -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Welcome back, Sarah! 👋</h1>
                <p class="text-lg text-gray-600 dark:text-gray-400">Here's your career journey today.</p>
            </div>
            <div class="flex space-x-8">
                <div class="text-center">
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">12</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Applications</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">85%</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Profile Complete</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">247</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Profile Views</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Bar -->
        <div class="mb-6 flex justify-between items-center bg-gradient-to-r from-orange-500 to-red-500 rounded-xl p-4 text-white">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center text-lg font-bold">SJ</div>
                <div>
                    <div class="font-semibold">Sarah Johnson - Computer Science</div>
                    <div class="text-orange-100 text-sm">Profile 85% Complete • €2,400 target salary</div>
                </div>
            </div>
            <div class="flex space-x-3">
                <Link href="/jobs" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg font-medium transition-colors">
                    🔍 Find Jobs
                </Link>
                <Link href="/profile" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg font-medium transition-colors">
                    ✏️ Update Profile
                </Link>
            </div>
        </div>

        <!-- Main Dashboard Cards -->
        <div class="grid md:grid-cols-3 gap-6 mb-6">
            <!-- Profile Progress -->
            <div class="bg-gradient-to-br from-white to-orange-50 dark:from-gray-800 dark:to-orange-900/10 rounded-2xl p-6 shadow-lg border border-gray-200/50 dark:border-gray-700/50 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Profile Progress</h3>
                    <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-4xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent mb-4">85%</div>
                <div class="space-y-3">
                    <div v-for="item in progress" :key="item.name" class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ item.name }}</span>
                        <div class="w-16 h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
                            <div :class="item.complete ? 'bg-gradient-to-r from-orange-500 to-red-500' : 'bg-gray-300'" 
                                 class="h-2 rounded-full transition-all duration-300" :style="{width: item.progress + '%'}"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Status -->
            <div class="bg-gradient-to-br from-white to-blue-50 dark:from-gray-800 dark:to-blue-900/10 rounded-2xl p-6 shadow-lg border border-gray-200/50 dark:border-gray-700/50 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Applications</h3>
                    <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex justify-center mb-4">
                    <div class="relative w-24 h-24">
                        <svg class="w-24 h-24 transform -rotate-90" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="40" stroke="#e5e7eb" stroke-width="8" fill="none"/>
                            <circle cx="50" cy="50" r="40" stroke="#3B82F6" stroke-width="8" fill="none" 
                                    stroke-dasharray="251.2" stroke-dashoffset="188.4" stroke-linecap="round" class="transition-all duration-1000"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-xl font-bold text-blue-600">12</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">Total</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-2 text-center text-sm">
                    <div class="p-2 bg-gray-50 dark:bg-gray-800/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="font-bold text-gray-900 dark:text-white">8</div>
                        <div class="text-gray-600 dark:text-gray-400">Pending</div>
                    </div>
                    <div class="p-2 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg hover:bg-yellow-100 dark:hover:bg-yellow-800/30 transition-colors">
                        <div class="font-bold text-yellow-700 dark:text-yellow-400">3</div>
                        <div class="text-yellow-600 dark:text-yellow-400">Interview</div>
                    </div>
                    <div class="p-2 bg-green-50 dark:bg-green-900/20 rounded-lg hover:bg-green-100 dark:hover:bg-green-800/30 transition-colors">
                        <div class="font-bold text-green-700 dark:text-green-400">1</div>
                        <div class="text-green-600 dark:text-green-400">Offer</div>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="bg-gradient-to-br from-white to-green-50 dark:from-gray-800 dark:to-green-900/10 rounded-2xl p-6 shadow-lg border border-gray-200/50 dark:border-gray-700/50 hover:shadow-xl transition-shadow">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Next Steps</h3>
                    <span class="bg-gradient-to-r from-green-500 to-emerald-500 text-white text-sm px-3 py-1 rounded-full font-semibold">1/3</span>
                </div>
                <div class="space-y-3">
                    <div v-for="task in tasks" :key="task.id" class="flex items-center space-x-3 p-3 rounded-lg hover:scale-[1.02] transition-transform" 
                         :class="task.done ? 'bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800' : 'bg-gray-50 dark:bg-gray-800/50'">
                        <div :class="task.done ? 'bg-gradient-to-r from-green-500 to-emerald-500' : 'bg-gray-400'" 
                             class="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg v-if="task.done" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <div v-else class="w-2 h-2 bg-white rounded-full"></div>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ task.title }}</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">{{ task.desc }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg rounded-2xl border border-gray-200/50 dark:border-gray-700/50 shadow-lg">
            <div class="grid lg:grid-cols-2 gap-8 p-8">
                <!-- Upcoming Events -->
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Upcoming Events</h3>
                        <span class="text-sm text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded-lg">June 2025</span>
                    </div>
                    <div class="space-y-4">
                        <div v-for="event in events" :key="event.id" class="flex items-start space-x-4 p-4 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors group"
                             :class="event.today ? 'bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 border-2 border-orange-200 dark:border-orange-800' : ''">
                            <div :class="event.today ? 'bg-gradient-to-r from-orange-500 to-red-500' : 'bg-gradient-to-r from-blue-500 to-indigo-500'" 
                                 class="w-12 h-12 rounded-lg flex items-center justify-center text-white text-xl font-bold group-hover:scale-110 transition-transform">
                                {{ event.icon }}
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors">{{ event.title }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ event.time }}</p>
                            </div>
                            <div v-if="event.today" class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Recent Activity</h3>
                        <span class="text-sm text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded-lg">Last 7 days</span>
                    </div>
                    <div class="space-y-4">
                        <div v-for="activity in activities" :key="activity.id" class="flex items-start space-x-4 p-4 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors group">
                            <div :class="activity.color" class="w-10 h-10 rounded-xl flex items-center justify-center text-white text-lg font-bold group-hover:scale-110 transition-transform">
                                {{ activity.icon }}
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-semibold text-gray-900 dark:text-white text-sm">{{ activity.title }}</h4>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ activity.desc }}</p>
                                    </div>
                                    <span class="text-xs text-gray-400 dark:text-gray-500 font-medium">{{ activity.time }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- View All Button -->
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <button class="w-full px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                            View All Activities
                        </button>
                    </div>
                </div>
            </div>

            <!-- Floating Action Button -->
            <div class="absolute bottom-6 right-6">
                <button class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-full shadow-lg hover:shadow-xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </button>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

const breadcrumbs = [{ title: 'Dashboard', href: '/dashboard' }]

const progress = [
    { name: 'Basic Info', progress: 100, complete: true },
    { name: 'Experience', progress: 75, complete: false },
    { name: 'Skills', progress: 90, complete: true },
    { name: 'Portfolio', progress: 50, complete: false }
]

const tasks = [
    { id: 1, title: 'Complete Portfolio', desc: 'Add 2 more projects', done: true },
    { id: 2, title: 'Update Skills', desc: 'Add certification badges', done: false },
    { id: 3, title: 'Schedule Interview', desc: 'Accenture - Technical', done: false }
]

const events = [
    { id: 1, title: 'Tech Career Fair', time: 'Today 2:00 PM • Meet top companies', icon: '📊', today: true },
    { id: 2, title: 'Mock Interview Session', time: 'Tomorrow 10:00 AM • Practice technical skills', icon: '💼', today: false },
    { id: 3, title: 'Networking Workshop', time: 'Friday 6:00 PM • Build connections', icon: '🤝', today: false }
]

const activities = [
    { id: 1, title: 'Application submitted', desc: 'Software Developer at Capgemini', time: '2h ago', icon: '✓', color: 'bg-green-500' },
    { id: 2, title: 'Profile viewed', desc: 'HR Manager from Accenture', time: '4h ago', icon: '👁', color: 'bg-blue-500' },
    { id: 3, title: 'Skill badge earned', desc: 'JavaScript Advanced certification', time: '1d ago', icon: '🏆', color: 'bg-yellow-500' },
    { id: 4, title: 'Interview scheduled', desc: 'Technical interview with delaware', time: '2d ago', icon: '📅', color: 'bg-purple-500' }
]
</script>