<template>
    <Head title="Company Onboarding - Review & Complete" />
    
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-slate-900 dark:to-indigo-950">
        <!-- Header -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-700/50">
            <div class="max-w-4xl mx-auto px-6 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center text-white text-xl shadow-lg">
                            ✅
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Review & Complete</h1>
                            <p class="text-gray-600 dark:text-gray-400">Step {{ currentStep }} of {{ totalSteps }}: Final review of your profile</p>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="flex items-center space-x-4">
                        <div class="w-48 h-3 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transition-all duration-500"
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
            <!-- Company Profile Preview -->
            <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl border border-gray-200/50 dark:border-gray-700/50 shadow-xl overflow-hidden mb-8">
                <!-- Cover Image -->
                <div v-if="company.cover_image_url" class="h-48 bg-gradient-to-r from-indigo-500 to-purple-500 relative overflow-hidden">
                    <img 
                        :src="company.cover_image_url" 
                        alt="Company Cover"
                        class="w-full h-full object-cover"
                    />
                    <div class="absolute inset-0 bg-black/20"></div>
                </div>
                <div v-else class="h-48 bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center">
                    <div class="text-center text-white">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl mx-auto mb-4 flex items-center justify-center text-2xl">
                            🏢
                        </div>
                        <p class="text-lg font-semibold">{{ company.name || 'Your Company' }}</p>
                    </div>
                </div>

                <!-- Company Header -->
                <div class="p-8">
                    <div class="flex items-start space-x-6">
                        <!-- Logo -->
                        <div class="flex-shrink-0">
                            <div v-if="company.logo_url" class="w-20 h-20 bg-white rounded-2xl shadow-lg overflow-hidden border-4 border-white">
                                <img 
                                    :src="company.logo_url" 
                                    :alt="company.name + ' Logo'"
                                    class="w-full h-full object-contain"
                                />
                            </div>
                            <div v-else class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl shadow-lg flex items-center justify-center text-white text-2xl">
                                {{ company.name?.charAt(0) || '🏢' }}
                            </div>
                        </div>

                        <!-- Company Info -->
                        <div class="flex-1 min-w-0">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                                {{ company.name || 'Your Company Name' }}
                            </h2>
                            <div class="flex flex-wrap items-center gap-4 mb-4">
                                <div v-if="company.industry" class="flex items-center space-x-2">
                                    <span class="text-lg">{{ company.industry?.icon || '🏢' }}</span>
                                    <span class="text-gray-600 dark:text-gray-400">{{ company.industry?.name }}</span>
                                </div>
                                <div v-if="company.company_size" class="flex items-center space-x-2">
                                    <span class="text-lg">👥</span>
                                    <span class="text-gray-600 dark:text-gray-400">{{ company.company_size?.label }}</span>
                                </div>
                                <div v-if="company.headquarters" class="flex items-center space-x-2">
                                    <span class="text-lg">📍</span>
                                    <span class="text-gray-600 dark:text-gray-400">{{ company.headquarters }}</span>
                                </div>
                                <div v-if="company.remote_policy" class="flex items-center space-x-2">
                                    <span class="text-lg">{{ getRemotePolicyIcon(company.remote_policy) }}</span>
                                    <span class="text-gray-600 dark:text-gray-400">{{ getRemotePolicyLabel(company.remote_policy) }}</span>
                                </div>
                            </div>
                            <p v-if="company.description" class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ company.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Sections -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Technologies -->
                <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl p-6 border border-gray-200/50 dark:border-gray-700/50 shadow-xl">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center text-white text-sm">
                            ⚡
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Tech Stack</h3>
                    </div>
                    <div v-if="company.technologies?.length > 0" class="flex flex-wrap gap-2">
                        <div
                            v-for="tech in company.technologies"
                            :key="tech.id"
                            class="flex items-center space-x-2 px-3 py-2 bg-green-100 dark:bg-green-900/30 rounded-xl border border-green-200 dark:border-green-700"
                        >
                            <span class="text-sm">{{ tech.icon }}</span>
                            <span class="text-sm font-medium text-green-700 dark:text-green-300">{{ tech.name }}</span>
                        </div>
                    </div>
                    <p v-else class="text-gray-500 dark:text-gray-400 text-sm">No technologies selected</p>
                </div>

                <!-- Benefits -->
                <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl p-6 border border-gray-200/50 dark:border-gray-700/50 shadow-xl">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center text-white text-sm">
                            🎁
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Benefits & Perks</h3>
                    </div>
                    <div v-if="company.benefits?.length > 0" class="space-y-2">
                        <div
                            v-for="benefit in company.benefits.slice(0, 4)"
                            :key="benefit.id"
                            class="flex items-center space-x-3 p-2 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl"
                        >
                            <span class="text-sm">{{ benefit.icon }}</span>
                            <span class="text-sm font-medium text-yellow-700 dark:text-yellow-300">{{ benefit.name }}</span>
                        </div>
                        <div v-if="company.benefits.length > 4" class="text-sm text-gray-500 dark:text-gray-400 text-center pt-2">
                            +{{ company.benefits.length - 4 }} more benefits
                        </div>
                    </div>
                    <p v-else class="text-gray-500 dark:text-gray-400 text-sm">No benefits selected</p>
                </div>
            </div>

            <!-- Profile Completeness -->
            <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl p-8 border border-gray-200/50 dark:border-gray-700/50 shadow-xl mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center text-white text-lg">
                            📊
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Profile Completeness</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ profileCompleteness }}% complete</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ profileCompleteness }}%</div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="w-full h-4 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden mb-4">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full transition-all duration-500"
                         :style="{ width: profileCompleteness + '%' }"></div>
                </div>

                <!-- Completeness Checklist -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center space-x-3">
                        <div :class="['w-6 h-6 rounded-full flex items-center justify-center text-white text-xs',
                                     company.name ? 'bg-green-500' : 'bg-gray-400']">
                            {{ company.name ? '✓' : '○' }}
                        </div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Company Name</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div :class="['w-6 h-6 rounded-full flex items-center justify-center text-white text-xs',
                                     company.industry_id ? 'bg-green-500' : 'bg-gray-400']">
                            {{ company.industry_id ? '✓' : '○' }}
                        </div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Industry</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div :class="['w-6 h-6 rounded-full flex items-center justify-center text-white text-xs',
                                     company.description ? 'bg-green-500' : 'bg-gray-400']">
                            {{ company.description ? '✓' : '○' }}
                        </div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Description</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div :class="['w-6 h-6 rounded-full flex items-center justify-center text-white text-xs',
                                     company.remote_policy ? 'bg-green-500' : 'bg-gray-400']">
                            {{ company.remote_policy ? '✓' : '○' }}
                        </div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Remote Policy</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div :class="['w-6 h-6 rounded-full flex items-center justify-center text-white text-xs',
                                     company.technologies?.length > 0 ? 'bg-green-500' : 'bg-gray-400']">
                            {{ company.technologies?.length > 0 ? '✓' : '○' }}
                        </div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Technologies</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div :class="['w-6 h-6 rounded-full flex items-center justify-center text-white text-xs',
                                     company.benefits?.length > 0 ? 'bg-green-500' : 'bg-gray-400']">
                            {{ company.benefits?.length > 0 ? '✓' : '○' }}
                        </div>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Benefits</span>
                    </div>
                </div>
            </div>

            <!-- Final Actions -->
            <form @submit.prevent="submit" class="space-y-6">
                <!-- Confirmation -->
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-3xl p-6 border border-emerald-200 dark:border-emerald-700">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-emerald-500 rounded-xl flex items-center justify-center text-white text-sm flex-shrink-0">
                            🎉
                        </div>
                        <div>
                            <h3 class="font-semibold text-emerald-900 dark:text-emerald-200 mb-2">Ready to Go Live!</h3>
                            <p class="text-sm text-emerald-800 dark:text-emerald-300 mb-4">
                                Your company profile looks great! Once you complete the onboarding, your profile will be live and visible to talented IT students looking for opportunities.
                            </p>
                            <div class="flex items-center space-x-2">
                                <input
                                    id="confirm"
                                    v-model="confirmed"
                                    type="checkbox"
                                    class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded focus:ring-emerald-500 dark:focus:ring-emerald-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                />
                                <label for="confirm" class="text-sm text-emerald-800 dark:text-emerald-300">
                                    I confirm that all information is accurate and I'm ready to publish this profile
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Validation Errors -->
                <div v-if="Object.keys(errors).length > 0" class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-2xl p-4">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white text-sm">
                            ⚠️
                        </div>
                        <h3 class="font-semibold text-red-800 dark:text-red-200">Please fix the following issues:</h3>
                    </div>
                    <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-1">
                        <li v-for="(error, field) in errors" :key="field">{{ error }}</li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-4">
                    <Link
                        :href="route('company.onboarding.show', { step: currentStep - 1 })"
                        class="flex items-center px-6 py-3 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-300"
                    >
                        ← Back to Previous Step
                    </Link>

                    <button
                        type="submit"
                        :disabled="processing || !confirmed"
                        class="flex items-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-2xl hover:shadow-xl hover:scale-105 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span v-if="processing">Publishing Profile...</span>
                        <span v-else>🚀 Publish Company Profile</span>
                    </button>
                </div>
            </form>

            <!-- Edit Links -->
            <div class="mt-8 p-6 bg-gray-50 dark:bg-gray-800/50 rounded-2xl">
                <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Need to make changes?</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    <Link
                        :href="route('company.onboarding.show', { step: 1 })"
                        class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors duration-200"
                    >
                        ← Edit Basic Info
                    </Link>
                    <Link
                        :href="route('company.onboarding.show', { step: 2 })"
                        class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors duration-200"
                    >
                        ← Edit Company Details
                    </Link>
                    <Link
                        :href="route('company.onboarding.show', { step: 3 })"
                        class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors duration-200"
                    >
                        ← Edit Tech Stack
                    </Link>
                    <Link
                        :href="route('company.onboarding.show', { step: 4 })"
                        class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors duration-200"
                    >
                        ← Edit Benefits
                    </Link>
                    <Link
                        :href="route('company.onboarding.show', { step: 5 })"
                        class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors duration-200"
                    >
                        ← Edit Media
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

