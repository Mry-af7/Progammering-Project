<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">My Appointments</h1>
          </div>
          
          <div class="space-y-6">
            <div v-for="appointment in appointments.data" :key="appointment.id" 
              class="bg-white border rounded-lg p-6 shadow-sm">
              <div class="flex justify-between items-start">
                <div>
                  <h2 class="text-xl font-semibold mb-2">{{ appointment.company.name }}</h2>
                  <div class="flex items-center text-gray-600 mb-4">
                    <CalendarIcon class="w-5 h-5 mr-2" />
                    <span>{{ formatDate(appointment.start_time) }}</span>
                    <span class="mx-2">•</span>
                    <ClockIcon class="w-5 h-5 mr-2" />
                    <span>{{ formatTime(appointment.start_time) }} - {{ formatTime(appointment.end_time) }}</span>
                  </div>
                  
                  <div class="flex items-center">
                    <span 
                      :class="{
                        'bg-yellow-100 text-yellow-800': appointment.status === 'pending',
                        'bg-green-100 text-green-800': appointment.status === 'confirmed',
                        'bg-red-100 text-red-800': appointment.status === 'cancelled'
                      }"
                      class="px-3 py-1 rounded-full text-sm font-medium"
                    >
                      {{ appointment.status }}
                    </span>
                  </div>
                </div>
                
                <div class="flex space-x-2">
                  <Link 
                    :href="route('appointments.show', appointment.id)"
                    class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                  >
                    <EyeIcon class="w-4 h-4 mr-2" />
                    View
                  </Link>
                  
                  <button 
                    v-if="appointment.status === 'pending'"
                    @click="cancelAppointment(appointment)"
                    class="inline-flex items-center px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                  >
                    <XMarkIcon class="w-4 h-4 mr-2" />
                    Cancel
                  </button>
                </div>
              </div>
              
              <div v-if="appointment.notes" class="mt-4 pt-4 border-t">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Notes</h3>
                <p class="text-gray-600">{{ appointment.notes }}</p>
              </div>
            </div>
          </div>
          
          <Pagination :links="appointments.links" class="mt-6" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { 
  CalendarIcon, 
  ClockIcon, 
  EyeIcon, 
  XMarkIcon 
} from '@heroicons/vue/24/outline';
import Pagination from '@/Components/Pagination.vue';
import { router } from '@inertiajs/vue3';
import { format } from 'date-fns';

const props = defineProps({
  appointments: Object
});

const formatDate = (date) => {
  return format(new Date(date), 'MMMM d, yyyy');
};

const formatTime = (date) => {
  return format(new Date(date), 'h:mm a');
};

const cancelAppointment = async (appointment) => {
  if (!confirm('Are you sure you want to cancel this appointment?')) {
    return;
  }
  
  try {
    await router.delete(route('appointments.destroy', appointment.id));
  } catch (error) {
    console.error('Error cancelling appointment:', error);
  }
};
</script> 