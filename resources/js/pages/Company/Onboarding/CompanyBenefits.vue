<template>
    <Head title="Company Onboarding - Benefits & Perks" />
    
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-slate-900 dark:to-indigo-950">
        <!-- Header -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-700/50">
            <div class="max-w-6xl mx-auto px-6 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center text-white text-xl shadow-lg">
                            🎁
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Benefits & Perks</h1>
                            <p class="text-gray-600 dark:text-gray-400">Step {{ currentStep }} of {{ totalSteps }}: What do you offer employees?</p>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="flex items-center space-x-4">
                        <div class="w-48 h-3 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full transition-all duration-500"
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
        <div class="max-w-6xl mx-auto px-6 py-12">
            <form @submit.prevent="submit" class="space-y-8">
                <!-- Selected Benefits Summary -->
                <div v-if="form.benefits.length > 0" class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl p-6 border border-gray-200/50 dark:border-gray-700/50 shadow-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Selected Benefits ({{ form.benefits.length }})</h3>
                        <button
                            type="button"
                            @click="clearAll"
                            class="text-sm text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-200"
                        >
                            Clear All
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        <div
                            v-for="benefitId in form.benefits"
                            :key="benefitId"
                            class="flex items-center justify-between p-3 bg-gradient-to-r from-yellow-100 to-orange-100 dark:from-yellow-900/30 dark:to-orange-900/30 rounded-xl border border-yellow-200 dark:border-yellow-700"
                        >
                            <div class="flex items-center space-x-3">
                                <span class="text-lg">{{ getBenefit(benefitId)?.icon }}</span>
                                <span class="text-sm font-medium text-yellow-700 dark:text-yellow-300">{{ getBenefit(benefitId)?.name }}</span>
                            </div>
                            <button
                                type="button"
                                @click="removeBenefit(benefitId)"
                                class="text-yellow-600 hover:text-red-600 dark:text-yellow-400 dark:hover:text-red-400 transition-colors duration-200 text-lg"
                            >
                                ×
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Benefit Categories -->
                <div v-for="category in categories" :key="category" class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl p-8 border border-gray-200/50 dark:border-gray-700/50 shadow-xl">
                    <div class="flex items-center space-x-4 mb-6">
                        <div :class="[
                            'w-10 h-10 rounded-2xl flex items-center justify-center text-white text-lg shadow-lg',
                            getCategoryGradient(category)
                        ]">
                            {{ getCategoryIcon(category) }}
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ getCategoryTitle(category) }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ getCategoryDescription(category) }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div
                            v-for="benefit in getBenefitsByCategory(category)"
                            :key="benefit.id"
                            @click="toggleBenefit(benefit.id)"
                            class="flex items-start p-4 bg-white/60 dark:bg-gray-700/60 rounded-2xl border border-gray-200 dark:border-gray-600 cursor-pointer hover:bg-white/80 dark:hover:bg-gray-700/80 hover:shadow-lg transition-all duration-300 group relative"
                            :class="{
                                'ring-2 ring-yellow-500 bg-yellow-50 dark:bg-yellow-900/20 shadow-lg': isSelected(benefit.id)
                            }"
                        >
                            <!-- Benefit Icon -->
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl mr-4 flex-shrink-0 transition-transform duration-300 group-hover:scale-110"
                                 :class="getCategoryIconBg(category)">
                                {{ benefit.icon }}
                            </div>
                            
                            <!-- Benefit Content -->
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1 group-hover:text-gray-900 dark:group-hover:text-white transition-colors duration-300">
                                    {{ benefit.name }}
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                    {{ benefit.description }}
                                </p>
                            </div>
                            
                            <!-- Selected Indicator -->
                            <div v-if="isSelected(benefit.id)" class="absolute top-3 right-3 w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                ✓
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Validation Error -->
                <div v-if="errors.benefits" class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-2xl p-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white text-sm">
                            ⚠️
                        </div>
                        <div>
                            <p class="font-semibold text-red-800 dark:text-red-200">Please select at least one benefit</p>
                            <p class="text-sm text-red-600 dark:text-red-400">{{ errors.benefits }}</p>
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
                        :disabled="processing || form.benefits.length === 0"
                        class="flex items-center px-8 py-4 bg-gradient-to-r from-yellow-500 to-orange-500 text-white font-semibold rounded-2xl hover:shadow-xl hover:scale-105 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span v-if="processing">Saving...</span>
                        <span v-else>Continue to Step 5</span>
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

interface Benefit {
    id: number
    name: string
    description: string
    category: string
    icon: string
}

interface Props {
    user: any
    company: any
    benefits: Benefit[]
    companyBenefits: any[]
    currentStep: number
    totalSteps: number
    errors: Record<string, string>
}

