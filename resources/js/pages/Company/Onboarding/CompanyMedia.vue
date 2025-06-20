<template>
    <Head title="Company Onboarding - Media & Branding" />
    
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-slate-900 dark:to-indigo-950">
        <!-- Header -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-700/50">
            <div class="max-w-4xl mx-auto px-6 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center text-white text-xl shadow-lg">
                            📸
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Media & Branding</h1>
                            <p class="text-gray-600 dark:text-gray-400">Step {{ currentStep }} of {{ totalSteps }}: Showcase your company</p>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="flex items-center space-x-4">
                        <div class="w-48 h-3 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-pink-500 to-rose-500 rounded-full transition-all duration-500"
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
                <!-- Company Logo -->
                <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl p-8 border border-gray-200/50 dark:border-gray-700/50 shadow-xl">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center text-white text-lg shadow-lg">
                            🎨
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Company Logo</h2>
                            <p class="text-gray-600 dark:text-gray-400">Your brand identity</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Logo URL Input -->
                        <div>
                            <label for="logo_url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Logo URL
                            </label>
                            <input
                                id="logo_url"
                                v-model="form.logo_url"
                                type="url"
                                class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                placeholder="https://example.com/logo.png"
                            />
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Upload your logo to a hosting service and paste the URL here
                            </p>
                            <div v-if="errors.logo_url" class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ errors.logo_url }}
                            </div>
                        </div>

                        <!-- Logo Preview -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Logo Preview
                            </label>
                            <div class="w-full h-32 bg-gray-100 dark:bg-gray-700 rounded-2xl border-2 border-dashed border-gray-300 dark:border-gray-600 flex items-center justify-center">
                                <div v-if="form.logo_url" class="max-w-full max-h-full">
                                    <img 
                                        :src="form.logo_url" 
                                        alt="Company Logo"
                                        class="max-w-full max-h-full object-contain rounded-lg"
                                        @error="logoError = true"
                                    />
                                </div>
                                <div v-else class="text-center">
                                    <div class="w-12 h-12 bg-gray-300 dark:bg-gray-600 rounded-xl mx-auto mb-2 flex items-center justify-center text-gray-500 text-xl">
                                        🖼️
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Logo preview will appear here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cover Image & Video -->
                <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl p-8 border border-gray-200/50 dark:border-gray-700/50 shadow-xl">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-violet-500 rounded-2xl flex items-center justify-center text-white text-lg shadow-lg">
                            🎬
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Cover Media</h2>
                            <p class="text-gray-600 dark:text-gray-400">Hero image and company video</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Cover Image -->
                        <div>
                            <label for="cover_image_url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Cover Image URL
                            </label>
                            <input
                                id="cover_image_url"
                                v-model="form.cover_image_url"
                                type="url"
                                class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                placeholder="https://example.com/cover-image.jpg"
                            />
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                A wide banner image that represents your company (recommended: 1200x400px)
                            </p>
                        </div>

                        <!-- Cover Image Preview -->
                        <div v-if="form.cover_image_url" class="w-full h-48 bg-gray-100 dark:bg-gray-700 rounded-2xl overflow-hidden">
                            <img 
                                :src="form.cover_image_url" 
                                alt="Cover Image"
                                class="w-full h-full object-cover"
                            />
                        </div>

                        <!-- Company Video -->
                        <div>
                            <label for="video_url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Company Video URL
                            </label>
                            <input
                                id="video_url"
                                v-model="form.video_url"
                                type="url"
                                class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                placeholder="https://youtube.com/watch?v=... or https://vimeo.com/..."
                            />
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                A video showcasing your company culture, office, or mission (YouTube, Vimeo, etc.)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Office Photos -->
                <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl rounded-3xl p-8 border border-gray-200/50 dark:border-gray-700/50 shadow-xl">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center text-white text-lg shadow-lg">
                            🏢
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Office Photos</h2>
                            <p class="text-gray-600 dark:text-gray-400">Show your workspace and team (optional)</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Office Photo Inputs -->
                        <div v-for="(photo, index) in form.office_photos" :key="index" class="flex items-center space-x-4">
                            <div class="flex-1">
                                <input
                                    v-model="form.office_photos[index]"
                                    type="url"
                                    class="w-full px-4 py-3 bg-white/80 dark:bg-gray-700/80 border border-gray-300 dark:border-gray-600 rounded-2xl focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                    :placeholder="`Office photo ${index + 1} URL`"
                                />
                            </div>
                            <button
                                type="button"
                                @click="removePhoto(index)"
                                class="w-10 h-10 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-xl hover:bg-red-200 dark:hover:bg-red-900/50 transition-colors duration-200 flex items-center justify-center"
                            >
                                ×
                            </button>
                        </div>

                        <!-- Add Photo Button -->
                        <button
                            type="button"
                            @click="addPhoto"
                            :disabled="form.office_photos.length >= 5"
                            class="w-full py-3 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl text-gray-600 dark:text-gray-400 hover:border-green-500 hover:text-green-600 dark:hover:text-green-400 transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            + Add Office Photo ({{ form.office_photos.length }}/5)
                        </button>

                        <!-- Photo Gallery Preview -->
                        <div v-if="validPhotos.length > 0" class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-6">
                            <div
                                v-for="(photo, index) in validPhotos"
                                :key="index"
                                class="aspect-square bg-gray-100 dark:bg-gray-700 rounded-xl overflow-hidden"
                            >
                                <img 
                                    :src="photo" 
                                    :alt="`Office photo ${index + 1}`"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tips Section -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-3xl p-6 border border-blue-200 dark:border-blue-700">
                    <div class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-blue-500 rounded-xl flex items-center justify-center text-white text-sm flex-shrink-0">
                            💡
                        </div>
                        <div>
                            <h3 class="font-semibold text-blue-900 dark:text-blue-200 mb-2">Media Tips</h3>
                            <ul class="text-sm text-blue-800 dark:text-blue-300 space-y-1">
                                <li>• Use high-quality images that represent your company culture</li>
                                <li>• Logo should be clear and visible on both light and dark backgrounds</li>
                                <li>• Cover image should be professional and engaging</li>
                                <li>• Office photos help candidates visualize working at your company</li>
                                <li>• All media is optional but highly recommended for better engagement</li>
                            </ul>
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
                        class="flex items-center px-8 py-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white font-semibold rounded-2xl hover:shadow-xl hover:scale-105 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span v-if="processing">Saving...</span>
                        <span v-else>Continue to Review</span>
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
import { computed, ref } from 'vue'

