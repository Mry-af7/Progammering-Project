<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Schedule Appointment with {{ company.name }}</h1>
          </div>
          
          <form @submit.prevent="submit" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <h2 class="text-lg font-medium mb-4">Available Time Slots</h2>
                <div class="space-y-2">
                  <div v-for="slot in availableSlots" :key="slot.start" 
                    class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer"
                    :class="{ 'bg-blue-50 border-blue-200': selectedSlot === slot }"
                    @click="selectSlot(slot)"
                  >
                    <input 
                      type="radio" 
                      :value="slot" 
                      v-model="selectedSlot"
                      class="mr-3"
                    >
                    <div>
                      <div class="font-medium">{{ formatDate(slot.start) }}</div>
                      <div class="text-sm text-gray-500">
                        {{ formatTime(slot.start) }} - {{ formatTime(slot.end) }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div>
                <h2 class="text-lg font-medium mb-4">Appointment Details</h2>
                
                <div class="space-y-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Notes (Optional)</label>
                    <textarea 
                      v-model="form.notes"
                      rows="4"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      placeholder="Add any additional information or questions you'd like to discuss..."
                    ></textarea>
                  </div>
                  
                  <div v-if="selectedSlot" class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-medium mb-2">Selected Time Slot</h3>
                    <p class="text-gray-600">
                      {{ formatDate(selectedSlot.start) }} at {{ formatTime(selectedSlot.start) }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="flex justify-end space-x-3">
              <Link 
                :href="route('companies.show', company.id)"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-gray-700 hover:bg-gray-50"
              >
                Cancel
              </Link>
              
              <button 
                type="submit"
                :disabled="!selectedSlot"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                Schedule Appointment
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { format } from 'date-fns';
import { ref } from 'vue';

const props = defineProps({
  company: Object,
  availableSlots: Array
});

const selectedSlot = ref(null);
const form = ref({
  notes: ''
});

const formatDate = (date) => {
  return format(new Date(date), 'MMMM d, yyyy');
};

const formatTime = (date) => {
  return format(new Date(date), 'h:mm a');
};

const selectSlot = (slot) => {
  selectedSlot.value = slot;
};

const submit = async () => {
  if (!selectedSlot.value) return;
  
  try {
    await router.post(route('appointments.store'), {
      company_id: props.company.id,
      start_time: selectedSlot.value.start,
      end_time: selectedSlot.value.end,
      notes: form.value.notes
    });
  } catch (error) {
    console.error('Error scheduling appointment:', error);
  }
};
</script> 