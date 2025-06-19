<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
      <!-- Advanced Header -->
      <header class="bg-white/95 backdrop-blur-xl shadow-2xl border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between items-center h-20">
            <!-- Premium Logo -->
            <div class="flex items-center space-x-4">
              <div class="relative">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 via-red-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                  <span class="text-white font-bold text-xl tracking-tight">E</span>
                </div>
                <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white animate-pulse"></div>
              </div>
              <div>
                <div class="font-black text-2xl text-gray-900 tracking-tight">erasmus</div>
                <div class="text-xs text-gray-500 font-semibold tracking-wider uppercase">Student Portal</div>
              </div>
            </div>
            
            <!-- Advanced Navigation & User Info -->
            <div class="flex items-center space-x-6">
              <!-- Quick Stats Bar -->
              <div class="hidden lg:flex items-center space-x-6 px-6 py-3 bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl border border-gray-200">
                <div class="text-center">
                  <div class="text-lg font-bold text-gray-900">{{ studentData.applications }}</div>
                  <div class="text-xs text-gray-500 font-medium">Applications</div>
                </div>
                <div class="w-px h-8 bg-gray-300"></div>
                <div class="text-center">
                  <div class="text-lg font-bold text-green-600">{{ studentData.profileComplete }}%</div>
                  <div class="text-xs text-gray-500 font-medium">Complete</div>
                </div>
                <div class="w-px h-8 bg-gray-300"></div>
                <div class="text-center">
                  <div class="text-lg font-bold text-blue-600">{{ studentData.profileViews }}</div>
                  <div class="text-xs text-gray-500 font-medium">Views</div>
                </div>
              </div>
  
              <!-- Notifications -->
              <div class="relative">
                <button class="p-3 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-all duration-300 relative">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                  </svg>
                  <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full animate-bounce"></span>
                </button>
              </div>
  
              <!-- Settings -->
              <button class="p-3 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </button>
  
              <!-- User Profile -->
              <div class="flex items-center space-x-4 pl-4 border-l border-gray-200">
                <div class="relative">
                  <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-lg">{{ studentData.avatar }}</span>
                  </div>
                  <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                </div>
                <div class="hidden sm:block">
                  <div class="text-sm font-bold text-gray-900">{{ studentData.name }}</div>
                  <div class="text-xs text-gray-500 font-medium">{{ studentData.study }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
  
      <!-- Main Content Container -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Hero Welcome Section -->
        <div class="bg-gradient-to-br from-violet-900 via-purple-900 to-indigo-900 rounded-3xl p-12 text-white relative overflow-hidden mb-10 shadow-2xl">
          <!-- Animated Background Elements -->
          <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 bg-white/5 rounded-full blur-3xl animate-pulse delay-1000"></div>
            <div class="absolute top-1/2 left-1/3 w-20 h-20 bg-white/10 rounded-full blur-xl animate-bounce"></div>
          </div>
          
          <div class="relative z-10 flex justify-between items-center">
            <div class="max-w-2xl">
              <div class="flex items-center space-x-3 mb-4">
                <span class="text-4xl">👋</span>
                <span class="bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 text-sm font-semibold">Welcome back!</span>
              </div>
              <h1 class="text-6xl font-black mb-4 bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">
                Hello, {{ studentData.name.split(' ')[0] }}!
              </h1>
              <p class="text-xl text-purple-200 mb-8 leading-relaxed">
                Your career journey is <span class="font-bold text-yellow-300">accelerating</span>. 
                Let's make today count towards your dream job! 🚀
              </p>
              
              <!-- Quick Actions -->
              <div class="flex flex-wrap gap-4">
                <button class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                  🔍 Browse Jobs
                </button>
                <button class="bg-gradient-to-r from-yellow-400 to-orange-500 hover:from-yellow-500 hover:to-orange-600 text-black px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                  ✨ Update Profile
                </button>
                <button class="border-2 border-white/30 hover:border-white/50 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105">
                  📊 View Analytics
                </button>
              </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="hidden lg:block">
              <div class="grid grid-cols-2 gap-6">
                <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20 hover:bg-white/30 transition-all duration-300">
                  <div class="text-4xl font-black text-yellow-300">{{ studentData.applications }}</div>
                  <div class="text-purple-200 font-semibold">Applications</div>
                  <div class="text-xs text-purple-300 mt-1">+23% this month</div>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20 hover:bg-white/30 transition-all duration-300">
                  <div class="text-4xl font-black text-green-300">{{ studentData.profileComplete }}%</div>
                  <div class="text-purple-200 font-semibold">Complete</div>
                  <div class="text-xs text-purple-300 mt-1">Profile strength</div>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20 hover:bg-white/30 transition-all duration-300">
                  <div class="text-4xl font-black text-blue-300">{{ studentData.profileViews }}</div>
                  <div class="text-purple-200 font-semibold">Views</div>
                  <div class="text-xs text-purple-300 mt-1">This week</div>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20 hover:bg-white/30 transition-all duration-300">
                  <div class="text-4xl font-black text-pink-300">{{ studentData.connections }}</div>
                  <div class="text-purple-200 font-semibold">Network</div>
                  <div class="text-xs text-purple-300 mt-1">Connections</div>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Premium Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
          <div v-for="(stat, index) in stats" :key="index" 
               class="group bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:shadow-2xl hover:scale-105 transition-all duration-500 relative overflow-hidden">
            <!-- Gradient Background -->
            <div :class="`absolute inset-0 bg-gradient-to-br ${stat.gradient} opacity-0 group-hover:opacity-10 transition-opacity duration-500`"></div>
            
            <div class="relative z-10">
              <div class="flex items-center justify-between mb-6">
                <div :class="`p-4 ${stat.iconBg} rounded-2xl shadow-lg`">
                  <component :is="stat.icon" :class="`w-8 h-8 ${stat.iconColor}`" />
                </div>
                <div class="text-right">
                  <span :class="`text-sm font-bold px-3 py-1 rounded-full ${stat.changeBg} ${stat.changeColor}`">
                    {{ stat.change }}
                  </span>
                </div>
              </div>
              <div class="text-4xl font-black text-gray-900 mb-3">{{ stat.value }}</div>
              <div class="text-gray-600 font-semibold">{{ stat.label }}</div>
              <div class="text-xs text-gray-500 mt-2">{{ stat.subtitle }}</div>
            </div>
          </div>
        </div>
  
        <!-- Main Dashboard Grid -->
        <div class="grid lg:grid-cols-3 gap-8 mb-10">
          <!-- Left Column - Main Content -->
          <div class="lg:col-span-2 space-y-8">
            
            <!-- Application Pipeline -->
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
              <div class="flex items-center justify-between mb-8">
                <div>
                  <h3 class="text-2xl font-black text-gray-900">Application Pipeline</h3>
                  <p class="text-gray-600 mt-1">Track your job application progress</p>
                </div>
                <button class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                  View All
                </button>
              </div>
              
              <!-- Pipeline Visualization -->
              <div class="relative mb-8">
                <div class="flex justify-between items-center">
                  <div v-for="(stage, index) in applicationStages" :key="stage.name" class="flex-1 text-center relative">
                    <div :class="`w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 text-lg font-bold transition-all duration-500 shadow-lg ${
                      stage.active ? 'bg-gradient-to-br from-orange-500 to-red-500 text-white scale-110' : 'bg-gray-200 text-gray-600'
                    }`">
                      {{ stage.count }}
                    </div>
                    <div class="text-sm font-bold text-gray-900">{{ stage.name }}</div>
                    <div class="text-xs text-gray-600">{{ stage.percentage }}%</div>
                    <div v-if="index < applicationStages.length - 1" 
                         :class="`absolute top-8 left-1/2 w-full h-1 rounded-full -z-10 ${
                           stage.active ? 'bg-gradient-to-r from-orange-500 to-red-500' : 'bg-gray-200'
                         }`"></div>
                  </div>
                </div>
              </div>
  
              <!-- Recent Applications -->
              <div class="space-y-4">
                <h4 class="font-bold text-gray-900 mb-4">Recent Applications</h4>
                <div v-for="app in recentApplications" :key="app.id" 
                     class="flex items-center justify-between p-6 border-2 border-gray-100 rounded-2xl hover:border-orange-200 hover:bg-orange-50 transition-all duration-300 group">
                  <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                      {{ app.company.logo }}
                    </div>
                    <div>
                      <div class="font-bold text-gray-900 text-lg">{{ app.position }}</div>
                      <div class="text-gray-600 font-medium">{{ app.company.name }}</div>
                      <div class="text-sm text-gray-500">Applied {{ app.appliedDays }} days ago</div>
                    </div>
                  </div>
                  <div class="flex items-center space-x-4">
                    <span :class="`px-4 py-2 rounded-xl text-sm font-bold ${getStatusColor(app.status)}`">
                      {{ app.status }}
                    </span>
                    <button class="opacity-0 group-hover:opacity-100 text-gray-400 hover:text-gray-600 transition-all duration-300">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>
  
            <!-- Skills Development -->
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
              <div class="flex items-center justify-between mb-8">
                <div>
                  <h3 class="text-2xl font-black text-gray-900">Skills Development</h3>
                  <p class="text-gray-600 mt-1">Level up your professional skills</p>
                </div>
                <button class="bg-gradient-to-r from-purple-500 to-indigo-500 hover:from-purple-600 hover:to-indigo-600 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                  Take Assessment
                </button>
              </div>
              
              <div class="grid md:grid-cols-2 gap-8">
                <!-- Current Skills -->
                <div>
                  <h4 class="font-bold text-gray-900 mb-6 text-lg">Current Skills</h4>
                  <div class="space-y-4">
                    <div v-for="skill in currentSkills" :key="skill.name" class="group">
                      <div class="flex items-center justify-between mb-2">
                        <span class="font-semibold text-gray-700">{{ skill.name }}</span>
                        <span class="text-sm font-bold text-gray-900">{{ skill.level }}%</span>
                      </div>
                      <div class="w-full h-3 bg-gray-200 rounded-full overflow-hidden">
                        <div :class="`h-3 rounded-full transition-all duration-1000 ${getSkillColor(skill.level)}`" 
                             :style="`width: ${skill.level}%`"></div>
                      </div>
                    </div>
                  </div>
                </div>
  
                <!-- Recommended Skills -->
                <div>
                  <h4 class="font-bold text-gray-900 mb-6 text-lg">Recommended Skills</h4>
                  <div class="space-y-4">
                    <div v-for="skill in recommendedSkills" :key="skill.name" 
                         class="flex items-center justify-between p-4 border-2 border-gray-100 rounded-2xl hover:border-purple-200 hover:bg-purple-50 transition-all duration-300 group">
                      <div>
                        <div class="font-semibold text-gray-900">{{ skill.name }}</div>
                        <div class="text-sm text-gray-600">{{ skill.demand }}% demand in IT</div>
                      </div>
                      <button class="bg-gradient-to-r from-orange-100 to-red-100 hover:from-orange-200 hover:to-red-200 text-orange-600 px-4 py-2 rounded-xl font-semibold transition-all duration-300 hover:scale-105">
                        Learn
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  
            <!-- My Favorite Companies -->
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
              <div class="flex items-center justify-between mb-8">
                <div>
                  <h3 class="text-2xl font-black text-gray-900">My Favorite Companies</h3>
                  <p class="text-gray-600 mt-1">{{ favoriteCompanies.length }} companies in your watchlist</p>
                </div>
                <div class="flex items-center space-x-4">
                  <button @click="showAllFavorites = !showAllFavorites" 
                          class="text-orange-600 hover:text-orange-800 font-semibold transition-colors">
                    {{ showAllFavorites ? 'Show Less' : 'View All' }}
                  </button>
                  <button class="bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                    Add More
                  </button>
                </div>
              </div>
              
              <div class="grid md:grid-cols-2 gap-6">
                <div v-for="company in (showAllFavorites ? favoriteCompanies : favoriteCompanies.slice(0, 4))" 
                     :key="company.id" 
                     class="group border-2 border-gray-100 rounded-2xl p-6 hover:border-pink-200 hover:bg-pink-50 transition-all duration-300 relative overflow-hidden">
                  
                  <!-- Favorite Heart -->
                  <button @click="removeFromFavorites(company.id)" 
                          class="absolute top-4 right-4 text-red-500 hover:text-red-700 transition-colors">
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                      <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                  </button>
  
                  <div class="flex items-center space-x-4 mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                      {{ company.logo }}
                    </div>
                    <div class="flex-1">
                      <div class="font-bold text-gray-900 text-lg">{{ company.name }}</div>
                      <div class="text-gray-600 font-medium">{{ company.industry }}</div>
                    </div>
                  </div>
                  
                  <div class="text-sm text-gray-600 mb-4 line-clamp-2">{{ company.specialisatie }}</div>
                  
                  <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center text-gray-500">
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                      </svg>
                      {{ company.location }}
                    </div>
                    <div class="flex items-center text-gray-500">
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                      </svg>
                      {{ company.employees }}
                    </div>
                  </div>
  
                  <!-- Hover Actions -->
                  <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="flex gap-2">
                      <button class="flex-1 bg-gradient-to-r from-orange-500 to-red-500 text-white py-2 px-4 rounded-xl font-semibold text-sm hover:scale-105 transition-all duration-300">
                        View Jobs
                      </button>
                      <button class="px-4 py-2 border-2 border-orange-500 text-orange-600 rounded-xl font-semibold text-sm hover:bg-orange-50 transition-all duration-300">
                        Visit
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
          <!-- Right Column - Sidebar -->
          <div class="space-y-8">
            
            <!-- Career Goals -->
            <div class="bg-gradient-to-br from-purple-50 via-indigo-50 to-blue-50 rounded-3xl p-8 border-2 border-purple-200">
              <div class="flex items-center justify-between mb-6">
                <div>
                  <h3 class="text-xl font-black text-gray-900">Career Goals</h3>
                  <p class="text-gray-600 text-sm">Track your progress</p>
                </div>
                <div class="p-3 bg-purple-200 rounded-2xl">
                  <svg class="w-6 h-6 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                  </svg>
                </div>
              </div>
              
              <div class="space-y-6">
                <div v-for="goal in careerGoals" :key="goal.id" class="bg-white rounded-2xl p-6 shadow-lg border border-purple-100">
                  <div class="flex items-center justify-between mb-3">
                    <div class="font-bold text-gray-900">{{ goal.title }}</div>
                    <span class="text-lg font-black text-purple-600">{{ goal.progress }}%</span>
                  </div>
                  <div class="w-full h-3 bg-purple-100 rounded-full mb-3 overflow-hidden">
                    <div class="h-3 bg-gradient-to-r from-purple-500 via-indigo-500 to-blue-500 rounded-full transition-all duration-1000" 
                         :style="`width: ${goal.progress}%`"></div>
                  </div>
                  <div class="text-sm text-gray-600">{{ goal.description }}</div>
                </div>
              </div>
            </div>
  
            <!-- Networking -->
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
              <div class="flex items-center justify-between mb-6">
                <div>
                  <h3 class="text-xl font-black text-gray-900">Networking</h3>
                  <p class="text-gray-600 text-sm">Expand your network</p>
                </div>
                <button class="text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                  View All
                </button>
              </div>
              
              <div class="space-y-4">
                <div v-for="person in networkingSuggestions" :key="person.id" 
                     class="flex items-center space-x-4 p-4 border-2 border-gray-100 rounded-2xl hover:border-blue-200 hover:bg-blue-50 transition-all duration-300 group">
                  <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-blue-500 rounded-2xl flex items-center justify-center text-white font-bold shadow-lg">
                    {{ person.name.split(' ').map(n => n[0]).join('') }}
                  </div>
                  <div class="flex-1">
                    <div class="font-semibold text-gray-900">{{ person.name }}</div>
                    <div class="text-xs text-gray-600">{{ person.position }}</div>
                    <div class="text-xs text-blue-600 font-medium">{{ person.mutualConnections }} mutual</div>
                  </div>
                  <button class="opacity-75 group-hover:opacity-100 bg-gradient-to-r from-blue-100 to-indigo-100 hover:from-blue-200 hover:to-indigo-200 text-blue-600 px-4 py-2 rounded-xl font-semibold text-sm transition-all duration-300 hover:scale-105">
                    Connect
                  </button>
                </div>
              </div>
            </div>
  
            <!-- Upcoming Events -->
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
              <div class="flex items-center justify-between mb-6">
                <div>
                  <h3 class="text-xl font-black text-gray-900">Upcoming Events</h3>
                  <p class="text-gray-600 text-sm">June 2025</p>
                </div>
              </div>
              
              <div class="space-y-4">
                <div v-for="event in upcomingEvents" :key="event.id" 
                     :class="`flex items-start space-x-4 p-4 rounded-2xl transition-all duration-300 ${
                       event.isToday ? 'bg-gradient-to-r from-orange-50 to-red-50 border-2 border-orange-200' : 'hover:bg-gray-50'
                     }`">
                  <div :class="`w-12 h-12 rounded-2xl flex items-center justify-center text-white text-xl font-bold shadow-lg ${
                    event.isToday ? 'bg-gradient-to-r from-orange-500 to-red-500' : 'bg-gradient-to-r from-blue-500 to-indigo-500'
                  }`">
                    {{ event.icon }}
                  </div>
                  <div class="flex-1">
                    <div class="font-semibold text-gray-900">{{ event.title }}</div>
                    <div class="text-sm text-gray-600">{{ event.time }}</div>
                    <div class="text-xs text-gray-500">{{ event.location }}</div>
                  </div>
                  <div v-if="event.isToday" class="w-3 h-3 bg-orange-500 rounded-full animate-pulse"></div>
                </div>
              </div>
            </div>
  
            <!-- Quick Actions -->
            <div class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 rounded-3xl p-8 border-2 border-green-200">
              <h3 class="text-xl font-black text-gray-900 mb-6">Quick Actions</h3>
              <div class="grid grid-cols-2 gap-4">
                <button v-for="action in quickActions" :key="action.title"
                        class="bg-white p-4 rounded-2xl border-2 border-gray-200 hover:border-green-300 hover:shadow-lg transition-all duration-300 text-left group hover:scale-105">
                  <div class="text-3xl mb-2">{{ action.icon }}</div>
                  <div class="text-sm font-bold text-gray-900">{{ action.title }}</div>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Floating Action Button -->
      <div class="fixed bottom-8 right-8 z-50">
        <div class="relative group">
          <button @click="showQuickMenu = !showQuickMenu"
                  class="w-16 h-16 bg-gradient-to-r from-orange-500 via-red-500 to-pink-500 rounded-full shadow-2xl hover:shadow-3xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300 animate-pulse hover:animate-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
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
  import { ref, computed, onMounted } from 'vue';
  
  // Reactive state
  const showQuickMenu = ref(false);
  const showAllFavorites = ref(false);
  
  interface StudentData {
    name: string;
    study: string;
    avatar: string;
    applications: number;
    profileComplete: number;
    profileViews: number;
    connections: number;
  }

  interface ApplicationStatus {
    id: number;
    position: string;
    company: { name: string; logo: string };
    status: 'Interview Scheduled' | 'Under Review' | 'Application Sent' | 'Offer' | 'Rejected';
    appliedDays: number;
  }

  interface Stat {
    label: string;
    value: string | number;
    change: string;
    subtitle: string;
    icon: string;
    iconBg: string;
    iconColor: string;
    changeBg: string;
    changeColor: string;
    gradient: string;
  }

  interface ApplicationStage {
    name: string;
    count: number;
    percentage: number;
    active: boolean;
  }

  interface CareerGoal {
    id: number;
    title: string;
    description: string;
    progress: number;
  }

  interface NetworkingSuggestion {
    id: number;
    name: string;
    position: string;
    mutualConnections: number;
  }

  interface UpcomingEvent {
    id: number;
    title: string;
    time: string;
    location: string;
    icon: string;
    isToday: boolean;
  }

  interface FavoriteCompany {
    id: number;
    name: string;
    industry: string;
    employees: string;
    location: string;
    specialisatie: string;
    logo: string;
  }

  interface QuickAction {
    title: string;
    icon: string;
  }

  interface FloatingMenuItem {
    title: string;
    icon: string;
  }

  // Student data
  const studentData = ref<StudentData>({
    name: 'Maryam Afallah',
    study: 'Applied Computer Science',
    avatar: 'MA',
    applications: 23,
    profileComplete: 85,
    profileViews: 156,
    connections: 89
  });
  
  // Stats for the grid
  const stats = ref<Stat[]>([
    { 
      label: "Applications", 
      value: 23, 
      change: "+23%", 
      subtitle: "This month",
      icon: "briefcase-icon",
      iconBg: "bg-blue-100",
      iconColor: "text-blue-600",
      changeBg: "bg-green-100",
      changeColor: "text-green-600",
      gradient: "from-blue-500 to-indigo-500"
    },
    { 
      label: "Profile Views", 
      value: 156, 
      change: "+12%", 
      subtitle: "This week",
      icon: "eye-icon",
      iconBg: "bg-green-100",
      iconColor: "text-green-600",
      changeBg: "bg-blue-100",
      changeColor: "text-blue-600",
      gradient: "from-green-500 to-emerald-500"
    },
    { 
      label: "Network", 
      value: 89, 
      change: "+8", 
      subtitle: "New connections",
      icon: "users-icon",
      iconBg: "bg-purple-100",
      iconColor: "text-purple-600",
      changeBg: "bg-purple-100",
      changeColor: "text-purple-600",
      gradient: "from-purple-500 to-indigo-500"
    },
    { 
      label: "Success Rate", 
      value: "67%", 
      change: "+5%", 
      subtitle: "Interview rate",
      icon: "trending-icon",
      iconBg: "bg-orange-100",
      iconColor: "text-orange-600",
      changeBg: "bg-green-100",
      changeColor: "text-green-600",
      gradient: "from-orange-500 to-red-500"
    }
  ]);
  
  // Application stages
  const applicationStages = ref<ApplicationStage[]>([
    { name: "Applied", count: 23, percentage: 100, active: true },
    { name: "Screening", count: 15, percentage: 65, active: true },
    { name: "Interview", count: 8, percentage: 35, active: true },
    { name: "Offer", count: 3, percentage: 13, active: false }
  ]);
  
  // Recent applications
  const recentApplications = ref<ApplicationStatus[]>([
    {
      id: 1,
      position: 'Junior Software Developer',
      company: { name: 'Capgemini', logo: '/images/logos/capgemini-logo.svg' },
      status: 'Interview Scheduled',
      appliedDays: 3
    },
    {
      id: 2,
      position: 'Frontend Developer',
      company: { name: 'Accenture', logo: '/images/logos/accenture-logo.svg' },
      status: 'Under Review',
      appliedDays: 5
    },
    {
      id: 3,
      position: 'Web Developer',
      company: { name: 'delaware', logo: '/images/logos/delaware-logo.svg' },
      status: 'Application Sent',
      appliedDays: 1
    }
  ]);
  
  // Current skills
  const currentSkills = [
    { name: 'JavaScript', level: 75 },
    { name: 'HTML/CSS', level: 85 },
    { name: 'Java', level: 60 },
    { name: 'Microsoft Office', level: 90 },
    { name: 'French', level: 100 },
    { name: 'Dutch', level: 85 }
  ];
  
  // Recommended skills
  const recommendedSkills = [
    { name: 'React.js', demand: 89 },
    { name: 'Node.js', demand: 76 },
    { name: 'Python', demand: 83 },
    { name: 'SQL', demand: 71 }
  ];
  
  // Career goals
  const careerGoals = ref<CareerGoal[]>([
    {
      id: 1,
      title: "Land First Developer Job",
      description: "Secure a junior developer position by July 2025",
      progress: 65
    },
    {
      id: 2,
      title: "Build Professional Network",
      description: "Connect with 100+ industry professionals", 
      progress: 45
    },
    {
      id: 3,
      title: "Complete Portfolio",
      description: "Showcase 5 professional projects",
      progress: 80
    }
  ]);
  
  // Networking suggestions
  const networkingSuggestions = ref<NetworkingSuggestion[]>([
    {
      id: 1,
      name: "Sarah De Vos",
      position: "Senior Developer at Capgemini",
      mutualConnections: 3
    },
    {
      id: 2,
      name: "Thomas Janssens", 
      position: "HR Manager at Accenture",
      mutualConnections: 1
    },
    {
      id: 3,
      name: "Marie Dupont",
      position: "Tech Lead at Delaware",
      mutualConnections: 2
    }
  ]);
  
  // Upcoming events
  const upcomingEvents = ref<UpcomingEvent[]>([
    {
      id: 1,
      title: "Tech Career Fair",
      time: "Today 2:00 PM",
      location: "Erasmushogeschool Brussels",
      icon: "📊",
      isToday: true
    },
    {
      id: 2,
      title: "Mock Interview Session",
      time: "Tomorrow 10:00 AM", 
      location: "Online",
      icon: "💼",
      isToday: false
    },
    {
      id: 3,
      title: "Networking Workshop",
      time: "Friday 6:00 PM",
      location: "Brussels",
      icon: "🤝",
      isToday: false
    }
  ]);
  
  // Favorite companies (integrated with favorites system)
  const favoriteCompanies = ref<FavoriteCompany[]>([
    {
      id: 1,
      name: "Accenture",
      industry: "IT Consulting",
      employees: "500+",
      location: "Brussels",
      specialisatie: "Technology & Consulting Leader with global expertise in digital transformation",
      logo: "A"
    },
    {
      id: 2,
      name: "Capgemini", 
      industry: "Technology Services",
      employees: "200+",
      location: "Brussels",
      specialisatie: "Digital Transformation Partner specializing in cloud and AI solutions",
      logo: "C"
    },
    {
      id: 3,
      name: "BNP Paribas Fortis",
      industry: "Financial Services", 
      employees: "1000+",
      location: "Brussels",
      specialisatie: "Leading Bank & Financial Services with innovative digital banking",
      logo: "B"
    },
    {
      id: 4,
      name: "Microsoft",
      industry: "Technology", 
      employees: "150+",
      location: "Brussels",
      specialisatie: "Cloud & AI Technology Solutions driving digital innovation",
      logo: "M"
    },
    {
      id: 5,
      name: "Delaware",
      industry: "IT Consulting", 
      employees: "100+",
      location: "Brussels",
      specialisatie: "Business & Technology Solutions with focus on enterprise applications",
      logo: "D"
    },
    {
      id: 6,
      name: "Deloitte",
      industry: "Professional Services", 
      employees: "300+",
      location: "Brussels",
      specialisatie: "Professional Services & Consulting with technology advisory expertise",
      logo: "D"
    }
  ]);
  
  // Quick actions
  const quickActions = ref<QuickAction[]>([
    { title: "Search Jobs", icon: "🔍" },
    { title: "Update CV", icon: "📝" },
    { title: "Network", icon: "🤝" },
    { title: "Analytics", icon: "📊" }
  ]);
  
  // Floating menu items
  const floatingMenuItems = ref<FloatingMenuItem[]>([
    { title: "Quick Apply", icon: "📝" },
    { title: "Schedule Meeting", icon: "📅" },
    { title: "Send Message", icon: "💬" },
    { title: "Set Goal", icon: "🎯" },
    { title: "Add Company", icon: "🏢" }
  ]);
  
  // Helper functions
  const getStatusColor = (status: string): string => {
    const colors = {
      'Interview Scheduled': 'bg-yellow-100 text-yellow-800 border-yellow-200',
      'Under Review': 'bg-blue-100 text-blue-800 border-blue-200', 
      'Application Sent': 'bg-gray-100 text-gray-800 border-gray-200',
      'Offer': 'bg-green-100 text-green-800 border-green-200',
      'Rejected': 'bg-red-100 text-red-800 border-red-200'
    };
    return colors[status as keyof typeof colors] || 'bg-gray-100 text-gray-800 border-gray-200';
  };
  
  const getSkillColor = (level: number): string => {
    if (level >= 80) return 'bg-gradient-to-r from-green-500 to-emerald-500';
    if (level >= 60) return 'bg-gradient-to-r from-yellow-500 to-orange-500';
    return 'bg-gradient-to-r from-red-500 to-pink-500';
  };
  
  const removeFromFavorites = (companyId: number): void => {
    favoriteCompanies.value = favoriteCompanies.value.filter(company => company.id !== companyId);
  };
  
  // Initialize favorites from global state if available
  onMounted(() => {
    if (window.favoritesState?.value) {
      favoriteCompanies.value = window.favoritesState.value;
    }
  });
  </script>
  
  <style scoped>
  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  
  .animate-in {
    animation: slideInFromBottom 0.3s ease-out;
  }
  
  .slide-in-from-bottom-2 {
    transform: translateY(8px);
  }
  
  @keyframes slideInFromBottom {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  /* Custom hover animations */
  .group:hover .group-hover\:scale-105 {
    transform: scale(1.05);
  }
  
  .group:hover .group-hover\:opacity-100 {
    opacity: 1;
  }
  </style>