<template>
    <Head title="Dashboard" />
    
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
            <!-- Professional Header with subtle color accents -->
            <div class="bg-gradient-to-r from-slate-50 via-indigo-50/30 to-purple-50/30 dark:from-gray-800 dark:via-slate-800 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <!-- Profile Header -->
                    <div class="flex flex-col lg:flex-row items-center justify-between">
                        <div class="flex items-center space-x-6 mb-6 lg:mb-0">
                            <!-- Enhanced Avatar with Status -->
                            <div class="relative">
                                <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-600 rounded-xl flex items-center justify-center text-2xl font-bold text-white border-2 border-indigo-100 dark:border-indigo-900/30 shadow-md">
                                    {{ getInitials() }}
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-emerald-500 rounded-full border-2 border-white dark:border-gray-800 shadow-md">
                                    <div class="w-2 h-2 bg-white rounded-full mx-auto mt-1"></div>
                                </div>
                            </div>
                            
                            <!-- Enhanced Profile Info -->
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                                    {{ displayName }}
                                </h1>
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-300 mb-3">
                                    <span v-if="props.student?.major" class="flex items-center gap-2 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 px-3 py-1 rounded-full border border-indigo-200 dark:border-indigo-800">
                                        <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
                                        {{ props.student.major }}
                                    </span>
                                    <span v-if="props.student?.year_of_study" class="flex items-center gap-2 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 px-3 py-1 rounded-full border border-emerald-200 dark:border-emerald-800">
                                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                        {{ props.student.year_of_study }}
                                    </span>
                                    <span v-if="profileCompleteness < 100" class="flex items-center gap-2 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 px-3 py-1 rounded-full border border-amber-200 dark:border-amber-800">
                                        <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                                        {{ profileCompleteness }}% Complete
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
                                            <div class="h-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-full transition-all duration-500"
                                                 :style="{ width: profileCompleteness + '%' }"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modern Stats Cards -->
                        <div class="grid grid-cols-3 gap-4">
                            <div class="bg-gradient-to-br from-white to-indigo-50/50 dark:from-gray-800 dark:to-indigo-900/10 rounded-lg p-4 text-center border border-indigo-100 dark:border-indigo-900/30 shadow-sm">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ props.student?.skills?.length || 0 }}</div>
                                <div class="text-sm text-indigo-600 dark:text-indigo-400 font-medium">Skills</div>
                            </div>
                            <div class="bg-gradient-to-br from-white to-purple-50/50 dark:from-gray-800 dark:to-purple-900/10 rounded-lg p-4 text-center border border-purple-100 dark:border-purple-900/30 shadow-sm">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ props.student?.portfolios?.length || 0 }}</div>
                                <div class="text-sm text-purple-600 dark:text-purple-400 font-medium">Projects</div>
                            </div>
                            <div class="bg-gradient-to-br from-white to-emerald-50/50 dark:from-gray-800 dark:to-emerald-900/10 rounded-lg p-4 text-center border border-emerald-100 dark:border-emerald-900/30 shadow-sm">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ props.student?.languages?.length || 0 }}</div>
                                <div class="text-sm text-emerald-600 dark:text-emerald-400 font-medium">Languages</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modern Navigation Tabs -->
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
                                    ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400'
                                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'
                            ]"
                        >
                            <span class="mr-2 text-lg">{{ link.icon }}</span>
                            {{ link.name }}
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Enhanced Content Area -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Overview Section -->
                <div v-if="activeSection === 'overview'">
                    <!-- Profile Completeness Banner -->
                    <div v-if="profileCompleteness < 100" class="mb-8">
                        <div class="bg-gradient-to-r from-amber-50 via-orange-50 to-pink-50 dark:from-amber-900/20 dark:via-orange-900/20 dark:to-pink-900/20 border border-amber-200 dark:border-amber-700 rounded-lg p-4 shadow-sm">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-gradient-to-br from-amber-400 to-orange-500 rounded-full flex items-center justify-center">
                                        <svg class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <h3 class="text-sm font-medium text-amber-800 dark:text-amber-200">🚀 Complete Your Profile</h3>
                                    <p class="mt-1 text-sm text-amber-700 dark:text-amber-300">Stand out to recruiters with a complete profile!</p>
                                    <div class="mt-3">
                                        <span class="text-sm font-medium text-amber-700 dark:text-amber-300">{{ profileCompleteness }}% complete</span>
                                        <div class="w-24 h-2 bg-amber-200 dark:bg-amber-800 rounded-full mt-1">
                                            <div class="h-full bg-gradient-to-r from-amber-500 to-orange-500 rounded-full transition-all duration-500" 
                                                 :style="{ width: profileCompleteness + '%' }"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                        <!-- About Me - Enhanced -->
                        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                            <div class="p-6">
                                <div class="flex items-center space-x-4 mb-6">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center text-white shadow-sm">
                                        👤
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">About Me</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Tell your story</p>
                                    </div>
                                </div>
                                <div v-if="props.student?.about_me" class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                    {{ props.student.about_me }}
                                </div>
                                <div v-else class="text-center py-8">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Tell your story</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Share your background, interests, and career goals.</p>
                                    <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 transition-all">
                                        Add Your Story
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Connect Card - Enhanced -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                            <div class="p-6">
                                <div class="flex items-center space-x-4 mb-6">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center text-white shadow-sm">
                                        🔗
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Connect</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Let's network!</p>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <a v-if="props.student?.linkedin_url" 
                                       :href="props.student.linkedin_url" 
                                       target="_blank" 
                                       class="flex items-center justify-between p-3 bg-gradient-to-r from-blue-50 to-blue-100/50 dark:from-blue-900/20 dark:to-blue-800/20 rounded-lg hover:shadow-sm transition-all group border border-blue-200 dark:border-blue-800">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white text-sm">
                                                💼
                                            </div>
                                            <span class="font-medium text-gray-900 dark:text-white">LinkedIn</span>
                                        </div>
                                        <span class="text-blue-600 group-hover:translate-x-1 transition-transform duration-300">→</span>
                                    </a>
                                    
                                    <a v-if="props.student?.custom_link_url" 
                                       :href="props.student.custom_link_url" 
                                       target="_blank" 
                                       class="flex items-center justify-between p-3 bg-gradient-to-r from-purple-50 to-purple-100/50 dark:from-purple-900/20 dark:to-purple-800/20 rounded-lg hover:shadow-sm transition-all group border border-purple-200 dark:border-purple-800">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center text-white text-sm">
                                                🌐
                                            </div>
                                            <span class="font-medium text-gray-900 dark:text-white">{{ props.student.custom_link_title || 'Website' }}</span>
                                        </div>
                                        <span class="text-purple-600 group-hover:translate-x-1 transition-transform duration-300">→</span>
                                    </a>
                                    
                                    <a v-if="props.student?.github_link" 
                                       :href="props.student.github_link" 
                                       target="_blank" 
                                       class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-slate-100/50 dark:from-gray-700/20 dark:to-slate-800/20 rounded-lg hover:shadow-sm transition-all group border border-gray-200 dark:border-gray-600">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-gray-800 dark:bg-gray-200 rounded-lg flex items-center justify-center text-white dark:text-gray-800 text-sm">
                                                🐙
                                            </div>
                                            <span class="font-medium text-gray-900 dark:text-white">GitHub</span>
                                        </div>
                                        <span class="text-gray-600 group-hover:translate-x-1 transition-transform duration-300">→</span>
                                    </a>
                                    
                                    <div v-if="!props.student?.linkedin_url && !props.student?.custom_link_url && !props.student?.github_link" class="text-center py-6">
                                        <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">No contact links yet</p>
                                        <button class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-4 py-2 rounded-lg text-sm hover:shadow-md transition-all">
                                            Add Links
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Skills Showcase -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-8">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center text-white shadow-sm">
                                        ⚡
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Technical Skills</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">My expertise areas</p>
                                    </div>
                                </div>
                                <button v-if="props.student?.skills && props.student.skills.length > 0" 
                                        @click="setActiveSection('skills')"
                                        class="text-sm text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                                    View All →
                                </button>
                            </div>
                            
                            <div v-if="props.student?.skills && props.student.skills.length > 0" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                <div v-for="skill in props.student.skills.slice(0, 8)" 
                                     :key="skill.name"
                                     class="bg-gradient-to-br from-slate-50 to-gray-100/50 dark:from-gray-700 dark:to-slate-900/20 rounded-lg p-4 border border-slate-200 dark:border-slate-700/30 hover:shadow-sm transition-all">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-2xl">{{ getSkillIcon(skill.name) }}</span>
                                        <span :class="[
                                            'px-2 py-1 rounded-lg text-xs font-medium',
                                            skill.proficiency === 'Expert' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300' :
                                            skill.proficiency === 'Advanced' ? 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300' :
                                            skill.proficiency === 'Intermediate' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300' :
                                            'bg-gray-100 text-gray-700 dark:bg-gray-600 dark:text-gray-300'
                                        ]">
                                            {{ skill.proficiency }}
                                        </span>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white mb-2">{{ skill.name }}</h4>
                                    <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                        <div :class="[
                                            'h-2 rounded-full transition-all duration-500',
                                            skill.proficiency === 'Expert' ? 'bg-gradient-to-r from-red-500 to-pink-500' :
                                            skill.proficiency === 'Advanced' ? 'bg-gradient-to-r from-orange-500 to-yellow-500' :
                                            skill.proficiency === 'Intermediate' ? 'bg-gradient-to-r from-yellow-500 to-green-500' :
                                            'bg-gradient-to-r from-gray-400 to-gray-500'
                                        ]"
                                             :style="{ 
                                                 width: skill.proficiency === 'Expert' ? '100%' :
                                                        skill.proficiency === 'Advanced' ? '80%' :
                                                        skill.proficiency === 'Intermediate' ? '60%' :
                                                        '30%'
                                             }"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div v-else class="text-center py-12">
                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                    </svg>
                                </div>
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No skills added yet</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Showcase your technical expertise to stand out</p>
                                <button class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-3 rounded-lg hover:shadow-md transition-all">
                                    Add Skills
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Languages & Hobbies Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Languages Card -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                            <div class="p-6">
                                <div class="flex items-center space-x-4 mb-6">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center text-white shadow-sm">
                                        🌍
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Languages</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Communication skills</p>
                                    </div>
                                </div>
                                
                                <div v-if="props.student?.languages && props.student.languages.length > 0" class="space-y-4">
                                    <div v-for="language in props.student.languages" 
                                         :key="language.name"
                                         class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-lg p-4 border border-green-200 dark:border-green-700">
                                        <div class="flex items-center justify-between mb-3">
                                            <div class="flex items-center space-x-3">
                                                <span class="text-2xl">{{ getLanguageFlag(language.name) }}</span>
                                                <span class="font-semibold text-gray-900 dark:text-white">{{ language.name }}</span>
                                            </div>
                                            <span class="text-sm font-medium text-green-600 dark:text-green-400">{{ language.fluency }}</span>
                                        </div>
                                        <div class="w-full bg-green-200 dark:bg-green-700 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-2 rounded-full transition-all duration-500"
                                                 :style="{ width: getLanguageProficiencyWidth(language.fluency) }"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div v-else class="text-center py-8">
                                    <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">No languages added yet</p>
                                </div>
                            </div>
                        </div>

                        <!-- Hobbies Card -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                            <div class="p-6">
                                <div class="flex items-center space-x-4 mb-6">
                                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center text-white shadow-sm">
                                        🎯
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Hobbies</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Personal interests</p>
                                    </div>
                                </div>
                                
                                <div v-if="props.student?.hobbies && props.student.hobbies.length > 0" class="grid grid-cols-1 gap-3">
                                    <div v-for="hobby in props.student.hobbies" 
                                         :key="hobby.name"
                                         class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-lg p-4 border border-indigo-200 dark:border-indigo-700 hover:scale-105 transition-transform duration-300">
                                        <div class="flex items-center space-x-3">
                                            <span class="text-2xl">{{ getHobbyIcon(hobby.name) }}</span>
                                            <span class="font-semibold text-gray-900 dark:text-white">{{ hobby.name }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div v-else class="text-center py-8">
                                    <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.01M15 10h1.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">No hobbies added yet</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Portfolio Section -->
                <div v-else-if="activeSection === 'portfolio'" class="space-y-8">
                    <div v-if="props.student?.portfolios && props.student.portfolios.length > 0" 
                         class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div v-for="project in props.student.portfolios" 
                             :key="project.id"
                             class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md hover:scale-105 transition-all duration-300 group">
                            <div class="flex items-start justify-between mb-6">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center text-white shadow-sm group-hover:scale-110 transition-transform duration-300">
                                    💼
                                </div>
                                <span class="text-xs text-gray-500 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">Project</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 group-hover:text-blue-600 transition-colors duration-300">
                                {{ project.name }}
                            </h3>
                            <a :href="project.url" 
                               target="_blank"
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white font-medium rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-300">
                                View Project
                                <span class="ml-2 group-hover:translate-x-1 transition-transform duration-300">→</span>
                            </a>
                        </div>
                    </div>
                    
                    <div v-else class="text-center py-20">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 00-2 2h-4a2 2 0 00-2-2V6m8 0h2a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h2" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No projects yet</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Showcase your amazing work to impress recruiters</p>
                        <button class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-xl transition-all duration-300">
                            Add Your First Project
                        </button>
                    </div>
                </div>

                <!-- Skills Section -->
                <div v-else-if="activeSection === 'skills'" class="space-y-8">
                    <div v-if="props.student?.skills && props.student.skills.length > 0" 
                         class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div v-for="skill in props.student.skills" 
                             :key="skill.name"
                             class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md hover:scale-105 transition-all duration-300">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center space-x-3">
                                    <span class="text-3xl">{{ getSkillIcon(skill.name) }}</span>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ skill.name }}</h3>
                                </div>
                                <span :class="[
                                    'px-3 py-1 rounded-xl text-sm font-bold',
                                    skill.proficiency === 'Expert' ? 'bg-gradient-to-r from-red-500 to-pink-500 text-white' :
                                    skill.proficiency === 'Advanced' ? 'bg-gradient-to-r from-orange-500 to-yellow-500 text-white' :
                                    skill.proficiency === 'Intermediate' ? 'bg-gradient-to-r from-yellow-500 to-green-500 text-white' :
                                    'bg-gradient-to-r from-gray-400 to-gray-500 text-white'
                                ]">
                                    {{ skill.proficiency }}
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 mb-4">
                                <div :class="[
                                    'h-3 rounded-full transition-all duration-1000',
                                    skill.proficiency === 'Expert' ? 'bg-gradient-to-r from-red-500 to-pink-500' :
                                    skill.proficiency === 'Advanced' ? 'bg-gradient-to-r from-orange-500 to-yellow-500' :
                                    skill.proficiency === 'Intermediate' ? 'bg-gradient-to-r from-yellow-500 to-green-500' :
                                    'bg-gradient-to-r from-gray-400 to-gray-500'
                                ]"
                                     :style="{ 
                                         width: skill.proficiency === 'Expert' ? '100%' :
                                                skill.proficiency === 'Advanced' ? '80%' :
                                                skill.proficiency === 'Intermediate' ? '60%' :
                                                '30%'
                                     }"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div v-else class="text-center py-20">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No skills yet</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Add your technical skills to showcase your expertise</p>
                        <button class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-xl transition-all duration-300">
                            Add Skills
                        </button>
                    </div>
                </div>

                <!-- About Section -->
                <div v-else-if="activeSection === 'about'">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Personal Information -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                            <div class="p-6">
                                <div class="flex items-center space-x-4 mb-8">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center text-white shadow-sm">
                                        👤
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Personal Information</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Basic details</p>
                                    </div>
                                </div>
                                <div class="space-y-6">
                                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-lg p-4 border border-purple-200 dark:border-purple-700">
                                        <label class="text-sm font-medium text-purple-600 dark:text-purple-400 mb-2 block">Full Name</label>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ props.student?.name || 'Not provided' }}</p>
                                    </div>
                                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-lg p-4 border border-blue-200 dark:border-blue-700">
                                        <label class="text-sm font-medium text-blue-600 dark:text-blue-400 mb-2 block">Email</label>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ props.student?.email || props.user?.email || 'Not provided' }}</p>
                                    </div>
                                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-lg p-4 border border-green-200 dark:border-green-700">
                                        <label class="text-sm font-medium text-green-600 dark:text-green-400 mb-2 block">Major</label>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ props.student?.major || 'Not provided' }}</p>
                                    </div>
                                    <div class="bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 rounded-lg p-4 border border-orange-200 dark:border-orange-700">
                                        <label class="text-sm font-medium text-orange-600 dark:text-orange-400 mb-2 block">Year of Study</label>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ props.student?.year_of_study || 'Not provided' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- About Me & Professional Links -->
                        <div class="space-y-8">
                            <!-- About Me -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                                <div class="p-6">
                                    <div class="flex items-center space-x-4 mb-6">
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center text-white shadow-sm">
                                            📝
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">About Me</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">My story</p>
                                        </div>
                                    </div>
                                    <div v-if="props.student?.about_me" 
                                         class="bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-lg p-6 border border-blue-200 dark:border-blue-700">
                                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ props.student.about_me }}</p>
                                    </div>
                                    <div v-else class="text-center py-8">
                                        <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">No bio provided yet</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Professional Links -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                                <div class="p-6">
                                    <div class="flex items-center space-x-4 mb-6">
                                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center text-white shadow-sm">
                                            🔗
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Professional Links</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Connect with me</p>
                                        </div>
                                    </div>
                                    <div class="space-y-4">
                                        <div v-if="props.student?.linkedin_url" class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg p-4 border border-blue-200 dark:border-blue-700">
                                            <label class="text-sm font-medium text-blue-600 dark:text-blue-400 mb-2 block">LinkedIn</label>
                                            <a :href="props.student.linkedin_url" target="_blank" class="text-lg font-semibold text-blue-600 hover:text-blue-700 transition-colors duration-300">
                                                View Profile →
                                            </a>
                                        </div>
                                        <div v-if="props.student?.custom_link_url" class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-lg p-4 border border-purple-200 dark:border-purple-700">
                                            <label class="text-sm font-medium text-purple-600 dark:text-purple-400 mb-2 block">{{ props.student.custom_link_title || 'Website' }}</label>
                                            <a :href="props.student.custom_link_url" target="_blank" class="text-lg font-semibold text-purple-600 hover:text-purple-700 transition-colors duration-300">
                                                Visit Site →
                                            </a>
                                        </div>
                                        <div v-if="props.student?.github_link" class="bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700/20 dark:to-slate-700/20 rounded-lg p-4 border border-gray-200 dark:border-gray-600">
                                            <label class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2 block">GitHub</label>
                                            <a :href="props.student.github_link" target="_blank" class="text-lg font-semibold text-gray-700 dark:text-gray-300 hover:text-gray-900 transition-colors duration-300">
                                                View Code →
                                            </a>
                                        </div>
                                        <div v-if="!props.student?.linkedin_url && !props.student?.custom_link_url && !props.student?.github_link" class="text-center py-6">
                                            <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                                </svg>
                                            </div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">No professional links added yet</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floating Action Button -->
            <div class="fixed bottom-8 right-8 z-30">
                <button class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-full shadow-2xl hover:shadow-3xl hover:scale-110 transition-all duration-300 flex items-center justify-center text-2xl">
                    ✨
                </button>
                
                <!-- Quick Menu -->
          <div v-if="showQuickMenu" 
               class="absolute bottom-20 right-0 w-56 bg-white rounded-3xl shadow-2xl border-2 border-gray-200 transform transition-all duration-300 animate-in slide-in-from-bottom-2">
            <div class="p-4">
              <div class="space-y-2">
                <button v-for="menuItem in floatingMenuItems" :key="menuItem.title"
                        class="w-full text-left px-4 py-3 rounded-2xl hover:bg-gradient-to-r hover:from-orange-50 hover:to-red-50 text-sm font-semibold text-gray-700 hover:text-orange-600 transition-all duration-300 flex items-center space-x-3">
                  <span class="text-lg">{{ menuItem.icon }}</span>
                  <span>{{ menuItem.title }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { Head } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'

const props = defineProps<{
    user: any,
    student: any,
    message?: string
}>()

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' }
]

