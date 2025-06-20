<template>
    <Head title="Company Onboarding - Basic Information" />
    
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-slate-900 dark:to-indigo-950">
        <!-- Header -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-700/50">
            <div class="max-w-4xl mx-auto px-6 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center text-white text-xl shadow-lg">
                            🏢
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Company Profile Setup</h1>
                            <p class="text-gray-600 dark:text-gray-400">Step {{ currentStep }} of {{ totalSteps }}: Basic Information</p>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="flex items-center space-x-4">
                        <div class="w-48 h-3 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full transition-all duration-500"
                                 :style="{ width: (currentStep / totalSteps) * 100 + '%' }"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">
                            {{ Math.round((currentStep / totalSteps) * 100) }}%
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-4xl mx-auto px-6 py-12">
            <form @submit.prevent="submit" class="space-y-8">
                <!-- Company Name & Industry -->
                <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl p-8 border border-gray-200/50 dark:border-gray-700/50 shadow-xl">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center text-white text-lg shadow-lg">
                            🏷️
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Company Identity</h2>
                            <p class="text-gray-600 dark:text-gray-400">Tell us about your company</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Company Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Company Name *
                            </label>
                            <input
                                id="name"
                                v-model="form.name"
                                type="text"
                                required
                                class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                placeholder="Enter your company name"
                            />
                            <div v-if="errors.name" class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ errors.name }}
                            </div>
                        </div>

                        <!-- Industry -->
                        <div>
                            <label for="industry_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Industry *
                            </label>
                            <select
                                id="industry_id"
                                v-model="form.industry_id"
                                required
                                class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 text-gray-900 dark:text-white"
                            >
                                <option value="">Select an industry</option>
                                <option v-for="industry in industries" :key="industry.id" :value="industry.id">
                                    {{ industry.name }}
                                </option>
                            </select>
                            <div v-if="errors.industry_id" class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ errors.industry_id }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Company Details -->
                <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl p-8 border border-gray-200/50 dark:border-gray-700/50 shadow-xl">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center text-white text-lg shadow-lg">
                            📊
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Company Details</h2>
                            <p class="text-gray-600 dark:text-gray-400">Basic information about your organization</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Company Size -->
                        <div>
                            <label for="company_size_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Company Size *
                            </label>
                            <select
                                id="company_size_id"
                                v-model="form.company_size_id"
                                required
                                class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 text-gray-900 dark:text-white"
                            >
                                <option value="">Select company size</option>
                                <option v-for="size in companySizes" :key="size.id" :value="size.id">
                                    {{ size.name }} ({{ size.label }})
                                </option>
                            </select>
                            <div v-if="errors.company_size_id" class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ errors.company_size_id }}
                            </div>
                        </div>

                        <!-- Website -->
                        <div>
                            <label for="website" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Company Website
                            </label>
                            <input
                                id="website"
                                v-model="form.website"
                                type="url"
                                class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                placeholder="https://yourcompany.com"
                            />
                            <div v-if="errors.website" class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ errors.website }}
                            </div>
                        </div>

                        <!-- Headquarters -->
                        <div>
                            <label for="headquarters" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Headquarters Location
                            </label>
                            <input
                                id="headquarters"
                                v-model="form.headquarters"
                                type="text"
                                class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                placeholder="San Francisco, CA"
                            />
                            <div v-if="errors.headquarters" class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ errors.headquarters }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-8">
                    <Link
                        href="/dashboard"
                        class="flex items-center px-6 py-3 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-300"
                    >
                        ← Back to Dashboard
                    </Link>

                    <button
                        type="submit"
                        :disabled="processing"
                        class="flex items-center px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-semibold rounded-2xl hover:shadow-xl hover:scale-105 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span v-if="processing">Saving...</span>
                        <span v-else>Continue to Step 2</span>
                        <svg v-if="!processing" class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3'
import { computed } from 'vue'

interface Props {
    user: any
    company: any
    industries: any[]
    companySizes: any[]
    currentStep: number
    totalSteps: number
    errors: Record<string, string>
}

const props = defineProps<Props>()

const form = useForm({
    name: props.company?.name || '',
    industry_id: props.company?.industry_id || '',
    company_size_id: props.company?.company_size_id || '',
    website: props.company?.website || '',
    founded_year: props.company?.founded_year || '',
    headquarters: props.company?.headquarters || '',
})

const submit = () => {
    console.log('Submitting form with data:', form.data())
    
    form.post(route('company.onboarding.basics'), {
        preserveScroll: true,
        onError: (errors) => {
            console.log('Form errors:', errors)
        },
        onSuccess: () => {
            console.log('Form submitted successfully')
        }
    })
}

const processing = computed(() => form.processing)
</script>

<style scoped>
/* Custom animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fadeIn 0.6s ease-out;
}

/* Enhanced focus states */
input:focus, select:focus {
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #6366f1, #8b5cf6);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #4f46e5, #7c3aed);
}
</style>