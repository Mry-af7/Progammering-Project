<template>
  <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
      <h1 class="text-3xl font-bold text-gray-900 mb-6">Studenten</h1>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="student in students" :key="student.id" 
             class="bg-white shadow rounded-lg overflow-hidden">
          <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-2">
              {{ student.name }}
            </h2>
            <p class="text-gray-600 mb-4">
              {{ student.profile?.education || 'Geen opleiding opgegeven' }}
            </p>
            <div class="flex justify-between items-center">
              <Link :href="route('students.show', student.id)"
                    class="text-indigo-600 hover:text-indigo-900">
                Bekijk profiel
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  students: {
    type: Array,
    required: true
  }
});
</script> 