const activeSection = ref('overview')

const navigationLinks = [
    { id: 'overview', name: 'Overview', icon: '🏠' },
    { id: 'portfolio', name: 'Portfolio', icon: '💼' },
    { id: 'skills', name: 'Skills', icon: '⚡' },
    { id: 'about', name: 'About', icon: '👤' }
]

const displayName = computed(() => {
    return props.student?.name || props.user?.name || 'Student'
})

const profileCompleteness = computed(() => {
    let score = 0
    const fields = [
        props.student?.name,
        props.student?.major,
        props.student?.year_of_study,
        props.student?.about_me,
        props.student?.linkedin_url,
        props.student?.skills?.length > 0,
        props.student?.languages?.length > 0,
        props.student?.portfolios?.length > 0
    ]
    
    fields.forEach(field => {
        if (field) score += 12.5
    })
    
    return Math.round(score)
})

const setActiveSection = (section: string) => {
    activeSection.value = section
}

// Helper functions
const getInitials = () => {
    const name = props.student?.name || props.user?.name || 'Student'
    const words = name.split(' ')
    if (words.length >= 2) {
        return (words[0].charAt(0) + words[1].charAt(0)).toUpperCase()
    }
    return name.charAt(0).toUpperCase()
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
</script>

<style scoped>
/* Professional styling with smooth transitions */
* {
    transition: all 0.2s ease-in-out;
}

/* Enhanced focus states for accessibility */
button:focus,
a:focus {
    outline: 2px solid #6366F1;
    outline-offset: 2px;
    border-radius: 6px;
}

/* Professional hover effects */
.hover\:shadow-md:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}
</style>