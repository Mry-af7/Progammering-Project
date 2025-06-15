<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import Navigation from '../../components/Navigation.vue'

const props = defineProps({
  position: {
    type: Object,
    required: true
  }
})

const form = useForm({
  position_id: props.position.id,
  cover_letter: '',
  cv: null,
  portfolio_url: ''
})

const submit = () => {
  form.post(route('applications.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
    }
  })
}
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <Head title="Nieuwe Sollicitatie" />

    <!-- Navigation -->
    <Navigation />

    <!-- Header -->
    <div class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
          <h1 class="text-3xl font-bold text-gray-900">Nieuwe Sollicitatie</h1>
          <Link :href="'/posities/' + position.id" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Terug naar Positie
          </Link>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <div class="mb-6">
            <h2 class="text-lg font-medium text-gray-900">{{ position.title }}</h2>
            <p class="mt-1 text-sm text-gray-500">{{ position.company.name }}</p>
          </div>

          <form @submit.prevent="submit" class="space-y-6">
            <div>
              <label for="cover_letter" class="block text-sm font-medium text-gray-700">Motivatiebrief</label>
              <div class="mt-1">
                <textarea
                  id="cover_letter"
                  v-model="form.cover_letter"
                  rows="6"
                  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                  :class="{ 'border-red-300': form.errors.cover_letter }"
                ></textarea>
                <p v-if="form.errors.cover_letter" class="mt-2 text-sm text-red-600">{{ form.errors.cover_letter }}</p>
              </div>
            </div>

            <div>
              <label for="cv" class="block text-sm font-medium text-gray-700">CV</label>
              <div class="mt-1">
                <input
                  type="file"
                  id="cv"
                  @change="form.cv = $event.target.files[0]"
                  accept=".pdf,.doc,.docx"
                  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                  :class="{ 'border-red-300': form.errors.cv }"
                >
                <p v-if="form.errors.cv" class="mt-2 text-sm text-red-600">{{ form.errors.cv }}</p>
                <p class="mt-2 text-sm text-gray-500">PDF, DOC of DOCX bestand (max. 10MB)</p>
              </div>
            </div>

            <div>
              <label for="portfolio_url" class="block text-sm font-medium text-gray-700">Portfolio URL (optioneel)</label>
              <div class="mt-1">
                <input
                  type="url"
                  id="portfolio_url"
                  v-model="form.portfolio_url"
                  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                  :class="{ 'border-red-300': form.errors.portfolio_url }"
                >
                <p v-if="form.errors.portfolio_url" class="mt-2 text-sm text-red-600">{{ form.errors.portfolio_url }}</p>
              </div>
            </div>

            <div class="flex justify-end">
              <button
                type="submit"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                :disabled="form.processing"
              >
                Sollicitatie Indienen
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template> 