<template>
  <div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6">Mijn Afspraken</h2>
    
    <div v-if="loading" class="flex justify-center items-center py-8">
      <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
    </div>

    <div v-else-if="appointments.length === 0" class="text-center py-8">
      <p class="text-gray-500">Je hebt nog geen afspraken.</p>
    </div>

    <div v-else class="space-y-4">
      <div v-for="appointment in appointments" :key="appointment.id" 
           class="border rounded-lg p-4 hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start">
          <div>
            <h3 class="font-semibold text-lg">{{ appointment.company.name }}</h3>
            <p class="text-gray-600">
              {{ formatDate(appointment.time_slot.start_time) }} - 
              {{ formatTime(appointment.time_slot.start_time) }} tot 
              {{ formatTime(appointment.time_slot.end_time) }}
            </p>
            <p class="text-sm text-gray-500 mt-2">
              Status: 
              <span :class="{
                'text-green-600': appointment.status === 'confirmed',
                'text-yellow-600': appointment.status === 'pending',
                'text-red-600': appointment.status === 'cancelled'
              }">
                {{ getStatusText(appointment.status) }}
              </span>
            </p>
          </div>
          
          <div class="flex space-x-2">
            <button v-if="appointment.status === 'pending'"
                    @click="cancelAppointment(appointment)"
                    class="text-red-600 hover:text-red-800">
              Annuleren
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { format } from 'date-fns';
import { nl } from 'date-fns/locale';

const appointments = ref([]);
const loading = ref(true);

const loadAppointments = async () => {
  try {
    const response = await axios.get('/api/appointments');
    appointments.value = response.data.appointments;
  } catch (error) {
    console.error('Error loading appointments:', error);
  } finally {
    loading.value = false;
  }
};

const cancelAppointment = async (appointment) => {
  if (!confirm('Weet je zeker dat je deze afspraak wilt annuleren?')) {
    return;
  }

  try {
    await axios.put(`/api/appointments/${appointment.id}`, {
      status: 'cancelled'
    });
    await loadAppointments();
  } catch (error) {
    console.error('Error cancelling appointment:', error);
    alert('Er is een fout opgetreden bij het annuleren van de afspraak.');
  }
};

const formatDate = (date) => {
  return format(new Date(date), 'EEEE d MMMM yyyy', { locale: nl });
};

const formatTime = (date) => {
  return format(new Date(date), 'HH:mm');
};

const getStatusText = (status) => {
  const statusMap = {
    'pending': 'In afwachting',
    'confirmed': 'Bevestigd',
    'cancelled': 'Geannuleerd'
  };
  return statusMap[status] || status;
};

onMounted(() => {
  loadAppointments();
});
</script> 