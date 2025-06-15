<template>
  <div class="favorites-page">
    <Navigation />

    <!-- Header Navigation (bovenaan, volle breedte) -->
    <header class="header w-full bg-white shadow mb-8">
      <div class="header-container max-w-6xl mx-auto flex items-center justify-between py-4 px-6">
        <div class="logo-section flex items-center">
          <img src="/images/erasmus-logo.png" alt="Erasmus" class="logo h-10 mr-4" />
          <span class="font-bold text-lg text-gray-700">Mijn favorieten</span>
        </div>
        <nav class="nav-tabs flex space-x-4">
          <button v-for="item in navItems" :key="item.key"
                  :class="['nav-tab px-4 py-2 rounded', { 'bg-orange-100 text-orange-600': item.key === 'fav', 'text-gray-600 hover:bg-orange-50': item.key !== 'fav' }]"
                  @click="navigate(item.key)">
            {{ item.label }}
          </button>
        </nav>
        <div class="header-actions flex items-center">
          <div class="search-container relative">
            <input type="search"
                   placeholder="Search"
                   v-model="searchTerm"
                   class="search-input border rounded px-3 py-1 pl-8" />
            <span class="search-icon absolute left-2 top-1.5 text-gray-400">🔍</span>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content (gecentreerd) -->
    <main class="main-content bg-gray-50 min-h-screen">
      <div class="content-container max-w-4xl mx-auto py-12 px-4">
        <h1 class="text-4xl font-bold mb-2 text-orange-600">Mijn Favorieten</h1>
        <div class="text-gray-500 mb-8">Je hebt nog geen favorieten toegevoegd.</div>

        <!-- Filter Section -->
        <div class="filter-section mb-6">
          <div class="flex items-center justify-between">
            <div class="filter-tabs flex space-x-4">
              <button v-for="filter in filterOptions" :key="filter.value"
                      :class="['filter-btn px-4 py-2 rounded-lg transition-colors', 
                              activeFilter === filter.value ? 'bg-orange-100 text-orange-600' : 'text-gray-600 hover:bg-orange-50']"
                      @click="activeFilter = filter.value">
                <span class="filter-icon mr-2">{{ filter.icon }}</span>
                {{ filter.label }}
              </button>
            </div>
            <div class="results-count text-sm text-gray-500">
              {{ filteredFavorites.length }} {{ filteredFavorites.length === 1 ? 'resultaat' : 'resultaten' }}
            </div>
          </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
          <!-- Empty State -->
          <div v-if="filteredFavorites.length === 0" class="empty-state text-center py-12">
            <div class="empty-illustration">
              <div class="empty-icon text-6xl mb-4">💝</div>
              <h2 class="empty-title text-2xl font-semibold text-gray-900 mb-2">Nog geen favorieten</h2>
              <p class="empty-description text-gray-600" v-if="!searchTerm">
                Voeg favorieten toe door op het hartje te klikken bij profielen die je interessant vindt.
              </p>
              <p class="empty-description text-gray-600" v-else>
                Geen resultaten gevonden voor "{{ searchTerm }}"
              </p>
            </div>
          </div>

          <!-- Favorites Grid -->
          <div v-else class="favorites-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="favorite in filteredFavorites" :key="favorite.id" 
                 class="favorite-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
              <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                  <div class="avatar-container w-16 h-16 rounded-lg overflow-hidden bg-gray-100">
                    <img :src="favorite.image_url || getDefaultAvatar(favorite.item_type)" 
                         :alt="favorite.title" 
                         class="w-full h-full object-cover"
                         @error="handleImageError" />
                  </div>
                  <button @click="removeFavorite(favorite.id)" 
                          class="favorite-toggle text-red-500 hover:text-red-600 transition-colors"
                          title="Verwijder uit favorieten">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                  </button>
                </div>
                <div class="card-body">
                  <h3 class="card-title text-xl font-semibold text-gray-900 mb-2">{{ favorite.title }}</h3>
                  <div class="card-meta flex justify-between items-center mb-3">
                    <span class="type-badge px-3 py-1 rounded-full text-sm"
                          :class="getTypeClass(favorite.item_type)">
                      {{ getTypeLabel(favorite.item_type) }}
                    </span>
                    <span class="date-added text-sm text-gray-500">{{ formatDate(favorite.created_at) }}</span>
                  </div>
                  <p v-if="favorite.description" class="card-description text-gray-600 mb-4">
                    {{ truncateText(favorite.description, 120) }}
                  </p>
                  <div class="card-actions flex space-x-3">
                    <button class="btn-primary bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors"
                            @click="viewProfile(favorite)">
                      Bekijk profiel
                    </button>
                    <button class="btn-secondary border border-orange-500 text-orange-500 px-4 py-2 rounded-lg hover:bg-orange-50 transition-colors"
                            @click="sendMessage(favorite)">
                      Bericht
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import Navigation from '@/components/Navigation.vue'
import { usePage } from '@inertiajs/vue3'

