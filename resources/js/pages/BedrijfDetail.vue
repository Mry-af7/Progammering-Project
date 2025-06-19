<script setup>
import { Head, Link } from '@inertiajs/vue3'
import Navigation from '../components/Navigation.vue'

const props = defineProps({
  company: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <Head :title="company.name" />

    <!-- Navigation -->
    <Navigation />

    <!-- Header -->
    <div class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
          <h1 class="text-3xl font-bold text-gray-900">{{ company.name }}</h1>
          <Link href="/bedrijven" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Terug naar Bedrijven
          </Link>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
          <div class="flex items-center">
            <div class="flex-shrink-0 h-16 w-16">
              <img class="h-16 w-16 rounded-full" :src="company.logo" :alt="company.name">
            </div>
            <div class="ml-4">
              <h2 class="text-2xl font-bold text-gray-900">{{ company.name }}</h2>
              <p class="text-sm text-gray-500">{{ company.industry }}</p>
            </div>
          </div>
        </div>
        <div class="border-t border-gray-200">
          <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">Locatie</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ company.location }}</dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">Beschrijving</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ company.description }}</dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">Contact</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <a :href="'mailto:' + company.email" class="text-indigo-600 hover:text-indigo-900">{{ company.email }}</a>
              </dd>
            </div>
          </dl>
        </div>
      </div>

      <!-- Available Positions -->
      <div class="mt-8">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Beschikbare Posities</h3>
        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
          <div v-for="position in company.positions" :key="position.id" class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-6">
              <h4 class="text-lg font-medium text-gray-900">{{ position.title }}</h4>
              <p class="mt-2 text-sm text-gray-500">{{ position.description }}</p>
              <div class="mt-4">
                <Link :href="'/posities/' + position.id" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Bekijk Positie
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template> 