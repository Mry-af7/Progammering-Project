<template>
  <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
      <h1 class="text-3xl font-bold text-gray-900 mb-6">Ontdek Bedrijven</h1>
          
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="company in companies.data" :key="company.id" 
             class="bg-white shadow rounded-lg overflow-hidden">
          <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-2">
              {{ company.name }}
            </h2>
            <p class="text-gray-600 mb-4 line-clamp-3">
              {{ company.description }}
            </p>
            <div class="flex justify-between items-center">
              <Link :href="route('companies.show', company.id)"
                    class="text-indigo-600 hover:text-indigo-900">
                Bekijk bedrijf
              </Link>
              <button v-if="$page.props.auth.user"
                  @click="toggleFavorite(company)"
                      class="text-gray-400 hover:text-red-500"
                      :class="{ 'text-red-500': isFavorited(company) }">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                </button>
            </div>
          </div>
        </div>
      </div>

      <Pagination :links="companies.links" class="mt-6" />
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import Pagination from '@/components/Pagination.vue';

const props = defineProps({
  companies: {
    type: Object,
    required: true
  }
});

const isFavorited = (company) => {
  return company.favorites?.some(favorite => favorite.user_id === $page.props.auth.user?.id);
};

const toggleFavorite = (company) => {
  if (isFavorited(company)) {
    router.delete(route('favorites.destroy', company.id));
  } else {
    router.post(route('favorites.store', company.id));
  }
};
</script> 