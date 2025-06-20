<script setup>
import { Head, Link } from '@inertiajs/vue3'
import Navigation from '../components/Navigation.vue'

const props = defineProps({
  position: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <Head :title="position.title" />

    <!-- Navigation -->
    <Navigation />

    <!-- Header -->
    <div class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
          <h1 class="text-3xl font-bold text-gray-900">{{ position.title }}</h1>
          <div class="flex space-x-4">
            <Link :href="'/bedrijven/' + position.company.id" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Bekijk Bedrijf
            </Link>
            <Link href="/bedrijven" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Terug naar Bedrijven
            </Link>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
          <div class="flex items-center">
            <div class="flex-shrink-0 h-16 w-16">
              <img class="h-16 w-16 rounded-full" :src="position.company.logo" :alt="position.company.name">
            </div>
            <div class="ml-4">
              <h2 class="text-2xl font-bold text-gray-900">{{ position.company.name }}</h2>
              <p class="text-sm text-gray-500">{{ position.company.industry }}</p>
            </div>
          </div>
        </div>
        <div class="border-t border-gray-200">
          <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">Locatie</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ position.location }}</dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">Type</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ position.type }}</dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">Salaris</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ position.salary_min ? `€${position.salary_min}` : '' }} - {{ position.salary_max ? `€${position.salary_max}` : '' }}
              </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">Beschrijving</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ position.description }}</dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">Vereisten</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ position.requirements }}</dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">Sollicitatie Deadline</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ position.application_deadline ? new Date(position.application_deadline).toLocaleDateString() : 'Geen deadline' }}
              </dd>
            </div>
          </dl>
        </div>
      </div>

      <!-- Apply Button -->
      <div class="mt-6 flex justify-end">
        <Link :href="'/sollicitaties/nieuw?position=' + position.id" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Solliciteer Nu
        </Link>
      </div>
    </div>
  </div>
</template> 