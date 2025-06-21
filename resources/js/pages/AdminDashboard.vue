<template>
  <div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg border-r border-gray-200 flex flex-col">
      <!-- Logo -->
      <div class="flex items-center justify-center h-16 border-b border-gray-200">
        <div class="flex items-center space-x-3">
          <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
            <span class="text-white font-bold text-sm">E</span>
          </div>
          <span class="text-xl font-bold text-gray-900">erasmus</span>
        </div>
      </div>

      <!-- Navigation Menu -->
      <nav class="flex-1 mt-6 px-4 space-y-1">
        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">MENU</div>
        
        <!-- Dashboards -->
        <div class="space-y-1">
          <button @click="toggleDashboards" 
                  class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="flex items-center">
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
              </svg>
              Dashboards
            </div>
            <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">3</span>
          </button>
          
          <div v-if="showDashboards" class="ml-8 space-y-1">
            <button @click="setActiveTab('dashboard-1')" 
                    :class="activeTab === 'dashboard-1' ? 'bg-orange-100 text-orange-700' : 'text-gray-600 hover:text-gray-900'"
                    class="w-full text-left px-3 py-2 text-sm rounded-lg transition-colors">
              Dashboard v.2
            </button>
            <button @click="setActiveTab('dashboard-2')" 
                    :class="activeTab === 'dashboard-2' ? 'bg-orange-100 text-orange-700' : 'text-gray-600 hover:text-gray-900'"
                    class="w-full text-left px-3 py-2 text-sm rounded-lg transition-colors">
              Dashboard v.3
            </button>
            <button @click="setActiveTab('dashboard-3')" 
                    :class="activeTab === 'dashboard-3' ? 'bg-orange-100 text-orange-700' : 'text-gray-600 hover:text-gray-900'"
                    class="w-full text-left px-3 py-2 text-sm rounded-lg transition-colors">
              Dashboard v.4
              <span class="ml-2 bg-red-100 text-red-800 text-xs px-1.5 py-0.5 rounded">NEW</span>
            </button>
          </div>
        </div>

        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 mt-6">APPS</div>
        
        <!-- Users Management -->
        <Link :href="route('admin.users.index')" 
              :class="currentRoute === 'admin.users.index' ? 'bg-orange-100 text-orange-700' : 'text-gray-700 hover:bg-gray-100'"
              class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
          </svg>
          Users
        </Link>

        <!-- Companies -->
        <Link :href="route('admin.companies.index')" 
              :class="currentRoute === 'admin.companies.index' ? 'bg-orange-100 text-orange-700' : 'text-gray-700 hover:bg-gray-100'"
              class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-4a2 2 0 012-2h2a2 2 0 012 2v4"/>
          </svg>
          Companies
        </Link>

        <!-- Events -->
        <Link :href="route('admin.events.index')" 
              :class="currentRoute === 'admin.events.index' ? 'bg-orange-100 text-orange-700' : 'text-gray-700 hover:bg-gray-100'"
              class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
          Events
        </Link>

        <!-- Applications -->
        <Link :href="route('admin.applications.index')" 
              :class="currentRoute === 'admin.applications.index' ? 'bg-orange-100 text-orange-700' : 'text-gray-700 hover:bg-gray-100'"
              class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2h8z"/>
          </svg>
          Applications
          <span class="ml-auto bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full">{{ stats.pendingApplications }}</span>
        </Link>

        <!-- File Manager -->
        <button class="flex items-center w-full px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002-2H5a2 2 0 002-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
          </svg>
          File Manager
        </button>

        <!-- Calendar -->
        <button class="flex items-center w-full px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
          Calendar
        </button>

        <!-- Settings -->
        <Link :href="route('admin.settings')" 
              class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          Settings
        </Link>
      </nav>

      <!-- User Profile -->
      <div class="p-4 border-t border-gray-200">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
            <span class="text-white font-medium text-sm">{{ adminUser.initials }}</span>
          </div>
          <div class="flex-1 min-w-0">
            <div class="text-sm font-medium text-gray-900 truncate">{{ adminUser.name }}</div>
            <div class="text-xs text-gray-500">{{ adminUser.role }}</div>
          </div>
          <button @click="logout" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Top Header -->
      <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="flex items-center justify-between px-6 py-4">
          <div>
            <h1 class="text-2xl font-bold text-gray-900">DASHBOARD 2</h1>
            <div class="flex items-center space-x-2 mt-1">
              <Link href="/admin" class="text-sm text-gray-500 hover:text-gray-700">Inspinia</Link>
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
              <span class="text-sm text-gray-900 font-medium">Dashboard 2</span>
            </div>
          </div>

          <div class="flex items-center space-x-4">
            <!-- Notifications -->
            <button @click="toggleNotifications" 
                    class="relative p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
              </svg>
              <span v-if="notifications.length > 0" 
                    class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                {{ notifications.length }}
              </span>
            </button>

            <!-- User Menu -->
            <div class="relative">
              <button @click="toggleUserMenu" 
                      class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                  <span class="text-white font-medium text-sm">{{ adminUser.initials }}</span>
                </div>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
              </button>

              <!-- User Dropdown -->
              <div v-if="showUserMenu" 
                   class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                <div class="py-2">
                  <Link :href="route('admin.profile')" 
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Profile
                  </Link>
                  <Link :href="route('admin.settings')" 
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Settings
                  </Link>
                  <div class="border-t border-gray-200 my-1"></div>
                  <button @click="logout" 
                          class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Logout
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>

      <!-- Dashboard Content -->
      <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <!-- Total Sales -->
          <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-600">Total Sales</p>
                <p class="text-2xl font-bold text-gray-900">${{ stats.totalSales.toLocaleString() }}</p>
                <p class="text-xs text-green-600">Monthly Total Sales</p>
              </div>
              <div class="w-16 h-16">
                <!-- Donut Chart Placeholder -->
                <div class="w-full h-full rounded-full border-4 border-green-200 border-t-green-500 animate-pulse"></div>
              </div>
            </div>
          </div>

          <!-- Total Orders -->
          <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-600">Total Orders</p>
                <p class="text-2xl font-bold text-gray-900">{{ stats.totalOrders.toLocaleString() }}</p>
                <p class="text-xs text-blue-600">Monthly Total Orders</p>
              </div>
              <div class="w-16 h-16">
                <div class="w-full h-full rounded-full border-4 border-blue-200 border-t-blue-500 animate-pulse"></div>
              </div>
            </div>
          </div>

          <!-- New Customers -->
          <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-600">New Customers</p>
                <p class="text-2xl font-bold text-gray-900">{{ stats.newCustomers.toLocaleString() }}</p>
                <p class="text-xs text-purple-600">Monthly New Customers</p>
              </div>
              <div class="w-16 h-16">
                <div class="w-full h-full rounded-full border-4 border-purple-200 border-t-purple-500 animate-pulse"></div>
              </div>
            </div>
          </div>

          <!-- Revenue -->
          <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-600">Revenue</p>
                <p class="text-2xl font-bold text-gray-900">${{ stats.revenue.toLocaleString() }}</p>
                <p class="text-xs text-orange-600">Monthly Revenue</p>
              </div>
              <div class="w-16 h-16">
                <div class="w-full h-full rounded-full border-4 border-orange-200 border-t-orange-500 animate-pulse"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Orders Statistics Chart -->
          <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between mb-6">
              <h3 class="text-lg font-semibold text-gray-900">Orders Statistics</h3>
              <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                  <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                  <span class="text-sm text-gray-600">Completed</span>
                </div>
                <div class="flex items-center space-x-2">
                  <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                  <span class="text-sm text-gray-600">Processing</span>
                </div>
                <div class="flex items-center space-x-2">
                  <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                  <span class="text-sm text-gray-600">Canceled</span>
                </div>
              </div>
            </div>
            
            <!-- Chart Container -->
            <div class="h-80 flex items-center justify-center border-2 border-dashed border-gray-200 rounded-lg">
              <div class="text-center">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <p class="text-gray-500 text-sm">Chart will be rendered here</p>
                <p class="text-gray-400 text-xs mt-1">Use Chart.js or any charting library</p>
              </div>
            </div>
          </div>

          <!-- Recent Orders -->
          <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between mb-6">
              <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
              <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</button>
            </div>

            <div class="space-y-4">
              <div v-for="order in recentOrders" :key="order.id" 
                   class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="flex items-center space-x-3">
                  <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-900">{{ order.product }}</p>
                    <p class="text-xs text-gray-500">{{ order.date }}</p>
                  </div>
                </div>
                <div class="text-right">
                  <p class="text-sm font-medium text-gray-900">${{ order.amount }}</p>
                  <span :class="`inline-flex px-2 py-1 text-xs font-medium rounded-full ${getStatusClass(order.status)}`">
                    {{ order.status }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product Inventory Table -->
        <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
          <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Product Inventory</h3>
            <div class="flex items-center space-x-3">
              <button class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Product
              </button>
              <button class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                </svg>
                Export CSV
              </button>
            </div>
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="product in products" :key="product.id" class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-600 font-medium text-sm">{{ product.name.charAt(0) }}</span>
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">{{ product.name }}</div>
                        <div class="text-sm text-gray-500">{{ product.category }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ product.stock }} units</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${{ product.price }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex text-yellow-400">
                        <svg v-for="i in 5" :key="i" 
                             :class="i <= product.rating ? 'text-yellow-400' : 'text-gray-300'"
                             class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                      </div>
                      <span class="ml-2 text-sm text-gray-500">({{ product.reviews }})</span>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span :class="`inline-flex px-2 py-1 text-xs font-medium rounded-full ${getStockStatusClass(product.stock)}`">
                      {{ getStockStatus(product.stock) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex items-center space-x-3">
                      <button @click="viewProduct(product.id)" 
                              class="text-blue-600 hover:text-blue-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                      </button>
                      <button @click="editProduct(product.id)" 
                              class="text-gray-600 hover:text-gray-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                      </button>
                      <button @click="deleteProduct(product.id)" 
                              class="text-red-600 hover:text-red-900">
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
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { Link, router, usePage } from '@inertiajs/vue3'

// Props from Laravel controller
const props = defineProps({
  stats: {
    type: Object,
    default: () => ({
      totalSales: 250000,
      totalOrders: 180,
      newCustomers: 50895,
      revenue: 50330,
      pendingApplications: 12
    })
  },
  recentOrders: {
    type: Array,
    default: () => [
      { id: 1, product: 'Smart Watch', amount: 89.99, status: 'Delivered', date: '2025-04-29' },
      { id: 2, product: 'Bluetooth Speaker', amount: 39.99, status: 'Pending', date: '2025-04-28' },
      { id: 3, product: 'Gaming Mouse', amount: 24.99, status: 'Completed', date: '2025-04-27' }
    ]
  },
  products: {
    type: Array,
    default: () => [
      { 
        id: 1, 
        name: 'Smart Watch', 
        category: 'Electronics', 
        stock: 120, 
        price: 89.99, 
        rating: 5, 
        reviews: 14 
      },
      { 
        id: 2, 
        name: 'Bluetooth Speaker', 
        category: 'Audio', 
        stock: 75, 
        price: 39.50, 
        rating: 4, 
        reviews: 8 
      },
      { 
        id: 3, 
        name: 'Gaming Mouse', 
        category: 'Accessories', 
        stock: 0, 
        price: 24.99, 
        rating: 5, 
        reviews: 14 
      },
      { 
        id: 4, 
        name: '4K Action Camera', 
        category: 'Electronics', 
        stock: 45, 
        price: 199.99, 
        rating: 4, 
        reviews: 23 
      }
    ]
  },
  notifications: {
    type: Array,
    default: () => [
      { id: 1, title: 'New user registered', message: 'Emma Janssen signed up', read: false },
      { id: 2, title: 'Order completed', message: 'Order #12345 has been delivered', read: false }
    ]
  }
})

// Reactive state
const activeTab = ref('dashboard-1')
const showDashboards = ref(true)
const showNotifications = ref(false)
const showUserMenu = ref(false)

// Current route for highlighting active nav
const page = usePage()
const currentRoute = computed(() => page.props.ziggy?.location)

// Admin user info
const adminUser = computed(() => {
  const user = page.props.auth?.user;
  if (user) {
    return {
      name: `${user.firstname} ${user.lastname}`,
      role: user.role === 'admin' ? 'Administrator' : user.role,
      initials: `${user.firstname?.charAt(0) || ''}${user.lastname?.charAt(0) || ''}`,
      email: user.email
    };
  }
  return {
    name: 'Admin User',
    role: 'Administrator',
    initials: 'AU',
    email: 'admin@example.com'
  };
});

// Methods
const setActiveTab = (tab) => {
  activeTab.value = tab
}

const toggleDashboards = () => {
  showDashboards.value = !showDashboards.value
}

const toggleNotifications = () => {
  showNotifications.value = !showNotifications.value
  showUserMenu.value = false
}

const toggleUserMenu = () => {
  showUserMenu.value = !showUserMenu.value
  showNotifications.value = false
}

const logout = () => {
  router.post(route('logout'))
}

// Product management methods
const viewProduct = (productId) => {
  router.get(route('admin.products.show', productId))
}

const editProduct = (productId) => {
  router.get(route('admin.products.edit', productId))
}

const deleteProduct = (productId) => {
  if (confirm('Are you sure you want to delete this product?')) {
    router.delete(route('admin.products.destroy', productId))
  }
}

// Status helper methods
const getStatusClass = (status) => {
  const classes = {
    'Delivered': 'bg-green-100 text-green-800',
    'Pending': 'bg-yellow-100 text-yellow-800',
    'Completed': 'bg-blue-100 text-blue-800',
    'Cancelled': 'bg-red-100 text-red-800'
  }
  return classes[status] || 'bg-gray-100 text-gray-800'
}

const getStockStatus = (stock) => {
  if (stock === 0) return 'Out of Stock'
  if (stock < 20) return 'Low Stock'
  return 'In Stock'
}

const getStockStatusClass = (stock) => {
  if (stock === 0) return 'bg-red-100 text-red-800'
  if (stock < 20) return 'bg-yellow-100 text-yellow-800'
  return 'bg-green-100 text-green-800'
}

// Close dropdowns when clicking outside
onMounted(() => {
  document.addEventListener('click', (event) => {
    if (!event.target.closest('.relative')) {
      showNotifications.value = false
      showUserMenu.value = false
    }
  })
})
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

/* Smooth transitions */
.transition-colors {
  transition-property: color, background-color, border-color;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}
</style>