const props = defineProps<Props>()

const form = useForm({
    benefits: props.companyBenefits?.map(b => b.id) || [],
})

const categories = computed(() => {
    return [...new Set(props.benefits.map(benefit => benefit.category))]
})

const getBenefitsByCategory = (category: string) => {
    return props.benefits.filter(benefit => benefit.category === category)
}

const getBenefit = (id: number) => {
    return props.benefits.find(benefit => benefit.id === id)
}

const isSelected = (benefitId: number) => {
    return form.benefits.includes(benefitId)
}

const toggleBenefit = (benefitId: number) => {
    if (isSelected(benefitId)) {
        form.benefits = form.benefits.filter(id => id !== benefitId)
    } else {
        form.benefits.push(benefitId)
    }
}

const removeBenefit = (benefitId: number) => {
    form.benefits = form.benefits.filter(id => id !== benefitId)
}

const clearAll = () => {
    form.benefits = []
}

const getCategoryTitle = (category: string) => {
    const titles: Record<string, string> = {
        'health': 'Health & Wellness',
        'financial': 'Financial Benefits',
        'time-off': 'Time Off & Leave',
        'growth': 'Learning & Development',
        'flexibility': 'Work-Life Balance',
        'perks': 'Office Perks & Culture',
        'wellness': 'Wellness Programs'
    }
    return titles[category] || category.charAt(0).toUpperCase() + category.slice(1)
}

const getCategoryDescription = (category: string) => {
    const descriptions: Record<string, string> = {
        'health': 'Medical, mental health, and wellness benefits',
        'financial': 'Salary, equity, bonuses, and retirement benefits',
        'time-off': 'Vacation, sick leave, and parental leave policies',
        'growth': 'Professional development and education support',
        'flexibility': 'Remote work and flexible schedule options',
        'perks': 'Office amenities and company culture benefits',
        'wellness': 'Physical and mental wellness programs'
    }
    return descriptions[category] || 'Employee benefits and perks'
}

const getCategoryIcon = (category: string) => {
    const icons: Record<string, string> = {
        'health': '🏥',
        'financial': '💰',
        'time-off': '🏖️',
        'growth': '📚',
        'flexibility': '⏰',
        'perks': '🎮',
        'wellness': '💪'
    }
    return icons[category] || '🎁'
}

const getCategoryGradient = (category: string) => {
    const gradients: Record<string, string> = {
        'health': 'bg-gradient-to-br from-green-500 to-emerald-500',
        'financial': 'bg-gradient-to-br from-yellow-500 to-amber-500',
        'time-off': 'bg-gradient-to-br from-blue-500 to-cyan-500',
        'growth': 'bg-gradient-to-br from-purple-500 to-violet-500',
        'flexibility': 'bg-gradient-to-br from-indigo-500 to-blue-500',
        'perks': 'bg-gradient-to-br from-pink-500 to-rose-500',
        'wellness': 'bg-gradient-to-br from-green-500 to-teal-500'
    }
    return gradients[category] || 'bg-gradient-to-br from-gray-500 to-gray-600'
}

const getCategoryIconBg = (category: string) => {
    const backgrounds: Record<string, string> = {
        'health': 'bg-green-100 dark:bg-green-900/30',
        'financial': 'bg-yellow-100 dark:bg-yellow-900/30',
        'time-off': 'bg-blue-100 dark:bg-blue-900/30',
        'growth': 'bg-purple-100 dark:bg-purple-900/30',
        'flexibility': 'bg-indigo-100 dark:bg-indigo-900/30',
        'perks': 'bg-pink-100 dark:bg-pink-900/30',
        'wellness': 'bg-green-100 dark:bg-green-900/30'
    }
    return backgrounds[category] || 'bg-gray-100 dark:bg-gray-900/30'
}

const submit = () => {
    console.log('Submitting benefits with data:', form.data())
    console.log('Available benefits:', props.benefits)
    
    form.post(route('company.onboarding.benefits'), {
        preserveScroll: true,
        onError: (errors) => {
            console.log('Form errors:', errors)
        },
        onSuccess: () => {
            console.log('Benefits submitted successfully')
        }
    })
}

const processing = computed(() => form.processing)
</script>

<style scoped>
/* Enhanced hover animations */
.group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
}

/* Benefit card animations */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}

/* Selected state animation */
.ring-2 {
    animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse-ring {
    0%, 100% {
        box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.5);
    }
    50% {
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.3);
    }
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
    background: linear-gradient(to bottom, #f59e0b, #ea580c);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #d97706, #dc2626);
}
</style>