interface Props {
    user: any
    company: any
    currentStep: number
    totalSteps: number
    errors: Record<string, string>
}

const props = defineProps<Props>()

const logoError = ref(false)

const form = useForm({
    logo_url: props.company?.logo_url || '',
    cover_image_url: props.company?.cover_image_url || '',
    video_url: props.company?.video_url || '',
    office_photos: props.company?.office_photos || [''],
})

const addPhoto = () => {
    if (form.office_photos.length < 5) {
        form.office_photos.push('')
    }
}

const removePhoto = (index: number) => {
    form.office_photos.splice(index, 1)
    if (form.office_photos.length === 0) {
        form.office_photos.push('')
    }
}

const validPhotos = computed(() => {
    return form.office_photos.filter((photo: string) => photo && photo.trim() !== '')
})

const submit = () => {
    console.log('Submitting media with data:', form.data())
    
    // Clean up empty photo URLs before submitting
    form.office_photos = form.office_photos.filter((photo: string) => photo && photo.trim() !== '')
    
    form.post(route('company.onboarding.media'), {
        preserveScroll: true,
        onError: (errors) => {
            console.log('Form errors:', errors)
        },
        onSuccess: () => {
            console.log('Media submitted successfully')
        }
    })
}

const processing = computed(() => form.processing)
</script>

<style scoped>
/* Image loading animations */
img {
    transition: opacity 0.3s ease;
}

/* Enhanced form styling */
input:focus {
    box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.1);
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
    background: linear-gradient(to bottom, #ec4899, #f43f5e);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #db2777, #e11d48);
}
</style>