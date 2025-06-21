<template>
    <Head title="Company Dashboard" />
    
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
            <!-- Professional Header with subtle color accents -->
            <div class="bg-gradient-to-r from-slate-50 via-blue-50/30 to-indigo-50/30 dark:from-gray-800 dark:via-slate-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex flex-col lg:flex-row items-start justify-between gap-8">
                        <div class="flex items-center space-x-6">
                            <!-- Company Logo/Avatar -->
                            <div class="relative">
                                <div v-if="company.logo_url" class="w-20 h-20 bg-white dark:bg-gray-700 rounded-xl overflow-hidden border-2 border-blue-100 dark:border-blue-900/30 shadow-md">
                                    <img 
                                        :src="company.logo_url" 
                                        :alt="company.name + ' Logo'"
                                        class="w-full h-full object-contain p-2"
                                    />
                                </div>
                                <div v-else class="w-20 h-20 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-2xl font-bold text-white border-2 border-blue-100 dark:border-blue-900/30 shadow-md">
                                    {{ getInitials() }}
                                </div>
                                <!-- Status indicator -->
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-emerald-500 rounded-full border-2 border-white dark:border-gray-800 shadow-md">
                                    <div class="w-2 h-2 bg-white rounded-full mx-auto mt-1"></div>
                                </div>
                            </div>
                            
                            <!-- Company Information -->
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                                    {{ displayName }}
                                </h1>
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-300 mb-3">
                                    <span v-if="company?.industry?.name" class="flex items-center gap-2 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 px-3 py-1 rounded-full border border-blue-200 dark:border-blue-800">
                                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                        {{ company.industry.name }}
                                    </span>
                                    <span v-if="company?.company_size?.label" class="flex items-center gap-2 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 px-3 py-1 rounded-full border border-emerald-200 dark:border-emerald-800">
                                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                        {{ company.company_size.label }}
                                    </span>
                                    <span v-if="company?.headquarters" class="flex items-center gap-2 bg-gradient-to-r from-violet-50 to-purple-50 dark:from-violet-900/20 dark:to-purple-900/20 px-3 py-1 rounded-full border border-violet-200 dark:border-violet-800">
                                        <span class="w-2 h-2 bg-violet-500 rounded-full"></span>
                                        {{ company.headquarters }}
                                    </span>
                                </div>
                                <!-- Profile completion indicator -->
                                <div v-if="profileCompleteness < 100" class="flex items-center gap-3">
                                    <div class="flex-1 max-w-xs">
                                        <div class="flex items-center justify-between text-xs text-gray-600 dark:text-gray-400 mb-1">
                                            <span>Profile completion</span>
                                            <span class="font-medium">{{ profileCompleteness }}%</span>
                                        </div>
                                        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                            <div class="h-full bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 rounded-full transition-all duration-500"
                                                 :style="{ width: profileCompleteness + '%' }"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Key Metrics Cards -->
                        <div class="grid grid-cols-3 gap-6">
                            <div class="bg-gradient-to-br from-white to-blue-50/50 dark:from-gray-800 dark:to-blue-900/10 rounded-lg p-4 text-center border border-blue-100 dark:border-blue-900/30 shadow-sm">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ activeJobsCount }}</div>
                                <div class="text-sm text-blue-600 dark:text-blue-400 font-medium">Active Jobs</div>
                            </div>
                            <div class="bg-gradient-to-br from-white to-indigo-50/50 dark:from-gray-800 dark:to-indigo-900/10 rounded-lg p-4 text-center border border-indigo-100 dark:border-indigo-900/30 shadow-sm">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ company?.technologies?.length || 0 }}</div>
                                <div class="text-sm text-indigo-600 dark:text-indigo-400 font-medium">Technologies</div>
                            </div>
                            <div class="bg-gradient-to-br from-white to-emerald-50/50 dark:from-gray-800 dark:to-emerald-900/10 rounded-lg p-4 text-center border border-emerald-100 dark:border-emerald-900/30 shadow-sm">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ applicationCount }}</div>
                                <div class="text-sm text-emerald-600 dark:text-emerald-400 font-medium">Applications</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <div class="sticky top-0 z-20 bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm border-b border-gray-200 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <nav class="flex space-x-8">
                        <button 
                            v-for="link in navigationLinks" 
                            :key="link.id"
                            @click="setActiveSection(link.id)"
                            :class="[
                                'py-4 px-2 border-b-2 font-medium text-sm transition-colors duration-200',
                                activeSection === link.id
                                    ? 'border-blue-500 text-blue-600 dark:text-blue-400'
                                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'
                            ]"
                        >
                            {{ link.name }}
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Profile Completion Alert -->
                <div v-if="profileCompleteness < 100 && activeSection === 'overview'" class="mb-8">
                    <div class="bg-gradient-to-r from-amber-50 via-orange-50 to-amber-50 dark:from-amber-900/20 dark:via-orange-900/20 dark:to-amber-900/20 border border-amber-200 dark:border-amber-700 rounded-lg p-4 shadow-sm">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gradient-to-br from-amber-400 to-orange-500 rounded-full flex items-center justify-center">
                                    <svg class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <h3 class="text-sm font-medium text-amber-800 dark:text-amber-200">Complete your company profile</h3>
                                <p class="mt-1 text-sm text-amber-700 dark:text-amber-300">Your profile is {{ profileCompleteness }}% complete. A complete profile helps attract better candidates and improves your visibility.</p>
                                <div class="mt-3">
                                    <Link href="/company/onboarding/step/1" class="text-sm font-medium text-amber-700 hover:text-amber-600 dark:text-amber-300 dark:hover:text-amber-200 hover:underline">
                                        Complete profile →
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Overview Section -->
                <div v-if="activeSection === 'overview'">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Main Content Area -->
                        <div class="lg:col-span-2 space-y-8">
                            <!-- Company Description -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">About {{ displayName }}</h3>
                                        <Link v-if="!company?.description" href="/company/onboarding/step/2" class="text-sm text-blue-600 hover:text-blue-500 dark:text-blue-400">
                                            Add description
                                        </Link>
                                    </div>
                                    <div v-if="company?.description" class="prose dark:prose-invert max-w-none">
                                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ company.description }}</p>
                                    </div>
                                    <div v-else class="text-center py-8">
                                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </div>
                                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Add company description</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Tell potential candidates about your company's mission, values, and culture.</p>
                                        <Link href="/company/onboarding/step/2" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                                            Add Description
                                        </Link>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <button class="bg-gradient-to-br from-white to-blue-50/70 dark:from-gray-800 dark:to-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-900/30 p-6 hover:shadow-md hover:border-blue-200 dark:hover:border-blue-800 transition-all text-left group">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center group-hover:from-blue-600 group-hover:to-blue-700 transition-all shadow-sm">
                                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 00-2 2h-4a2 2 0 00-2-2V6m8 0h2a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h2" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Post a Job</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Create and publish job openings</p>
                                        </div>
                                    </div>
                                </button>

                                <button class="bg-gradient-to-br from-white to-emerald-50/70 dark:from-gray-800 dark:to-emerald-900/20 rounded-lg border border-emerald-100 dark:border-emerald-900/30 p-6 hover:shadow-md hover:border-emerald-200 dark:hover:border-emerald-800 transition-all text-left group">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center group-hover:from-emerald-600 group-hover:to-emerald-700 transition-all shadow-sm">
                                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-medium text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">View Analytics</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Track hiring performance metrics</p>
                                        </div>
                                    </div>
                                </button>
                            </div>

                            <!-- Technology Preview -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Technology Stack</h3>
                                        <button @click="setActiveSection('technologies')" class="text-sm text-blue-600 hover:text-blue-500 dark:text-blue-400">
                                            View all →
                                        </button>
                                    </div>
                                    <div v-if="company?.technologies && company.technologies.length > 0" class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                        <div v-for="tech in company.technologies.slice(0, 4)" 
                                             :key="tech.id"
                                             class="bg-gradient-to-br from-slate-50 to-indigo-50/50 dark:from-gray-700 dark:to-indigo-900/20 rounded-lg p-3 text-center border border-slate-200 dark:border-indigo-900/30 hover:shadow-sm transition-all">
                                            <div class="text-lg mb-1">{{ tech.icon || '💻' }}</div>
                                            <div class="text-xs font-medium text-gray-700 dark:text-gray-300 truncate">{{ tech.name }}</div>
                                        </div>
                                        <div v-if="company.technologies.length > 4" class="bg-gradient-to-br from-slate-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 rounded-lg p-3 text-center border border-slate-200 dark:border-gray-600 flex items-center justify-center">
                                            <span class="text-xs text-slate-600 dark:text-slate-400 font-medium">+{{ company.technologies.length - 4 }} more</span>
                                        </div>
                                    </div>
                                    <div v-else class="text-center py-4">
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">No technologies added yet</p>
                                        <Link href="/company/onboarding/step/3" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-blue-600 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/30 dark:hover:bg-blue-900/50">
                                            Add Technologies
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="space-y-6">
                            <!-- Company Details -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Company Details</h3>
                                    <div class="space-y-4">
                                        <div v-if="company?.industry">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Industry</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ company.industry.name }}</dd>
                                        </div>
                                        <div v-if="company?.company_size">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Company Size</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ company.company_size.label }}</dd>
                                        </div>
                                        <div v-if="company?.remote_policy">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Work Policy</dt>
                                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ getRemotePolicyLabel(company.remote_policy) }}</dd>
                                        </div>
                                        <div v-if="company?.website">
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Website</dt>
                                            <dd class="mt-1">
                                                <a :href="company.website" target="_blank" class="text-sm text-blue-600 hover:text-blue-500 dark:text-blue-400 hover:underline">
                                                    Visit website →
                                                </a>
                                            </dd>
                                        </div>
                                        <div v-if="!company?.industry && !company?.company_size && !company?.remote_policy && !company?.website" class="text-center py-4">
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">No details added yet</p>
                                            <Link href="/company/onboarding/step/1" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-blue-600 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/30 dark:hover:bg-blue-900/50">
                                                Add Details
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Activity -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Activity</h3>
                                    <div class="text-center py-4">
                                        <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">No recent activity</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Technologies Section -->
                <div v-else-if="activeSection === 'technologies'">
                    <div class="mb-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Technology Stack</h2>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Showcase the technologies your team works with</p>
                            </div>
                            <Link href="/company/onboarding/step/3" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                                Add Technologies
                            </Link>
                        </div>
                    </div>

                    <div v-if="company?.technologies && company.technologies.length > 0" 
                         class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <div v-for="tech in company.technologies" 
                             :key="tech.id"
                             class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center space-x-3">
                                <span class="text-2xl">{{ tech.icon || '💻' }}</span>
                                <h3 class="font-medium text-gray-900 dark:text-white">{{ tech.name }}</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div v-else class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No technologies added</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Add technologies to showcase your tech stack to potential candidates.</p>
                        <Link href="/company/onboarding/step/3" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                            Add Technologies
                        </Link>
                    </div>
                </div>

                <!-- Saved Profiles Section -->
                <div v-else-if="activeSection === 'saved'">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Saved Profiles</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Students you've bookmarked for future opportunities</p>
                    </div>

                    <!-- Saved Students Grid -->
                    <div v-if="savedStudents && savedStudents.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div v-for="student in savedStudents" 
                             :key="student.id"
                             class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-all p-6 group relative">
                            
                            <!-- Saved Badge -->
                            <div class="absolute top-4 right-4">
                                <div class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-2 py-1 rounded-full text-xs font-medium flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    Saved
                                </div>
                            </div>
                            
                            <!-- Student Header -->
                            <div class="flex items-center space-x-4 mb-4 pr-16">
                                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-600 rounded-xl flex items-center justify-center text-xl font-bold text-white">
                                    {{ getStudentInitials(student.name) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">
                                        {{ student.name || 'Student' }}
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ student.major || 'Not specified' }}
                                        <span v-if="student.year_of_study" class="mx-1">•</span>
                                        {{ student.year_of_study }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Student Bio -->
                            <div v-if="student.about_me" class="mb-4">
                                <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-3">
                                    {{ student.about_me }}
                                </p>
                            </div>
                            
                            <!-- Skills Preview -->
                            <div v-if="student.skills && student.skills.length > 0" class="mb-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Skills</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span v-for="skill in student.skills.slice(0, 4)" 
                                          :key="skill.name"
                                          class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                        <span class="mr-1">{{ getSkillIcon(skill.name) }}</span>
                                        {{ skill.name }}
                                    </span>
                                    <span v-if="student.skills.length > 4" 
                                          class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                        +{{ student.skills.length - 4 }} more
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Languages -->
                            <div v-if="student.languages && student.languages.length > 0" class="mb-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Languages</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span v-for="language in student.languages.slice(0, 3)" 
                                          :key="language.name"
                                          class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                        {{ language.name }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Save Date -->
                            <div class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                                Saved {{ new Date(student.pivot?.created_at || Date.now()).toLocaleDateString() }}
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex items-center space-x-3 text-sm text-gray-500 dark:text-gray-400">
                                    <span v-if="student.portfolios?.length" class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                        {{ student.portfolios.length }} project{{ student.portfolios.length !== 1 ? 's' : '' }}
                                    </span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button 
                                        @click="viewStudentProfile(student)"
                                        class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                        View Profile
                                    </button>
                                    <button 
                                        @click="unsaveStudent(student)"
                                        class="inline-flex items-center px-3 py-1.5 border border-red-300 dark:border-red-600 text-sm font-medium rounded-md text-red-700 dark:text-red-300 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 transition-all">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Empty State for Saved Profiles -->
                    <div v-else class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No saved profiles yet</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Start browsing students and save the ones you're interested in for easy access later.</p>
                        <button 
                            @click="setActiveSection('students')"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 transition-all">
                            Browse Students
                        </button>
                    </div>
                </div>
                <div v-else-if="activeSection === 'students'">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Find Students</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Search and discover talented students for your opportunities</p>
                    </div>

                    <!-- Search and Filters -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm p-6 mb-8">
                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                            <!-- Search Input -->
                            <div class="lg:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search Students</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input 
                                        v-model="searchQuery"
                                        type="text" 
                                        placeholder="Search by name, major, or skills..."
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    />
                                </div>
                            </div>
                            
                            <!-- Major Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Major</label>
                                <select 
                                    v-model="selectedFilters.major"
                                    class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                >
                                    <option value="">All Majors</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Software Engineering">Software Engineering</option>
                                    <option value="Information Technology">Information Technology</option>
                                    <option value="Data Science">Data Science</option>
                                    <option value="Cybersecurity">Cybersecurity</option>
                                </select>
                            </div>
                            
                            <!-- Year Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Year</label>
                                <select 
                                    v-model="selectedFilters.yearOfStudy"
                                    class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                >
                                    <option value="">All Years</option>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                    <option value="Graduate">Graduate</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Filter Actions -->
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                <span>{{ filteredStudents.length }} student{{ filteredStudents.length !== 1 ? 's' : '' }} found</span>
                            </div>
                            <button 
                                @click="clearFilters"
                                class="text-sm text-blue-600 hover:text-blue-500 dark:text-blue-400 font-medium"
                            >
                                Clear filters
                            </button>
                        </div>
                    </div>

                    <!-- Students Grid -->
                    <div v-if="filteredStudents.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div v-for="student in filteredStudents" 
                             :key="student.id"
                             class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-all p-6 group">
                            
                            <!-- Student Header -->
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ getStudentInitials(student.name) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">
                                        {{ student.name || 'Student' }}
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ student.major || 'Not specified' }}
                                        <span v-if="student.year_of_study" class="mx-1">•</span>
                                        {{ student.year_of_study }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Student Bio -->
                            <div v-if="student.about_me" class="mb-4">
                                <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-3">
                                    {{ student.about_me }}
                                </p>
                            </div>
                            
                            <!-- Skills Preview -->
                            <div v-if="student.skills && student.skills.length > 0" class="mb-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Skills</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span v-for="skill in student.skills.slice(0, 4)" 
                                          :key="skill.name"
                                          class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                        <span class="mr-1">{{ getSkillIcon(skill.name) }}</span>
                                        {{ skill.name }}
                                    </span>
                                    <span v-if="student.skills.length > 4" 
                                          class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                        +{{ student.skills.length - 4 }} more
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Languages -->
                            <div v-if="student.languages && student.languages.length > 0" class="mb-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Languages</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span v-for="language in student.languages.slice(0, 3)" 
                                          :key="language.name"
                                          class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                        {{ language.name }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex items-center space-x-3 text-sm text-gray-500 dark:text-gray-400">
                                    <span v-if="student.portfolios?.length" class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                        {{ student.portfolios.length }} project{{ student.portfolios.length !== 1 ? 's' : '' }}
                                    </span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button 
                                        @click="viewStudentProfile(student)"
                                        class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                        View Profile
                                    </button>
                                    <button 
                                        @click="isStudentSaved(student.id) ? unsaveStudent(student) : saveStudent(student)"
                                        :class="[
                                            'inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition-all',
                                            isStudentSaved(student.id) 
                                                ? 'border border-red-300 dark:border-red-600 text-red-700 dark:text-red-300 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30'
                                                : 'border border-transparent text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700'
                                        ]">
                                        <svg class="w-4 h-4 mr-1" :fill="isStudentSaved(student.id) ? 'currentColor' : 'none'" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                        {{ isStudentSaved(student.id) ? 'Saved' : 'Save' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Empty State -->
                    <div v-else class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                            {{ searchQuery || selectedFilters.major || selectedFilters.yearOfStudy ? 'No students found' : 'No students available' }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                            {{ searchQuery || selectedFilters.major || selectedFilters.yearOfStudy 
                                ? 'Try adjusting your search criteria or filters.' 
                                : 'Students will appear here once they join the platform.' }}
                        </p>
                        <button v-if="searchQuery || selectedFilters.major || selectedFilters.yearOfStudy"
                                @click="clearFilters" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                            Clear Filters
                        </button>
                    </div>
                </div>
                <div v-else-if="activeSection === 'jobs'">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Job Postings</h2>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your open positions</p>
                        </div>
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                            Post New Job
                        </button>
                    </div>

                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 00-2 2h-4a2 2 0 00-2-2V6m8 0h2a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h2" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No job postings yet</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Create your first job posting to start finding great candidates.</p>
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                            Post Your First Job
                        </button>
                    </div>
                </div>

                <!-- Profile Section -->
                <div v-else-if="activeSection === 'profile'">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Company Profile</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your company information and settings</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Profile Information -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Company Information</h3>
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Company Name</label>
                                        <p class="text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded-md border border-gray-200 dark:border-gray-600">
                                            {{ company?.name || 'Not provided' }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                                        <p class="text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded-md border border-gray-200 dark:border-gray-600">
                                            {{ company?.email || user?.email || 'Not provided' }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Industry</label>
                                        <p class="text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded-md border border-gray-200 dark:border-gray-600">
                                            {{ company?.industry?.name || 'Not provided' }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Headquarters</label>
                                        <p class="text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded-md border border-gray-200 dark:border-gray-600">
                                            {{ company?.headquarters || 'Not provided' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Actions -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Profile Management</h3>
                                <div class="space-y-3">
                                    <Link href="/company/onboarding/step/1" class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center group-hover:bg-blue-200 dark:group-hover:bg-blue-900/50 transition-colors">
                                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-2m-2 0H7m5 0v-2a2 2 0 01-2-2v-4a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v2" />
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="font-medium text-gray-900 dark:text-white">Basic Information</span>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Company name, industry, size</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </Link>
                                    
                                    <Link href="/company/onboarding/step/2" class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center group-hover:bg-purple-200 dark:group-hover:bg-purple-900/50 transition-colors">
                                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="font-medium text-gray-900 dark:text-white">Company Details</span>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Description, culture, policies</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </Link>
                                    
                                    <Link href="/company/onboarding/step/3" class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center group-hover:bg-orange-200 dark:group-hover:bg-orange-900/50 transition-colors">
                                                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="font-medium text-gray-900 dark:text-white">Technology Stack</span>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Technologies and tools used</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </Link>
                                    
                                    <Link href="/company/onboarding/step/4" class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center group-hover:bg-green-200 dark:group-hover:bg-green-900/50 transition-colors">
                                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="font-medium text-gray-900 dark:text-white">Benefits & Perks</span>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Employee benefits and perks</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </Link>

                                    <Link href="/company/onboarding/step/5" class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-pink-100 dark:bg-pink-900/30 rounded-lg flex items-center justify-center group-hover:bg-pink-200 dark:group-hover:bg-pink-900/50 transition-colors">
                                                <svg class="w-5 h-5 text-pink-600 dark:text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="font-medium text-gray-900 dark:text-white">Media & Branding</span>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Logo and visual identity</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Profile Modal -->
            <div v-if="showStudentModal && selectedStudent" 
                 class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4"
                 @click="closeStudentModal">
                <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto"
                     @click.stop>
                    <!-- Modal Header -->
                    <div class="bg-gradient-to-r from-slate-50 via-indigo-50/30 to-purple-50/30 dark:from-gray-700 dark:via-slate-700 dark:to-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600 sticky top-0 z-10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-600 rounded-xl flex items-center justify-center text-xl font-bold text-white">
                                    {{ getStudentInitials(selectedStudent.name) }}
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ selectedStudent.name || 'Student' }}</h2>
                                    <p class="text-gray-600 dark:text-gray-300">
                                        {{ selectedStudent.major || 'Not specified' }}
                                        <span v-if="selectedStudent.year_of_study" class="mx-2">•</span>
                                        {{ selectedStudent.year_of_study }}
                                    </p>
                                </div>
                            </div>
                            <button @click="closeStudentModal" 
                                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Content -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- Main Content -->
                            <div class="lg:col-span-2 space-y-6">
                                <!-- About Section -->
                                <div class="bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700 dark:to-slate-700 rounded-lg p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center text-white mr-3">
                                            👤
                                        </div>
                                        About
                                    </h3>
                                    <p v-if="selectedStudent.about_me" class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                        {{ selectedStudent.about_me }}
                                    </p>
                                    <p v-else class="text-gray-500 dark:text-gray-400 italic">No bio provided</p>
                                </div>

                                <!-- Skills Section -->
                                <div v-if="selectedStudent.skills && selectedStudent.skills.length > 0" 
                                     class="bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700 dark:to-slate-700 rounded-lg p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center text-white mr-3">
                                            ⚡
                                        </div>
                                        Technical Skills
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div v-for="skill in selectedStudent.skills" 
                                             :key="skill.id"
                                             class="bg-white dark:bg-gray-600 rounded-lg p-4 border border-gray-200 dark:border-gray-500">
                                            <div class="flex items-center justify-between mb-3">
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-xl">{{ getSkillIcon(skill.name) }}</span>
                                                    <span class="font-medium text-gray-900 dark:text-white">{{ skill.name }}</span>
                                                </div>
                                            </div>
                                            <div class="w-full bg-gray-200 dark:bg-gray-500 rounded-full h-2">
                                                <div class="h-2 rounded-full bg-gradient-to-r from-blue-400 to-blue-500"
                                                     style="width: 80%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Portfolio Section -->
                                <div v-if="selectedStudent.portfolios && selectedStudent.portfolios.length > 0" 
                                     class="bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700 dark:to-slate-700 rounded-lg p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center text-white mr-3">
                                            💼
                                        </div>
                                        Portfolio Projects
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div v-for="project in selectedStudent.portfolios" 
                                             :key="project.id"
                                             class="bg-white dark:bg-gray-600 rounded-lg p-4 border border-gray-200 dark:border-gray-500">
                                            <h4 class="font-semibold text-gray-900 dark:text-white mb-2">{{ project.name }}</h4>
                                            <a v-if="project.url" 
                                               :href="project.url" 
                                               target="_blank"
                                               class="inline-flex items-center text-sm text-blue-600 hover:text-blue-500 dark:text-blue-400">
                                                View Project
                                                <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sidebar -->
                            <div class="space-y-6">
                                <!-- Contact Information -->
                                <div class="bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700 dark:to-slate-700 rounded-lg p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center text-white mr-3">
                                            🔗
                                        </div>
                                        Connect
                                    </h3>
                                    <div class="space-y-3">
                                        <div v-if="selectedStudent.email" class="flex items-center space-x-3 p-3 bg-white dark:bg-gray-600 rounded-lg">
                                            <div class="w-8 h-8 bg-gray-500 rounded-lg flex items-center justify-center text-white text-sm">
                                                📧
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">Email</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ selectedStudent.email }}</p>
                                            </div>
                                        </div>
                                        
                                        <a v-if="selectedStudent.linkedin_url" 
                                           :href="selectedStudent.linkedin_url" 
                                           target="_blank"
                                           class="flex items-center space-x-3 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors group">
                                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white text-sm">
                                                💼
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">LinkedIn</p>
                                                <p class="text-sm text-blue-600 dark:text-blue-400">View Profile</p>
                                            </div>
                                            <svg class="w-4 h-4 text-blue-600 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>

                                        <a v-if="selectedStudent.github_link" 
                                           :href="selectedStudent.github_link" 
                                           target="_blank"
                                           class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-600/20 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600/30 transition-colors group">
                                            <div class="w-8 h-8 bg-gray-800 dark:bg-gray-200 rounded-lg flex items-center justify-center text-white dark:text-gray-800 text-sm">
                                                🐙
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">GitHub</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">View Code</p>
                                            </div>
                                            <svg class="w-4 h-4 text-gray-600 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>

                                        <a v-if="selectedStudent.custom_link_url" 
                                           :href="selectedStudent.custom_link_url" 
                                           target="_blank"
                                           class="flex items-center space-x-3 p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors group">
                                            <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center text-white text-sm">
                                                🌐
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ selectedStudent.custom_link_title || 'Website' }}</p>
                                                <p class="text-sm text-purple-600 dark:text-purple-400">Visit Site</p>
                                            </div>
                                            <svg class="w-4 h-4 text-purple-600 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <!-- Languages -->
                                <div v-if="selectedStudent.languages && selectedStudent.languages.length > 0" 
                                     class="bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700 dark:to-slate-700 rounded-lg p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center text-white mr-3">
                                            🌍
                                        </div>
                                        Languages
                                    </h3>
                                    <div class="space-y-3">
                                        <div v-for="language in selectedStudent.languages" 
                                             :key="language.id"
                                             class="bg-white dark:bg-gray-600 rounded-lg p-3">
                                            <div class="flex items-center justify-between mb-2">
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-lg">{{ getLanguageFlag(language.name) }}</span>
                                                    <span class="font-medium text-gray-900 dark:text-white">{{ language.name }}</span>
                                                </div>
                                                <span class="text-sm font-medium text-emerald-600 dark:text-emerald-400">
                                                    {{ language.pivot?.fluency_level || 'Basic' }}
                                                </span>
                                            </div>
                                            <div class="w-full bg-green-200 dark:bg-green-700 rounded-full h-2">
                                                <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-2 rounded-full transition-all duration-500"
                                                     :style="{ width: getLanguageProficiencyWidth(language.pivot?.fluency_level || 'Basic') }"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hobbies -->
                                <div v-if="selectedStudent.hobbies && selectedStudent.hobbies.length > 0" 
                                     class="bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700 dark:to-slate-700 rounded-lg p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center text-white mr-3">
                                            🎯
                                        </div>
                                        Hobbies & Interests
                                    </h3>
                                    <div class="grid grid-cols-1 gap-2">
                                        <div v-for="hobby in selectedStudent.hobbies" 
                                             :key="hobby.id"
                                             class="bg-white dark:bg-gray-600 rounded-lg p-3 flex items-center space-x-3">
                                            <span class="text-lg">{{ getHobbyIcon(hobby.name) }}</span>
                                            <span class="font-medium text-gray-900 dark:text-white">{{ hobby.name }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700 dark:to-slate-700 rounded-lg p-6">
                                    <div class="space-y-3">
                                        <button class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 transition-all">
                                            Send Message
                                        </button>
                                        <button 
                                            @click="isStudentSaved(selectedStudent.id) ? unsaveStudent(selectedStudent) : saveStudent(selectedStudent)"
                                            :class="[
                                                'w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-md transition-all',
                                                isStudentSaved(selectedStudent.id) 
                                                    ? 'border border-red-300 dark:border-red-600 text-red-700 dark:text-red-300 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30'
                                                    : 'border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500'
                                            ]">
                                            <svg class="w-4 h-4 mr-2" :fill="isStudentSaved(selectedStudent.id) ? 'currentColor' : 'none'" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            {{ isStudentSaved(selectedStudent.id) ? 'Remove from Saved' : 'Save Profile' }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'

// Define interfaces for better type safety
interface Student {
  id: number;
  name: string;
  major: string;
  year_of_study: string;
  about_me: string;
  skills: { id: number; name: string; icon?: string; }[];
  languages: { id: number; name: string; pivot?: { fluency_level: string; } }[];
  hobbies: { id: number; name: string; }[];
  portfolios: { id: number; title: string; }[];
  pivot?: { created_at: string; };
}

interface Company {
    name: string;
    logo_url: string;
    industry: { name: string; };
    company_size: { label: string; };
    headquarters: string;
    description: string;
    remote_policy: string;
    website: string;
    technologies: { id: number; name: string; icon: string; }[];
    benefits: any[];
}

const props = defineProps<{
    user: any,
    company: Company,
    students?: Student[],
    savedStudents?: Student[],
    message?: string
}>()

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Company Dashboard', href: '/company/dashboard' }
]

const activeSection = ref('students')
const searchQuery = ref('')
const selectedStudent = ref<Student | null>(null)
const showStudentModal = ref(false)
const savedStudentIds = ref(new Set(props.savedStudents?.map(s => s.id) || []))
const selectedFilters = ref({
    major: '',
    yearOfStudy: '',
    skills: [],
    languages: []
})

// Search functionality
const filteredStudents = computed(() => {
    if (!props.students) return []
    
    return props.students.filter(student => {
        // Text search
        if (searchQuery.value) {
            const query = searchQuery.value.toLowerCase()
            const matchesName = student.name?.toLowerCase().includes(query)
            const matchesMajor = student.major?.toLowerCase().includes(query)
            const matchesSkills = student.skills?.some((skill: any) => 
                skill.name?.toLowerCase().includes(query)
            )
            
            if (!matchesName && !matchesMajor && !matchesSkills) {
                return false
            }
        }
        
        // Filter by major
        if (selectedFilters.value.major && student.major !== selectedFilters.value.major) {
            return false
        }
        
        // Filter by year of study
        if (selectedFilters.value.yearOfStudy && student.year_of_study !== selectedFilters.value.yearOfStudy) {
            return false
        }
        
        return true
    })
})

const navigationLinks = [
    { id: 'overview', name: 'Overview' },
    { id: 'jobs', name: 'Job Postings' },
    { id: 'students', name: 'Find Students' },
    { id: 'saved', name: 'Saved Profiles' },
    { id: 'technologies', name: 'Tech Stack' },
    { id: 'profile', name: 'Profile Settings' }
]

const displayName = computed(() => {
    return props.company?.name || 'Your Company'
})

const profileCompleteness = computed(() => {
    let score = 0
    const fields = [
        props.company?.name,
        props.company?.industry,
        props.company?.company_size,
        props.company?.description,
        props.company?.remote_policy,
        props.company?.technologies?.length > 0,
        props.company?.benefits?.length > 0,
        props.company?.website,
        props.company?.headquarters,
        props.company?.logo_url,
    ]
    
    fields.forEach(field => {
        if (field) score += 10
    })
    
    return Math.round(score)
})

// Professional metrics - replace with actual data from your backend
const activeJobsCount = computed(() => {
    // This should come from your actual job postings data
    return 0
})

const applicationCount = computed(() => {
    // This should come from your actual applications data
    return 0
})

const setActiveSection = (section: string) => {
    activeSection.value = section
}

const clearFilters = () => {
    searchQuery.value = ''
    selectedFilters.value = {
        major: '',
        yearOfStudy: '',
        skills: [],
        languages: []
    }
}

const viewStudentProfile = (student: any) => {
    selectedStudent.value = student
    showStudentModal.value = true
}

const closeStudentModal = () => {
    showStudentModal.value = false
    selectedStudent.value = null
}

const saveStudent = async (student: any) => {
    try {
        console.log('Attempting to save student using Inertia:', student.id)
        
        router.post('/company/save-student', {
            student_id: student.id
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: (page) => {
                savedStudentIds.value.add(student.id)
                console.log('Student saved successfully')
            },
            onError: (errors) => {
                console.error('Failed to save student:', errors)
            }
        })
    } catch (error) {
        console.error('Error saving student:', error)
    }
}

const unsaveStudent = async (student: any) => {
    try {
        console.log('Attempting to unsave student using Inertia:', student.id)
        
        router.delete('/company/unsave-student', {
            data: { student_id: student.id },
            onSuccess: () => {
                savedStudentIds.value.delete(student.id)
                console.log('Student unsaved successfully')
            },
            onError: (errors) => {
                console.error('Failed to unsave student:', errors)
            }
        })
    } catch (error) {
        console.error('Error unsaving student:', error)
    }
}

const isStudentSaved = (studentId: number) => {
    return savedStudentIds.value.has(studentId)
}

const getSavedStudents = computed(() => {
    return props.savedStudents || []
})

const getInitials = () => {
    return props.company?.name?.slice(0, 2).toUpperCase() || 'CO'
}

const getLanguageFlag = (languageName: string) => {
    const flags: Record<string, string> = {
        'English': '🇬🇧',
        'Spanish': '🇪🇸',
        'French': '🇫🇷',
        'German': '🇩🇪',
        'Italian': '🇮🇹',
        'Portuguese': '🇵🇹',
        'Chinese (Mandarin)': '🇨🇳',
        'Japanese': '🇯🇵',
        'Korean': '🇰🇷',
        'Arabic': '🇸🇦',
        'Dutch': '🇳🇱',
        'Russian': '🇷🇺',
        'Hindi': '🇮🇳'
    }
    return flags[languageName] || '🌍'
}

const getLanguageProficiencyWidth = (proficiency: string) => {
    const widths: Record<string, string> = {
        'Native': '100%',
        'Fluent': '90%',
        'Business': '75%',
        'Conversational': '60%',
        'Basic': '30%'
    }
    return widths[proficiency] || '50%'
}

const getHobbyIcon = (hobbyName: string) => {
    const icons: Record<string, string> = {
        'Photography': '📸',
        'Reading': '📚',
        'Gaming': '🎮',
        'Music': '🎵',
        'Sports': '⚽',
        'Cooking': '👨‍🍳',
        'Travel': '✈️',
        'Art': '🎨',
        'Programming': '💻',
        'Fitness': '💪',
        'Dancing': '💃',
        'Writing': '✍️',
        'Movies': '🎬',
        'Hiking': '🥾'
    }
    return icons[hobbyName] || '🎯'
}

const getSkillIcon = (skillName: string) => {
    const icons: Record<string, string> = {
        'JavaScript': '🟨',
        'Python': '🐍',
        'Java': '☕',
        'React': '⚛️',
        'Vue.js': '💚',
        'Node.js': '🟢',
        'PHP': '🐘',
        'HTML': '🌐',
        'CSS': '🎨',
        'TypeScript': '🔷',
        'C++': '⚙️',
        'C#': '🔵',
        'Swift': '🍎',
        'Kotlin': '🤖',
        'Go': '🐹',
        'Rust': '🦀',
        'SQL': '🗄️',
        'MongoDB': '🍃',
        'Docker': '🐳',
        'Git': '📝',
        'AWS': '☁️',
        'Firebase': '🔥'
    }
    return icons[skillName] || '💻'
}

// Helper functions
const getInitials = () => {
    const name = props.company?.name || 'Company'
    const words = name.split(' ')
    if (words.length >= 2) {
        return (words[0].charAt(0) + words[1].charAt(0)).toUpperCase()
    }
    return name.charAt(0).toUpperCase()
}

const getRemotePolicyLabel = (policy: string) => {
    const labels: Record<string, string> = {
        'fully_remote': 'Fully Remote',
        'hybrid': 'Hybrid Work',
        'office_only': 'On-site Only'
    }
    return labels[policy] || policy
}

const getStudentInitials = (name: string) => {
    if (!name) return 'ST'
    const words = name.split(' ')
    if (words.length >= 2) {
        return (words[0].charAt(0) + words[1].charAt(0)).toUpperCase()
    }
    return name.charAt(0).toUpperCase()
}

const getSkillProficiencyWidth = (skill: any) => {
    // This is a placeholder. You might not have this data.
    return '80%'
}
</script>

<style scoped>
/* Professional styling with smooth transitions */
* {
    transition: all 0.2s ease-in-out;
}

/* Enhanced focus states for accessibility */
button:focus,
a:focus {
    outline: 2px solid #3B82F6;
    outline-offset: 2px;
    border-radius: 6px;
}

/* Professional hover effects */
.hover\:shadow-md:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

/* Subtle animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.3s ease-out;
}
</style>