
<template>
  <div class="favorites-page">
    <!-- Header Navigation -->
    <header class="header">
      <div class="header-container">
        <div class="logo-section">
          <img src="/images/erasmus-logo.png" alt="Erasmus" class="logo" />
        </div>
        
        <nav class="nav-tabs">
          <button v-for="item in navItems" :key="item.key" 
                  :class="['nav-tab', { active: item.key === 'fav' }]" 
                  @click="navigate(item.key)">
            {{ item.label }}
          </button>
        </nav>

        <div class="header-actions">
          <div class="search-container">
            <input type="search" 
                   placeholder="Search" 
                   v-model="searchTerm" 
                   class="search-input" />
            <span class="search-icon">🔍</span>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
      <div class="content-container">
        <!-- Page Header -->
        <div class="page-header">
          <h1 class="page-title">Mijn favorieten</h1>
          <div class="title-underline"></div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
          <div class="filter-tabs">
            <button v-for="filter in filterOptions" :key="filter.value"
                    :class="['filter-btn', { active: activeFilter === filter.value }]"
                    @click="activeFilter = filter.value">
              <span class="filter-icon">{{ filter.icon }}</span>
              {{ filter.label }}
            </button>
          </div>
          <div class="results-count">
            {{ filteredFavorites.length }} {{ filteredFavorites.length === 1 ? 'resultaat' : 'resultaten' }}
          </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
          <!-- Empty State -->
          <div v-if="filteredFavorites.length === 0" class="empty-state">
            <div class="empty-illustration">
              <div class="empty-icon">💝</div>
              <h2 class="empty-title">Nog geen favorieten</h2>
              <p class="empty-description" v-if="!searchTerm">
                Voeg favorieten toe door op het hartje te klikken bij profielen die je interessant vindt.
              </p>
              <p class="empty-description" v-else>
                Geen resultaten gevonden voor "{{ searchTerm }}"
              </p>
            </div>
          </div>

          <!-- Favorites Grid -->
          <div v-else class="favorites-grid">
            <div v-for="favorite in filteredFavorites" :key="favorite.id" 
                 class="favorite-card">
              <div class="card-header">
                <div class="avatar-container">
                  <img :src="favorite.image_url || '/images/default-avatar.png'" 
                       :alt="favorite.title" 
                       @error="$event.target.src='/images/default-avatar.png'"
                       class="avatar" />
                </div>
                <button @click="removeFavorite(favorite.id)" 
                        class="favorite-toggle active" 
                        title="Verwijder uit favorieten">
                  ❤️
                </button>
              </div>
              
              <div class="card-body">
                <h3 class="card-title">{{ favorite.title }}</h3>
                <div class="card-meta">
                  <span class="type-badge" :class="`type-${favorite.item_type}`">
                    {{ getTypeLabel(favorite.item_type) }}
                  </span>
                  <span class="date-added">{{ formatDate(favorite.created_at) }}</span>
                </div>
                
                <p v-if="favorite.description" class="card-description">
                  {{ truncateText(favorite.description, 120) }}
                </p>

                <div class="card-actions">
                  <button class="btn-primary" @click="viewProfile(favorite)">
                    Bekijk profiel
                  </button>
                  <button class="btn-secondary" @click="sendMessage(favorite)">
                    Bericht
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Toast Notifications -->
    <transition name="toast">
      <div v-if="toast.show" :class="['toast', `toast-${toast.type}`]">
        <div class="toast-content">
          <span class="toast-icon">{{ getToastIcon(toast.type) }}</span>
          <span class="toast-message">{{ toast.message }}</span>
        </div>
        <button @click="toast.show = false" class="toast-close">×</button>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({ 
  favorites: {
    type: Array,
    default: () => []
  }
})

const searchTerm = ref('')
const activeFilter = ref('all')
const toast = ref({ show: false, message: '', type: 'info' })

const navItems = [
  { key: 'home', label: 'Home' },
  { key: 'info', label: 'Info' },
  { key: 'fav', label: 'Favorieten' },
  { key: 'contact', label: 'Contact' }
]

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

function navigate(page) {
  const routes = { 
    home: '/', 
    info: '/info', 
    fav: '/favorieten', 
    contact: '/contact' 
  }
  router.visit(routes[page])
}

