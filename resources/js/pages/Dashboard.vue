<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
              <span class="text-white font-bold text-sm">E</span>
            </div>
            <h1 class="text-xl font-semibold text-gray-900">Erasmus Dashboard</h1>
          </div>
          
          <div class="flex items-center space-x-4">
            <!-- Real-time Clock -->
            <div class="hidden md:block text-sm text-gray-500">
              {{ formatTime(currentTime) }}
            </div>
            
            <!-- Notifications -->
            <div class="relative">
              <button @click="toggleNotifications" 
                      class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors relative">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M15 17h5l-5 5v-5zM9 7h6l3 3-3 3H9V7z"></path>
                </svg>
                <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full text-xs text-white flex items-center justify-center">
                  {{ notifications.filter(n => !n.read).length }}
                </span>
              </button>
              
              <!-- Notifications Dropdown -->
              <div v-if="showNotifications" 
                   class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                <div class="p-4 border-b border-gray-200">
                  <h3 class="font-semibold text-gray-900">Notificaties</h3>
                </div>
                <div class="max-h-64 overflow-y-auto">
                  <div v-for="notification in notifications" :key="notification.id" 
                       class="p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer"
                       :class="{ 'bg-blue-50': !notification.read }"
                       @click="markAsRead(notification.id)">
                    <p class="text-sm font-medium text-gray-900">{{ notification.title }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ notification.message }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ formatTimeAgo(notification.created_at) }}</p>
                  </div>
                </div>
                <div class="p-3 border-t border-gray-200">
                  <button class="text-sm text-orange-600 hover:text-orange-700 font-medium">
                    Alle notificaties bekijken
                  </button>
                </div>
              </div>
            </div>
            
            <!-- Profile Menu -->
            <div class="relative">
              <button @click="toggleProfileMenu" 
                      class="w-8 h-8 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center">
                <span class="text-white font-medium text-sm">{{ getInitials(user.firstname, user.lastname) }}</span>
              </button>
              
              <!-- Profile Dropdown -->
              <div v-if="showProfileMenu" 
                   class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                <div class="p-4 border-b border-gray-200">
                  <p class="font-medium text-gray-900">{{ user.firstname }} {{ user.lastname }}</p>
                  <p class="text-sm text-gray-500">{{ user.email }}</p>
                </div>
                <div class="py-2">
                  <Link :href="route('profile.edit')" 
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profiel bewerken
                  </Link>
                  <Link :href="route('settings')" 
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Instellingen
                  </Link>
                  <button @click="downloadCV" 
                          class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                    </svg>
                    CV Downloaden
                  </button>
                  <div class="border-t border-gray-200 my-1"></div>
                  <Link :href="route('logout')" method="post"
                        class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Uitloggen
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Navigation Tabs -->
    <div class="bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex space-x-8">
          <button @click="setActiveTab('dashboard')" 
                  :class="tabClass('dashboard')" 
                  class="border-b-2 py-4 px-1 text-sm font-medium transition-colors">
            Dashboard
          </button>
          <button @click="setActiveTab('profile')" 
                  :class="tabClass('profile')" 
                  class="border-b-2 py-4 px-1 text-sm font-medium transition-colors">
            Profiel
          </button>
          <button @click="setActiveTab('applications')" 
                  :class="tabClass('applications')" 
                  class="border-b-2 py-4 px-1 text-sm font-medium transition-colors">
            Sollicitaties ({{ applications.length }})
          </button>
          <button @click="setActiveTab('meetings')" 
                  :class="tabClass('meetings')" 
                  class="border-b-2 py-4 px-1 text-sm font-medium transition-colors">
            Afspraken ({{ upcomingMeetings.length }})
          </button>
        </nav>
      </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      
      <!-- Dashboard Tab -->
      <div v-if="activeTab === 'dashboard'">
        <!-- Welcome Section -->
        <div class="mb-8">
          <h2 class="text-3xl font-bold text-gray-900 mb-2">Welkom terug, {{ user.firstname }}!</h2>
          <p class="text-gray-600">Hier is je persoonlijke dashboard overzicht</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
            <div class="flex items-center">
              <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Huidig Semester</p>
                <p class="text-2xl font-bold text-gray-900">{{ stats.semester }}</p>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
            <div class="flex items-center">
              <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Voltooide Projecten</p>
                <p class="text-2xl font-bold text-gray-900">{{ stats.completed_projects }}</p>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
            <div class="flex items-center">
              <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Beheerste Skills</p>
                <p class="text-2xl font-bold text-gray-900">{{ stats.skills_mastered }}</p>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
            <div class="flex items-center">
              <div class="w-12 h-12 bg-gradient-to-br from-orange-100 to-orange-200 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h8z"></path>
                </svg>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Actieve Sollicitaties</p>
                <p class="text-2xl font-bold text-gray-900">{{ stats.applications }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Recent Activities -->
          <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
              <h3 class="text-lg font-semibold text-gray-900">Recente Activiteit</h3>
            </div>
            <div class="p-6">
              <div class="space-y-4">
                <div v-for="activity in recentActivities" :key="activity.id" 
                     class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg">
                  <div class="w-8 h-8 rounded-full flex items-center justify-center"
                       :class="getActivityIconClass(activity.type)">
                    <component :is="getActivityIcon(activity.type)" class="w-4 h-4" />
                  </div>
                  <div class="flex-1">
                    <p class="text-sm text-gray-900">{{ activity.description }}</p>
                    <p class="text-xs text-gray-500">{{ formatTimeAgo(activity.created_at) }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Career Launch Event -->
          <div class="bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl p-6 text-white">
            <div class="flex items-center mb-4">
              <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div class="ml-3">
                <h3 class="font-semibold">Career Launch 2025</h3>
                <p class="text-sm opacity-90">15 maart 2025</p>
              </div>
            </div>
            <p class="text-sm opacity-90 mb-4">Het grootste netwerkevent voor design & technologie studenten.</p>
            <div class="space-y-2 mb-4">
              <div class="flex items-center text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                </svg>
                Campus Kaai - Zaal A101
              </div>
              <div class="flex items-center text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                09:00 - 17:00
              </div>
            </div>
            <Link :href="route('career-launch')" 
                  class="w-full bg-white text-orange-600 font-medium py-2 px-4 rounded-lg hover:bg-gray-50 transition-colors inline-block text-center">
              Meer Info & Aanmelden
            </Link>
          </div>
        </div>
      </div>

      <!-- Profile Tab -->
      <div v-if="activeTab === 'profile'">
        <div class="max-w-4xl">
          <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Mijn Profiel</h2>
            <p class="text-gray-600">Beheer je persoonlijke informatie en voorkeuren</p>
          </div>

          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
              <h3 class="text-lg font-semibold text-gray-900">Persoonlijke Informatie</h3>
              <Link :href="route('profile.edit')" 
                    class="px-4 py-2 text-sm font-medium text-orange-600 hover:text-orange-700 hover:bg-orange-50 rounded-lg transition-colors">
                Bewerken
              </Link>
            </div>
            
            <div class="p-6">
              <div class="flex items-start space-x-6 mb-6">
                <div class="w-24 h-24 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center shadow-lg">
                  <span class="text-white font-bold text-3xl">{{ getInitials(user.firstname, user.lastname) }}</span>
                </div>
                <div class="flex-1">
                  <h4 class="text-2xl font-bold text-gray-900 mb-2">{{ user.firstname }} {{ user.lastname }}</h4>
                  <p class="text-gray-600 mb-4">{{ user.major }} - {{ user.year }}</p>
                  <div class="flex items-center space-x-4">
                    <button class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
                      CV Bijwerken
                    </button>
                    <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                      Portfolio Bekijken
                    </button>
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                  <p class="text-gray-900">{{ user.email }}</p>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Student ID</label>
                  <p class="text-gray-900">{{ user.studentId }}</p>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Studierichting</label>
                  <p class="text-gray-900">{{ user.major }}</p>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Studiejaar</label>
                  <p class="text-gray-900">{{ user.year }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Skills Section -->
          <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
              <h3 class="text-lg font-semibold text-gray-900">Skills & Vaardigheden</h3>
              <button class="px-4 py-2 text-sm font-medium text-orange-600 hover:text-orange-700 hover:bg-orange-50 rounded-lg transition-colors">
                Skills Toevoegen
              </button>
            </div>
            <div class="p-6">
              <div class="space-y-6">
                <div>
                  <h4 class="font-medium text-gray-900 mb-4">Programmeertalen</h4>
                  <div class="flex flex-wrap gap-2">
                    <span v-for="skill in programmingSkills" :key="skill" 
                          class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                      {{ skill }}
                    </span>
                  </div>
                </div>
                <div>
                  <h4 class="font-medium text-gray-900 mb-4">Frameworks & Tools</h4>
                  <div class="flex flex-wrap gap-2">
                    <span v-for="framework in frameworks" :key="framework" 
                          class="px-3 py-1 bg-orange-100 text-orange-800 text-sm font-medium rounded-full">
                      {{ framework }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Applications Tab -->
      <div v-if="activeTab === 'applications'">
        <div class="mb-8 flex items-center justify-between">
          <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Mijn Sollicitaties</h2>
            <p class="text-gray-600">Overzicht van al je sollicitaties en hun status</p>
          </div>
          <Link :href="route('companies.index')" 
                class="px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors font-medium">
            + Nieuwe Sollicitatie
          </Link>
        </div>

        <!-- Filters -->
        <div class="mb-6 flex items-center space-x-4">
          <div class="flex-1 relative">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" v-model="applicationSearch" 
                   placeholder="Zoek sollicitaties..." 
                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 w-full">
          </div>
          <select v-model="applicationFilter" 
                  class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
            <option value="all">Alle Status</option>
            <option value="pending">In Behandeling</option>
            <option value="interview">Interview</option>
            <option value="accepted">Geaccepteerd</option>
            <option value="rejected">Afgewezen</option>
          </select>
        </div>

        <!-- Applications List -->
        <div class="space-y-4">
          <div v-for="application in filteredApplications" :key="application.id" 
               class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
              <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-red-400 rounded-lg flex items-center justify-center">
                  <span class="text-white font-bold text-sm">{{ application.company.charAt(0) }}</span>
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">{{ application.position }}</h3>
                  <p class="text-gray-600">{{ application.company }}</p>
                  <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                    <span>Ingediend: {{ formatDate(application.applied_at) }}</span>
                    <span>{{ application.type }}</span>
                  </div>
                </div>
              </div>
              <div class="flex items-center space-x-3">
                <span :class="getStatusClass(application.status)" 
                      class="px-3 py-1 rounded-full text-sm font-medium">
                  {{ getStatusText(application.status) }}
                </span>
                <button class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </button>
              </div>
            </div>
            
            <div class="mt-4 pt-4 border-t border-gray-100">
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                  <span class="text-sm text-gray-500">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    </svg>
                    {{ application.location }}
                  </span>
                  <span class="text-sm text-gray-500">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    € {{ application.salary || 'Te bespreken' }}
                  </span>
                </div>
                <div class="flex items-center space-x-2">
                  <button v-if="application.status === 'interview'" 
                          class="px-3 py-1 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                    Interview Plannen
                  </button>
                  <button class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
                    Details
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Empty State -->
        <div v-if="filteredApplications.length === 0" 
             class="text-center py-12 bg-white rounded-2xl shadow-sm border border-gray-100">
          <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h8z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-2">Nog geen sollicitaties</h3>
          <p class="text-gray-500 mb-6">Begin je carrière door te solliciteren bij interessante bedrijven</p>
          <Link :href="route('companies.index')" 
                class="inline-flex items-center px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors font-medium">
            Ontdek Bedrijven
          </Link>
        </div>
      </div>

      <!-- Meetings Tab -->
      <div v-if="activeTab === 'meetings'">
        <div class="mb-8 flex items-center justify-between">
          <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Mijn Afspraken</h2>
            <p class="text-gray-600">Overzicht van al je geplande gesprekken en meetings</p>
          </div>
          <button @click="scheduleNewMeeting" 
                  class="px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors font-medium">
            + Nieuwe Afspraak
          </button>
        </div>

        <!-- Calendar View Toggle -->
        <div class="mb-6 flex items-center space-x-4">
          <div class="flex bg-gray-100 rounded-lg p-1">
            <button @click="meetingView = 'list'" 
                    :class="meetingView === 'list' ? 'bg-white shadow-sm' : ''" 
                    class="px-4 py-2 text-sm font-medium rounded-md transition-colors">
              Lijst
            </button>
            <button @click="meetingView = 'calendar'" 
                    :class="meetingView === 'calendar' ? 'bg-white shadow-sm' : ''" 
                    class="px-4 py-2 text-sm font-medium rounded-md transition-colors">
              Kalender
            </button>
          </div>
          <div class="flex-1"></div>
          <select v-model="meetingFilter" 
                  class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500">
            <option value="all">Alle Afspraken</option>
            <option value="today">Vandaag</option>
            <option value="upcoming">Aankomend</option>
            <option value="past">Voorbij</option>
          </select>
        </div>

        <!-- Meetings List View -->
        <div v-if="meetingView === 'list'" class="space-y-4">
          <div v-for="meeting in filteredMeetings" :key="meeting.id" 
               class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow"
               :class="getMeetingCardClass(meeting)">
            <div class="flex items-start justify-between">
              <div class="flex items-start space-x-4">
                <div :class="getMeetingIconClass(meeting.type)" 
                     class="w-12 h-12 rounded-lg flex items-center justify-center">
                  <component :is="getMeetingIcon(meeting.type)" class="w-6 h-6" />
                </div>
                <div class="flex-1">
                  <h3 class="text-lg font-semibold text-gray-900">{{ meeting.title }}</h3>
                  <p class="text-gray-600">{{ meeting.company }}</p>
                  <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                    <span class="flex items-center">
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>
                      {{ formatDateTime(meeting.datetime) }}
                    </span>
                    <span class="flex items-center">
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                      </svg>
                      {{ meeting.location }}
                    </span>
                    <span v-if="meeting.recruiter" class="flex items-center">
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                      </svg>
                      {{ meeting.recruiter }}
                    </span>
                  </div>
                </div>
              </div>
              <div class="flex items-center space-x-2">
                <span :class="getMeetingStatusClass(meeting)" 
                      class="px-3 py-1 rounded-full text-sm font-medium">
                  {{ getMeetingStatusText(meeting) }}
                </span>
                <div class="relative">
                  <button @click="toggleMeetingMenu(meeting.id)" 
                          class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                  </button>
                  
                  <!-- Meeting Actions Menu -->
                  <div v-if="activeMeetingMenu === meeting.id" 
                       class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                    <div class="py-2">
                      <button @click="editMeeting(meeting)" 
                              class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Bewerken
                      </button>
                      <button v-if="meeting.meeting_link" @click="joinMeeting(meeting.meeting_link)" 
                              class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Deelnemen
                      </button>
                      <button @click="reschedule(meeting)" 
                              class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Verplaatsen
                      </button>
                      <div class="border-t border-gray-200 my-1"></div>
                      <button @click="cancelMeeting(meeting)" 
                              class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1H8a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Annuleren
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div v-if="meeting.notes" class="mt-4 pt-4 border-t border-gray-100">
              <p class="text-sm text-gray-600">{{ meeting.notes }}</p>
            </div>
          </div>
        </div>

        <!-- Calendar View -->
        <div v-if="meetingView === 'calendar'" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
          <div class="mb-6 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">{{ formatMonthYear(currentDate) }}</h3>
            <div class="flex items-center space-x-2">
              <button @click="previousMonth" 
                      class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
              </button>
              <button @click="nextMonth" 
                      class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </button>
            </div>
          </div>
          
          <!-- Calendar Grid -->
          <div class="grid grid-cols-7 gap-1 mb-4">
            <div v-for="day in ['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo']" :key="day" 
                 class="p-2 text-center text-sm font-medium text-gray-500">
              {{ day }}
            </div>
          </div>
          
          <div class="grid grid-cols-7 gap-1">
            <div v-for="date in calendarDates" :key="date.date" 
                 class="min-h-24 p-2 border border-gray-100 hover:bg-gray-50"
                 :class="{ 'bg-gray-50': !date.isCurrentMonth, 'bg-blue-50': date.isToday }">
              <div class="text-sm font-medium text-gray-900">{{ date.day }}</div>
              <div class="mt-1 space-y-1">
                <div v-for="meeting in date.meetings" :key="meeting.id" 
                     class="text-xs p-1 rounded bg-orange-100 text-orange-800 truncate cursor-pointer"
                     @click="selectMeeting(meeting)">
                  {{ meeting.title }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Empty State -->
        <div v-if="filteredMeetings.length === 0" 
             class="text-center py-12 bg-white rounded-2xl shadow-sm border border-gray-100">
          <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-2">Geen afspraken gepland</h3>
          <p class="text-gray-500 mb-6">Plan je eerste gesprek met een potentiële werkgever</p>
          <button @click="scheduleNewMeeting" 
                  class="inline-flex items-center px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors font-medium">
            Plan Afspraak
          </button>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { Link } from '@inertiajs/vue3'

// Props
const props = defineProps({
  user: {
    type: Object,
    default: () => ({
      firstname: 'Amine',
      lastname: 'Zerouali',
      email: 'amine.zerouali@student.ehb.be',
      studentId: 'EHB2024001',
      major: 'Computer Science',
      year: '3de Jaar'
    })
  },
  student: Object,
  favorites: {
    type: Array,
    default: () => []
  },
  stats: {
    type: Object,
    default: () => ({
      semester: '3de Jaar',
      completed_projects: 12,
      skills_mastered: 8,
      applications: 5
    })
  }
})

// Reactive data
const activeTab = ref('dashboard')
const showProfileMenu = ref(false)
const showNotifications = ref(false)
const currentTime = ref(new Date())
const applicationSearch = ref('')
const applicationFilter = ref('all')
const meetingView = ref('list')
const meetingFilter = ref('all')
const activeMeetingMenu = ref(null)
const currentDate = ref(new Date())

// Mock data
const notifications = ref([
  { id: 1, title: 'Nieuw gesprek gepland', message: 'Je hebt een gesprek met Accenture op 22 juni', read: false, created_at: new Date(Date.now() - 3600000) },
  { id: 2, title: 'Sollicitatie update', message: 'Je sollicitatie bij Amista is in behandeling', read: true, created_at: new Date(Date.now() - 86400000) },
  { id: 3, title: 'Career Launch reminder', message: 'Vergeet niet je aan te melden voor Career Launch 2025', read: false, created_at: new Date(Date.now() - 172800000) }
])

const applications = ref([
  { id: 1, company: 'Accenture', position: 'Junior Developer', status: 'interview', type: 'Stage', location: 'Brussels', salary: '€1200', applied_at: '2025-06-15' },
  { id: 2, company: 'Amista', position: 'Frontend Developer', status: 'pending', type: 'Stage', location: 'Lier', salary: '€1000', applied_at: '2025-06-10' },
  { id: 3, company: 'Acolad', position: 'Full Stack Developer', status: 'accepted', type: 'Job', location: 'Brussels', salary: '€2500', applied_at: '2025-06-05' }
])

const upcomingMeetings = ref([
  { 
    id: 1, 
    title: 'Career Gesprek - Accenture', 
    company: 'Accenture',
    datetime: '2025-06-22T14:00:00', 
    type: 'interview', 
    location: 'Online - Teams', 
    recruiter: 'Sarah Van Der Berg',
    meeting_link: 'https://teams.microsoft.com/...',
    notes: 'Voorbereiden: portfolio presentatie en vragen over bedrijfscultuur'
  },
  { 
    id: 2, 
    title: 'Stage Oriëntatie', 
    company: 'Erasmus Hogeschool',
    datetime: '2025-06-25T10:00:00', 
    type: 'orientation', 
    location: 'Campus Kaai - A101', 
    recruiter: 'Prof. Dr. Smith'
  },
  { 
    id: 3, 
    title: 'Follow-up Gesprek', 
    company: 'Amista',
    datetime: '2025-06-28T15:30:00', 
    type: 'followup', 
    location: 'Amista Kantoor Lier', 
    recruiter: 'Jan Janssen'
  }
])

const recentActivities = ref([
  { id: 1, type: 'application', description: 'Sollicitatie ingediend bij Accenture', created_at: new Date(Date.now() - 3600000) },
  { id: 2, type: 'profile', description: 'Profiel bijgewerkt met nieuwe skills', created_at: new Date(Date.now() - 7200000) },
  { id: 3, type: 'favorite', description: 'Bedrijf toegevoegd aan favorieten', created_at: new Date(Date.now() - 259200000) }
])

const programmingSkills = ref(['JavaScript', 'PHP', 'Python', 'Java'])
const frameworks = ref(['Laravel', 'Vue.js', 'React', 'Node.js', 'PostgreSQL'])

// Computed properties
const filteredApplications = computed(() => {
  let filtered = applications.value
  
  if (applicationSearch.value) {
    filtered = filtered.filter(app => 
      app.company.toLowerCase().includes(applicationSearch.value.toLowerCase()) ||
      app.position.toLowerCase().includes(applicationSearch.value.toLowerCase())
    )
  }
  
  if (applicationFilter.value !== 'all') {
    filtered = filtered.filter(app => app.status === applicationFilter.value)
  }
  
  return filtered
})

const filteredMeetings = computed(() => {
  let filtered = upcomingMeetings.value
  const now = new Date()
  
  if (meetingFilter.value === 'today') {
    filtered = filtered.filter(meeting => {
      const meetingDate = new Date(meeting.datetime)
      return meetingDate.toDateString() === now.toDateString()
    })
  } else if (meetingFilter.value === 'upcoming') {
    filtered = filtered.filter(meeting => new Date(meeting.datetime) > now)
  } else if (meetingFilter.value === 'past') {
    filtered = filtered.filter(meeting => new Date(meeting.datetime) < now)
  }
  
  return filtered
})

const calendarDates = computed(() => {
  const year = currentDate.value.getFullYear()
  const month = currentDate.value.getMonth()
  
  const firstDay = new Date(year, month, 1)
  const lastDay = new Date(year, month + 1, 0)
  const startDate = new Date(firstDay)
  startDate.setDate(startDate.getDate() - firstDay.getDay() + 1)
  
  const dates = []
  const currentDateObj = new Date(startDate)
  
  for (let i = 0; i < 42; i++) {
    const isCurrentMonth = currentDateObj.getMonth() === month
    const isToday = currentDateObj.toDateString() === new Date().toDateString()
    
    const dayMeetings = upcomingMeetings.value.filter(meeting => {
      const meetingDate = new Date(meeting.datetime)
      return meetingDate.toDateString() === currentDateObj.toDateString()
    })
    
    dates.push({
      date: new Date(currentDateObj),
      day: currentDateObj.getDate(),
      isCurrentMonth,
      isToday,
      meetings: dayMeetings
    })
    
    currentDateObj.setDate(currentDateObj.getDate() + 1)
  }
  
  return dates
})

// Methods
const getInitials = (firstname, lastname) => {
  if (!firstname || !lastname) return 'N/A'
  return `${firstname[0]}${lastname[0]}`.toUpperCase()
}

const setActiveTab = (tab) => {
  activeTab.value = tab
  // Close any open menus when switching tabs
  showProfileMenu.value = false
  showNotifications.value = false
  activeMeetingMenu.value = null
}

const tabClass = (tab) => {
  return activeTab.value === tab 
    ? 'border-orange-500 text-orange-600' 
    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
}

const toggleProfileMenu = () => {
  showProfileMenu.value = !showProfileMenu.value
  showNotifications.value = false
}

const toggleNotifications = () => {
  showNotifications.value = !showNotifications.value
  showProfileMenu.value = false
}

const toggleMeetingMenu = (meetingId) => {
  activeMeetingMenu.value = activeMeetingMenu.value === meetingId ? null : meetingId
}

const formatTime = (date) => {
  return date.toLocaleTimeString('nl-NL', { hour: '2-digit', minute: '2-digit' })
}

const formatTimeAgo = (date) => {
  const now = new Date()
  const diff = now - date
  const minutes = Math.floor(diff / 60000)
  const hours = Math.floor(minutes / 60)
  const days = Math.floor(hours / 24)
  
  if (days > 0) return `${days} dag${days > 1 ? 'en' : ''} geleden`
  if (hours > 0) return `${hours} uur geleden`
  if (minutes > 0) return `${minutes} minuten geleden`
  return 'Zojuist'
}

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('nl-NL')
}

const formatDateTime = (dateString) => {
  const date = new Date(dateString)
  return date.toLocaleDateString('nl-NL', { 
    weekday: 'short', 
    month: 'short', 
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}

const formatMonthYear = (date) => {
  return date.toLocaleDateString('nl-NL', { month: 'long', year: 'numeric' })
}

const getStatusClass = (status) => {
  const classes = {
    pending: 'bg-yellow-100 text-yellow-800',
    interview: 'bg-blue-100 text-blue-800',
    accepted: 'bg-green-100 text-green-800',
    rejected: 'bg-red-100 text-red-800'
  }
  return classes[status] || 'bg-gray-100 text-gray-800'
}

const getStatusText = (status) => {
  const texts = {
    pending: 'In Behandeling',
    interview: 'Interview',
    accepted: 'Geaccepteerd',
    rejected: 'Afgewezen'
  }
  return texts[status] || status
}

const getMeetingCardClass = (meeting) => {
  const now = new Date()
  const meetingDate = new Date(meeting.datetime)
  
  if (meetingDate.toDateString() === now.toDateString()) {
    return 'border-orange-200 bg-orange-50'
  }
  if (meetingDate < now) {
    return 'opacity-75'
  }
  return ''
}

const getMeetingIconClass = (type) => {
  const classes = {
    interview: 'bg-blue-100 text-blue-600',
    orientation: 'bg-green-100 text-green-600',
    followup: 'bg-purple-100 text-purple-600',
    general: 'bg-orange-100 text-orange-600'
  }
  return classes[type] || classes.general
}

const getMeetingIcon = (type) => {
  // Return the icon component name as string since we can't import lucide-react components
  const icons = {
    interview: 'svg', // Would be different icons in real implementation
    orientation: 'svg',
    followup: 'svg',
    general: 'svg'
  }
  return icons[type] || 'svg'
}

const getMeetingStatusClass = (meeting) => {
  const now = new Date()
  const meetingDate = new Date(meeting.datetime)
  
  if (meetingDate.toDateString() === now.toDateString()) {
    return 'bg-orange-100 text-orange-800'
  }
  if (meetingDate < now) {
    return 'bg-gray-100 text-gray-800'
  }
  return 'bg-blue-100 text-blue-800'
}

const getMeetingStatusText = (meeting) => {
  const now = new Date()
  const meetingDate = new Date(meeting.datetime)
  
  if (meetingDate.toDateString() === now.toDateString()) {
    return 'Vandaag'
  }
  if (meetingDate < now) {
    return 'Voltooid'
  }
  return 'Gepland'
}

const getActivityIconClass = (type) => {
  const classes = {
    application: 'bg-blue-100 text-blue-600',
    profile: 'bg-green-100 text-green-600',
    favorite: 'bg-purple-100 text-purple-600',
    meeting: 'bg-orange-100 text-orange-600'
  }
  return classes[type] || 'bg-gray-100 text-gray-600'
}

const getActivityIcon = (type) => {
  // Would return actual icon components in real implementation
  return 'svg'
}

// Action methods
const markAsRead = (notificationId) => {
  const notification = notifications.value.find(n => n.id === notificationId)
  if (notification) {
    notification.read = true
  }
}

const downloadCV = () => {
  // Implementation for CV download
  console.log('Downloading CV...')
}

const scheduleNewMeeting = () => {
  // Implementation for scheduling new meeting
  console.log('Opening meeting scheduler...')
}

const editMeeting = (meeting) => {
  // Implementation for editing meeting
  console.log('Editing meeting:', meeting.id)
  activeMeetingMenu.value = null
}

const joinMeeting = (link) => {
  window.open(link, '_blank')
  activeMeetingMenu.value = null
}

const reschedule = (meeting) => {
  // Implementation for rescheduling
  console.log('Rescheduling meeting:', meeting.id)
  activeMeetingMenu.value = null
}

const cancelMeeting = (meeting) => {
  // Implementation for canceling meeting
  console.log('Canceling meeting:', meeting.id)
  activeMeetingMenu.value = null
}

const selectMeeting = (meeting) => {
  // Implementation for selecting meeting in calendar
  console.log('Selected meeting:', meeting.id)
}

const previousMonth = () => {
  currentDate.value = new Date(currentDate.value.getFullYear(), currentDate.value.getMonth() - 1, 1)
}

const nextMonth = () => {
  currentDate.value = new Date(currentDate.value.getFullYear(), currentDate.value.getMonth() + 1, 1)
}

// Lifecycle hooks
let timeInterval = null

onMounted(() => {
  timeInterval = setInterval(() => {
    currentTime.value = new Date()
  }, 1000)
  
  // Close menus when clicking outside
  document.addEventListener('click', (event) => {
    if (!event.target.closest('.relative')) {
      showProfileMenu.value = false
      showNotifications.value = false
      activeMeetingMenu.value = null
    }
  })
})

onUnmounted(() => {
  if (timeInterval) {
    clearInterval(timeInterval)
  }
})
</script>

<style scoped>
/* Custom animations */
.hover\:-translate-y-1:hover {
  transform: translateY(-0.25rem);
}

/* Smooth transitions */
.transition-all {
  transition-property: all;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 300ms;
}
</style>