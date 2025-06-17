<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-gray-50 to-zinc-50">
    <!-- Ultra Premium Header -->
    <header class="bg-white/95 backdrop-blur-2xl shadow-2xl border-b border-gray-200 sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
          <!-- Admin Logo & Branding -->
          <div class="flex items-center space-x-4">
            <div class="relative">
              <div class="w-14 h-14 bg-gradient-to-br from-red-600 via-orange-600 to-yellow-500 rounded-2xl flex items-center justify-center shadow-2xl">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
              </div>
              <div class="absolute -top-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white animate-pulse flex items-center justify-center">
                <div class="w-2 h-2 bg-white rounded-full"></div>
              </div>
            </div>
            <div>
              <div class="font-black text-2xl text-gray-900 tracking-tight">erasmus</div>
              <div class="text-xs text-gray-500 font-bold tracking-wider uppercase bg-red-100 text-red-600 px-2 py-1 rounded-full">
                Admin Command Center
              </div>
            </div>
          </div>
          
          <!-- Real-time System Status -->
          <div class="hidden lg:flex items-center space-x-8 px-8 py-4 bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl border border-gray-200">
            <div class="text-center">
              <div class="text-xl font-black text-gray-900">{{ adminData.totalUsers.toLocaleString() }}</div>
              <div class="text-xs text-gray-500 font-medium">Total Users</div>
            </div>
            <div class="w-px h-10 bg-gray-300"></div>
            <div class="text-center">
              <div class="text-xl font-black text-green-600">{{ adminData.activeUsers.toLocaleString() }}</div>
              <div class="text-xs text-gray-500 font-medium">Active Now</div>
            </div>
            <div class="w-px h-10 bg-gray-300"></div>
            <div class="text-center">
              <div class="text-xl font-black text-blue-600">{{ adminData.todayLogins }}</div>
              <div class="text-xs text-gray-500 font-medium">Today's Logins</div>
            </div>
            <div class="w-px h-10 bg-gray-300"></div>
            <div class="text-center">
              <div class="flex items-center justify-center space-x-1">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-xs font-bold text-green-600">99.9%</span>
              </div>
              <div class="text-xs text-gray-500 font-medium">System Health</div>
            </div>
          </div>

          <!-- Admin Controls -->
          <div class="flex items-center space-x-4">
            <!-- Emergency Button -->
            <button class="p-3 bg-red-100 hover:bg-red-200 text-red-600 rounded-xl transition-all duration-300 relative group">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
              </svg>
              <div class="absolute -top-2 -right-2 w-4 h-4 bg-red-500 rounded-full text-white text-xs flex items-center justify-center font-bold">
                {{ pendingAlerts }}
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

            <!-- Admin Profile -->
            <div class="flex items-center space-x-4 pl-4 border-l-2 border-gray-200">
              <div class="relative">
                <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg">
                  <span class="text-white font-bold text-lg">{{ adminData.avatar }}</span>
                </div>
                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
              </div>
              <div class="hidden sm:block">
                <div class="text-sm font-bold text-gray-900">{{ adminData.name }}</div>
                <div class="text-xs text-gray-500 font-medium">{{ adminData.role }}</div>
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
                      ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-lg scale-105'
                      : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100'
                  }`">
            <component :is="tab.icon" class="w-5 h-5" />
            <span>{{ tab.label }}</span>
            <span v-if="tab.badge" :class="`px-2 py-1 rounded-full text-xs font-bold ${
              activeTab === tab.id ? 'bg-white/20 text-white' : 'bg-red-100 text-red-600'
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
        <!-- Hero Command Center -->
        <div class="bg-gradient-to-br from-slate-900 via-gray-900 to-zinc-900 rounded-3xl p-12 text-white relative overflow-hidden mb-10 shadow-2xl">
          <!-- Animated Tech Background -->
          <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-56 h-56 bg-purple-500/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
            <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-green-500/10 rounded-full blur-2xl animate-bounce"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900/20 to-purple-900/20"></div>
          </div>
          
          <div class="relative z-10">
            <div class="flex items-center space-x-4 mb-8">
              <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-orange-500 rounded-2xl flex items-center justify-center shadow-xl">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
              </div>
              <div>
                <h1 class="text-5xl font-black mb-2 bg-gradient-to-r from-white via-blue-200 to-purple-200 bg-clip-text text-transparent">
                  Admin Command Center
                </h1>
                <p class="text-xl text-gray-300">Full control over your Career Launch ecosystem 🚀</p>
              </div>
            </div>
            
            <!-- Live Metrics Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
              <div v-for="metric in liveMetrics" :key="metric.label"
                   class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                  <component :is="metric.icon" class="w-8 h-8 text-blue-300" />
                  <div :class="`px-2 py-1 rounded-full text-xs font-bold ${metric.trendColor}`">
                    {{ metric.trend }}
                  </div>
                </div>
                <div class="text-3xl font-black text-white mb-2">{{ metric.value }}</div>
                <div class="text-gray-300 font-medium text-sm">{{ metric.label }}</div>
                <div class="text-xs text-gray-400 mt-1">{{ metric.subtitle }}</div>
              </div>
            </div>

            <!-- Quick Actions Bar -->
            <div class="flex flex-wrap gap-4">
              <button v-for="action in quickAdminActions" :key="action.title"
                      :class="`flex items-center space-x-3 px-6 py-3 rounded-2xl font-bold transition-all duration-300 hover:scale-105 shadow-lg ${action.style}`">
                <span class="text-xl">{{ action.icon }}</span>
                <span>{{ action.title }}</span>
              </button>
            </div>
          </div>
        </div>

        <!-- Advanced Analytics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
          <div v-for="(stat, index) in overviewStats" :key="index" 
               class="group bg-white rounded-3xl p-8 shadow-xl border-2 border-gray-100 hover:shadow-2xl hover:scale-105 hover:border-orange-200 transition-all duration-500 relative overflow-hidden">
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
              <div class="text-4xl font-black text-gray-900 mb-3 group-hover:text-orange-600 transition-colors duration-300">
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

        <!-- Main Dashboard Grid -->
        <div class="grid lg:grid-cols-3 gap-8">
          <!-- Left Column - Activities & Management -->
          <div class="lg:col-span-2 space-y-8">
            
            <!-- Real-time Activity Feed -->
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
              <div class="flex items-center justify-between mb-8">
                <div>
                  <h3 class="text-2xl font-black text-gray-900">Live Activity Feed</h3>
                  <p class="text-gray-600 mt-1">Real-time platform monitoring</p>
                </div>
                <div class="flex items-center space-x-4">
                  <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium text-green-600">Live</span>
                  </div>
                  <button class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                    View All
                  </button>
                </div>
              </div>
              
              <div class="space-y-4 max-h-96 overflow-y-auto">
                <div v-for="activity in recentActivities" :key="activity.id" 
                     :class="`p-6 rounded-2xl border-l-4 transition-all duration-300 hover:scale-102 hover:shadow-lg ${getActivityStatusColor(activity.status)}`">
                  <div class="flex items-start space-x-4">
                    <span class="text-3xl">{{ activity.icon }}</span>
                    <div class="flex-1">
                      <div class="font-bold text-gray-900 mb-1">{{ activity.message }}</div>
                      <div class="text-sm text-gray-600 mb-2">{{ activity.details }}</div>
                      <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500 font-medium">{{ activity.time }}</span>
                        <button v-if="activity.actionable" 
                                class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-lg font-medium transition-colors">
                          Take Action
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Approvals Management -->
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
              <div class="flex items-center justify-between mb-8">
                <div>
                  <h3 class="text-2xl font-black text-gray-900">Pending Approvals</h3>
                  <p class="text-gray-600 mt-1">{{ pendingUsers.length }} items require your attention</p>
                </div>
                <div class="flex items-center space-x-4">
                  <span class="bg-gradient-to-r from-yellow-100 to-orange-100 text-orange-700 px-4 py-2 rounded-full text-sm font-bold border border-orange-200">
                    {{ pendingUsers.length }} pending
                  </span>
                  <button class="text-orange-600 hover:text-orange-800 font-semibold transition-colors">
                    Bulk Actions
                  </button>
                </div>
              </div>
              
              <div class="space-y-4">
                <div v-for="user in pendingUsers" :key="user.id" 
                     class="flex items-center justify-between p-6 border-2 border-gray-100 rounded-2xl hover:border-orange-200 hover:bg-orange-50 transition-all duration-300 group">
                  <div class="flex items-center space-x-6">
                    <div class="relative">
                      <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        {{ user.type === 'Student' ? '👤' : '🏢' }}
                      </div>
                      <div :class="`absolute -top-2 -right-2 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold ${
                        user.priority === 'high' ? 'bg-red-500 text-white' : 
                        user.priority === 'medium' ? 'bg-yellow-500 text-white' : 'bg-green-500 text-white'
                      }`">
                        !
                      </div>
                    </div>
                    <div>
                      <div class="font-bold text-gray-900 text-lg">{{ user.name }}</div>
                      <div class="text-gray-600 font-medium">{{ user.email }}</div>
                      <div class="flex items-center space-x-4 mt-2">
                        <span :class="`px-3 py-1 rounded-full text-xs font-bold ${
                          user.type === 'Student' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700'
                        }`">
                          {{ user.type }}
                        </span>
                        <span class="text-xs text-gray-500">{{ user.registrationDate }}</span>
                      </div>
                    </div>
                  </div>
                  
                  <div class="flex items-center space-x-3">
                    <button @click="rejectUser(user.id)"
                            class="bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-xl font-semibold transition-all duration-300 hover:scale-105">
                      Reject
                    </button>
                    <button @click="approveUser(user.id)"
                            class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-6 py-2 rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg">
                      Approve
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Right Column - System Status & Quick Info -->
          <div class="space-y-8">
            
            <!-- System Health Monitor -->
            <div class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 rounded-3xl p-8 border-2 border-green-200">
              <div class="flex items-center justify-between mb-6">
                <div>
                  <h3 class="text-xl font-black text-gray-900">System Health</h3>
                  <p class="text-gray-600 text-sm">Real-time monitoring</p>
                </div>
                <div class="p-3 bg-green-200 rounded-2xl">
                  <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </div>
              </div>
              
              <div class="space-y-4">
                <div v-for="component in systemHealth" :key="component.component" 
                     class="bg-white rounded-2xl p-4 shadow-sm border border-green-100">
                  <div class="flex items-center justify-between mb-2">
                    <div class="font-bold text-gray-900">{{ component.component }}</div>
                    <span :class="`px-3 py-1 rounded-full text-xs font-bold ${getStatusColor(component.status)}`">
                      {{ component.status }}
                    </span>
                  </div>
                  <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                      <span class="text-gray-600">Uptime:</span>
                      <span class="font-semibold text-green-600 ml-1">{{ component.uptime }}</span>
                    </div>
                    <div>
                      <span class="text-gray-600">Response:</span>
                      <span class="font-semibold text-blue-600 ml-1">{{ component.responseTime }}</span>
                    </div>
                  </div>
                  <div class="text-xs text-gray-500 mt-2">Last checked: {{ component.lastCheck }}</div>
                </div>
              </div>
            </div>

            <!-- Quick Management Tools -->
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
              <h3 class="text-xl font-black text-gray-900 mb-6">Quick Tools</h3>
              <div class="grid grid-cols-2 gap-4">
                <button v-for="tool in quickManagementTools" :key="tool.title"
                        :class="`p-4 rounded-2xl border-2 border-gray-200 hover:shadow-lg transition-all duration-300 text-left group hover:scale-105 ${tool.hoverColor}`">
                  <div class="text-3xl mb-2">{{ tool.icon }}</div>
                  <div class="text-sm font-bold text-gray-900">{{ tool.title }}</div>
                  <div class="text-xs text-gray-600 mt-1">{{ tool.description }}</div>
                </button>
              </div>
            </div>

            <!-- Recent Performance -->
            <div class="bg-gradient-to-br from-purple-50 via-indigo-50 to-blue-50 rounded-3xl p-8 border-2 border-purple-200">
              <h3 class="text-xl font-black text-gray-900 mb-6">Platform Performance</h3>
              <div class="space-y-4">
                <div v-for="metric in performanceMetrics" :key="metric.name"
                     class="bg-white rounded-2xl p-4 shadow-sm border border-purple-100">
                  <div class="flex items-center justify-between mb-2">
                    <span class="font-semibold text-gray-900">{{ metric.name }}</span>
                    <span :class="`text-sm font-bold ${metric.color}`">{{ metric.value }}</span>
                  </div>
                  <div class="w-full h-2 bg-purple-100 rounded-full overflow-hidden">
                    <div :class="`h-full rounded-full transition-all duration-1000 ${metric.barColor}`" 
                         :style="`width: ${metric.percentage}%`"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Users Tab -->
      <div v-if="activeTab === 'users'" class="space-y-8">
        <!-- Users Header -->
        <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-3xl p-8 text-white">
          <h2 class="text-4xl font-black mb-4">User Management</h2>
          <p class="text-xl text-blue-100 mb-6">Manage students, companies, and user permissions</p>
          <div class="grid grid-cols-3 gap-6">
            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 text-center">
              <div class="text-3xl font-bold">{{ userStats.totalStudents }}</div>
              <div class="text-blue-100">Students</div>
            </div>
            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 text-center">
              <div class="text-3xl font-bold">{{ userStats.totalCompanies }}</div>
              <div class="text-blue-100">Companies</div>
            </div>
            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 text-center">
              <div class="text-3xl font-bold">{{ userStats.pendingApprovals }}</div>
              <div class="text-blue-100">Pending</div>
            </div>
          </div>
        </div>

        <!-- User Management Interface -->
        <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
          <div class="flex items-center justify-between mb-8">
            <h3 class="text-2xl font-black text-gray-900">All Users</h3>
            <div class="flex items-center space-x-4">
              <select v-model="userFilter" class="px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="all">All Users</option>
                <option value="students">Students Only</option>
                <option value="companies">Companies Only</option>
                <option value="pending">Pending Approval</option>
              </select>
              <button class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-3 rounded-2xl font-semibold hover:scale-105 transition-all duration-300">
                Export Data
              </button>
            </div>
          </div>

          <!-- Users Table -->
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead>
                <tr class="border-b-2 border-gray-100">
                  <th class="text-left py-4 px-4 font-bold text-gray-900">User</th>
                  <th class="text-left py-4 px-4 font-bold text-gray-900">Type</th>
                  <th class="text-left py-4 px-4 font-bold text-gray-900">Status</th>
                  <th class="text-left py-4 px-4 font-bold text-gray-900">Joined</th>
                  <th class="text-left py-4 px-4 font-bold text-gray-900">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in filteredUsers" :key="user.id" 
                    class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                  <td class="py-4 px-4">
                    <div class="flex items-center space-x-3">
                      <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-full flex items-center justify-center text-white font-bold">
                        {{ user.name.charAt(0) }}
                      </div>
                      <div>
                        <div class="font-semibold text-gray-900">{{ user.name }}</div>
                        <div class="text-sm text-gray-600">{{ user.email }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="py-4 px-4">
                    <span :class="`px-3 py-1 rounded-full text-xs font-bold ${
                      user.type === 'Student' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700'
                    }`">
                      {{ user.type }}
                    </span>
                  </td>
                  <td class="py-4 px-4">
                    <span :class="`px-3 py-1 rounded-full text-xs font-bold ${getStatusColor(user.status)}`">
                      {{ user.status }}
                    </span>
                  </td>
                  <td class="py-4 px-4 text-sm text-gray-600">{{ user.joinDate }}</td>
                  <td class="py-4 px-4">
                    <div class="flex items-center space-x-2">
                      <button class="text-blue-600 hover:text-blue-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                      </button>
                      <button class="text-gray-600 hover:text-gray-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                      </button>
                      <button class="text-red-600 hover:text-red-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Companies Tab -->
      <div v-if="activeTab === 'companies'" class="space-y-8">
        <!-- Companies Header -->
        <div class="bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 rounded-3xl p-8 text-white">
          <h2 class="text-4xl font-black mb-4">Company Management</h2>
          <p class="text-xl text-green-100 mb-6">Manage company profiles and verify business accounts</p>
        </div>

        <!-- Company Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="company in companies" :key="company.id" 
               class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100 hover:shadow-2xl hover:scale-105 transition-all duration-300 group">
            <div class="flex items-center justify-between mb-4">
              <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                {{ company.name.charAt(0) }}
              </div>
              <span :class="`px-3 py-1 rounded-full text-xs font-bold ${getStatusColor(company.status)}`">
                {{ company.status }}
              </span>
            </div>
            
            <h4 class="font-bold text-gray-900 text-lg mb-2">{{ company.name }}</h4>
            <p class="text-gray-600 text-sm mb-4">{{ company.industry }}</p>
            
            <div class="grid grid-cols-2 gap-4 text-sm mb-4">
              <div>
                <span class="text-gray-500">Employees:</span>
                <span class="font-semibold text-gray-900 ml-1">{{ company.employees }}</span>
              </div>
              <div>
                <span class="text-gray-500">Applications:</span>
                <span class="font-semibold text-blue-600 ml-1">{{ company.applications }}</span>
              </div>
              <div>
                <span class="text-gray-500">Events:</span>
                <span class="font-semibold text-purple-600 ml-1">{{ company.events }}</span>
              </div>
              <div>
                <span class="text-gray-500">Active:</span>
                <span class="font-semibold text-green-600 ml-1">{{ company.lastActive }}</span>
              </div>
            </div>

            <div class="flex items-center space-x-2">
              <button v-if="company.status === 'pending'" 
                      @click="verifyCompany(company.id)"
                      class="flex-1 bg-gradient-to-r from-green-500 to-emerald-500 text-white py-2 px-4 rounded-xl font-semibold hover:scale-105 transition-all duration-300">
                Verify
              </button>
              <button class="flex-1 border-2 border-gray-200 text-gray-700 py-2 px-4 rounded-xl font-semibold hover:bg-gray-50 transition-colors">
                View Details
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Events Tab -->
      <div v-if="activeTab === 'events'" class="space-y-8">
        <!-- Events Header -->
        <div class="bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 rounded-3xl p-8 text-white">
          <h2 class="text-4xl font-black mb-4">Event Management</h2>
          <p class="text-xl text-purple-100 mb-6">Create and manage career events and speeddate sessions</p>
          <button class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 hover:scale-105">
            Create New Event
          </button>
        </div>

        <!-- Events List -->
        <div class="space-y-6">
          <div v-for="event in upcomingEvents" :key="event.id" 
               class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300">
            <div class="flex items-start justify-between">
              <div class="flex-1">
                <div class="flex items-center space-x-3 mb-4">
                  <h4 class="font-black text-gray-900 text-xl">{{ event.title }}</h4>
                  <span :class="`px-3 py-1 rounded-full text-xs font-bold ${getStatusColor(event.status)}`">
                    {{ event.status }}
                  </span>
                </div>
                
                <div class="grid md:grid-cols-2 gap-4 mb-4">
                  <div class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ event.date }}
                  </div>
                  <div class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    {{ event.location }}
                  </div>
                  <div class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                    </svg>
                    {{ event.companies }} companies
                  </div>
                  <div class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/>
                    </svg>
                    {{ event.students }} students
                  </div>
                </div>
                
                <p class="text-gray-600 text-sm">Organized by {{ event.organizer }}</p>
              </div>
              
              <div class="flex items-center space-x-3">
                <button class="text-blue-600 hover:text-blue-800 transition-colors">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                  </svg>
                </button>
                <button class="text-gray-600 hover:text-gray-800 transition-colors">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Admin Floating Action Menu -->
    <div class="fixed bottom-8 right-8 z-50">
      <div class="relative group">
        <button @click="showAdminQuickMenu = !showAdminQuickMenu"
                class="w-16 h-16 bg-gradient-to-r from-red-600 via-orange-600 to-yellow-500 rounded-full shadow-2xl hover:shadow-3xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
          </svg>
        </button>
        
        <!-- Advanced Admin Menu -->
        <div v-if="showAdminQuickMenu" 
             class="absolute bottom-20 right-0 w-64 bg-white rounded-3xl shadow-2xl border-2 border-gray-200 transform transition-all duration-300">
          <div class="p-6">
            <h4 class="font-bold text-gray-900 mb-4">Admin Quick Actions</h4>
            <div class="space-y-3">
              <button v-for="action in adminQuickActions" :key="action.title"
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
const showAdminQuickMenu = ref(false);
const userFilter = ref('all');
const pendingAlerts = ref(5);

// Admin data
const adminData = ref({
  name: "System Admin",
  role: "Platform Administrator",
  avatar: "SA",
  totalUsers: 1247,
  activeUsers: 892,
  todayLogins: 156
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
    id: 'users', 
    label: 'Users', 
    icon: 'users-icon',
    badge: '1.2k'
  },
  { 
    id: 'companies', 
    label: 'Companies', 
    icon: 'building-icon',
    badge: '45'
  },
  { 
    id: 'events', 
    label: 'Events', 
    icon: 'calendar-icon',
    badge: '3'
  },
  { 
    id: 'analytics', 
    label: 'Analytics', 
    icon: 'trending-icon',
    badge: null
  },
  { 
    id: 'system', 
    label: 'System', 
    icon: 'cog-icon',
    badge: pendingAlerts.value > 0 ? pendingAlerts.value : null
  }
]);

// Live metrics for hero section
const liveMetrics = ref([
  {
    label: "Total Users",
    value: "1,247",
    trend: "+12%",
    subtitle: "Active this month",
    icon: "users-icon",
    trendColor: "bg-green-100 text-green-600"
  },
  {
    label: "Daily Active",
    value: "892",
    trend: "+8%",
    subtitle: "Online now",
    icon: "activity-icon",
    trendColor: "bg-blue-100 text-blue-600"
  },
  {
    label: "Success Rate",
    value: "67%",
    trend: "+5%",
    subtitle: "Job placements",
    icon: "target-icon",
    trendColor: "bg-purple-100 text-purple-600"
  },
  {
    label: "Revenue",
    value: "€15.2k",
    trend: "+23%",
    subtitle: "This quarter",
    icon: "currency-icon",
    trendColor: "bg-green-100 text-green-600"
  }
]);

// Quick admin actions
const quickAdminActions = ref([
  {
    title: "Emergency Broadcast",
    icon: "📢",
    style: "bg-red-500/20 hover:bg-red-500/30 text-red-700 border border-red-300"
  },
  {
    title: "System Maintenance",
    icon: "🔧",
    style: "bg-yellow-500/20 hover:bg-yellow-500/30 text-yellow-700 border border-yellow-300"
  },
  {
    title: "Bulk User Actions",
    icon: "👥",
    style: "bg-blue-500/20 hover:bg-blue-500/30 text-blue-700 border border-blue-300"
  },
  {
    title: "Analytics Export",
    icon: "📊",
    style: "bg-green-500/20 hover:bg-green-500/30 text-green-700 border border-green-300"
  }
]);

// Overview statistics
const overviewStats = ref([
  { 
    label: "Total Students", 
    value: 892, 
    change: "+12%", 
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
    label: "Active Companies", 
    value: 45, 
    change: "+3", 
    subtitle: "New this week",
    icon: "building-icon",
    iconBg: "bg-green-100",
    iconColor: "text-green-600",
    changeBg: "bg-blue-100",
    changeColor: "text-blue-600",
    gradient: "from-green-500 to-emerald-500",
    trendPercentage: 62,
    trendBarColor: "bg-gradient-to-r from-green-500 to-emerald-500"
  },
  { 
    label: "Total Applications", 
    value: 2156, 
    change: "+23%", 
    subtitle: "All time",
    icon: "briefcase-icon",
    iconBg: "bg-purple-100",
    iconColor: "text-purple-600",
    changeBg: "bg-purple-100",
    changeColor: "text-purple-600",
    gradient: "from-purple-500 to-indigo-500",
    trendPercentage: 89,
    trendBarColor: "bg-gradient-to-r from-purple-500 to-indigo-500"
  },
  { 
    label: "Success Rate", 
    value: "67%", 
    change: "+5%", 
    subtitle: "Job placements",
    icon: "trending-icon",
    iconBg: "bg-orange-100",
    iconColor: "text-orange-600",
    changeBg: "bg-green-100",
    changeColor: "text-green-600",
    gradient: "from-orange-500 to-red-500",
    trendPercentage: 67,
    trendBarColor: "bg-gradient-to-r from-orange-500 to-red-500"
  }
]);

// Recent activities
const recentActivities = ref([
  {
    id: 1,
    type: "user_registration",
    message: "New student registered",
    details: "Emma Janssen completed profile setup",
    time: "2 minutes ago",
    status: "info",
    icon: "👤",
    actionable: true
  },
  {
    id: 2,
    type: "company_verified",
    message: "Company verified successfully",
    details: "Microsoft België account approved and activated",
    time: "15 minutes ago", 
    status: "success",
    icon: "✅",
    actionable: false
  },
  {
    id: 3,
    type: "event_created",
    message: "New event scheduled",
    details: "Tech Meetup Brussels created for July 22",
    time: "1 hour ago",
    status: "info",
    icon: "📅",
    actionable: true
  },
  {
    id: 4,
    type: "system_alert",
    message: "System maintenance scheduled",
    details: "Planned downtime tonight 2:00-4:00 AM",
    time: "2 hours ago",
    status: "warning",
    icon: "⚠️",
    actionable: true
  },
  {
    id: 5,
    type: "application_peak",
    message: "Application surge detected",
    details: "300% increase in job applications today",
    time: "3 hours ago",
    status: "success",
    icon: "📈",
    actionable: false
  }
]);

// Pending users
const pendingUsers = ref([
  {
    id: 1,
    name: "Sarah De Vries",
    email: "sarah.devries@student.ehb.be",
    type: "Student",
    registrationDate: "2025-06-16",
    status: "pending",
    priority: "high"
  },
  {
    id: 2,
    name: "Tech Innovators BV",
    email: "hr@techinnovators.be",
    type: "Company",
    registrationDate: "2025-06-15",
    status: "pending",
    priority: "medium"
  },
  {
    id: 3,
    name: "Mark Stevens",
    email: "mark.stevens@gmail.com",
    type: "Student",
    registrationDate: "2025-06-14",
    status: "pending",
    priority: "low"
  }
]);

// System health
const systemHealth = ref([
  { 
    component: "Database", 
    status: "healthy", 
    uptime: "99.9%", 
    lastCheck: "2 minutes ago",
    responseTime: "12ms"
  },
  { 
    component: "API Server", 
    status: "healthy", 
    uptime: "99.8%", 
    lastCheck: "1 minute ago",
    responseTime: "45ms"
  },
  { 
    component: "File Storage", 
    status: "warning", 
    uptime: "98.5%", 
    lastCheck: "5 minutes ago",
    responseTime: "120ms"
  },
  { 
    component: "Email Service", 
    status: "healthy", 
    uptime: "99.7%", 
    lastCheck: "3 minutes ago",
    responseTime: "89ms"
  }
]);

// Quick management tools
const quickManagementTools = ref([
  {
    title: "User Backup",
    description: "Export data",
    icon: "💾",
    hoverColor: "hover:border-blue-300 hover:bg-blue-50"
  },
  {
    title: "Send Alerts",
    description: "Broadcast message",
    icon: "📢",
    hoverColor: "hover:border-red-300 hover:bg-red-50"
  },
  {
    title: "System Logs",
    description: "View activity",
    icon: "📋",
    hoverColor: "hover:border-green-300 hover:bg-green-50"
  },
  {
    title: "Analytics",
    description: "Generate report",
    icon: "📊",
    hoverColor: "hover:border-purple-300 hover:bg-purple-50"
  }
]);

// Performance metrics
const performanceMetrics = ref([
  {
    name: "Server Response",
    value: "45ms",
    percentage: 85,
    barColor: "bg-gradient-to-r from-green-500 to-emerald-500",
    color: "text-green-600"
  },
  {
    name: "Database Queries",
    value: "1.2s",
    percentage: 70,
    barColor: "bg-gradient-to-r from-yellow-500 to-orange-500",
    color: "text-yellow-600"
  },
  {
    name: "Memory Usage",
    value: "67%",
    percentage: 67,
    barColor: "bg-gradient-to-r from-blue-500 to-indigo-500",
    color: "text-blue-600"
  },
  {
    name: "CPU Load",
    value: "34%",
    percentage: 34,
    barColor: "bg-gradient-to-r from-purple-500 to-pink-500",
    color: "text-purple-600"
  }
]);

// User stats
const userStats = ref({
  totalStudents: 892,
  totalCompanies: 45,
  pendingApprovals: 3
});

// All users (for user management)
const allUsers = ref([
  {
    id: 1,
    name: "Maryam Afallah",
    email: "maryam.afallah@student.ehb.be",
    type: "Student",
    status: "verified",
    joinDate: "2025-01-15"
  },
  {
    id: 2,
    name: "Accenture Belgium",
    email: "careers@accenture.be",
    type: "Company",
    status: "verified",
    joinDate: "2025-02-01"
  },
  {
    id: 3,
    name: "Sarah De Vries",
    email: "sarah.devries@student.ehb.be",
    type: "Student",
    status: "pending",
    joinDate: "2025-06-16"
  }
]);

// Companies
const companies = ref([
  {
    id: 1,
    name: "Accenture",
    industry: "IT Consulting",
    employees: "500+",
    location: "Brussels",
    status: "verified",
    applications: 156,
    events: 3,
    lastActive: "Today"
  },
  {
    id: 2,
    name: "Capgemini",
    industry: "Technology Services", 
    employees: "200+",
    location: "Brussels",
    status: "verified",
    applications: 89,
    events: 2,
    lastActive: "Yesterday"
  },
  {
    id: 3,
    name: "Microsoft België",
    industry: "Software",
    employees: "150+", 
    location: "Brussels",
    status: "pending",
    applications: 234,
    events: 5,
    lastActive: "2 days ago"
  }
]);

// Upcoming events
const upcomingEvents = ref([
  {
    id: 1,
    title: "Career Launch 2025",
    date: "2025-07-15",
    location: "Campus Brussels",
    companies: 25,
    students: 150,
    status: "active",
    organizer: "Erasmus Hogeschool"
  },
  {
    id: 2,
    title: "Tech Job Fair Brussels",
    date: "2025-07-22",
    location: "Brussels Expo",
    companies: 35,
    students: 200,
    status: "planning",
    organizer: "Tech Hub Brussels"
  }
]);

// Admin quick actions
const adminQuickActions = ref([
  {
    title: "Create Event",
    icon: "📅",
    style: "hover:bg-blue-50 text-blue-700"
  },
  {
    title: "Approve Users",
    icon: "✅",
    style: "hover:bg-green-50 text-green-700"
  },
  {
    title: "System Alert",
    icon: "⚠️",
    style: "hover:bg-yellow-50 text-yellow-700"
  },
  {
    title: "Export Data",
    icon: "📊",
    style: "hover:bg-purple-50 text-purple-700"
  }
]);

// Computed properties
const filteredUsers = computed(() => {
  if (userFilter.value === 'all') return allUsers.value;
  if (userFilter.value === 'students') return allUsers.value.filter(user => user.type === 'Student');
  if (userFilter.value === 'companies') return allUsers.value.filter(user => user.type === 'Company');
  if (userFilter.value === 'pending') return allUsers.value.filter(user => user.status === 'pending');
  return allUsers.value;
});

// Helper functions
const getStatusColor = (status) => {
  const colors = {
    'verified': 'bg-green-100 text-green-800 border-green-200',
    'pending': 'bg-yellow-100 text-yellow-800 border-yellow-200',
    'rejected': 'bg-red-100 text-red-800 border-red-200',
    'active': 'bg-blue-100 text-blue-800 border-blue-200',
    'planning': 'bg-purple-100 text-purple-800 border-purple-200',
    'draft': 'bg-gray-100 text-gray-800 border-gray-200',
    'healthy': 'bg-green-100 text-green-800 border-green-200',
    'warning': 'bg-yellow-100 text-yellow-800 border-yellow-200',
    'error': 'bg-red-100 text-red-800 border-red-200'
  };
  return colors[status] || 'bg-gray-100 text-gray-800 border-gray-200';
};

const getActivityStatusColor = (status) => {
  const colors = {
    'info': 'bg-blue-50 text-blue-700 border-l-blue-500 border border-blue-100',
    'success': 'bg-green-50 text-green-700 border-l-green-500 border border-green-100',
    'warning': 'bg-yellow-50 text-yellow-700 border-l-yellow-500 border border-yellow-100',
    'error': 'bg-red-50 text-red-700 border-l-red-500 border border-red-100'
  };
  return colors[status] || 'bg-gray-50 text-gray-700 border-l-gray-500 border border-gray-100';
};

// Action functions
const approveUser = (userId) => {
  const userIndex = pendingUsers.value.findIndex(user => user.id === userId);
  if (userIndex > -1) {
    pendingUsers.value.splice(userIndex, 1);
  }
  console.log(`Approved user ${userId}`);
};

const rejectUser = (userId) => {
  const userIndex = pendingUsers.value.findIndex(user => user.id === userId);
  if (userIndex > -1) {
    pendingUsers.value.splice(userIndex, 1);
  }
  console.log(`Rejected user ${userId}`);
};

const verifyCompany = (companyId) => {
  const companyIndex = companies.value.findIndex(company => company.id === companyId);
  if (companyIndex > -1) {
    companies.value[companyIndex].status = 'verified';
  }
  console.log(`Verified company ${companyId}`);
};

// Initialize
onMounted(() => {
  console.log('Admin Dashboard PRO initialized');
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
</style>