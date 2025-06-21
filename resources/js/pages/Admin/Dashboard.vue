<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
          <div class="flex items-center">
            <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
          </div>
          <div class="flex items-center space-x-4">
            <span class="text-sm text-gray-500">Welcome, {{ $page.props.auth.user.name }}</span>
            <Link :href="route('logout')" method="post" class="text-red-600 hover:text-red-800">
              Logout
            </Link>
          </div>
        </div>
      </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Quick Stats -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
            </div>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                <dd class="text-lg font-medium text-gray-900">{{ stats.totalUsers }}</dd>
              </dl>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                </svg>
              </div>
            </div>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt class="text-sm font-medium text-gray-500 truncate">Total Students</dt>
                <dd class="text-lg font-medium text-gray-900">{{ stats.totalStudents }}</dd>
              </dl>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h4a2 2 0 012 2v2a2 2 0 01-2 2H8a2 2 0 01-2-2v-2z"></path>
                </svg>
              </div>
            </div>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt class="text-sm font-medium text-gray-500 truncate">Total Companies</dt>
                <dd class="text-lg font-medium text-gray-900">{{ stats.totalCompanies }}</dd>
              </dl>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                  <path fill-rule="evenodd" d="M4 5a2 2 0 012-2h8a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 1h6v4H7V6z" clip-rule="evenodd"></path>
                </svg>
              </div>
            </div>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt class="text-sm font-medium text-gray-500 truncate">Pending Approvals</dt>
                <dd class="text-lg font-medium text-gray-900">{{ stats.pendingApprovals }}</dd>
              </dl>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Dashboard Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-8">
          <!-- Analytics Section -->
          <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-lg font-medium text-gray-900 flex items-center">
                <span class="mr-2">📊</span>
                Analytics
              </h2>
            </div>
            <div class="p-6">
              <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Registration Trends (Last 30 Days)</h3>
                <div class="h-64 bg-gray-100 rounded-lg flex items-center justify-center">
                  <p class="text-gray-500">Chart Component Here</p>
                  <!-- You can integrate Chart.js or any other charting library -->
                </div>
              </div>
              <div class="grid grid-cols-2 gap-4">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                  <div class="text-2xl font-bold text-blue-600">{{ stats.newUsersThisMonth }}</div>
                  <div class="text-sm text-gray-500">New Users This Month</div>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                  <div class="text-2xl font-bold text-green-600">{{ stats.activeJobPostings }}</div>
                  <div class="text-sm text-gray-500">Active Job Postings</div>
                </div>
              </div>
            </div>
          </div>

          <!-- User Management Section -->
          <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-lg font-medium text-gray-900 flex items-center">
                <span class="mr-2">👥</span>
                User Management
              </h2>
            </div>
            <div class="p-6">
              <div class="flex space-x-4 mb-4">
                <button 
                  @click="activeTab = 'students'"
                  :class="activeTab === 'students' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
                  class="px-4 py-2 rounded-md text-sm font-medium"
                >
                  Students
                </button>
                <button 
                  @click="activeTab = 'companies'"
                  :class="activeTab === 'companies' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
                  class="px-4 py-2 rounded-md text-sm font-medium"
                >
                  Companies
                </button>
              </div>
              
              <div v-if="activeTab === 'students'" class="space-y-4">
                <div v-for="student in recentStudents" :key="student.id" class="flex items-center justify-between p-4 border rounded-lg">
                  <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-medium">
                      {{ student.name.charAt(0) }}
                    </div>
                    <div>
                      <div class="font-medium">{{ student.name }}</div>
                      <div class="text-sm text-gray-500">{{ student.email }}</div>
                    </div>
                  </div>
                  <div class="flex space-x-2">
                    <button @click="editUser(student)" class="text-blue-600 hover:text-blue-800 text-sm">Edit</button>
                    <button @click="deleteUser(student)" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                  </div>
                </div>
              </div>
              
              <div v-if="activeTab === 'companies'" class="space-y-4">
                <div v-for="company in recentCompanies" :key="company.id" class="flex items-center justify-between p-4 border rounded-lg">
                  <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-medium">
                      {{ company.name.charAt(0) }}
                    </div>
                    <div>
                      <div class="font-medium">{{ company.name }}</div>
                      <div class="text-sm text-gray-500">{{ company.email }}</div>
                    </div>
                  </div>
                  <div class="flex space-x-2">
                    <button @click="editUser(company)" class="text-blue-600 hover:text-blue-800 text-sm">Edit</button>
                    <button @click="deleteUser(company)" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Job Management Section -->
          <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-lg font-medium text-gray-900 flex items-center">
                <span class="mr-2">💼</span>
                Job/Internship Postings
              </h2>
            </div>
            <div class="p-6">
              <div class="space-y-4">
                <div v-for="job in recentJobs" :key="job.id" class="flex items-center justify-between p-4 border rounded-lg">
                  <div>
                    <div class="font-medium">{{ job.title }}</div>
                    <div class="text-sm text-gray-500">{{ job.company }} • {{ job.location }}</div>
                    <div class="text-xs text-gray-400 mt-1">Posted {{ job.posted_date }}</div>
                  </div>
                  <div class="flex space-x-2">
                    <span :class="job.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'" 
                          class="px-2 py-1 rounded-full text-xs">
                      {{ job.status }}
                    </span>
                    <button @click="manageJob(job)" class="text-blue-600 hover:text-blue-800 text-sm">Manage</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-8">
          <!-- Company Approval Section -->
          <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-lg font-medium text-gray-900 flex items-center">
                <span class="mr-2">🏢</span>
                Company Approval
              </h2>
            </div>
            <div class="p-6">
              <div class="space-y-4">
                <div v-for="company in pendingCompanies" :key="company.id" class="p-4 border rounded-lg">
                  <div class="font-medium">{{ company.name }}</div>
                  <div class="text-sm text-gray-500 mb-3">{{ company.industry }}</div>
                  <div class="flex space-x-2">
                    <button @click="approveCompany(company)" class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600">
                      Approve
                    </button>
                    <button @click="rejectCompany(company)" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                      Reject
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-lg font-medium text-gray-900">Quick Actions</h2>
            </div>
            <div class="p-6 space-y-3">
              <button @click="openContentManagement" class="w-full flex items-center p-3 text-left bg-gray-50 rounded-lg hover:bg-gray-100">
                <span class="mr-3">📝</span>
                <span>Content Management</span>
              </button>
              <button @click="openAppointmentManagement" class="w-full flex items-center p-3 text-left bg-gray-50 rounded-lg hover:bg-gray-100">
                <span class="mr-3">📅</span>
                <span>Appointment Management</span>
              </button>
              <button @click="openSystemSettings" class="w-full flex items-center p-3 text-left bg-gray-50 rounded-lg hover:bg-gray-100">
                <span class="mr-3">🛠️</span>
                <span>System Settings</span>
              </button>
            </div>
          </div>

          <!-- Recent Activity -->
          <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-lg font-medium text-gray-900">Recent Activity</h2>
            </div>
            <div class="p-6">
              <div class="space-y-3">
                <div v-for="activity in recentActivity" :key="activity.id" class="flex items-start space-x-3">
                  <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                  <div class="flex-1">
                    <div class="text-sm">{{ activity.description }}</div>
                    <div class="text-xs text-gray-500">{{ activity.time }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Link, router } from '@inertiajs/vue3'