interface Props {
    user: any
    company: any
    currentStep: number
    totalSteps: number
    errors: Record<string, string>
}

const props = defineProps<Props>()

const confirmed = ref(false)

const form = useForm({})

const profileCompleteness = computed(() => {
    const fields = [
        props.company?.name,
        props.company?.industry_id,
        props.company?.company_size_id,
        props.company?.description,
        props.company?.remote_policy,
        props.company?.technologies?.length > 0,
        props.company?.benefits?.length > 0,
        props.company?.website,
        props.company?.headquarters,
        props.company?.logo_url,
    ]

    const completed = fields.filter(field => !!field).length
    return Math.round((completed / fields.length) * 100)
})

const getRemotePolicyIcon = (policy: string) => {
    const icons: Record<string, string> = {
        'fully_remote': '🏠',
        'hybrid': '🔄',
        'office_only': '🏢'
    }
    return icons[policy] || '🏢'
}

const getRemotePolicyLabel = (policy: string) => {
    const labels: Record<string, string> = {
        'fully_remote': 'Fully Remote',
        'hybrid': 'Hybrid',
        'office_only': 'Office Only'
    }
    return labels[policy] || policy
}

const submit = () => {
    console.log('Completing company onboarding')
    
    form.post(route('company.onboarding.complete'), {
        preserveScroll: true,
        onError: (errors) => {
            console.log('Form errors:', errors)
        },
        onSuccess: () => {
            console.log('Company onboarding completed successfully!')
        }
    })
}

const processing = computed(() => form.processing)
</script>

<style scoped>
/* Enhanced preview styling */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}

/* Completion indicator animations */
.bg-green-500 {
    animation: check-bounce 0.6s ease-out;
}

@keyframes check-bounce {
    0% { transform: scale(0); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
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
    background: linear-gradient(to bottom, #10b981, #14b8a6);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #059669, #0d9488);
}
</style>