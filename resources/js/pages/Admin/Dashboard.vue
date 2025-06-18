<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
      <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-2000"></div>
      <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-xl opacity-10 animate-pulse animation-delay-4000"></div>
    </div>

    <!-- Premium Header -->
    <header class="relative bg-white/5 backdrop-blur-2xl border-b border-white/10 sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
          <div class="flex items-center space-x-4">
            <div class="relative">
              <div class="w-14 h-14 bg-gradient-to-br from-orange-400 via-red-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-2xl shadow-orange-500/25">
                <span class="text-white font-black text-2xl tracking-tight">E</span>
              </div>
              <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full animate-pulse shadow-lg shadow-green-400/50"></div>
            </div>
            <div>
              <div class="font-black text-3xl bg-gradient-to-r from-white via-blue-100 to-purple-200 bg-clip-text text-transparent tracking-tight">
                erasmus
              </div>
              <div class="text-xs text-white/60 font-semibold tracking-widest uppercase">
                Admin Control Center
              </div>
            </div>
          </div>
          
          <div class="flex items-center space-x-6">
            <!-- Real-time Status -->
            <div class="hidden md:flex items-center space-x-2 bg-white/10 rounded-xl px-4 py-2">
              <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
              <span class="text-white/80 text-sm font-medium">Live</span>
            </div>
            
            <!-- Admin Profile -->
            <div class="flex items-center space-x-3">
              <div class="text-right hidden sm:block">
                <div class="text-white font-semibold">Admin Portal</div>
                <div class="text-white/60 text-sm">Welkom terug</div>
              </div>
              <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-600 rounded-xl flex items-center justify-center">
                <span class="text-white font-bold">A</span>
              </div>
            </div>
            
            <Link href="/logout" method="post" as="button" 
                  class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg shadow-red-500/25 hover:shadow-red-500/40 hover:scale-105">
              Uitloggen
            </Link>
          </div>
        </div>
      </div>
    </header>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <!-- Enhanced Statistics -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        <div class="group relative bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl p-8 hover:bg-white/15 transition-all duration-500 border border-white/20 hover:border-white/30 hover:scale-105">
          <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative flex flex-col items-center">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-blue-500/25">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
              </svg>
            </div>
            <div class="text-5xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300">
              {{ stats.total_students }}
            </div>
            <div class="text-white/70 font-semibold">Studenten</div>
            <div class="text-blue-400 text-sm mt-2">+12% deze maand</div>
          </div>
        </div>

        <div class="group relative bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl p-8 hover:bg-white/15 transition-all duration-500 border border-white/20 hover:border-white/30 hover:scale-105">
          <div class="absolute inset-0 bg-gradient-to-br from-green-500/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative flex flex-col items-center">
            <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-green-500/25">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
              </svg>
            </div>
            <div class="text-5xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300">
              {{ stats.total_companies }}
            </div>
            <div class="text-white/70 font-semibold">Bedrijven</div>
            <div class="text-green-400 text-sm mt-2">+8% deze maand</div>
          </div>
        </div>

        <div class="group relative bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl p-8 hover:bg-white/15 transition-all duration-500 border border-white/20 hover:border-white/30 hover:scale-105">
          <div class="absolute inset-0 bg-gradient-to-br from-yellow-500/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative flex flex-col items-center">
            <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-yellow-500/25">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
            </div>
            <div class="text-5xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300">
              {{ stats.total_appointments }}
            </div>
            <div class="text-white/70 font-semibold">Afspraken</div>
            <div class="text-yellow-400 text-sm mt-2">+25% deze week</div>
          </div>
        </div>

        <div class="group relative bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl p-8 hover:bg-white/15 transition-all duration-500 border border-white/20 hover:border-white/30 hover:scale-105">
          <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative flex flex-col items-center">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-purple-500/25">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <div class="text-5xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300">
              {{ stats.pending_appointments }}
            </div>
            <div class="text-white/70 font-semibold">In Afwachting</div>
            <div class="text-purple-400 text-sm mt-2">Actie vereist</div>
          </div>
        </div>
      </div>

      <!-- Enhanced Main Content Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <!-- Recente Afspraken -->
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 hover:border-white/30 transition-all duration-500">
          <div class="px-8 py-6 border-b border-white/20">
            <div class="flex items-center justify-between">
              <h3 class="text-xl font-bold text-white flex items-center">
                <div class="w-2 h-2 bg-blue-400 rounded-full mr-3 animate-pulse"></div>
                Recente Afspraken
              </h3>
              <Link href="/admin/appointments" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                Bekijk alle
              </Link>
            </div>
          </div>
          <div class="p-8">
            <div v-if="recent_appointments.length === 0" class="text-center py-12">
              <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
              <p class="text-white/60">Geen recente afspraken</p>
            </div>
            <div v-else class="space-y-4">
              <div v-for="appointment in recent_appointments" :key="appointment.id" 
                   class="group flex items-center justify-between p-6 bg-white/5 rounded-2xl hover:bg-white/10 transition-all duration-300 border border-white/10 hover:border-white/20">
                <div class="flex items-center space-x-4">
                  <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-sm">
                      {{ appointment.user?.firstname?.charAt(0) }}{{ appointment.user?.lastname?.charAt(0) }}
                    </span>
                  </div>
                  <div>
                    <p class="font-semibold text-white group-hover:text-blue-300 transition-colors">
                      {{ appointment.user?.firstname }} {{ appointment.user?.lastname }}
                    </p>
                    <p class="text-white/70 text-sm">{{ appointment.company?.name }}</p>
                    <p class="text-white/50 text-xs">{{ new Date(appointment.created_at).toLocaleDateString() }}</p>
                  </div>
                </div>
                <span :class="[
                  'px-3 py-1 text-xs font-semibold rounded-full border',
                  appointment.status === 'confirmed' 
                    ? 'bg-green-500/20 text-green-300 border-green-500/30' 
                    : 'bg-yellow-500/20 text-yellow-300 border-yellow-500/30'
                ]">
                  {{ appointment.status }}
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Recente Studenten -->
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 hover:border-white/30 transition-all duration-500">
          <div class="px-8 py-6 border-b border-white/20">
            <div class="flex items-center justify-between">
              <h3 class="text-xl font-bold text-white flex items-center">
                <div class="w-2 h-2 bg-green-400 rounded-full mr-3 animate-pulse"></div>
                Recente Studenten
              </h3>
              <Link href="/admin/students" class="text-green-400 hover:text-green-300 text-sm font-medium">
                Bekijk alle
              </Link>
            </div>
          </div>
          <div class="p-8">
            <div v-if="recent_students.length === 0" class="text-center py-12">
              <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
              </div>
              <p class="text-white/60">Geen recente studenten</p>
            </div>
            <div v-else class="space-y-4">
              <div v-for="student in recent_students" :key="student.id" 
                   class="group flex items-center justify-between p-6 bg-white/5 rounded-2xl hover:bg-white/10 transition-all duration-300 border border-white/10 hover:border-white/20">
                <div class="flex items-center space-x-4">
                  <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-sm">
                      {{ student.firstname?.charAt(0) }}{{ student.lastname?.charAt(0) }}
                    </span>
                  </div>
                  <div>
                    <p class="font-semibold text-white group-hover:text-green-300 transition-colors">
                      {{ student.firstname }} {{ student.lastname }}
                    </p>
                    <p class="text-white/70 text-sm">{{ student.email }}</p>
                  </div>
                </div>
                <div class="text-right">
                  <span class="text-white/50 text-xs">
                    {{ new Date(student.created_at).toLocaleDateString() }}
                  </span>
                  <div class="mt-1">
                    <span class="px-2 py-1 bg-blue-500/20 text-blue-300 text-xs rounded-full border border-blue-500/30">
                      Actief
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Enhanced Quick Actions -->
      <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 hover:border-white/30 transition-all duration-500">
        <div class="px-8 py-6 border-b border-white/20">
          <h3 class="text-xl font-bold text-white flex items-center">
            <div class="w-2 h-2 bg-orange-400 rounded-full mr-3 animate-pulse"></div>
            Snelle Acties & Beheer
          </h3>
        </div>
        <div class="p-8">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <Link href="/admin/students" 
                  class="group relative flex items-center p-6 bg-gradient-to-br from-blue-500/20 to-blue-600/20 rounded-2xl hover:from-blue-500/30 hover:to-blue-600/30 transition-all duration-300 border border-blue-500/30 hover:border-blue-400/50 hover:scale-105">
              <div class="absolute inset-0 bg-gradient-to-br from-blue-400/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <div class="relative flex items-center space-x-4">
                <div class="p-3 bg-blue-500/30 rounded-xl group-hover:bg-blue-500/40 transition-colors shadow-lg shadow-blue-500/25">
                  <svg class="w-7 h-7 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                  </svg>
                </div>
                <div>
                  <p class="font-bold text-white group-hover:text-blue-300 transition-colors">Beheer Studenten</p>
                  <p class="text-white/70 text-sm">Bekijk en beheer alle studenten</p>
                  <p class="text-blue-400 text-xs mt-1">{{ stats.total_students }} geregistreerd</p>
                </div>
              </div>
            </Link>

            <Link href="/admin/companies" 
                  class="group relative flex items-center p-6 bg-gradient-to-br from-green-500/20 to-green-600/20 rounded-2xl hover:from-green-500/30 hover:to-green-600/30 transition-all duration-300 border border-green-500/30 hover:border-green-400/50 hover:scale-105">
              <div class="absolute inset-0 bg-gradient-to-br from-green-400/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <div class="relative flex items-center space-x-4">
                <div class="p-3 bg-green-500/30 rounded-xl group-hover:bg-green-500/40 transition-colors shadow-lg shadow-green-500/25">
                  <svg class="w-7 h-7 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                  </svg>
                </div>
                <div>
                  <p class="font-bold text-white group-hover:text-green-300 transition-colors">Beheer Bedrijven</p>
                  <p class="text-white/70 text-sm">Bekijk en beheer alle bedrijven</p>
                  <p class="text-green-400 text-xs mt-1">{{ stats.total_companies }} partners</p>
                </div>
              </div>
            </Link>

            <Link href="/admin/appointments" 
                  class="group relative flex items-center p-6 bg-gradient-to-br from-yellow-500/20 to-yellow-600/20 rounded-2xl hover:from-yellow-500/30 hover:to-yellow-600/30 transition-all duration-300 border border-yellow-500/30 hover:border-yellow-400/50 hover:scale-105">
              <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <div class="relative flex items-center space-x-4">
                <div class="p-3 bg-yellow-500/30 rounded-xl group-hover:bg-yellow-500/40 transition-colors shadow-lg shadow-yellow-500/25">
                  <svg class="w-7 h-7 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                </div>
                <div>
                  <p class="font-bold text-white group-hover:text-yellow-300 transition-colors">Beheer Afspraken</p>
                  <p class="text-white/70 text-sm">Bekijk en beheer alle afspraken</p>
                  <p class="text-yellow-400 text-xs mt-1">{{ stats.pending_appointments }} wachtend</p>
                </div>
              </div>
            </Link>

            <!-- Additional Pro Features -->
            <Link href="/admin/analytics" 
                  class="group relative flex items-center p-6 bg-gradient-to-br from-purple-500/20 to-purple-600/20 rounded-2xl hover:from-purple-500/30 hover:to-purple-600/30 transition-all duration-300 border border-purple-500/30 hover:border-purple-400/50 hover:scale-105">
              <div class="absolute inset-0 bg-gradient-to-br from-purple-400/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <div class="relative flex items-center space-x-4">
                <div class="p-3 bg-purple-500/30 rounded-xl group-hover:bg-purple-500/40 transition-colors shadow-lg shadow-purple-500/25">
                  <svg class="w-7 h-7 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                  </svg>
                </div>
                <div>
                  <p class="font-bold text-white group-hover:text-purple-300 transition-colors">Analytics</p>
                  <p class="text-white/70 text-sm">Gedetailleerde rapportages</p>
                  <p class="text-purple-400 text-xs mt-1">Real-time data</p>
                </div>
              </div>
            </Link>

            <Link href="/admin/settings" 
                  class="group relative flex items-center p-6 bg-gradient-to-br from-indigo-500/20 to-indigo-600/20 rounded-2xl hover:from-indigo-500/30 hover:to-indigo-600/30 transition-all duration-300 border border-indigo-500/30 hover:border-indigo-400/50 hover:scale-105">
              <div class="absolute inset-0 bg-gradient-to-br from-indigo-400/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <div class="relative flex items-center space-x-4">
                <div class="p-3 bg-indigo-500/30 rounded-xl group-hover:bg-indigo-500/40 transition-colors shadow-lg shadow-indigo-500/25">
                  <svg class="w-7 h-7 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                </div>
                <div>
                  <p class="font-bold text-white group-hover:text-indigo-300 transition-colors">Instellingen</p>
                  <p class="text-white/70 text-sm">Systeem configuratie</p>
                  <p class="text-indigo-400 text-xs mt-1">Geavanceerd</p>
                </div>
              </div>
            </Link>

            <Link href="/admin/notifications" 
                  class="group relative flex items-center p-6 bg-gradient-to-br from-pink-500/20 to-pink-600/20 rounded-2xl hover:from-pink-500/30 hover:to-pink-600/30 transition-all duration-300 border border-pink-500/30 hover:border-pink-400/50 hover:scale-105">
              <div class="absolute inset-0 bg-gradient-to-br from-pink-400/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <div class="relative flex items-center space-x-4">
                <div class="p-3 bg-pink-500/30 rounded-xl group-hover:bg-pink-500/40 transition-colors shadow-lg shadow-pink-500/25">
                  <svg class="w-7 h-7 text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM12 17h-7a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2z"></path>
                  </svg>
                </div>
                <div>
                  <p class="font-bold text-white group-hover:text-pink-300 transition-colors">Notificaties</p>
                  <p class="text-white/70 text-sm">Berichten & waarschuwingen</p>
                  <p class="text-pink-400 text-xs mt-1">3 nieuwe</p>
                </div>
              </div>
            </Link>
          </div>
        </div>
      </div>

      <!-- Additional Pro Dashboard Section -->
      <div class="mt-12 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Activity Feed -->
        <div class="lg:col-span-2 bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20">
          <div class="px-8 py-6 border-b border-white/20">
            <h3 class="text-xl font-bold text-white flex items-center">
              <div class="w-2 h-2 bg-green-400 rounded-full mr-3 animate-pulse"></div>
              Live Activiteiten
            </h3>
          </div>
          <div class="p-8 space-y-4">
            <div class="flex items-center space-x-4 p-4 bg-white/5 rounded-xl border border-white/10">
              <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
              <div class="flex-1">
                <p class="text-white text-sm">Nieuwe student geregistreerd</p>
                <p class="text-white/60 text-xs">2 minuten geleden</p>
              </div>
            </div>
            <div class="flex items-center space-x-4 p-4 bg-white/5 rounded-xl border border-white/10">
              <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
              <div class="flex-1">
                <p class="text-white text-sm">Afspraak bevestigd</p>
                <p class="text-white/60 text-xs">5 minuten geleden</p>
              </div>
            </div>
            <div class="flex items-center space-x-4 p-4 bg-white/5 rounded-xl border border-white/10">
              <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></div>
              <div class="flex-1">
                <p class="text-white text-sm">Nieuw bedrijf wacht op goedkeuring</p>
                <p class="text-white/60 text-xs">12 minuten geleden</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20">
          <div class="px-8 py-6 border-b border-white/20">
            <h3 class="text-xl font-bold text-white">Vandaag</h3>
          </div>
          <div class="p-8 space-y-6">
            <div class="text-center">
              <div class="text-3xl font-black text-blue-400 mb-1">24</div>
              <div class="text-white/70 text-sm">Nieuwe registraties</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-black text-green-400 mb-1">12</div>
              <div class="text-white/70 text-sm">Bevestigde afspraken</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-black text-yellow-400 mb-1">6</div>
              <div class="text-white/70 text-sm">Wachtende goedkeuringen</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  stats: {
    type: Object,
    required: true
  },
  recent_appointments: {
    type: Array,
    required: true
  },
  recent_students: {
    type: Array,
    required: true
  }
})
</script>

<style scoped>
@keyframes pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
  }
}

.animate-pulse {
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

/* Custom scrollbar for better aesthetics */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.1);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.3);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.5);
}
</style>