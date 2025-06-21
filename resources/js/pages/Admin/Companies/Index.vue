<template>
  <div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="px-4 py-6 sm:px-0">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-2xl font-bold text-gray-900">Companies Management</h2>
              <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg">
                Add Company
              </button>
            </div>

            <!-- Search and Filters -->
            <div class="mb-6 flex gap-4">
              <div class="flex-1">
                <input
                  type="text"
                  placeholder="Search companies..."
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                />
              </div>
              <select class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                <option value="">All Industries</option>
                <option value="technology">Technology</option>
                <option value="finance">Finance</option>
                <option value="healthcare">Healthcare</option>
              </select>
            </div>

            <!-- Companies Table -->
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Industry</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Size</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="company in companies.data" :key="company.id" class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                          <span class="text-white font-medium text-sm">{{ company.company_name?.charAt(0) || 'C' }}</span>
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">{{ company.company_name }}</div>
                          <div class="text-sm text-gray-500">{{ company.email }}</div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ company.industry?.name || 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ company.company_size?.name || 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span :class="`inline-flex px-2 py-1 text-xs font-medium rounded-full ${getStatusClass(company.status)}`">
                        {{ company.status || 'Active' }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{ formatDate(company.created_at) }}
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
                Showing {{ companies.from }} to {{ companies.to }} of {{ companies.total }} results
              </div>
              <div class="flex space-x-2">
                <button 
                  v-if="companies.prev_page_url"
                  class="px-3 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50"
                >
                  Previous
                </button>
                <button 
                  v-if="companies.next_page_url"
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
  companies: {
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

const getStatusClass = (status) => {
  const classes = {
    'active': 'bg-green-100 text-green-800',
    'pending': 'bg-yellow-100 text-yellow-800',
    'inactive': 'bg-red-100 text-red-800'
  }
  return classes[status] || 'bg-green-100 text-green-800'
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString()
}
</script> 