// Define props that would come from your Laravel controller
const props = defineProps({
  stats: Object,
  recentStudents: Array,
  recentCompanies: Array,
  pendingCompanies: Array,
  recentJobs: Array,
  recentActivity: Array
})

// Reactive data
const activeTab = ref('students')

// Default data (you would get this from your Laravel controller)
const stats = ref(props.stats || {
  totalUsers: 1250,
  totalStudents: 890,
  totalCompanies: 360,
  pendingApprovals: 15,
  newUsersThisMonth: 142,
  activeJobPostings: 89
})

const recentStudents = ref(props.recentStudents || [
  { id: 1, name: 'John Doe', email: 'john@university.edu', created_at: '2024-01-15' },
  { id: 2, name: 'Jane Smith', email: 'jane@university.edu', created_at: '2024-01-14' },
  { id: 3, name: 'Mike Johnson', email: 'mike@university.edu', created_at: '2024-01-13' }
])

const recentCompanies = ref(props.recentCompanies || [
  { id: 1, name: 'Tech Corp', email: 'hr@techcorp.com', status: 'approved' },
  { id: 2, name: 'Innovation Ltd', email: 'contact@innovation.com', status: 'pending' }
])

const pendingCompanies = ref(props.pendingCompanies || [
  { id: 1, name: 'New Startup Inc', industry: 'Technology', email: 'hello@newstartup.com' },
  { id: 2, name: 'Marketing Agency', industry: 'Marketing', email: 'info@marketing.com' }
])

const recentJobs = ref(props.recentJobs || [
  { id: 1, title: 'Software Developer Intern', company: 'Tech Corp', location: 'Remote', status: 'active', posted_date: '2 days ago' },
  { id: 2, title: 'Marketing Assistant', company: 'Innovation Ltd', location: 'New York', status: 'pending', posted_date: '1 week ago' }
])

const recentActivity = ref(props.recentActivity || [
  { id: 1, description: 'New company "Tech Solutions" registered', time: '2 hours ago' },
  { id: 2, description: 'Student John Doe updated profile', time: '4 hours ago' },
  { id: 3, description: 'Company "Innovation Ltd" posted new job', time: '1 day ago' }
])

// Methods
const editUser = (user) => {
  // Navigate to edit page or open modal
  router.visit(`/admin/users/${user.id}/edit`)
}

const deleteUser = (user) => {
  if (confirm(`Are you sure you want to delete ${user.name}?`)) {
    router.delete(`/admin/users/${user.id}`)
  }
}

const approveCompany = (company) => {
  router.post(`/admin/companies/${company.id}/approve`, {}, {
    onSuccess: () => {
      // Remove from pending list
      const index = pendingCompanies.value.findIndex(c => c.id === company.id)
      if (index > -1) pendingCompanies.value.splice(index, 1)
    }
  })
}

const rejectCompany = (company) => {
  if (confirm(`Are you sure you want to reject ${company.name}?`)) {
    router.post(`/admin/companies/${company.id}/reject`, {}, {
      onSuccess: () => {
        // Remove from pending list
        const index = pendingCompanies.value.findIndex(c => c.id === company.id)
        if (index > -1) pendingCompanies.value.splice(index, 1)
      }
    })
  }
}

const manageJob = (job) => {
  router.visit(`/admin/jobs/${job.id}`)
}

const openContentManagement = () => {
  router.visit('/admin/content')
}

const openAppointmentManagement = () => {
  router.visit('/admin/appointments')
}

const openSystemSettings = () => {
  router.visit('/admin/settings')
}

onMounted(() => {
  // Any initialization logic
})
</script>