const favorites = computed(() => usePage().props.favorites || [])

const props = defineProps({ 
  favorites: {
    type: Array,
    default: () => []
  }
})

const searchTerm = ref('')
const activeFilter = ref('all')

const filterOptions = [
  { value: 'all', label: 'Alle', icon: '📋' },
  { value: 'bedrijf', label: 'Bedrijven', icon: '🏢' },
  { value: 'student', label: 'Studenten', icon: '👥' },
  { value: 'profiel', label: 'Profielen', icon: '👤' }
]

const filteredFavorites = computed(() => {
  let filtered = props.favorites || []
  
  // Apply search filter
  if (searchTerm.value) {
    const search = searchTerm.value.toLowerCase().trim()
    filtered = filtered.filter(f => 
      f.title.toLowerCase().includes(search) || 
      (f.description && f.description.toLowerCase().includes(search))
    )
  }
  
  // Apply type filter
  if (activeFilter.value !== 'all') {
    filtered = filtered.filter(f => f.item_type === activeFilter.value)
  }
  
  return filtered.sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
})

function getTypeLabel(type) {
  const labels = {
    bedrijf: 'Bedrijf',
    student: 'Student',
    profiel: 'Profiel'
  }
  return labels[type] || type
}

function getTypeClass(type) {
  const classes = {
    bedrijf: 'bg-blue-100 text-blue-800',
    student: 'bg-green-100 text-green-800',
    profiel: 'bg-purple-100 text-purple-800'
  }
  return classes[type] || 'bg-gray-100 text-gray-800'
}

function formatDate(date) {
  return new Date(date).toLocaleDateString('nl-BE', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
}

function truncateText(text, length) {
  if (text.length <= length) return text
  return text.substring(0, length) + '...'
}

function getDefaultAvatar(type) {
  const avatars = {
    student: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMjAiIGZpbGw9IiM2NzY2ZWEiLz4KPGF4dCB4PSIyMCIgeT0iMTQiIGZpbGw9IndoaXRlIiBmb250LXNpemU9IjE2Ij7wn5GljwvdGV4dD4KPC9zdmc+',
    bedrijf: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMjAiIGZpbGw9IiNkYzVhNDEiLz4KPGF4dCB4PSIyMCIgeT0iMTQiIGZpbGw9IndoaXRlIiBmb250LXNpemU9IjE2Ij7wn5OfywvdGV4dD4KPC9zdmc+',
    profiel: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMjAiIGZpbGw9IiMxMGI5ODEiLz4KPGF4dCB4PSIyMCIgeT0iMTQiIGZpbGw9IndoaXRlIiBmb250LXNpemU9IjE2Ij7wn5SLIX0vdGV4dD4KPC9zdmc+'
  }
  return avatars[type] || avatars.profiel
}

function handleImageError(event) {
  event.target.src = getDefaultAvatar('profiel')
}

async function removeFavorite(id) {
  if (confirm('Weet je zeker dat je dit favoriet wilt verwijderen?')) {
    try {
      await router.delete(`/favorites/${id}`, {
        preserveState: true,
        preserveScroll: true
      })
    } catch (error) {
      console.error('Error removing favorite:', error)
    }
  }
}

function viewProfile(favorite) {
  const routes = {
    bedrijf: `/bedrijven/${favorite.item_id}`,
    student: `/studenten/${favorite.item_id}`,
    profiel: `/profielen/${favorite.item_id}`
  }
  router.visit(routes[favorite.item_type] || '/')
}

function sendMessage(favorite) {
  router.visit(`/berichten/nieuw?to=${favorite.item_id}&type=${favorite.item_type}`)
}
</script>

<style scoped>
.favorites-page {
  min-height: 100vh;
  background-color: #f8fafc;
}
</style>