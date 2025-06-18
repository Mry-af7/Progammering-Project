<template>
  <AppLayout>
    <Head title="Mijn Favorieten - Career Launch 2025" />
    
    <!-- Hero Section -->
    <section class="py-16 lg:py-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <div class="inline-flex items-center px-4 py-2 bg-orange-100 rounded-full text-orange-700 text-sm font-medium mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
            Mijn Favorieten
          </div>
          <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
            Jouw
            <span class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">
              favoriete bedrijven
            </span>
          </h1>
          <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
            Houd je interessante bedrijven bij en vind snel terug wat je zoekt voor je toekomstige carrière.
          </p>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
      
      <!-- Statistics Bar -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
          <div class="text-center">
            <div class="text-2xl font-bold text-gray-900">{{ favorites.length }}</div>
            <div class="text-sm text-gray-500">Favorieten</div>
          </div>
          <div class="text-center">
            <div class="text-2xl font-bold text-gray-900">{{ uniqueIndustries.length }}</div>
            <div class="text-sm text-gray-500">Industrieën</div>
          </div>
          <div class="text-center">
            <div class="text-2xl font-bold text-gray-900">{{ totalEmployees }}</div>
            <div class="text-sm text-gray-500">Totaal werknemers</div>
          </div>
          <div class="text-center">
            <div class="text-2xl font-bold text-gray-900">{{ uniqueLocations.length }}</div>
            <div class="text-sm text-gray-500">Locaties</div>
          </div>
        </div>
      </div>

      <!-- Filter & Search Bar -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8" v-if="favorites.length > 0">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="flex-1">
            <div class="relative">
              <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
              <input 
                v-model="searchQuery"
                type="text" 
                placeholder="Zoek in favorieten..." 
                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent"
              >
            </div>
          </div>
          <div class="flex gap-2">
            <select v-model="selectedIndustry" class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent">
              <option value="">Alle industrieën</option>
              <option v-for="industry in uniqueIndustries" :key="industry" :value="industry">{{ industry }}</option>
            </select>
            <button @click="clearFilters" class="px-4 py-3 text-gray-500 hover:text-gray-700 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Favorites Grid -->
      <div v-if="filteredFavorites.length > 0">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div 
            v-for="company in filteredFavorites" 
            :key="company.id"
            class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 overflow-hidden"
          >
            <!-- Company Card Header -->
            <div class="relative p-6 bg-gradient-to-br from-gray-50 to-white">
              <!-- Favorite Button -->
              <button
                @click="removeFromFavorites(company.id)"
                class="absolute top-4 right-4 w-12 h-12 rounded-xl flex items-center justify-center transition-all duration-300 bg-red-100 text-red-600 hover:bg-red-200"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
              </button>

              <!-- Company Logo -->
              <div class="flex justify-center mb-4">
                <div class="w-20 h-20 bg-white rounded-2xl shadow-md flex items-center justify-center hover:shadow-lg transition-shadow cursor-pointer" @click="openModal(company)">
                  <img
                    :src="company.src"
                    :alt="company.name"
                    class="max-w-16 max-h-16 object-contain"
                  />
                </div>
              </div>

              <!-- Company Name -->
              <h3 class="text-xl font-bold text-gray-900 text-center mb-2 group-hover:text-orange-600 transition-colors cursor-pointer" @click="openModal(company)">
                {{ company.name }}
              </h3>

              <!-- Industry Tag -->
              <div class="flex justify-center mb-3">
                <span class="px-3 py-1 bg-orange-100 text-orange-600 text-sm font-medium rounded-full">
                  {{ company.industry }}
                </span>
              </div>
            </div>

            <!-- Company Info -->
            <div class="p-6 pt-0">
              <!-- Specialization -->
              <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                {{ company.specialisatie }}
              </p>

              <!-- Company Details -->
              <div class="space-y-2 mb-4">
                <div class="flex items-center text-sm text-gray-500">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  {{ company.location }}
                </div>
                <div class="flex items-center text-sm text-gray-500">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                  </svg>
                  {{ company.employees }} medewerkers
                </div>
              </div>

              <!-- Tags -->
              <div class="flex flex-wrap gap-1 mb-4">
                <span
                  v-for="tag in company.tags.slice(0, 3)"
                  :key="tag"
                  class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full"
                >
                  {{ tag }}
                </span>
              </div>

              <!-- Action Buttons -->
              <div class="flex gap-2">
                <button
                  @click="openModal(company)"
                  class="flex-1 bg-orange-500 text-white py-2 px-4 rounded-xl text-sm font-medium hover:bg-orange-600 transition-colors"
                >
                  Bekijk details
                </button>
                <a
                  :href="company.website"
                  target="_blank"
                  class="px-4 py-2 border border-gray-300 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-50 transition-colors"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else-if="favorites.length === 0" class="text-center py-16">
        <div class="w-24 h-24 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
          <svg class="w-12 h-12 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
          </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Nog geen favorieten</h3>
        <p class="text-gray-600 mb-8 max-w-md mx-auto">
          Je hebt nog geen bedrijven toegevoegd aan je favorieten. Ontdek interessante bedrijven en voeg ze toe!
        </p>
        <Link
          href="/bedrijven"
          class="inline-flex items-center bg-orange-500 text-white px-6 py-3 rounded-xl font-medium hover:bg-orange-600 transition-colors"
        >
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
          </svg>
          Ontdek bedrijven
        </Link>
      </div>

      <!-- No Results State -->
      <div v-else class="text-center py-16">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
          <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Geen resultaten gevonden</h3>
        <p class="text-gray-600 mb-8 max-w-md mx-auto">
          Probeer andere zoektermen of filters om je favorieten te vinden.
        </p>
        <button
          @click="clearFilters"
          class="inline-flex items-center bg-orange-500 text-white px-6 py-3 rounded-xl font-medium hover:bg-orange-600 transition-colors"
        >
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
          </svg>
          Filters wissen
        </button>
      </div>
    </main>
  </AppLayout>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref, computed, onMounted } from 'vue';

