<template>
    <Head title="Company Onboarding - Tech Stack" />
    
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-slate-900 dark:to-indigo-950">
        <!-- Header -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-700/50">
            <div class="max-w-6xl mx-auto px-6 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center text-white text-xl shadow-lg">
                            ⚡
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tech Stack</h1>
                            <p class="text-gray-600 dark:text-gray-400">Step {{ currentStep }} of {{ totalSteps }}: What technologies do you use?</p>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="flex items-center space-x-4">
                        <div class="w-48 h-3 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500 rounded-full transition-all duration-500"
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
                <!-- Selected Technologies Summary -->
                <div v-if="form.technologies.length > 0" class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl p-6 border border-gray-200/50 dark:border-gray-700/50 shadow-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Selected Technologies ({{ form.technologies.length }})</h3>
                        <button
                            type="button"
                            @click="clearAll"
                            class="text-sm text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-200"
                        >
                            Clear All
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <div
                            v-for="techId in form.technologies"
                            :key="techId"
                            class="flex items-center space-x-2 px-3 py-2 bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 rounded-xl border border-green-200 dark:border-green-700"
                        >
                            <span class="text-lg">{{ getTechnology(techId)?.icon }}</span>
                            <span class="text-sm font-medium text-green-700 dark:text-green-300">{{ getTechnology(techId)?.name }}</span>
                            <button
                                type="button"
                                @click="removeTechnology(techId)"
                                class="text-green-600 hover:text-red-600 dark:text-green-400 dark:hover:text-red-400 transition-colors duration-200"
                            >
                                ×
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Technology Categories -->
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

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        <div
                            v-for="tech in getTechnologiesByCategory(category)"
                            :key="tech.id"
                            @click="toggleTechnology(tech.id)"
                            class="flex flex-col items-center p-4 bg-white/60 dark:bg-gray-700/60 rounded-2xl border border-gray-200 dark:border-gray-600 cursor-pointer hover:bg-white/80 dark:hover:bg-gray-700/80 hover:shadow-lg transition-all duration-300 group"
                            :class="{
                                'ring-2 ring-green-500 bg-green-50 dark:bg-green-900/20 shadow-lg': isSelected(tech.id)
                            }"
                        >
                            <!-- Technology Icon -->
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl mb-3 transition-transform duration-300 group-hover:scale-110"
                                 :style="{ backgroundColor: tech.color + '20', color: tech.color }">
                                {{ tech.icon }}
                            </div>
                            
                            <!-- Technology Name -->
                            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 text-center group-hover:text-gray-900 dark:group-hover:text-white transition-colors duration-300">
                                {{ tech.name }}
                            </span>
                            
                            <!-- Selected Indicator -->
                            <div v-if="isSelected(tech.id)" class="absolute top-2 right-2 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                ✓
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Validation Error -->
                <div v-if="errors.technologies" class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-2xl p-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white text-sm">
                            ⚠️
                        </div>
                        <div>
                            <p class="font-semibold text-red-800 dark:text-red-200">Please select at least one technology</p>
                            <p class="text-sm text-red-600 dark:text-red-400">{{ errors.technologies }}</p>
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
                        :disabled="processing || form.technologies.length === 0"
                        class="flex items-center px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-semibold rounded-2xl hover:shadow-xl hover:scale-105 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span v-if="processing">Saving...</span>
                        <span v-else>Continue to Step 4</span>
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

interface Technology {
    id: number
    name: string
    category: string
    icon: string
    color: string
}

interface Props {
    user: any
    company: any
    technologies: Technology[]
    companyTechnologies: any[]
    currentStep: number
    totalSteps: number
    errors: Record<string, string>
}

const props = defineProps<Props>()

const form = useForm({
    technologies: props.companyTechnologies?.map(t => t.id) || [],
})

const categories = computed(() => {
    return [...new Set(props.technologies.map(tech => tech.category))]
})

const getTechnologiesByCategory = (category: string) => {
    return props.technologies.filter(tech => tech.category === category)
}

const getTechnology = (id: number) => {
    return props.technologies.find(tech => tech.id === id)
}

const isSelected = (techId: number) => {
    return form.technologies.includes(techId)
}

const toggleTechnology = (techId: number) => {
    if (isSelected(techId)) {
        form.technologies = form.technologies.filter(id => id !== techId)
    } else {
        form.technologies.push(techId)
    }
}

const removeTechnology = (techId: number) => {
    form.technologies = form.technologies.filter(id => id !== techId)
}

const clearAll = () => {
    form.technologies = []
}

const getCategoryTitle = (category: string) => {
    const titles: Record<string, string> = {
        'frontend': 'Frontend Technologies',
        'backend': 'Backend Technologies',
        'database': 'Databases',
        'devops': 'DevOps & Cloud',
        'mobile': 'Mobile Development'
    }
    return titles[category] || category.charAt(0).toUpperCase() + category.slice(1)
}

const getCategoryDescription = (category: string) => {
    const descriptions: Record<string, string> = {
        'frontend': 'User interface and client-side technologies',
        'backend': 'Server-side languages and frameworks',
        'database': 'Data storage and management systems',
        'devops': 'Deployment, infrastructure, and automation tools',
        'mobile': 'Mobile app development frameworks'
    }
    return descriptions[category] || 'Technologies and tools'
}

const getCategoryIcon = (category: string) => {
    const icons: Record<string, string> = {
        'frontend': '🎨',
        'backend': '⚙️',
        'database': '🗄️',
        'devops': '☁️',
        'mobile': '📱'
    }
    return icons[category] || '💻'
}

const getCategoryGradient = (category: string) => {
    const gradients: Record<string, string> = {
        'frontend': 'bg-gradient-to-br from-pink-500 to-rose-500',
        'backend': 'bg-gradient-to-br from-blue-500 to-indigo-500',
        'database': 'bg-gradient-to-br from-yellow-500 to-orange-500',
        'devops': 'bg-gradient-to-br from-purple-500 to-violet-500',
        'mobile': 'bg-gradient-to-br from-green-500 to-teal-500'
    }
    return gradients[category] || 'bg-gradient-to-br from-gray-500 to-gray-600'
}

const submit = () => {
    console.log('Submitting tech stack with data:', form.data())
    console.log('Available technologies:', props.technologies)
    
    form.post(route('company.onboarding.tech'), {
        preserveScroll: true,
        onError: (errors) => {
            console.log('Form errors:', errors)
        },
        onSuccess: () => {
            console.log('Tech stack submitted successfully')
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

/* Technology card animations */
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
        box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.5);
    }
    50% {
        box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.3);
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
    background: linear-gradient(to bottom, #22c55e, #10b981);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #16a34a, #059669);
}

/* Responsive grid adjustments */
@media (max-width: 640px) {
    .grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (min-width: 1280px) {
    .xl\:grid-cols-5 {
        grid-template-columns: repeat(5, minmax(0, 1fr));
    }
}
</style>