function removeFavorite(id) {
  if (confirm('Weet je zeker dat je dit favoriet wilt verwijderen?')) {
    router.delete(`/favorites/${id}`, {
      onSuccess: () => showToast('Favoriet succesvol verwijderd', 'success'),
      onError: () => showToast('Er is een fout opgetreden', 'error')
    })
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

function getTypeLabel(type) {
  const labels = { 
    bedrijf: 'Bedrijf', 
    student: 'Student', 
    profiel: 'Profiel' 
  }
  return labels[type] || type
}

function formatDate(dateString) {
  const date = new Date(dateString)
  const now = new Date()
  const diffDays = Math.ceil((now - date) / (1000 * 60 * 60 * 24))
  
  if (diffDays === 0) return 'Vandaag'
  if (diffDays === 1) return 'Gisteren'
  if (diffDays < 7) return `${diffDays} dagen geleden`
  if (diffDays < 30) return `${Math.ceil(diffDays / 7)} weken geleden`
  
  return date.toLocaleDateString('nl-NL', { 
    day: 'numeric', 
    month: 'short',
    year: date.getFullYear() !== now.getFullYear() ? 'numeric' : undefined
  })
}

function truncateText(text, maxLength) {
  if (text.length <= maxLength) return text
  return text.substring(0, maxLength).trim() + '...'
}

function showToast(message, type = 'info') {
  toast.value = { show: true, message, type }
  setTimeout(() => toast.value.show = false, 4000)
}

function getToastIcon(type) {
  const icons = {
    success: '✅',
    error: '❌',
    warning: '⚠️',
    info: 'ℹ️'
  }
  return icons[type] || icons.info
}
</script>

<style scoped>
* {
  box-sizing: border-box;
}

.favorites-page {
  min-height: 100vh;
  background: #f8fafc;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* Header Styles */
.header {
  background: white;
  border-bottom: 1px solid #e2e8f0;
  position: sticky;
  top: 0;
  z-index: 100;
}

.header-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 24px;
  display: flex;
  align-items: center;
  height: 64px;
}

.logo-section {
  margin-right: 48px;
}

.logo {
  height: 32px;
  width: auto;
}

.nav-tabs {
  display: flex;
  gap: 8px;
  flex: 1;
}

.nav-tab {
  padding: 8px 16px;
  border: none;
  background: transparent;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 500;
  color: #64748b;
  transition: all 0.2s ease;
}

.nav-tab:hover {
  background: #f1f5f9;
  color: #334155;
}

.nav-tab.active {
  background: #dc5a41;
  color: white;
}

.header-actions {
  display: flex;
  align-items: center;
}

.search-container {
  position: relative;
}

.search-input {
  width: 240px;
  padding: 8px 12px 8px 36px;
  border: 1px solid #d1d5db;
  border-radius: 6px;
  font-size: 14px;
  background: #f9fafb;
  transition: all 0.2s ease;
}

.search-input:focus {
  outline: none;
  border-color: #dc5a41;
  background: white;
  box-shadow: 0 0 0 3px rgba(220, 90, 65, 0.1);
}

.search-icon {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: #9ca3af;
  font-size: 14px;
}

/* Main Content */
.main-content {
  flex: 1;
}

.content-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 32px 24px;
}

.page-header {
  margin-bottom: 32px;
}

.page-title {
  font-size: 28px;
  font-weight: 700;
  color: #1e293b;
  margin: 0;
}

.title-underline {
  width: 60px;
  height: 3px;
  background: #dc5a41;
  margin-top: 8px;
  border-radius: 2px;
}

/* Filter Section */
.filter-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}

.filter-tabs {
  display: flex;
  gap: 4px;
  background: #f1f5f9;
  padding: 4px;
  border-radius: 8px;
}

.filter-btn {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 8px 16px;
  border: none;
  background: transparent;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 500;
  color: #64748b;
  transition: all 0.2s ease;
  font-size: 14px;
}

.filter-btn:hover {
  color: #334155;
}

.filter-btn.active {
  background: white;
  color: #dc5a41;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.filter-icon {
  font-size: 16px;
}

.results-count {
  font-size: 14px;
  color: #64748b;
  font-weight: 500;
}

/* Content Area */
.content-area {
  min-height: 400px;
}

/* Empty State */
.empty-state {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 64px 24px;
}

.empty-illustration {
  text-align: center;
  max-width: 400px;
}

.empty-icon {
  font-size: 64px;
  margin-bottom: 16px;
}

.empty-title {
  font-size: 24px;
  font-weight: 600;
  color: #374151;
  margin: 0 0 8px 0;
}

