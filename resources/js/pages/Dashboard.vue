<template>
    <Head title="Dashboard" />
    
    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- Enhanced Welcome Section with Career Insights -->
        <div class="mb-8">
            <!-- Main Welcome Banner -->
            <div class="bg-gradient-to-r from-orange-500 via-red-500 to-pink-500 rounded-3xl p-8 text-white relative overflow-hidden mb-6">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10 flex justify-between items-center">
                    <div>
                        <h1 class="text-5xl font-bold mb-3">Welcome back, Maryam! 👋</h1>
                        <p class="text-xl text-orange-100 mb-4">Your career journey is accelerating</p>
                        <div class="flex items-center space-x-6">
                            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 flex items-center space-x-3">
                                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                                    <span class="text-2xl font-bold text-orange-500">MA</span>
                                </div>
                                <div>
                                    <div class="font-semibold">Maryam Afallah</div>
                                    <div class="text-orange-100 text-sm">Bachelor Toegepaste Informatica</div>
                                </div>
                            </div>
                            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                    <span class="text-sm">LinkedIn Connected</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="text-center">
                                <div class="text-4xl font-bold">15</div>
                                <div class="text-orange-100">Applications</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold">92%</div>
                                <div class="text-orange-100">Profile Complete</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold">347</div>
                                <div class="text-orange-100">Profile Views</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Floating elements -->
                <div class="absolute top-4 right-4 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
                <div class="absolute bottom-8 left-1/3 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
            </div>

            <!-- Quick Stats & Actions -->
            <div class="grid grid-cols-4 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300 hover:scale-105">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="text-green-500 text-sm font-medium">+23%</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">15</div>
                    <div class="text-gray-600 dark:text-gray-400 text-sm">Active Applications</div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300 hover:scale-105">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span class="text-blue-500 text-sm font-medium">+12</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">89</div>
                    <div class="text-gray-600 dark:text-gray-400 text-sm">Network Connections</div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300 hover:scale-105">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-purple-500 text-sm font-medium">+5</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">7.8</div>
                    <div class="text-gray-600 dark:text-gray-400 text-sm">Skill Score</div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300 hover:scale-105">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        <span class="text-green-500 text-sm font-medium">€2,400</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">€2,200</div>
                    <div class="text-gray-600 dark:text-gray-400 text-sm">Avg. Salary Target</div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid lg:grid-cols-3 gap-8 mb-8">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- CV & LinkedIn Integration -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Professional Profile</h3>
                        <div class="flex space-x-2">
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">CV Updated</span>
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">LinkedIn Synced</span>
                        </div>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- CV Section -->
                        <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-4 hover:border-orange-300 transition-colors">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900 dark:text-white">CV Afallah.M.docx</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">Last updated: Today</div>
                                    </div>
                                </div>
                                <button class="text-orange-600 hover:text-orange-800 text-sm font-medium">View</button>
                            </div>
                            <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                <div class="flex justify-between">
                                    <span>Work Experience</span>
                                    <span class="text-green-600">4 positions</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Education</span>
                                    <span class="text-green-600">Complete</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Skills</span>
                                    <span class="text-yellow-600">Needs update</span>
                                </div>
                            </div>
                            <button class="w-full mt-4 bg-orange-50 hover:bg-orange-100 text-orange-600 py-2 rounded-lg text-sm font-medium transition-colors">
                                Update CV
                            </button>
                        </div>

                        <!-- LinkedIn Section -->
                        <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-4 hover:border-blue-300 transition-colors">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900 dark:text-white">LinkedIn Profile</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">maryam-afallah-246977359</div>
                                    </div>
                                </div>
                                <a href="https://www.linkedin.com/in/maryam-afallah-246977359" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</a>
                            </div>
                            <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                <div class="flex justify-between">
                                    <span>Profile Views</span>
                                    <span class="text-green-600">+23 this week</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Connections</span>
                                    <span class="text-blue-600">89 contacts</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Post Engagement</span>
                                    <span class="text-purple-600">High</span>
                                </div>
                            </div>
                            <button class="w-full mt-4 bg-blue-50 hover:bg-blue-100 text-blue-600 py-2 rounded-lg text-sm font-medium transition-colors">
                                Sync LinkedIn
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Application Tracker -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Application Pipeline</h3>
                        <Link href="/applications" class="text-orange-600 hover:text-orange-800 text-sm font-medium">View All</Link>
                    </div>
                    
                    <!-- Application Flow Visualization -->
                    <div class="relative mb-6">
                        <div class="flex justify-between items-center">
                            <div v-for="(stage, index) in applicationStages" :key="stage.name" class="flex-1 text-center relative">
                                <div :class="stage.active ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400'" 
                                     class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2 text-sm font-bold transition-all duration-300">
                                    {{ stage.count }}
                                </div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ stage.name }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">{{ stage.percentage }}%</div>
                                <div v-if="index < applicationStages.length - 1" class="absolute top-6 left-1/2 w-full h-0.5 bg-gray-200 dark:bg-gray-700 -z-10"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Applications -->
                    <div class="space-y-3">
                        <div v-for="app in recentApplications" :key="app.id" class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                            <div class="flex items-center space-x-4">
                                <img :src="app.company.logo" :alt="app.company.name" class="w-12 h-12 rounded-lg object-cover">
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-white">{{ app.position }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ app.company.name }} • Applied {{ app.appliedDays }} days ago</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span :class="getStatusColor(app.status)" class="px-3 py-1 rounded-full text-xs font-medium">
                                    {{ app.status }}
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

                <!-- Skills Development -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Skills Development</h3>
                        <button class="text-orange-600 hover:text-orange-800 text-sm font-medium">Take Assessment</button>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Current Skills -->
                        <div>
                            <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Current Skills</h4>
                            <div class="space-y-3">
                                <div v-for="skill in currentSkills" :key="skill.name" class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ skill.name }}</span>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-20 h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
                                            <div :class="getSkillColor(skill.level)" class="h-2 rounded-full transition-all duration-300" :style="{width: skill.level + '%'}"></div>
                                        </div>
                                        <span class="text-xs text-gray-500 w-8">{{ skill.level }}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recommended Skills -->
                        <div>
                            <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Recommended Skills</h4>
                            <div class="space-y-3">
                                <div v-for="skill in recommendedSkills" :key="skill.name" class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ skill.name }}</div>
                                        <div class="text-xs text-gray-600 dark:text-gray-400">{{ skill.demand }}% demand in your field</div>
                                    </div>
                                    <button class="bg-orange-100 hover:bg-orange-200 text-orange-600 px-3 py-1 rounded-lg text-xs font-medium transition-colors">
                                        Learn
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Career Goals Tracker -->
                <div class="bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 rounded-2xl p-6 border border-purple-200 dark:border-purple-800">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Career Goals</h3>
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div v-for="goal in careerGoals" :key="goal.id" class="bg-white dark:bg-gray-800 rounded-xl p-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="font-medium text-gray-900 dark:text-white">{{ goal.title }}</div>
                                <span class="text-sm text-purple-600 font-medium">{{ goal.progress }}%</span>
                            </div>
                            <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full mb-2">
                                <div class="h-2 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full transition-all duration-300" :style="{width: goal.progress + '%'}"></div>
                            </div>
                            <div class="text-xs text-gray-600 dark:text-gray-400">{{ goal.description }}</div>
                        </div>
                    </div>
                </div>

                <!-- Networking Recommendations -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Networking</h3>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</button>
                    </div>
                    <div class="space-y-4">
                        <div v-for="person in networkingSuggestions" :key="person.id" class="flex items-center space-x-3 p-3 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                            <img :src="person.avatar" :alt="person.name" class="w-12 h-12 rounded-full object-cover">
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 dark:text-white text-sm">{{ person.name }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">{{ person.position }}</div>
                                <div class="text-xs text-blue-600">{{ person.mutualConnections }} mutual connections</div>
                            </div>
                            <button class="bg-blue-100 hover:bg-blue-200 text-blue-600 px-3 py-1 rounded-lg text-xs font-medium transition-colors">
                                Connect
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Upcoming Events</h3>
                        <span class="text-sm text-gray-600 dark:text-gray-400">June 2025</span>
                    </div>
                    <div class="space-y-4">
                        <div v-for="event in upcomingEvents" :key="event.id" class="flex items-start space-x-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors"
                             :class="event.isToday ? 'bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 border border-orange-200 dark:border-orange-800' : ''">
                            <div :class="event.isToday ? 'bg-gradient-to-r from-orange-500 to-red-500' : 'bg-gradient-to-r from-blue-500 to-indigo-500'" 
                                 class="w-10 h-10 rounded-lg flex items-center justify-center text-white text-lg font-bold">
                                {{ event.icon }}
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 dark:text-white text-sm">{{ event.title }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">{{ event.time }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-500">{{ event.location }}</div>
                            </div>
                            <div v-if="event.isToday" class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-2xl p-6 border border-green-200 dark:border-green-800">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <button class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all text-left">
                            <div class="text-2xl mb-1">🔍</div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">Search Jobs</div>
                        </button>
                        <button class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all text-left">
                            <div class="text-2xl mb-1">📝</div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">Update CV</div>
                        </button>
                        <button class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all text-left">
                            <div class="text-2xl mb-1">🤝</div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">Network</div>
                        </button>
                        <button class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all text-left">
                            <div class="text-2xl mb-1">📊</div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">Analytics</div>
                        </button>
                        <a href="https://github.com/Mry-af7/Progammering-Project.git" target="_blank" class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all text-left">
                            <div class="text-2xl mb-1">🐙</div>
                            <div class="text-sm font-medium text-gray-900 dark:text-white">GitHub Repo</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Action Button -->
        <div class="fixed bottom-6 right-6 z-50">
            <div class="relative group">
                <button class="w-14 h-14 bg-gradient-to-r from-orange-500 to-red-500 rounded-full shadow-lg hover:shadow-xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </button>
                
                <!-- Quick Menu -->
                <div class="absolute bottom-16 right-0 w-48 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                    <div class="p-2">
                        <button class="w-full text-left px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 text-sm text-gray-700 dark:text-gray-300 transition-colors">
                            📝 Quick Apply
                        </button>
                        <button class="w-full text-left px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 text-sm text-gray-700 dark:text-gray-300 transition-colors">
                            📅 Schedule Meeting
                        </button>
                        <button class="w-full text-left px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 text-sm text-gray-700 dark:text-gray-300 transition-colors">
                            💬 Send Message
                        </button>
                        <button class="w-full text-left px-4 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 text-sm text-gray-700 dark:text-gray-300 transition-colors">
                            🎯 Set Goal
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

const breadcrumbs = [
    { title: 'Home', href: '/' },
    { title: 'Info', href: '/info' },
    { title: 'Bedrijven', href: '/bedrijven' },
    { title: 'Afspraak', href: '/afspraak' },
    { title: 'Contact', href: '/contact' },
];

// Application stages for pipeline visualization
const applicationStages = [
    { name: 'Applied', count: 15, percentage: 100, active: true },
    { name: 'Reviewing', count: 8, percentage: 53, active: true },
    { name: 'Interview', count: 3, percentage: 20, active: true },
    { name: 'Offer', count: 1, percentage: 7, active: false }
]

// Recent applications
const recentApplications = [
    {
        id: 1,
        position: 'Junior Software Developer',
        company: { name: 'Capgemini', logo: '/images/logos/capgemini-logo.svg' },
        status: 'Interview Scheduled' as ApplicationStatus,
        appliedDays: 3
    },
    {
        id: 2,
        position: 'Frontend Developer',
        company: { name: 'Accenture', logo: '/images/logos/accenture-logo.svg' },
        status: 'Under Review' as ApplicationStatus,
        appliedDays: 5
    },
    {
        id: 3,
        position: 'Web Developer',
        company: { name: 'delaware', logo: '/images/logos/delaware-logo.svg' },
        status: 'Application Sent' as ApplicationStatus,
        appliedDays: 1
    }
]

// Current skills
const currentSkills = [
    { name: 'JavaScript', level: 75 },
    { name: 'HTML/CSS', level: 85 },
    { name: 'Java', level: 60 },
    { name: 'Microsoft Office', level: 90 },
    { name: 'French', level: 100 },
    { name: 'Dutch', level: 85 }
]

// Recommended skills
const recommendedSkills = [
    { name: 'React.js', demand: 89 },
    { name: 'Node.js', demand: 76 },
    { name: 'Python', demand: 83 },
    { name: 'SQL', demand: 71 }
]

// Career goals
const careerGoals = [
    {
        id: 1,
        title: 'Land First Developer Job',
        description: 'Secure a junior developer position by July 2025',
        progress: 65
    },
    {
        id: 2,
        title: 'Build Professional Network',
        description: 'Connect with 100+ industry professionals',
        progress: 45
    },
    {
        id: 3,
        title: 'Complete Portfolio',
        description: 'Showcase 5 professional projects',
        progress: 80
    }
]

// Networking suggestions
const networkingSuggestions = [
    {
        id: 1,
        name: 'Sarah De Vos',
        position: 'Senior Developer at Capgemini',
        avatar: '/images/avatar-1.jpg',
        mutualConnections: 3
    },
    {
        id: 2,
        name: 'Thomas Janssens',
        position: 'HR Manager at Accenture',
        avatar: '/images/avatar-2.jpg',
        mutualConnections: 1
    },
    {
        id: 3,
        name: 'Marie Dupont',
        position: 'Tech Lead at delaware',
        avatar: '/images/avatar-3.jpg',
        mutualConnections: 2
    }
]

// Upcoming events
const upcomingEvents = [
    {
        id: 1,
        title: 'Tech Career Fair',
        time: 'Today 2:00 PM',
        location: 'Erasmushogeschool Brussels',
        icon: '📊',
        isToday: true
    },
    {
        id: 2,
        title: 'Mock Interview Session',
        time: 'Tomorrow 10:00 AM',
        location: 'Online',
        icon: '💼',
        isToday: false
    },
    {
        id: 3,
        title: 'Networking Workshop',
        time: 'Friday 6:00 PM',
        location: 'Brussels',
        icon: '🤝',
        isToday: false
    }
]

// Helper functions
type ApplicationStatus = 'Interview Scheduled' | 'Under Review' | 'Application Sent' | 'Offer' | 'Rejected';

const getStatusColor = (status: ApplicationStatus) => {
    const colors: Record<ApplicationStatus, string> = {
        'Interview Scheduled': 'bg-yellow-100 text-yellow-800',
        'Under Review': 'bg-blue-100 text-blue-800',
        'Application Sent': 'bg-gray-100 text-gray-800',
        'Offer': 'bg-green-100 text-green-800',
        'Rejected': 'bg-red-100 text-red-800'
    }
    return colors[status] || 'bg-gray-100 text-gray-800'
}

const getSkillColor = (level: number) => {
    if (level >= 80) return 'bg-gradient-to-r from-green-500 to-emerald-500'
    if (level >= 60) return 'bg-gradient-to-r from-yellow-500 to-orange-500'
    return 'bg-gradient-to-r from-red-500 to-pink-500'
}
</script>