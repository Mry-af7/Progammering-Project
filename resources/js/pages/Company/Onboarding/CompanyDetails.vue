<template>
    <Head title="Company Onboarding - Company Details" />
    
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-slate-900 dark:to-indigo-950">
        <!-- Header -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-700/50">
            <div class="max-w-4xl mx-auto px-6 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center text-white text-xl shadow-lg">
                            📝
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Company Details</h1>
                            <p class="text-gray-600 dark:text-gray-400">Step {{ currentStep }} of {{ totalSteps }}: Tell us about your company</p>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="flex items-center space-x-4">
                        <div class="w-48 h-3 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500 rounded-full transition-all duration-500"
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
                <!-- Company Description -->
                <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl p-8 border border-gray-200/50 dark:border-gray-700/50 shadow-xl">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center text-white text-lg shadow-lg">
                            📄
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Company Description</h2>
                            <p class="text-gray-600 dark:text-gray-400">What does your company do?</p>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            Company Description *
                        </label>
                        <textarea
                            id="description"
                            v-model="form.description"
                            rows="6"
                            required
                            class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 resize-none"
                            placeholder="Describe what your company does, your products/services, and what makes you unique..."
                        ></textarea>
                        <div class="mt-2 flex justify-between">
                            <div v-if="errors.description" class="text-sm text-red-600 dark:text-red-400">
                                {{ errors.description }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ form.description.length }}/2000 characters
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mission & Culture -->
                <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl p-8 border border-gray-200/50 dark:border-gray-700/50 shadow-xl">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center text-white text-lg shadow-lg">
                            🎯
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Mission & Culture</h2>
                            <p class="text-gray-600 dark:text-gray-400">What drives your company?</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Mission Statement -->
                        <div>
                            <label for="mission_statement" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Mission Statement
                            </label>
                            <textarea
                                id="mission_statement"
                                v-model="form.mission_statement"
                                rows="4"
                                class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 resize-none"
                                placeholder="What is your company's mission and purpose?"
                            ></textarea>
                            <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                {{ form.mission_statement.length }}/1000 characters
                            </div>
                        </div>

                        <!-- Company Culture -->
                        <div>
                            <label for="company_culture" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Company Culture
                            </label>
                            <textarea
                                id="company_culture"
                                v-model="form.company_culture"
                                rows="4"
                                class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 resize-none"
                                placeholder="Describe your work environment and company values..."
                            ></textarea>
                            <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                {{ form.company_culture.length }}/1000 characters
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Work Policy & Social Links -->
                <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl p-8 border border-gray-200/50 dark:border-gray-700/50 shadow-xl">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center text-white text-lg shadow-lg">
                            🌐
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Work Policy & Social Presence</h2>
                            <p class="text-gray-600 dark:text-gray-400">How do you work and where can people find you?</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Remote Policy -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
                                Remote Work Policy *
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <label class="flex items-center p-4 bg-white/60 dark:bg-gray-700/60 rounded-2xl border border-gray-200 dark:border-gray-600 cursor-pointer hover:bg-white/80 dark:hover:bg-gray-700/80 transition-all duration-300"
                                       :class="{ 'ring-2 ring-orange-500 bg-orange-50 dark:bg-orange-900/20': form.remote_policy === 'fully_remote' }">
                                    <input
                                        v-model="form.remote_policy"
                                        type="radio"
                                        value="fully_remote"
                                        class="sr-only"
                                    />
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center text-white text-sm">
                                            🏠
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 dark:text-white">Fully Remote</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Work from anywhere</div>
                                        </div>
                                    </div>
                                </label>

                                <label class="flex items-center p-4 bg-white/60 dark:bg-gray-700/60 rounded-2xl border border-gray-200 dark:border-gray-600 cursor-pointer hover:bg-white/80 dark:hover:bg-gray-700/80 transition-all duration-300"
                                       :class="{ 'ring-2 ring-orange-500 bg-orange-50 dark:bg-orange-900/20': form.remote_policy === 'hybrid' }">
                                    <input
                                        v-model="form.remote_policy"
                                        type="radio"
                                        value="hybrid"
                                        class="sr-only"
                                    />
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center text-white text-sm">
                                            🔄
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 dark:text-white">Hybrid</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Mix of remote & office</div>
                                        </div>
                                    </div>
                                </label>

                                <label class="flex items-center p-4 bg-white/60 dark:bg-gray-700/60 rounded-2xl border border-gray-200 dark:border-gray-600 cursor-pointer hover:bg-white/80 dark:hover:bg-gray-700/80 transition-all duration-300"
                                       :class="{ 'ring-2 ring-orange-500 bg-orange-50 dark:bg-orange-900/20': form.remote_policy === 'office_only' }">
                                    <input
                                        v-model="form.remote_policy"
                                        type="radio"
                                        value="office_only"
                                        class="sr-only"
                                    />
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center text-white text-sm">
                                            🏢
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 dark:text-white">Office Only</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">In-person work</div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div v-if="errors.remote_policy" class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ errors.remote_policy }}
                            </div>
                        </div>

                        <!-- Social Links -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- LinkedIn -->
                            <div>
                                <label for="linkedin_url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    LinkedIn URL
                                </label>
                                <input
                                    id="linkedin_url"
                                    v-model="form.linkedin_url"
                                    type="url"
                                    class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                    placeholder="https://linkedin.com/company/..."
                                />
                            </div>

                            <!-- Twitter -->
                            <div>
                                <label for="twitter_url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    Twitter URL
                                </label>
                                <input
                                    id="twitter_url"
                                    v-model="form.twitter_url"
                                    type="url"
                                    class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                    placeholder="https://twitter.com/..."
                                />
                            </div>

                            <!-- Glassdoor -->
                            <div>
                                <label for="glassdoor_url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    Glassdoor URL
                                </label>
                                <input
                                    id="glassdoor_url"
                                    v-model="form.glassdoor_url"
                                    type="url"
                                    class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                    placeholder="https://glassdoor.com/..."
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-8">
                    <Link
                        :href="route('company.onboarding.show', { step: currentStep - 1 })"
                        class="flex items-center px-6 py-3 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-300"
                    >
                        ← Back to Previous Step
                    </Link>

                    <button
                        type="submit"
                        :disabled="processing"
                        class="flex items-center px-8 py-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold rounded-2xl hover:shadow-xl hover:scale-105 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span v-if="processing">Saving...</span>
                        <span v-else>Continue to Step 3</span>
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
    currentStep: number
    totalSteps: number
    errors: Record<string, string>
}

const props = defineProps<Props>()

const form = useForm({
    description: props.company?.description || '',
    mission_statement: props.company?.mission_statement || '',
    company_culture: props.company?.company_culture || '',
    remote_policy: props.company?.remote_policy || '',
    linkedin_url: props.company?.linkedin_url || '',
    twitter_url: props.company?.twitter_url || '',
    glassdoor_url: props.company?.glassdoor_url || '',
})

const submit = () => {
    console.log('Submitting company details form with data:', form.data())
    
    form.post(route('company.onboarding.details'), {
        preserveScroll: true,
        onError: (errors) => {
            console.log('Form errors:', errors)
        },
        onSuccess: () => {
            console.log('Company details submitted successfully')
        }
    })
}

const processing = computed(() => form.processing)
</script>

<style scoped>
/* Enhanced textarea styling */
textarea:focus {
    box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.1);
}

/* Radio button animations */
input[type="radio"]:checked + div {
    transform: scale(1.02);
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
    background: linear-gradient(to bottom, #8b5cf6, #ec4899);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #7c3aed, #db2777);
}
</style>