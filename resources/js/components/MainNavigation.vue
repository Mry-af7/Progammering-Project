<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const mobileMenuOpen = ref(false);

// Props voor de actieve pagina en aantal favorieten
defineProps<{
  activePage?: string;
  favoritenCount?: number;
}>();
</script>

<template>
  <nav class="bg-white/80 backdrop-blur-lg shadow-lg sticky top-0 z-40 border-b border-orange-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <Link href="/" class="flex items-center space-x-3 group">
          <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-700 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
            <span class="text-white font-bold text-lg">E</span>
          </div>
          <div>
            <div class="text-gray-900 font-bold text-xl">erasmus</div>
            <div class="text-xs text-gray-600 -mt-1">HOGESCHOOL BRUSSEL</div>
          </div>
        </Link>

        <!-- Mobile menu button -->
        <div class="md:hidden">
          <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-gray-700 hover:bg-orange-100 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center space-x-1">
          <Link href="/" :class="['px-4 py-2 font-medium transition-colors rounded-lg hover:bg-orange-50', activePage === 'home' ? 'text-orange-600 bg-orange-100' : 'text-gray-700 hover:text-orange-600']">Home</Link>
          <Link href="/info" :class="['px-4 py-2 font-medium transition-colors rounded-lg hover:bg-orange-50', activePage === 'info' ? 'text-orange-600 bg-orange-100' : 'text-gray-700 hover:text-orange-600']">Info</Link>
          <Link href="/bedrijven" :class="['px-4 py-2 font-medium transition-colors rounded-lg hover:bg-orange-50', activePage === 'bedrijven' ? 'text-orange-600 bg-orange-100' : 'text-gray-700 hover:text-orange-600']">Bedrijven</Link>
          <Link href="/favorieten" :class="['px-4 py-2 font-medium transition-colors rounded-lg hover:bg-orange-50 relative', activePage === 'favorieten' ? 'text-orange-600 bg-orange-100' : 'text-gray-700 hover:text-orange-600']">
            Favorieten
            <span v-if="favoritenCount && favoritenCount > 0" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
              {{ favoritenCount }}
            </span>
          </Link>
          <Link href="/contact" :class="['px-4 py-2 font-medium transition-colors rounded-lg hover:bg-orange-50', activePage === 'contact' ? 'text-orange-600 bg-orange-100' : 'text-gray-700 hover:text-orange-600']">Contact</Link>
          <div class="flex items-center ml-6">
            <Link href="/login" class="px-6 py-2 text-orange-600 hover:text-orange-700 font-medium transition-colors">Inloggen</Link>
          </div>
        </div>
      </div>

      <!-- Mobile menu -->
      <div v-show="mobileMenuOpen" class="md:hidden mt-4 pb-4 border-t border-orange-200">
        <div class="flex flex-col space-y-2 pt-4">
          <Link href="/" :class="['px-4 py-2 font-medium rounded-lg', activePage === 'home' ? 'text-orange-600 bg-orange-100' : 'text-gray-700 hover:text-orange-600']">Home</Link>
          <Link href="/info" :class="['px-4 py-2 font-medium rounded-lg', activePage === 'info' ? 'text-orange-600 bg-orange-100' : 'text-gray-700 hover:text-orange-600']">Info</Link>
          <Link href="/bedrijven" :class="['px-4 py-2 font-medium rounded-lg', activePage === 'bedrijven' ? 'text-orange-600 bg-orange-100' : 'text-gray-700 hover:text-orange-600']">Bedrijven</Link>
          <Link href="/favorieten" :class="['px-4 py-2 font-medium rounded-lg', activePage === 'favorieten' ? 'text-orange-600 bg-orange-100' : 'text-gray-700 hover:text-orange-600']">Favorieten</Link>
          <Link href="/contact" :class="['px-4 py-2 font-medium rounded-lg', activePage === 'contact' ? 'text-orange-600 bg-orange-100' : 'text-gray-700 hover:text-orange-600']">Contact</Link>
          <Link href="/login" class="px-4 py-2 text-orange-600 hover:text-orange-700 font-medium rounded-lg">Inloggen</Link>
        </div>
      </div>
    </div>
  </nav>
</template> 