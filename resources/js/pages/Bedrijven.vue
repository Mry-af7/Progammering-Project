<script setup>
import { Head } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

const props = defineProps({
  companies: {
    type: Array,
    required: true
  }
})

const filters = ref({
  search: '',
  industry: '',
  location: ''
})

const industries = [
  'IT & Software',
  'Financiën',
  'Marketing',
  'Onderwijs',
  'Zorg & Welzijn',
  'Retail',
  'Productie',
  'Consulting'
]

const locations = [
  'Brussel',
  'Antwerpen',
  'Gent',
  'Leuven',
  'Mechelen',
  'Brugge',
  'Hasselt',
  'Luik'
]

const currentPage = ref(1)
const itemsPerPage = 9

const filteredCompanies = computed(() => {
  let filtered = props.companies

  if (filters.value.search) {
    const search = filters.value.search.toLowerCase()
    filtered = filtered.filter(company => 
      company.name.toLowerCase().includes(search) ||
      company.description.toLowerCase().includes(search) ||
      company.location.toLowerCase().includes(search)
    )
  }

  if (filters.value.industry) {
    filtered = filtered.filter(company => company.industry === filters.value.industry)
  }

  if (filters.value.location) {
    filtered = filtered.filter(company => company.location === filters.value.location)
  }

  const start = (currentPage.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return filtered.slice(start, end)
})

const totalCompanies = computed(() => {
  let filtered = props.companies

  if (filters.value.search) {
    const search = filters.value.search.toLowerCase()
    filtered = filtered.filter(company => 
      company.name.toLowerCase().includes(search) ||
      company.description.toLowerCase().includes(search) ||
      company.location.toLowerCase().includes(search)
    )
  }

  if (filters.value.industry) {
    filtered = filtered.filter(company => company.industry === filters.value.industry)
  }

  if (filters.value.location) {
    filtered = filtered.filter(company => company.location === filters.value.location)
  }

  return filtered.length
})

const totalPages = computed(() => Math.ceil(totalCompanies.value / itemsPerPage))

const paginationStart = computed(() => (currentPage.value - 1) * itemsPerPage + 1)

const paginationEnd = computed(() => Math.min(currentPage.value * itemsPerPage, totalCompanies.value))

const displayedPages = computed(() => {
  const pages = []
  const maxPages = 5
  let start = Math.max(1, currentPage.value - Math.floor(maxPages / 2))
  let end = Math.min(totalPages.value, start + maxPages - 1)

  if (end - start + 1 < maxPages) {
    start = Math.max(1, end - maxPages + 1)
  }

  for (let i = start; i <= end; i++) {
    pages.push(i)
  }

  return pages
})

function viewCompany(id) {
  window.location.href = `/bedrijven/${id}`
}

function previousPage() {
  if (currentPage.value > 1) {
    currentPage.value--
  }
}

function nextPage() {
  if (currentPage.value < totalPages.value) {
    currentPage.value++
  }
}

function goToPage(page) {
  currentPage.value = page
}
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <Head title="Bedrijven" />

    <!-- Header -->
    <div class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">Bedrijven</h1>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <!-- Filters -->
      <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6 mb-6">
        <div class="md:flex md:items-center md:justify-between">
          <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">Filters</h2>
          </div>
        </div>
        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
          <div class="sm:col-span-2">
            <label for="search" class="block text-sm font-medium text-gray-700">Zoeken</label>
            <div class="mt-1">
              <input type="text" name="search" id="search" v-model="filters.search" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Zoek op naam, locatie...">
            </div>
          </div>

          <div class="sm:col-span-2">
            <label for="industry" class="block text-sm font-medium text-gray-700">Industrie</label>
            <select id="industry" name="industry" v-model="filters.industry" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
              <option value="">Alle industrieën</option>
              <option v-for="industry in industries" :key="industry" :value="industry">{{ industry }}</option>
            </select>
          </div>

          <div class="sm:col-span-2">
            <label for="location" class="block text-sm font-medium text-gray-700">Locatie</label>
            <select id="location" name="location" v-model="filters.location" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
              <option value="">Alle locaties</option>
              <option v-for="location in locations" :key="location" :value="location">{{ location }}</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Companies Grid -->
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <div v-for="company in filteredCompanies" :key="company.id" class="bg-white overflow-hidden shadow rounded-lg">
          <div class="p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0 h-12 w-12">
                <img class="h-12 w-12 rounded-full" :src="company.logo" :alt="company.name">
              </div>
              <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">{{ company.name }}</h3>
                <p class="text-sm text-gray-500">{{ company.industry }}</p>
              </div>
            </div>
            <div class="mt-4">
              <p class="text-sm text-gray-500">{{ company.description }}</p>
            </div>
            <div class="mt-4">
              <div class="flex items-center text-sm text-gray-500">
                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                </svg>
                {{ company.location }}
              </div>
            </div>
            <div class="mt-6">
              <button @click="viewCompany(company.id)" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Bekijk profiel
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-6">
        <div class="flex-1 flex justify-between sm:hidden">
          <button @click="previousPage" :disabled="currentPage === 1" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Vorige
          </button>
          <button @click="nextPage" :disabled="currentPage === totalPages" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Volgende
          </button>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
          <div>
            <p class="text-sm text-gray-700">
              Toont <span class="font-medium">{{ paginationStart }}</span> tot <span class="font-medium">{{ paginationEnd }}</span> van <span class="font-medium">{{ totalCompanies }}</span> bedrijven
            </p>
          </div>
          <div>
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
              <button @click="previousPage" :disabled="currentPage === 1" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Vorige</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
              </button>
              <button v-for="page in displayedPages" :key="page" @click="goToPage(page)" :class="[page === currentPage ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50', 'relative inline-flex items-center px-4 py-2 border text-sm font-medium']">
                {{ page }}
              </button>
              <button @click="nextPage" :disabled="currentPage === totalPages" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Volgende</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
              </button>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Add any custom styles here */
</style>
