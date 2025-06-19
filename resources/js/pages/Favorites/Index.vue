<template>
  <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
      <h1 class="text-3xl font-bold text-gray-900 mb-6">Mijn Favorieten</h1>

      <div v-if="favorites.length === 0" class="text-center py-8">
        <p class="text-gray-500">Je hebt nog geen favoriete bedrijven.</p>
        <Link :href="route('companies.index')" 
              class="mt-4 inline-block text-indigo-600 hover:text-indigo-900">
          Ontdek bedrijven
        </Link>
          </div>
          
      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="favorite in favorites" :key="favorite.id" 
             class="bg-white shadow rounded-lg overflow-hidden">
          <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-2">
              {{ favorite.company.name }}
            </h2>
            <p class="text-gray-600 mb-4 line-clamp-3">
              {{ favorite.company.description }}
            </p>
            <div class="flex justify-between items-center">
              <Link :href="route('companies.show', favorite.company.id)"
                    class="text-indigo-600 hover:text-indigo-900">
                Bekijk bedrijf
              </Link>
              <button @click="removeFavorite(favorite.company)"
                      class="text-red-600 hover:text-red-900">
                Verwijder
                </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  favorites: {
    type: Array,
    required: true
  }
});

const removeFavorite = (company) => {
  if (confirm('Weet je zeker dat je dit bedrijf uit je favorieten wilt verwijderen?')) {
    router.delete(route('favorites.destroy', company.id));
  }
};
</script> 