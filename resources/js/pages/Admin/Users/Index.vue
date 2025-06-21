<template>
  <div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="px-4 py-6 sm:px-0">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-2xl font-bold text-gray-900">Users Management</h2>
              <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg">
                Add User
              </button>
            </div>

            <!-- Search and Filters -->
            <div class="mb-6 flex gap-4">
              <div class="flex-1">
                <input
                  type="text"
                  placeholder="Search users..."
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                />
              </div>
              <select class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                <option value="">All Roles</option>
                <option value="student">Student</option>
                <option value="company">Company</option>
                <option value="admin">Admin</option>
              </select>
            </div>

            <!-- Users Table -->
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="user in users.data" :key="user.id" class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                          <span class="text-white font-medium text-sm">{{ getUserInitials(user) }}</span>
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">{{ getUserName(user) }}</div>
                          <div class="text-sm text-gray-500">{{ user.email }}</div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span :class="`inline-flex px-2 py-1 text-xs font-medium rounded-full ${getRoleClass(user.role)}`">
                        {{ user.role }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span :class="`inline-flex px-2 py-1 text-xs font-medium rounded-full ${getStatusClass(user.email_verified_at)}`">
                        {{ user.email_verified_at ? 'Verified' : 'Pending' }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{ formatDate(user.created_at) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <div class="flex space-x-2">
                        <button class="text-blue-600 hover:text-blue-900">View</button>
                        <button class="text-gray-600 hover:text-gray-900">Edit</button>
                        <button class="text-red-600 hover:text-red-900">Delete</button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex items-center justify-between">
              <div class="text-sm text-gray-700">
                Showing {{ users.from }} to {{ users.to }} of {{ users.total }} results
              </div>
              <div class="flex space-x-2">
                <button 
                  v-if="users.prev_page_url"
                  class="px-3 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50"
                >
                  Previous
                </button>
                <button 
                  v-if="users.next_page_url"
                  class="px-3 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50"
                >
                  Next
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  users: {
    type: Object,
    default: () => ({
      data: [],
      current_page: 1,
      from: 1,
      to: 10,
      total: 0,
      prev_page_url: null,
      next_page_url: null
    })
  }
})

const getUserInitials = (user) => {
  if (user.student_profile) {
    return `${user.student_profile.firstname?.charAt(0) || ''}${user.student_profile.lastname?.charAt(0) || ''}`
  }
  if (user.company_profile) {
    return user.company_profile.company_name?.charAt(0) || 'C'
  }
  return user.email.charAt(0).toUpperCase()
}

const getUserName = (user) => {
  if (user.student_profile) {
    return `${user.student_profile.firstname} ${user.student_profile.lastname}`
  }
  if (user.company_profile) {
    return user.company_profile.company_name
  }
  return user.email
}

const getRoleClass = (role) => {
  const classes = {
    'student': 'bg-blue-100 text-blue-800',
    'company': 'bg-green-100 text-green-800',
    'admin': 'bg-purple-100 text-purple-800'
  }
  return classes[role] || 'bg-gray-100 text-gray-800'
}

const getStatusClass = (verified) => {
  return verified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString()
}
</script> 