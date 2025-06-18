<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
      <!-- Ultra Premium Company Header -->
      <header class="bg-white/95 backdrop-blur-2xl shadow-2xl border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between items-center h-20">
            <!-- Company Branding -->
            <div class="flex items-center space-x-4">
              <div class="relative">
                <div class="w-14 h-14 bg-gradient-to-br from-green-600 via-emerald-600 to-teal-500 rounded-2xl flex items-center justify-center shadow-2xl">
                  <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10V9a1 1 0 011-1h4a1 1 0 011 1v12M9 7h1m-1 4h1"/>
                  </svg>
                </div>
                <div class="absolute -top-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white animate-pulse flex items-center justify-center">
                  <div class="w-2 h-2 bg-white rounded-full"></div>
                </div>
                                </div>
                                <div>
                <div class="font-black text-2xl text-gray-900 tracking-tight">{{ companyData.name }}</div>
                <div class="text-xs text-gray-500 font-bold tracking-wider uppercase bg-green-100 text-green-600 px-2 py-1 rounded-full">
                  Company Portal
                                </div>
                            </div>
                        </div>
            
            <!-- Real-time Company Metrics -->
            <div class="hidden lg:flex items-center space-x-8 px-8 py-4 bg-gradient-to-r from-gray-50 to-green-50 rounded-2xl border border-gray-200">
              <div class="text-center">
                <div class="text-xl font-black text-gray-900">{{ companyData.activeJobs }}</div>
                <div class="text-xs text-gray-500 font-medium">Active Jobs</div>
                    </div>
              <div class="w-px h-10 bg-gray-300"></div>
                            <div class="text-center">
                <div class="text-xl font-black text-blue-600">{{ companyData.applications }}</div>
                <div class="text-xs text-gray-500 font-medium">Applications</div>
                            </div>
              <div class="w-px h-10 bg-gray-300"></div>
                            <div class="text-center">
                <div class="text-xl font-black text-purple-600">{{ companyData.interviews }}</div>
                <div class="text-xs text-gray-500 font-medium">Interviews</div>
                            </div>
              <div class="w-px h-10 bg-gray-300"></div>
                            <div class="text-center">
                <div class="flex items-center justify-center space-x-1">
                  <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                  <span class="text-xs font-bold text-green-600">{{ companyData.responseRate }}%</span>
                </div>
                <div class="text-xs text-gray-500 font-medium">Response Rate</div>
              </div>
            </div>
  
            <!-- Company Controls -->
            <div class="flex items-center space-x-4">
              <!-- Talent Search -->
              <button class="p-3 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-xl transition-all duration-300 relative group">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <div class="absolute -top-2 -right-2 w-4 h-4 bg-blue-500 rounded-full text-white text-xs flex items-center justify-center font-bold">
                  {{ newTalentCount }}
                </div>
              </button>
  
              <!-- Notifications -->
              <div class="relative">
                <button class="p-3 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-all duration-300 relative">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                  </svg>
                  <span class="absolute top-2 right-2 w-3 h-3 bg-orange-500 rounded-full animate-bounce"></span>
                </button>
              </div>
  
              <!-- Settings -->
              <button class="p-3 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </button>
  
              <!-- Company Profile -->
              <div class="flex items-center space-x-4 pl-4 border-l-2 border-gray-200">
                <div class="relative">
                  <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-lg">{{ companyData.avatar }}</span>
                  </div>
                  <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                </div>
                <div class="hidden sm:block">
                  <div class="text-sm font-bold text-gray-900">{{ companyData.name }}</div>
                  <div class="text-xs text-gray-500 font-medium">{{ companyData.industry }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </header>
  
      <!-- Advanced Navigation Tabs -->
      <div class="bg-white/90 backdrop-blur-xl border-b-2 border-gray-200 sticky top-20 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <nav class="flex space-x-1 py-2">
            <button v-for="tab in navigationTabs" :key="tab.id"
                    @click="activeTab = tab.id"
                    :class="`flex items-center space-x-3 py-4 px-6 rounded-2xl text-sm font-bold transition-all duration-300 ${
                      activeTab === tab.id
                        ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white shadow-lg scale-105'
                        : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100'
                    }`">
              <component :is="tab.icon" class="w-5 h-5" />
              <span>{{ tab.label }}</span>
              <span v-if="tab.badge" :class="`px-2 py-1 rounded-full text-xs font-bold ${
                activeTab === tab.id ? 'bg-white/20 text-white' : 'bg-green-100 text-green-600'
              }`">
                {{ tab.badge }}
              </span>
            </button>
          </nav>
        </div>
                        </div>
  
      <!-- Main Content -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Overview Tab -->
        <div v-if="activeTab === 'overview'">
          <!-- Hero Company Center -->
          <div class="bg-gradient-to-br from-emerald-900 via-green-900 to-teal-900 rounded-3xl p-12 text-white relative overflow-hidden mb-10 shadow-2xl">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0">
              <div class="absolute top-10 left-10 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl animate-pulse"></div>
              <div class="absolute bottom-10 right-10 w-56 h-56 bg-teal-500/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
              <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-green-500/10 rounded-full blur-2xl animate-bounce"></div>
              <div class="absolute inset-0 bg-gradient-to-r from-green-900/20 to-emerald-900/20"></div>
                    </div>
            
            <div class="relative z-10">
              <div class="flex items-center space-x-6 mb-8">
                <div class="w-20 h-20 bg-gradient-to-br from-white/20 to-white/10 rounded-3xl flex items-center justify-center shadow-2xl backdrop-blur-sm">
                  <span class="text-3xl font-black text-white">{{ companyData.avatar }}</span>
                </div>
                <div>
                  <h1 class="text-5xl font-black mb-2 bg-gradient-to-r from-white via-green-200 to-emerald-200 bg-clip-text text-transparent">
                    Welcome, {{ companyData.name }}!
                  </h1>
                  <p class="text-xl text-green-200">Find the perfect talent for your team 🚀</p>
                  <div class="flex items-center space-x-4 mt-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl px-4 py-2 flex items-center space-x-2">
                      <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                      <span class="text-sm font-semibold">{{ companyData.status }}</span>
                        </div>
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl px-4 py-2 text-sm font-semibold">
                      {{ companyData.location }}
                    </div>
                  </div>
                </div>
                </div>

              <!-- Company Metrics Grid -->
              <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                <div v-for="metric in companyMetrics" :key="metric.label"
                     class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300">
                  <div class="flex items-center justify-between mb-4">
                    <component :is="metric.icon" class="w-8 h-8 text-green-300" />
                    <div :class="`px-2 py-1 rounded-full text-xs font-bold ${metric.trendColor}`">
                      {{ metric.trend }}
                    </div>
                  </div>
                  <div class="text-3xl font-black text-white mb-2">{{ metric.value }}</div>
                  <div class="text-green-300 font-medium text-sm">{{ metric.label }}</div>
                  <div class="text-xs text-green-400 mt-1">{{ metric.subtitle }}</div>
                </div>
              </div>
  
              <!-- Quick Company Actions -->
              <div class="flex flex-wrap gap-4">
                <button v-for="action in quickCompanyActions" :key="action.title"
                        :class="`flex items-center space-x-3 px-6 py-3 rounded-2xl font-bold transition-all duration-300 hover:scale-105 shadow-lg ${action.style}`">
                  <span class="text-xl">{{ action.icon }}</span>
                  <span>{{ action.title }}</span>
                </button>
              </div>
            </div>
          </div>
  
          <!-- Company Stats Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
            <div v-for="(stat, index) in companyStats" :key="index" 
                 class="group bg-white rounded-3xl p-8 shadow-xl border-2 border-gray-100 hover:shadow-2xl hover:scale-105 hover:border-green-200 transition-all duration-500 relative overflow-hidden">
              <!-- Gradient overlay -->
              <div :class="`absolute inset-0 bg-gradient-to-br ${stat.gradient} opacity-0 group-hover:opacity-5 transition-opacity duration-500`"></div>
              
              <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                  <div :class="`p-4 ${stat.iconBg} rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300`">
                    <component :is="stat.icon" :class="`w-8 h-8 ${stat.iconColor}`" />
                  </div>
                  <div class="text-right">
                    <span :class="`text-sm font-black px-3 py-2 rounded-full ${stat.changeBg} ${stat.changeColor} group-hover:scale-110 transition-transform duration-300`">
                      {{ stat.change }}
                    </span>
                  </div>
                        </div>
                <div class="text-4xl font-black text-gray-900 mb-3 group-hover:text-green-600 transition-colors duration-300">
                  {{ stat.value }}
                    </div>
                <div class="text-gray-600 font-bold text-lg">{{ stat.label }}</div>
                <div class="text-sm text-gray-500 mt-2">{{ stat.subtitle }}</div>
                
                <!-- Mini trend chart -->
                <div class="mt-4 h-2 bg-gray-100 rounded-full overflow-hidden">
                  <div :class="`h-full rounded-full transition-all duration-1000 ${stat.trendBarColor}`" 
                       :style="`width: ${stat.trendPercentage}%`"></div>
                </div>
                </div>
            </div>
        </div>

          <!-- Main Company Dashboard Grid -->
          <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left Column - Jobs & Applications -->
            <div class="lg:col-span-2 space-y-8">
              
              <!-- Active Job Postings -->
              <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                <div class="flex items-center justify-between mb-8">
                  <div>
                    <h3 class="text-2xl font-black text-gray-900">Active Job Postings</h3>
                    <p class="text-gray-600 mt-1">{{ activeJobs.length }} open positions</p>
                  </div>
                  <button class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                    Post New Job
                  </button>
                </div>
                
                <div class="space-y-4">
                  <div v-for="job in activeJobs" :key="job.id" 
                       class="flex items-center justify-between p-6 border-2 border-gray-100 rounded-2xl hover:border-green-200 hover:bg-green-50 transition-all duration-300 group">
                    <div class="flex items-center space-x-6">
                      <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        {{ job.title.charAt(0) }}
                      </div>
                      <div>
                        <div class="font-bold text-gray-900 text-lg">{{ job.title }}</div>
                        <div class="text-gray-600 font-medium">{{ job.department }}</div>
                        <div class="flex items-center space-x-4 mt-2">
                          <span class="text-sm text-gray-500">{{ job.applications }} applications</span>
                          <span class="text-sm text-gray-500">Posted {{ job.postedDays }} days ago</span>
                          <span :class="`px-3 py-1 rounded-full text-xs font-bold ${getJobTypeColor(job.type)}`">
                            {{ job.type }}
                          </span>
                        </div>
                      </div>
                    </div>
                    
                                <div class="flex items-center space-x-3">
                      <button class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-xl font-semibold transition-all duration-300 hover:scale-105">
                        View Applications
                      </button>
                      <button class="text-gray-400 hover:text-gray-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                </div>
              </div>
  
              <!-- Recent Applications -->
              <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                <div class="flex items-center justify-between mb-8">
                  <div>
                    <h3 class="text-2xl font-black text-gray-900">Recent Applications</h3>
                    <p class="text-gray-600 mt-1">Latest candidate submissions</p>
                  </div>
                                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                      <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                      <span class="text-sm font-medium text-green-600">Live</span>
                    </div>
                    <button class="text-green-600 hover:text-green-800 font-semibold transition-colors">
                      View All
                    </button>
                  </div>
                </div>
                
                <div class="space-y-4">
                  <div v-for="application in recentApplications" :key="application.id" 
                       class="flex items-center justify-between p-6 border-2 border-gray-100 rounded-2xl hover:border-blue-200 hover:bg-blue-50 transition-all duration-300 group">
                    <div class="flex items-center space-x-6">
                      <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                          {{ application.candidateName.split(' ').map(n => n[0]).join('') }}
                        </div>
                        <div v-if="application.featured" class="absolute -top-2 -right-2 w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center">
                          <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                          </svg>
                        </div>
                                </div>
                      <div>
                        <div class="font-bold text-gray-900 text-lg">{{ application.candidateName }}</div>
                        <div class="text-gray-600 font-medium">{{ application.position }}</div>
                        <div class="flex items-center space-x-4 mt-2">
                          <span class="text-sm text-gray-500">{{ application.experience }} experience</span>
                          <span class="text-sm text-gray-500">Applied {{ application.appliedHours }}h ago</span>
                          <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-600">{{ application.matchScore }}% match</span>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="flex items-center space-x-3">
                      <button class="bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-xl font-semibold transition-all duration-300 hover:scale-105">
                        Reject
                      </button>
                      <button class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-6 py-2 rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                        Interview
                      </button>
                    </div>
                  </div>
                </div>
              </div>
  
              <!-- Talent Pipeline -->
              <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                <div class="flex items-center justify-between mb-8">
                  <div>
                    <h3 class="text-2xl font-black text-gray-900">Talent Pipeline</h3>
                    <p class="text-gray-600 mt-1">Track candidates through your hiring process</p>
                  </div>
                  <button class="bg-gradient-to-r from-purple-500 to-indigo-500 hover:from-purple-600 hover:to-indigo-600 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                    Manage Pipeline
                  </button>
                </div>
                
                <!-- Pipeline Visualization -->
                <div class="relative mb-8">
                  <div class="flex justify-between items-center">
                    <div v-for="(stage, index) in talentPipeline" :key="stage.name" class="flex-1 text-center relative">
                      <div :class="`w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 text-lg font-bold transition-all duration-500 shadow-lg ${
                        stage.active ? 'bg-gradient-to-br from-green-500 to-emerald-500 text-white scale-110' : 'bg-gray-200 text-gray-600'
                      }`">
                        {{ stage.count }}
                      </div>
                      <div class="text-sm font-bold text-gray-900">{{ stage.name }}</div>
                      <div class="text-xs text-gray-600">{{ stage.percentage }}%</div>
                      <div v-if="index < talentPipeline.length - 1" 
                           :class="`absolute top-8 left-1/2 w-full h-1 rounded-full -z-10 ${
                             stage.active ? 'bg-gradient-to-r from-green-500 to-emerald-500' : 'bg-gray-200'
                           }`"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  
            <!-- Right Column - Company Tools -->
            <div class="space-y-8">
              
              <!-- Company Profile Status -->
              <div class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 rounded-3xl p-8 border-2 border-green-200">
                    <div class="flex items-center justify-between mb-6">
                  <div>
                    <h3 class="text-xl font-black text-gray-900">Company Profile</h3>
                    <p class="text-gray-600 text-sm">{{ companyData.profileCompleteness }}% complete</p>
                  </div>
                  <div class="p-3 bg-green-200 rounded-2xl">
                    <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                  </div>
                </div>
                
                <div class="space-y-4">
                  <div v-for="section in profileSections" :key="section.name" 
                       class="bg-white rounded-2xl p-4 shadow-sm border border-green-100">
                    <div class="flex items-center justify-between mb-2">
                      <div class="font-bold text-gray-900">{{ section.name }}</div>
                      <span :class="`px-3 py-1 rounded-full text-xs font-bold ${section.status === 'complete' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'}`">
                        {{ section.status }}
                      </span>
                    </div>
                    <div class="w-full h-2 bg-green-100 rounded-full overflow-hidden">
                      <div class="h-2 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full transition-all duration-1000" 
                           :style="`width: ${section.progress}%`"></div>
                    </div>
                    <div class="text-xs text-gray-600 mt-2">{{ section.description }}</div>
                  </div>
                </div>
              </div>
  
              <!-- Favorite Students/Candidates -->
              <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                  <div>
                    <h3 class="text-xl font-black text-gray-900">Favorite Candidates</h3>
                    <p class="text-gray-600 text-sm">{{ favoriteCandidates.length }} talented individuals</p>
                  </div>
                  <button class="text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                    View All
                  </button>
                    </div>
                    
                    <div class="space-y-4">
                  <div v-for="candidate in favoriteCandidates" :key="candidate.id" 
                       class="flex items-center space-x-4 p-4 border-2 border-gray-100 rounded-2xl hover:border-blue-200 hover:bg-blue-50 transition-all duration-300 group">
                    <div class="relative">
                      <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center text-white font-bold shadow-lg">
                        {{ candidate.name.split(' ').map(n => n[0]).join('') }}
                      </div>
                      <button @click="removeFromFavorites(candidate.id)" 
                              class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full text-white text-xs flex items-center justify-center hover:bg-red-600 transition-colors">
                        ×
                      </button>
                    </div>
                    <div class="flex-1">
                      <div class="font-semibold text-gray-900">{{ candidate.name }}</div>
                      <div class="text-xs text-gray-600">{{ candidate.field }}</div>
                      <div class="text-xs text-blue-600 font-medium">{{ candidate.skills.join(', ') }}</div>
                    </div>
                    <button class="opacity-75 group-hover:opacity-100 bg-gradient-to-r from-blue-100 to-indigo-100 hover:from-blue-200 hover:to-indigo-200 text-blue-600 px-4 py-2 rounded-xl font-semibold text-sm transition-all duration-300 hover:scale-105">
                      Contact
                    </button>
                  </div>
                </div>
              </div>
  
              <!-- Recruitment Analytics -->
              <div class="bg-gradient-to-br from-purple-50 via-indigo-50 to-blue-50 rounded-3xl p-8 border-2 border-purple-200">
                <h3 class="text-xl font-black text-gray-900 mb-6">Recruitment Analytics</h3>
                <div class="space-y-4">
                  <div v-for="metric in recruitmentMetrics" :key="metric.name"
                       class="bg-white rounded-2xl p-4 shadow-sm border border-purple-100">
                    <div class="flex items-center justify-between mb-2">
                      <span class="font-semibold text-gray-900">{{ metric.name }}</span>
                      <span :class="`text-sm font-bold ${metric.color}`">{{ metric.value }}</span>
                    </div>
                    <div class="w-full h-2 bg-purple-100 rounded-full overflow-hidden">
                      <div :class="`h-full rounded-full transition-all duration-1000 ${metric.barColor}`" 
                           :style="`width: ${metric.percentage}%`"></div>
                    </div>
                    <div class="text-xs text-gray-600 mt-2">{{ metric.description }}</div>
                  </div>
                </div>
              </div>
  
              <!-- Quick Tools -->
              <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                <h3 class="text-xl font-black text-gray-900 mb-6">Quick Tools</h3>
                <div class="grid grid-cols-2 gap-4">
                  <button v-for="tool in quickTools" :key="tool.title"
                          :class="`p-4 rounded-2xl border-2 border-gray-200 hover:shadow-lg transition-all duration-300 text-left group hover:scale-105 ${tool.hoverColor}`">
                    <div class="text-3xl mb-2">{{ tool.icon }}</div>
                    <div class="text-sm font-bold text-gray-900">{{ tool.title }}</div>
                    <div class="text-xs text-gray-600 mt-1">{{ tool.description }}</div>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Jobs Tab -->
        <div v-if="activeTab === 'jobs'" class="space-y-8">
          <!-- Jobs Header -->
          <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-3xl p-8 text-white">
            <h2 class="text-4xl font-black mb-4">Job Management</h2>
            <p class="text-xl text-blue-100 mb-6">Create, manage and track your job postings</p>
            <button class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105">
              Create New Job
            </button>
          </div>
  
          <!-- Jobs Management Interface -->
          <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
            <div class="flex items-center justify-between mb-8">
              <h3 class="text-2xl font-black text-gray-900">All Job Postings</h3>
                            <div class="flex items-center space-x-4">
                <select v-model="jobFilter" class="px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                  <option value="all">All Jobs</option>
                  <option value="active">Active Only</option>
                  <option value="draft">Drafts</option>
                  <option value="closed">Closed</option>
                </select>
                <button class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-3 rounded-2xl font-semibold hover:scale-105 transition-all duration-300">
                  Bulk Actions
                </button>
              </div>
            </div>
  
            <!-- Jobs Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
              <div v-for="job in filteredJobs" :key="job.id" 
                   class="bg-white rounded-3xl p-6 shadow-lg border-2 border-gray-100 hover:shadow-xl hover:scale-105 hover:border-blue-200 transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                  <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                    {{ job.title.charAt(0) }}
                  </div>
                  <span :class="`px-3 py-1 rounded-full text-xs font-bold ${getJobStatusColor(job.status)}`">
                    {{ job.status }}
                  </span>
                </div>
                
                <h4 class="font-bold text-gray-900 text-lg mb-2">{{ job.title }}</h4>
                <p class="text-gray-600 text-sm mb-4">{{ job.department }}</p>
                
                <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                  <div>
                    <span class="text-gray-500">Applications:</span>
                    <span class="font-semibold text-blue-600 ml-1">{{ job.applications }}</span>
                  </div>
                  <div>
                    <span class="text-gray-500">Views:</span>
                    <span class="font-semibold text-green-600 ml-1">{{ job.views }}</span>
                  </div>
                  <div>
                    <span class="text-gray-500">Type:</span>
                    <span class="font-semibold text-purple-600 ml-1">{{ job.type }}</span>
                  </div>
                                <div>
                    <span class="text-gray-500">Posted:</span>
                    <span class="font-semibold text-gray-600 ml-1">{{ job.postedDays }}d ago</span>
                                </div>
                            </div>
  
                <div class="flex items-center space-x-2">
                  <button class="flex-1 bg-gradient-to-r from-blue-500 to-indigo-500 text-white py-2 px-4 rounded-xl font-semibold hover:scale-105 transition-all duration-300">
                    Manage
                  </button>
                  <button class="px-4 py-2 border-2 border-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors">
                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Candidates Tab -->
        <div v-if="activeTab === 'candidates'" class="space-y-8">
          <!-- Candidates Header -->
          <div class="bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 rounded-3xl p-8 text-white">
            <h2 class="text-4xl font-black mb-4">Candidate Management</h2>
            <p class="text-xl text-purple-100 mb-6">Review applications and manage your talent pool</p>
          </div>
  
          <!-- Candidates Interface -->
          <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
            <div class="flex items-center justify-between mb-8">
              <h3 class="text-2xl font-black text-gray-900">All Candidates</h3>
              <div class="flex items-center space-x-4">
                <select v-model="candidateFilter" class="px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                  <option value="all">All Candidates</option>
                  <option value="new">New Applications</option>
                  <option value="interview">Interview Stage</option>
                  <option value="hired">Hired</option>
                </select>
                <button class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-3 rounded-2xl font-semibold hover:scale-105 transition-all duration-300">
                  Export List
                </button>
              </div>
            </div>
  
            <!-- Candidates List -->
            <div class="space-y-4">
              <div v-for="candidate in filteredCandidates" :key="candidate.id" 
                   class="flex items-center justify-between p-6 border-2 border-gray-100 rounded-2xl hover:border-purple-200 hover:bg-purple-50 transition-all duration-300 group">
                <div class="flex items-center space-x-6">
                  <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                      {{ candidate.name.split(' ').map(n => n[0]).join('') }}
                    </div>
                    <div v-if="candidate.featured" class="absolute -top-2 -right-2 w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center">
                      <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                      </svg>
                            </div>
                            </div>
                  <div>
                    <div class="font-bold text-gray-900 text-lg">{{ candidate.name }}</div>
                    <div class="text-gray-600 font-medium">{{ candidate.position }}</div>
                    <div class="flex items-center space-x-4 mt-2">
                      <span class="text-sm text-gray-500">{{ candidate.experience }} experience</span>
                      <span class="text-sm text-gray-500">{{ candidate.education }}</span>
                      <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-600">{{ candidate.rating }}/5</span>
                      </div>
                    </div>
                    <div class="flex items-center space-x-2 mt-2">
                      <span v-for="skill in candidate.skills.slice(0, 3)" :key="skill"
                            class="px-2 py-1 bg-purple-100 text-purple-600 text-xs rounded-full font-medium">
                        {{ skill }}
                      </span>
                      <span v-if="candidate.skills.length > 3" 
                            class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full font-medium">
                        +{{ candidate.skills.length - 3 }}
                      </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                  <button @click="addToFavorites(candidate)"
                          class="text-red-500 hover:text-red-700 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                        </button>
                  <button class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 rounded-xl font-semibold transition-all duration-300 hover:scale-105">
                    View Profile
                        </button>
                  <button class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-6 py-2 rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                    Schedule Interview
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
      </div>
  
      <!-- Company Floating Action Menu -->
      <div class="fixed bottom-8 right-8 z-50">
        <div class="relative group">
          <button @click="showCompanyQuickMenu = !showCompanyQuickMenu"
                  class="w-16 h-16 bg-gradient-to-r from-green-600 via-emerald-600 to-teal-500 rounded-full shadow-2xl hover:shadow-3xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300 animate-pulse hover:animate-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
          </button>
          
          <!-- Company Quick Menu -->
          <div v-if="showCompanyQuickMenu" 
               class="absolute bottom-20 right-0 w-64 bg-white rounded-3xl shadow-2xl border-2 border-gray-200 transform transition-all duration-300">
            <div class="p-6">
              <h4 class="font-bold text-gray-900 mb-4">Quick Actions</h4>
              <div class="space-y-3">
                <button v-for="action in companyQuickActions" :key="action.title"
                        :class="`w-full text-left px-4 py-3 rounded-2xl font-semibold transition-all duration-300 flex items-center space-x-3 ${action.style}`">
                  <span class="text-xl">{{ action.icon }}</span>
                  <span>{{ action.title }}</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

// Reactive state
const activeTab = ref('overview');
const showCompanyQuickMenu = ref(false);
const jobFilter = ref('all');
const candidateFilter = ref('all');
const newTalentCount = ref(12);

// Company data
const companyData = ref({
  name: "Accenture Belgium",
  industry: "IT Consulting & Services",
  avatar: "AC",
  location: "Brussels, Belgium",
  status: "Verified Premium",
  profileCompleteness: 85,
  activeJobs: 8,
  applications: 156,
  interviews: 12,
  responseRate: 92
});

// Navigation tabs
const navigationTabs = ref([
  { 
    id: 'overview', 
    label: 'Overview', 
    icon: 'chart-icon',
    badge: null
  },
  { 
    id: 'jobs', 
    label: 'Jobs', 
    icon: 'briefcase-icon',
    badge: '8'
  },
  { 
    id: 'candidates', 
    label: 'Candidates', 
    icon: 'users-icon',
    badge: '156'
  },
  { 
    id: 'analytics', 
    label: 'Analytics', 
    icon: 'trending-icon',
    badge: null
  },
  { 
    id: 'events', 
    label: 'Events', 
    icon: 'calendar-icon',
    badge: '2'
  },
  { 
    id: 'messages', 
    label: 'Messages', 
    icon: 'message-icon',
    badge: '24'
  }
]);

// Company metrics for hero section
const companyMetrics = ref([
  {
    label: "Active Jobs",
    value: "8",
    trend: "+2",
    subtitle: "This month",
    icon: "briefcase-icon",
    trendColor: "bg-green-100 text-green-600"
  },
  {
    label: "Applications",
    value: "156",
    trend: "+23%",
    subtitle: "Total received",
    icon: "users-icon",
    trendColor: "bg-blue-100 text-blue-600"
  },
  {
    label: "Interview Rate",
    value: "67%",
    trend: "+12%",
    subtitle: "Conversion rate",
    icon: "target-icon",
    trendColor: "bg-purple-100 text-purple-600"
  },
  {
    label: "Hired",
    value: "24",
    trend: "+8",
    subtitle: "This quarter",
    icon: "check-icon",
    trendColor: "bg-green-100 text-green-600"
  }
]);

// Quick company actions
const quickCompanyActions = ref([
  {
    title: "Post New Job",
    icon: "💼",
    style: "bg-blue-500/20 hover:bg-blue-500/30 text-blue-700 border border-blue-300"
  },
  {
    title: "Review Applications",
    icon: "📋",
    style: "bg-purple-500/20 hover:bg-purple-500/30 text-purple-700 border border-purple-300"
  },
  {
    title: "Schedule Interviews",
    icon: "📅",
    style: "bg-green-500/20 hover:bg-green-500/30 text-green-700 border border-green-300"
  },
  {
    title: "Analytics Report",
    icon: "📊",
    style: "bg-orange-500/20 hover:bg-orange-500/30 text-orange-700 border border-orange-300"
  }
]);

// Company statistics
const companyStats = ref([
  { 
    label: "Total Applications", 
    value: 156, 
    change: "+23%", 
    subtitle: "This month",
    icon: "users-icon",
    iconBg: "bg-blue-100",
    iconColor: "text-blue-600",
    changeBg: "bg-green-100",
    changeColor: "text-green-600",
    gradient: "from-blue-500 to-indigo-500",
    trendPercentage: 78,
    trendBarColor: "bg-gradient-to-r from-blue-500 to-indigo-500"
  },
  { 
    label: "Interview Scheduled", 
    value: 24, 
    change: "+8", 
    subtitle: "This week",
    icon: "calendar-icon",
    iconBg: "bg-purple-100",
    iconColor: "text-purple-600",
    changeBg: "bg-blue-100",
    changeColor: "text-blue-600",
    gradient: "from-purple-500 to-pink-500",
    trendPercentage: 65,
    trendBarColor: "bg-gradient-to-r from-purple-500 to-pink-500"
  },
  { 
    label: "Successful Hires", 
    value: 12, 
    change: "+4", 
    subtitle: "This quarter",
    icon: "check-icon",
    iconBg: "bg-green-100",
    iconColor: "text-green-600",
    changeBg: "bg-green-100",
    changeColor: "text-green-600",
    gradient: "from-green-500 to-emerald-500",
    trendPercentage: 82,
    trendBarColor: "bg-gradient-to-r from-green-500 to-emerald-500"
  },
  { 
    label: "Company Rating", 
    value: "4.8★", 
    change: "+0.2", 
    subtitle: "Candidate reviews",
    icon: "star-icon",
    iconBg: "bg-yellow-100",
    iconColor: "text-yellow-600",
    changeBg: "bg-green-100",
    changeColor: "text-green-600",
    gradient: "from-yellow-500 to-orange-500",
    trendPercentage: 96,
    trendBarColor: "bg-gradient-to-r from-yellow-500 to-orange-500"
  }
]);

// Active jobs
const activeJobs = ref([
  {
      id: 1,
    title: "Senior Software Engineer",
    department: "Technology",
    applications: 45,
    postedDays: 5,
    type: "Full-time",
    status: "active"
  },
  {
      id: 2,
    title: "Frontend Developer",
    department: "Digital",
    applications: 32,
    postedDays: 3,
    type: "Full-time", 
    status: "active"
  },
  {
      id: 3,
    title: "Data Analyst",
    department: "Analytics",
    applications: 28,
    postedDays: 7,
    type: "Contract",
    status: "active"
  },
  {
    id: 4,
    title: "UX Designer",
    department: "Design",
    applications: 19,
    postedDays: 2,
    type: "Full-time",
    status: "draft"
  }
]);

// Recent applications
const recentApplications = ref([
  {
      id: 1,
    candidateName: "Maryam Afallah",
    position: "Frontend Developer",
    experience: "2+ years",
    appliedHours: 2,
    matchScore: 94,
    featured: true
  },
  {
      id: 2,
    candidateName: "Thomas Janssen",
    position: "Senior Software Engineer", 
    experience: "5+ years",
    appliedHours: 4,
    matchScore: 87,
    featured: false
  },
  {
    id: 3,
    candidateName: "Sarah De Vos",
    position: "Data Analyst",
    experience: "3+ years", 
    appliedHours: 6,
    matchScore: 91,
    featured: true
  },
  {
    id: 4,
    candidateName: "Lucas Martinez",
    position: "UX Designer",
    experience: "4+ years",
    appliedHours: 8,
    matchScore: 78,
    featured: false
  }
]);

// Talent pipeline
const talentPipeline = ref([
  { name: "Applied", count: 156, percentage: 100, active: true },
  { name: "Screening", count: 89, percentage: 57, active: true },
  { name: "Interview", count: 24, percentage: 15, active: true },
  { name: "Offer", count: 8, percentage: 5, active: false }
]);

// Profile sections
const profileSections = ref([
  {
    name: "Company Information",
    status: "complete",
    progress: 100,
    description: "Basic company details and description"
  },
  {
    name: "Culture & Values",
    status: "complete",
    progress: 90,
    description: "Company culture, values and benefits"
  },
  {
    name: "Media & Photos",
    status: "incomplete",
    progress: 60,
    description: "Office photos and company videos"
  },
  {
    name: "Contact Information",
    status: "complete",
    progress: 100,
    description: "Location, contact details and social media"
  }
]);

// Favorite candidates (integrated with favorites system)
const favoriteCandidates = ref([
  {
    id: 1,
    name: "Maryam Afallah",
    field: "Frontend Development",
    skills: ["React", "JavaScript", "CSS"],
    rating: 4.9
  },
  {
    id: 2,
    name: "Thomas Janssen", 
    field: "Backend Development",
    skills: ["Java", "Spring", "PostgreSQL"],
    rating: 4.7
  },
  {
      id: 3,
    name: "Sarah De Vos",
    field: "Data Science",
    skills: ["Python", "Machine Learning", "SQL"],
    rating: 4.8
  }
]);

// Recruitment metrics
const recruitmentMetrics = ref([
  {
    name: "Application Response Rate",
    value: "92%",
    percentage: 92,
    barColor: "bg-gradient-to-r from-green-500 to-emerald-500",
    color: "text-green-600",
    description: "Companies respond to applications"
  },
  {
    name: "Interview Conversion",
    value: "15%",
    percentage: 68,
    barColor: "bg-gradient-to-r from-blue-500 to-indigo-500",
    color: "text-blue-600",
    description: "Applications leading to interviews"
  },
  {
    name: "Hire Success Rate",
    value: "8%",
    percentage: 45,
    barColor: "bg-gradient-to-r from-purple-500 to-pink-500",
    color: "text-purple-600",
    description: "Interviews resulting in hires"
  },
  {
    name: "Time to Hire",
    value: "18 days",
    percentage: 75,
    barColor: "bg-gradient-to-r from-yellow-500 to-orange-500",
    color: "text-yellow-600",
    description: "Average hiring process duration"
  }
]);

// Quick tools
const quickTools = ref([
  {
    title: "Bulk Actions",
    description: "Mass operations",
    icon: "⚡",
    hoverColor: "hover:border-blue-300 hover:bg-blue-50"
  },
  {
    title: "Export Data",
    description: "Download reports",
    icon: "📊",
    hoverColor: "hover:border-green-300 hover:bg-green-50"
  },
  {
    title: "Invite Team",
    description: "Add colleagues",
    icon: "👥",
    hoverColor: "hover:border-purple-300 hover:bg-purple-50"
  },
  {
    title: "Settings",
    description: "Configure account",
    icon: "⚙️",
    hoverColor: "hover:border-gray-300 hover:bg-gray-50"
  }
]);

// All candidates (for candidate management)
const allCandidates = ref([
  {
      id: 1,
    name: "Maryam Afallah",
    position: "Frontend Developer",
    experience: "2+ years",
    education: "Bachelor Computer Science",
    rating: 4.9,
    skills: ["React", "JavaScript", "CSS", "TypeScript"],
    featured: true,
    status: "new"
  },
  {
      id: 2,
    name: "Thomas Janssen",
    position: "Senior Software Engineer", 
    experience: "5+ years",
    education: "Master Software Engineering",
    rating: 4.7,
    skills: ["Java", "Spring", "PostgreSQL", "Microservices"],
    featured: false,
    status: "interview"
  },
  {
      id: 3,
    name: "Sarah De Vos",
    position: "Data Analyst",
    experience: "3+ years",
    education: "Master Data Science",
    rating: 4.8,
    skills: ["Python", "Machine Learning", "SQL", "Tableau"],
    featured: true,
    status: "new"
  }
]);

// Company quick actions
const companyQuickActions = ref([
  {
    title: "Post Job",
    icon: "💼",
    style: "hover:bg-blue-50 text-blue-700"
  },
  {
    title: "Review CVs",
    icon: "📋",
    style: "hover:bg-purple-50 text-purple-700"
  },
  {
    title: "Schedule Call",
    icon: "📞",
    style: "hover:bg-green-50 text-green-700"
  },
  {
    title: "Send Message",
    icon: "💬",
    style: "hover:bg-orange-50 text-orange-700"
  }
]);

// Computed properties
const filteredJobs = computed(() => {
  if (jobFilter.value === 'all') return activeJobs.value;
  return activeJobs.value.filter(job => job.status === jobFilter.value);
});

const filteredCandidates = computed(() => {
  if (candidateFilter.value === 'all') return allCandidates.value;
  return allCandidates.value.filter(candidate => candidate.status === candidateFilter.value);
});

// Helper functions
const getJobTypeColor = (type) => {
  const colors = {
    'Full-time': 'bg-green-100 text-green-800 border-green-200',
    'Part-time': 'bg-blue-100 text-blue-800 border-blue-200',
    'Contract': 'bg-orange-100 text-orange-800 border-orange-200',
    'Internship': 'bg-purple-100 text-purple-800 border-purple-200'
  };
  return colors[type] || 'bg-gray-100 text-gray-800 border-gray-200';
};

const getJobStatusColor = (status) => {
  const colors = {
    'active': 'bg-green-100 text-green-800 border-green-200',
    'draft': 'bg-yellow-100 text-yellow-800 border-yellow-200',
    'paused': 'bg-orange-100 text-orange-800 border-orange-200',
    'closed': 'bg-red-100 text-red-800 border-red-200'
  };
  return colors[status] || 'bg-gray-100 text-gray-800 border-gray-200';
};

// Action functions
const addToFavorites = (candidate) => {
  const exists = favoriteCandidates.value.find(fav => fav.id === candidate.id);
  if (!exists) {
    favoriteCandidates.value.push({
      id: candidate.id,
      name: candidate.name,
      field: candidate.position,
      skills: candidate.skills.slice(0, 3),
      rating: candidate.rating
    });
  }
};

const removeFromFavorites = (candidateId) => {
  favoriteCandidates.value = favoriteCandidates.value.filter(candidate => candidate.id !== candidateId);
};

// Initialize favorites from global state if available
onMounted(() => {
  if (window.companyFavoritesState?.value) {
    favoriteCandidates.value = window.companyFavoritesState.value;
  }
  
  // Make favorite functions globally available for companies
  if (!window.addCandidateToFavorites) {
    window.addCandidateToFavorites = addToFavorites;
  }
  
  if (!window.removeCandidateFromFavorites) {
    window.removeCandidateFromFavorites = removeFromFavorites;
  }
  
  console.log('Company Dashboard PRO initialized');
});
</script> 
  
<style scoped>
/* Custom scrollbar */
.overflow-y-auto::-webkit-scrollbar {
  width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 10px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
  background: #555;
}

/* Custom animations */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
  animation: fadeIn 0.5s ease-out;
}

/* Hover scale effects */
.hover\:scale-102:hover {
  transform: scale(1.02);
}

.hover\:scale-105:hover {
  transform: scale(1.05);
}

.hover\:scale-110:hover {
  transform: scale(1.1);
}

/* Gradient text */
.bg-clip-text {
  -webkit-background-clip: text;
  background-clip: text;
}

/* Pulse animation for floating button */
@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.05); }
}

.animate-pulse {
  animation: pulse 2s infinite;
}
</style>