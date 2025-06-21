<template>
  <div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="px-4 py-6 sm:px-0">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-2xl font-bold text-gray-900">Events Management</h2>
              <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg">
                Add Event
              </button>
            </div>

            <!-- Search and Filters -->
            <div class="mb-6 flex gap-4">
              <div class="flex-1">
                <input
                  type="text"
                  placeholder="Search events..."
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                />
              </div>
              <select class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                <option value="">All Status</option>
                <option value="upcoming">Upcoming</option>
                <option value="ongoing">Ongoing</option>
                <option value="completed">Completed</option>
              </select>
            </div>

            <!-- Events Table -->
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attendees</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="event in events.data" :key="event.id" class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                          <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                          </svg>
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">{{ event.title }}</div>
                          <div class="text-sm text-gray-500">{{ event.description?.substring(0, 50) }}...</div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ formatDate(event.start_date) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ event.location || 'Online' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span :class="`inline-flex px-2 py-1 text-xs font-medium rounded-full ${getStatusClass(event.status)}`">
                        {{ event.status || 'Upcoming' }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      {{ event.max_attendees || 0 }} / {{ event.max_attendees || 0 }}
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
                Showing {{ events.from }} to {{ events.to }} of {{ events.total }} results
              </div>
              <div class="flex space-x-2">
                <button 
                  v-if="events.prev_page_url"
                  class="px-3 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50"
                >
                  Previous
                </button>
                <button 
                  v-if="events.next_page_url"
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
  events: {
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
    'upcoming': 'bg-blue-100 text-blue-800',
    'ongoing': 'bg-green-100 text-green-800',
    'completed': 'bg-gray-100 text-gray-800'
  }
  return classes[status] || 'bg-blue-100 text-blue-800'
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString()
}
</script> 