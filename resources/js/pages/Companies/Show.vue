<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="flex justify-between items-start mb-6">
            <div>
              <h1 class="text-3xl font-semibold mb-2">{{ company.name }}</h1>
              <div class="flex items-center text-gray-600">
                <MapPinIcon class="w-5 h-5 mr-2" />
                <span>{{ company.city }}</span>
              </div>
            </div>
            
            <button 
              @click="toggleFavorite"
              class="p-2 rounded-full bg-white shadow-md hover:bg-gray-100"
            >
              <HeartIcon 
                :class="company.favorites.length ? 'text-red-500' : 'text-gray-400'"
                class="w-6 h-6"
              />
            </button>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
              <div class="prose max-w-none">
                <h2 class="text-xl font-semibold mb-4">About</h2>
                <p class="text-gray-600">{{ company.description }}</p>
              </div>
              
              <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Contact Information</h2>
                <div class="space-y-4">
                  <div class="flex items-center">
                    <EnvelopeIcon class="w-5 h-5 text-gray-400 mr-3" />
                    <a :href="`mailto:${company.email}`" class="text-blue-600 hover:underline">
                      {{ company.email }}
                    </a>
                  </div>
                  
                  <div class="flex items-center" v-if="company.phone">
                    <PhoneIcon class="w-5 h-5 text-gray-400 mr-3" />
                    <a :href="`tel:${company.phone}`" class="text-blue-600 hover:underline">
                      {{ company.phone }}
                    </a>
                  </div>
                  
                  <div class="flex items-center" v-if="company.website">
                    <GlobeAltIcon class="w-5 h-5 text-gray-400 mr-3" />
                    <a :href="company.website" target="_blank" class="text-blue-600 hover:underline">
                      {{ company.website }}
                    </a>
                  </div>
                  
                  <div class="flex items-start">
                    <HomeIcon class="w-5 h-5 text-gray-400 mr-3 mt-1" />
                    <div>
                      <p>{{ company.address }}</p>
                      <p>{{ company.postal_code }} {{ company.city }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="md:col-span-1">
              <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Schedule a Meeting</h2>
                <p class="text-gray-600 mb-4">
                  Book a meeting with {{ company.name }} to discuss opportunities.
                </p>
                
                <Link 
                  :href="route('appointments.create', company.id)"
                  class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                >
                  <CalendarIcon class="w-5 h-5 mr-2" />
                  Book Appointment
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { 
  HeartIcon, 
  MapPinIcon, 
  EnvelopeIcon, 
  PhoneIcon, 
  GlobeAltIcon, 
  HomeIcon,
  CalendarIcon 
} from '@heroicons/vue/24/outline';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  company: Object
});

const toggleFavorite = async () => {
  try {
    const response = await axios.post(route('favorites.toggle', props.company.id));
    router.reload({ only: ['company'] });
  } catch (error) {
    console.error('Error toggling favorite:', error);
  }
};
</script> 