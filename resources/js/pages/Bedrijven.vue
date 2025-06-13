<template>
  <div class="min-h-screen bg-orange-50">
    <NavMain />

    <Head title="Alle Bedrijven" />

    <!-- Pagina header -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
      <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Alle bedrijven</h1>
      <p class="text-gray-600 text-lg">Ontdek welke bedrijven op zoek zijn naar talent zoals jij</p>
    </section>

    <!-- Toast Message -->
    <div v-if="message" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
      {{ message }}
    </div>
    
    <div v-if="error" class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
      {{ error }}
    </div>

    <!-- Bedrijven grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
      <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-6 justify-items-center">
        <div
          v-for="bedrijf in bedrijven"
          :key="bedrijf.id"
          class="relative bg-white rounded-xl p-4 shadow-sm w-full h-24 flex items-center justify-center"
        >
          <!-- ⭐ Sterretje rechtsboven -->
          <button
            @click="toggleFavorite(bedrijf)"
            class="absolute top-2 right-2"
            :class="{ 'text-red-500': bedrijf.is_favorite }"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5 transition-colors"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
          </button>

          <!-- Bedrijfslogo (klikbaar om modal te openen) -->
          <img
            :src="bedrijf.logo_path"
            :alt="bedrijf.name"
            class="h-10 object-contain cursor-pointer"
            @click="openModal(bedrijf)"/>
        </div>
      </div>
    </section>

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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div>
        <h4 class="font-semibold mb-4">Voor bedrijven</h4>
        <ul class="space-y-2 text-orange-100 text-sm">
          <li><Link href="/studenten" class="hover:text-white transition-colors">Browse studenten</Link></li>
          <li><Link href="/contact" class="hover:text-white transition-colors">Partnership</Link></li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import NavMain from '@/components/NavMain.vue'

const props = defineProps(['bedrijven'])

const mobileMenuOpen = ref(false)
const message = ref('')
const error = ref('')

const geselecteerdBedrijf = ref(null)
const showModal = ref(false)

function openModal(bedrijf) {
  geselecteerdBedrijf.value = bedrijf
  showModal.value = true
}

function closeModal() {
  showModal.value = false
  geselecteerdBedrijf.value = null
}

async function toggleFavorite(company) {
  try {
    if (company.is_favorite) {
      await router.delete(`/favorites/${company.favorite_id}`, {
        preserveState: true,
        preserveScroll: true
      })
      company.is_favorite = false
      company.favorite_id = null
    } else {
      const response = await router.post('/favorites', {
        item_id: company.id,
        item_type: 'bedrijf'
      }, {
        preserveState: true,
        preserveScroll: true
      })
      company.is_favorite = true
      company.favorite_id = response.data.favorite.id
    }
  } catch (error) {
    console.error('Error toggling favorite:', error)
  }
}
</script> 