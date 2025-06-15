<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue'

const mobileMenuOpen = ref(false)

const bedrijven = ref([
  {
    name: 'Accenture',
    src: '/images/logos/accenture-logo.svg',
    favoriet: false,
    website: 'https://www.accenture.com/be-en'
  },
  { name: 'Capgemini', src: '/images/logos/capgemini-logo.svg', favoriet: false },
  { name: 'Delaware', src: '/images/logos/delaware-logo.svg', favoriet: false },
  { name: 'Flexso', src: '/images/logos/flexo-logo.svg', favoriet: false },
  { name: 'BNP Paribas', src: '/images/logos/bnp-paribas-fortis-logo.svg', favoriet: false },
  { name: 'Colruyt Group', src: '/images/logos/colruyt-group-logo.svg', favoriet: false },
  // werkt nie idk wrm { name: 'Safran', src: '/images/logos/safran-logo.svg', favoriet: false }, -> verander svg img
  { name: 'Inetum', src: '/images/logos/inetum-realdolmen-logo.svg', favoriet: false }
  /*nog toe te voegen bedrijven:
  - avalon
  - axxess
  - equans
  - exclusive
  - gumption
  - nexios-it
  - nomios
  - simac
  */
])
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
</script>

<template>
  <div class="min-h-screen bg-orange-50">
    <!-- Navigation -->
    <nav class="bg-orange-50/90 backdrop-blur-sm shadow-sm sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <!-- Logo -->
          <Link href="/" class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center shadow-lg">
              <span class="text-white font-bold text-lg">E</span>
            </div>
            <div>
              <div class="text-gray-900 font-bold text-xl">erasmus</div>
              <div class="text-xs text-gray-600 -mt-1">HOGESCHOOL BRUSSEL</div>
            </div>
          </Link>

          <!-- Mobile menu button -->
          <div class="md:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-gray-700 hover:bg-orange-100">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
          </div>

          <!-- Desktop Navigation Links -->
          <div class="hidden md:flex items-center space-x-1">
            <Link href="/" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Home</Link>
            <Link href="/info" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Info</Link>
            <Link href="/bedrijven" class="px-4 py-2 text-orange-600 bg-orange-100 rounded-lg font-medium transition-colors">Bedrijven</Link>
            <Link href="/favorieten" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Favorieten</Link>
            <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Contact</Link>

            <div class="flex items-center ml-6">
              <Link href="/login" class="px-6 py-2 text-orange-600 hover:text-orange-700 font-medium transition-colors">Inloggen</Link>
            </div>
          </div>
        </div>

        <!-- Mobile menu -->
        <div v-show="mobileMenuOpen" class="md:hidden mt-4 pb-4 border-t border-orange-200">
          <div class="flex flex-col space-y-2 pt-4">
            <Link href="/" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Home</Link>
            <Link href="/info" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Info</Link>
            <Link href="/afspraak" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Afspraak</Link>
            <Link href="/favorieten" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Favorieten</Link>
            <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Contact</Link>
            <Link href="/login" class="px-4 py-2 text-orange-600 hover:text-orange-700 font-medium">Inloggen</Link>
          </div>
        </div>
      </div>
    </nav>

    <Head title="Alle Bedrijven" />

    <!-- Pagina header -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
      <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Alle bedrijven</h1>
      <p class="text-gray-600 text-lg">Ontdek welke bedrijven op zoek zijn naar talent zoals jij</p>
    </section>

    <!-- Bedrijven grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
      <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-6 justify-items-center">
        <div
          v-for="bedrijf in bedrijven"
          :key="bedrijf.name"
          class="relative bg-white rounded-xl p-4 shadow-sm w-full h-24 flex items-center justify-center"
        >
          <!-- ⭐ Sterretje rechtsboven -->
          <button
            @click="bedrijf.favoriet = !bedrijf.favoriet"
            class="absolute top-2 right-2"
          >
            <svg
              :class="['w-5 h-5 transition-colors', bedrijf.favoriet ? 'text-yellow-400' : 'text-gray-300']"
              fill="currentColor"
              viewBox="0 0 20 20">

              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.173 3.617a1 1 0 00.95.69h3.801c.969 0 1.371 1.24.588 1.81l-3.073 2.23a1 1 0 00-.364 1.118l1.173 3.617c.3.921-.755 1.688-1.54 1.118l-3.073-2.23a1 1 0 00-1.175 0l-3.073 2.23c-.784.57-1.838-.197-1.54-1.118l1.173-3.617a1 1 0 00-.364-1.118L2.536 9.044c-.783-.57-.38-1.81.588-1.81h3.801a1 1 0 00.95-.69l1.173-3.617z" />
            </svg>
          </button>


          <!-- Bedrijfslogo (klikbaar om modal te openen) -->
          <img
              :src="bedrijf.src"
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
        <!-- Logo met aparte achtergrondkleur -->
        <div class="w-14 h-14 bg-white rounded-xl shadow-md flex items-center justify-center">
          <img :src="geselecteerdBedrijf.src" :alt="geselecteerdBedrijf.name" class="w-10 h-10 object-contain" />
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



    <!-- Footer -->
    <footer class="bg-orange-500 text-white py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8">
          <div>
            <div class="flex items-center space-x-3 mb-4">
              <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center">
                <span class="text-white font-bold text-lg">E</span>
              </div>
              <div class="text-white font-bold text-xl">erasmus</div>
            </div>
            <p class="text-orange-100 text-sm mb-4">
              Hogeschool Brussel<br />
              Connecting talent with opportunity
            </p>
          </div>

          <div>
            <h4 class="font-semibold mb-4">Voor studenten</h4>
            <ul class="space-y-2 text-orange-100 text-sm">
              <li><Link href="/register?type=student" class="hover:text-white transition-colors">Maak je profiel</Link></li>
              <li><Link href="/info" class="hover:text-white transition-colors">Career Launch Info</Link></li>
              <li><Link href="/afspraak" class="hover:text-white transition-colors">Speeddate plannen</Link></li>
            </ul>
          </div>

          <div>
            <h4 class="font-semibold mb-4">Voor bedrijven</h4>
            <ul class="space-y-2 text-orange-100 text-sm">
              <li><Link href="/companies" class="hover:text-white transition-colors">Browse studenten</Link></li>
              <li><Link href="/contact" class="hover:text-white transition-colors">Partnership</Link></li>
            </ul>
          </div>

          <div>
            <h4 class="font-semibold mb-4">Support</h4>
            <ul class="space-y-2 text-orange-100 text-sm">
              <li><Link href="/contact" class="hover:text-white transition-colors">Contact</Link></li>
              <li><Link href="/privacy" class="hover:text-white transition-colors">Privacy beleid</Link></li>
            </ul>
          </div>
        </div>

        <div class="border-t border-orange-400 mt-12 pt-8 text-center text-orange-100 text-sm">
          <p>&copy; 2025 Erasmus Hogeschool Brussel. Alle rechten voorbehouden.</p>
        </div>
      </div>
    </footer>

  </div>
</template>

<style scoped>
/* Add any custom styles here */
</style>
