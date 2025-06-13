<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
import Navigation from '../components/Navigation.vue'

const mobileMenuOpen = ref(false)

const props = defineProps({
  bedrijven: {
    type: Array,
    required: true
  }
})

const geselecteerdBedrijf = ref(null)
const showModal = ref(false)

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
  let filtered = props.bedrijven

  if (filters.value.search) {
    const search = filters.value.search.toLowerCase()
    filtered = filtered.filter(company => 
      company.name.toLowerCase().includes(search) ||
      company.beschrijving.toLowerCase().includes(search) ||
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
  let filtered = props.bedrijven

  if (filters.value.search) {
    const search = filters.value.search.toLowerCase()
    filtered = filtered.filter(company => 
      company.name.toLowerCase().includes(search) ||
      company.beschrijving.toLowerCase().includes(search) ||
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

function openModal(bedrijf) {
  geselecteerdBedrijf.value = bedrijf
  showModal.value = true
}

function closeModal() {
  showModal.value = false
  geselecteerdBedrijf.value = null
}

function toggleFavoriet(bedrijf) {
  // TODO: Implementeer favorieten functionaliteit met backend
  bedrijf.favoriet = !bedrijf.favoriet
}

function viewCompany(id) {
  return `/bedrijven/${id}`
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
  <div class="min-h-screen bg-orange-50">
    <Head title="Alle Bedrijven" />
    <Navigation />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <h1 class="text-4xl font-bold text-gray-900 mb-8">Bedrijven</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="bedrijf in bedrijven" :key="bedrijf.id" class="bg-white rounded-lg shadow-md overflow-hidden">
          <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ bedrijf.name }}</h2>
            <p class="text-gray-600 mb-4">{{ bedrijf.beschrijving }}</p>
            <Link :href="'/bedrijven/' + bedrijf.id" class="text-orange-600 hover:text-orange-700 font-medium">Bekijk details</Link>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal overlay -->
    <div
      v-if="geselecteerdBedrijf"
      class="fixed inset-0 z-50 bg-black/10 flex items-center justify-center px-4"
    >
      <!-- Modal venster -->
      <div class="bg-gradient-to-br from-orange-100 to-orange-200 rounded-2xl shadow-xl max-w-xl w-full p-8 relative border border-orange-300">
        <!-- Sluitknop -->
        <button @click="closeModal" class="absolute top-4 right-4 text-orange-500 hover:text-orange-600 text-2xl font-bold">
          &times;
        </button>

        <!-- Header met logo en naam -->
        <div class="flex items-center space-x-4 mb-6">
          <!-- Logo met aparte achtergrondkleur -->
          <div class="w-14 h-14 bg-white rounded-xl shadow-md flex items-center justify-center">
            <img :src="geselecteerdBedrijf.logo_path" :alt="geselecteerdBedrijf.name" class="w-10 h-10 object-contain" />
          </div>
          <h2 class="text-2xl font-bold text-orange-800">{{ geselecteerdBedrijf.name }}</h2>
        </div>

        <!-- Bedrijfsinformatie -->
        <ul class="space-y-2 text-sm text-orange-900">
          <li><strong>Specialisatie:</strong> {{ geselecteerdBedrijf.specialisatie || '—' }}</li>
          <li><strong>Beschrijving:</strong> {{ geselecteerdBedrijf.beschrijving || '—' }}</li>
          <li><strong>Adres:</strong> {{ geselecteerdBedrijf.adres || '—' }}</li>
          <li><strong>Telefoonnummer:</strong> {{ geselecteerdBedrijf.telefoon || '—' }}</li>
          <li><strong>Email-adres:</strong> {{ geselecteerdBedrijf.email || '—' }}</li>
        </ul>

        <!-- Website-link rechts onderaan -->
        <div class="flex justify-end mt-8">
          <a
            v-if="geselecteerdBedrijf.website"
            :href="geselecteerdBedrijf.website"
            class="text-orange-600 hover:text-orange-700 font-semibold underline text-sm"
            target="_blank">
            🌐 Ga naar website
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Add any custom styles here */
</style>