.empty-description {
  color: #6b7280;
  font-size: 16px;
  line-height: 1.5;
  margin: 0;
}

/* Favorites Grid */
.favorites-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
  gap: 20px;
}

.favorite-card {
  background: white;
  border-radius: 12px;
  border: 1px solid #e5e7eb;
  overflow: hidden;
  transition: all 0.3s ease;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.favorite-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.card-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 20px 20px 0 20px;
}

.avatar-container {
  width: 60px;
  height: 60px;
  border-radius: 12px;
  overflow: hidden;
  background: #f3f4f6;
}

.avatar {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.favorite-toggle {
  background: #fef2f2;
  border: none;
  border-radius: 8px;
  width: 36px;
  height: 36px;
  cursor: pointer;
  font-size: 16px;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.favorite-toggle:hover {
  background: #fee2e2;
  transform: scale(1.1);
}

.favorite-toggle.active {
  background: #dc5a41;
  color: white;
}

.card-body {
  padding: 16px 20px 20px 20px;
}

.card-title {
  font-size: 18px;
  font-weight: 600;
  color: #111827;
  margin: 0 0 8px 0;
  line-height: 1.3;
}

.card-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}

.type-badge {
  padding: 4px 8px;
  border-radius: 6px;
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.type-bedrijf {
  background: #dbeafe;
  color: #1e40af;
}

.type-student {
  background: #d1fae5;
  color: #065f46;
}

.type-profiel {
  background: #fde68a;
  color: #92400e;
}

.date-added {
  font-size: 12px;
  color: #9ca3af;
}

.card-description {
  color: #6b7280;
  font-size: 14px;
  line-height: 1.5;
  margin: 0 0 16px 0;
}

.card-actions {
  display: flex;
  gap: 8px;
}

.btn-primary, .btn-secondary {
  flex: 1;
  padding: 8px 16px;
  border-radius: 6px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;
  border: 1px solid;
}

.btn-primary {
  background: #dc5a41;
  color: white;
  border-color: #dc5a41;
}

.btn-primary:hover {
  background: #b91c1c;
  border-color: #b91c1c;
}

.btn-secondary {
  background: white;
  color: #374151;
  border-color: #d1d5db;
}

.btn-secondary:hover {
  background: #f9fafb;
  border-color: #9ca3af;
}

/* Toast Notifications */
.toast {
  position: fixed;
  top: 20px;
  right: 20px;
  background: white;
  border-radius: 8px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
  display: flex;
  align-items: center;
  padding: 16px;
  max-width: 400px;
  z-index: 1000;
  border-left: 4px solid;
}

.toast-success {
  border-left-color: #10b981;
}

.toast-error {
  border-left-color: #ef4444;
}

.toast-warning {
  border-left-color: #f59e0b;
}

.toast-info {
  border-left-color: #3b82f6;
}

.toast-content {
  display: flex;
  align-items: center;
  gap: 8px;
  flex: 1;
}

.toast-icon {
  font-size: 16px;
}

.toast-message {
  font-size: 14px;
  color: #374151;
}

.toast-close {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 18px;
  color: #9ca3af;
  padding: 0;
  margin-left: 12px;
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.toast-close:hover {
  color: #374151;
}

/* Toast Animations */
.toast-enter-active, .toast-leave-active {
  transition: all 0.3s ease;
}

.toast-enter-from {
  opacity: 0;
  transform: translateX(100%);
}

.toast-leave-to {
  opacity: 0;
  transform: translateX(100%);
}

/* Responsive Design */
@media (max-width: 768px) {
  .header-container {
    flex-wrap: wrap;
    height: auto;
    padding: 16px;
    gap: 16px;
  }
  
  .nav-tabs {
    order: 3;
    width: 100%;
    justify-content: center;
  }
  
  .search-input {
    width: 200px;
  }
  
  .content-container {
    padding: 20px 16px;
  }
  
  .filter-section {
    flex-direction: column;
    gap: 16px;
    align-items: stretch;
  }
  
  .filter-tabs {
    justify-content: center;
  }
  
  .results-count {
    text-align: center;
  }
  
  .favorites-grid {
    grid-template-columns: 1fr;
  }
  
  .toast {
    left: 16px;
    right: 16px;
    max-width: none;
  }
}

@media (max-width: 480px) {
  .page-title {
    font-size: 24px;
  }
  
  .filter-tabs {
    flex-wrap: wrap;
  }
  
  .card-actions {
    flex-direction: column;
  }
}
</style>