const mobileMenuOpen = ref(false);
const searchQuery = ref('');
const selectedIndustry = ref('');
const showFilters = ref(false);

// Sample favorites data - in a real app this would come from props or API
const favorites = ref([
  {
    id: 1,
    name: 'Accenture',
    src: '/images/logos/accenture-logo.svg',
    industry: 'Consulting',
    location: 'Brussel',
    employees: '500+',
    specialisatie: 'Consulting, digitale transformatie, technologie en outsourcing',
    tags: ['AI', 'Cloud', 'Digital Transformation', 'Strategy']
  },
  {
    id: 2,
    name: 'Acolad',
    src: '/images/logos/acolad-LOGO.png',
    industry: 'Translation & Localization',
    location: 'Brussel',
    employees: '100-250',
    specialisatie: 'Vertalingen, lokalisatie, content en multimedia‑diensten',
    tags: ['Translation', 'AI', 'Content', 'Multimedia']
  },
  {
    id: 3,
    name: 'Amista',
    src: '/images/logos/amista.png',
    industry: 'SAP & ERP',
    location: 'Lier',
    employees: '250',
    specialisatie: 'SAP ERP, integratie & technologie, intelligente documentflows, digital learning',
    tags: ['SAP', 'ERP', 'Digital Learning', 'Integration']
  }
]);

// Computed properties
const uniqueIndustries = computed(() => {
  return [...new Set(favorites.value.map(fav => fav.industry))];
});

const uniqueLocations = computed(() => {
  return [...new Set(favorites.value.map(fav => fav.location))];
});

const totalEmployees = computed(() => {
  return favorites.value.reduce((total, fav) => {
    const employees = parseInt(fav.employees.replace(/\D/g, '')) || 0;
    return total + employees;
  }, 0);
});

const filteredFavorites = computed(() => {
  let filtered = favorites.value;
  
  if (searchQuery.value) {
    filtered = filtered.filter(fav => 
      fav.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      fav.specialisatie.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      fav.tags.some(tag => tag.toLowerCase().includes(searchQuery.value.toLowerCase()))
    );
  }
  
  if (selectedIndustry.value) {
    filtered = filtered.filter(fav => fav.industry === selectedIndustry.value);
  }
  
  return filtered;
});

// Methods
const removeFromFavorites = (companyId: number) => {
  favorites.value = favorites.value.filter(fav => fav.id !== companyId);
  if (window.showGlobalToast) {
    window.showGlobalToast('Bedrijf verwijderd uit favorieten', 'success');
  }
};

const clearFilters = () => {
  searchQuery.value = '';
  selectedIndustry.value = '';
};

const openModal = (company: any) => {
  // In a real app, this would open a modal with company details
  console.log('Opening modal for:', company.name);
};
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  line-clamp: 2;
}
</style>