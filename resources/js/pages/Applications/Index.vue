<script setup>
import { Head, Link } from '@inertiajs/vue3'
import Navigation from '../../components/Navigation.vue'

const props = defineProps({
  applications: {
    type: Array,
    required: true
  }
})

const getStatusColor = (status) => {
  switch (status) {
    case 'pending':
      return 'bg-yellow-100 text-yellow-800'
    case 'accepted':
      return 'bg-green-100 text-green-800'
    case 'rejected':
      return 'bg-red-100 text-red-800'
    case 'interview':
      return 'bg-blue-100 text-blue-800'
    default:
      return 'bg-gray-100 text-gray-800'
  }
}

const getStatusText = (status) => {
  switch (status) {
    case 'pending':
      return 'In behandeling'
    case 'accepted':
      return 'Geaccepteerd'
    case 'rejected':
      return 'Afgewezen'
    case 'interview':
      return 'Uitgenodigd voor gesprek'
    default:
      return status
  }
}
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <Head title="Mijn Sollicitaties" />

    <!-- Navigation -->
    <Navigation />

    <!-- Header -->
    <div class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">Mijn Sollicitaties</h1>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul role="list" class="divide-y divide-gray-200">
          <li v-for="application in applications" :key="application.id">
            <div class="px-4 py-4 sm:px-6">
              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-12 w-12">
                    <img class="h-12 w-12 rounded-full" :src="application.position.company.logo" :alt="application.position.company.name">
                  </div>
                  <div class="ml-4">
                    <h2 class="text-lg font-medium text-gray-900">{{ application.position.title }}</h2>
                    <p class="text-sm text-gray-500">{{ application.position.company.name }}</p>
                  </div>
                </div>
                <div class="flex items-center">
                  <span :class="[getStatusColor(application.status), 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full']">
                    {{ getStatusText(application.status) }}
                  </span>
                  <Link :href="'/sollicitaties/' + application.id" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Bekijk Details
                  </Link>
                </div>
              </div>
              <div class="mt-2 sm:flex sm:justify-between">
                <div class="sm:flex">
                  <p class="flex items-center text-sm text-gray-500">
                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    {{ application.position.location }}
                  </p>
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                  <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                  </svg>
                  <p>
                    Ingediend op {{ new Date(application.created_at).toLocaleDateString() }}
                  </p>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template> 