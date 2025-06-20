<template>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Your Hobbies
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Step {{ currentStep }} of 6: Add 3 hobbies you enjoy
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <!-- Progress Bar -->
                <div class="mb-8">
                    <div class="bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" :style="`width: ${(currentStep / 6) * 100}%`"></div>
                    </div>
                </div>

                <form @submit.prevent="submit">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-4">
                                Enter 3 hobbies
                            </label>
                            
                            <div class="space-y-3">
                                <div v-for="(hobby, index) in form.hobbies" :key="index">
                                    <input
                                        v-model="form.hobbies[index]"
                                        type="text"
                                        :placeholder="`Hobby ${index + 1}`"
                                        required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    />
                                </div>
                            </div>
                            
                            <div v-if="errors.hobbies" class="mt-2 text-sm text-red-600">{{ errors.hobbies }}</div>
                            
                            <div class="mt-4 p-4 bg-blue-50 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-blue-700">
                                            Examples: Photography, Reading, Gaming, Cooking, Traveling, Sports, Music, Art, etc.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex space-x-4">
                            <button
                                type="button"
                                @click="goBack"
                                class="flex-1 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            >
                                Back
                            </button>
                            <button
                                type="submit"
                                :disabled="!areAllHobbiesFilled"
                                class="flex-1 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:bg-gray-400 disabled:cursor-not-allowed"
                            >
                                Next Step
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import { computed } from 'vue'

export default {
    props: {
        student: Object,
        currentStep: Number,
        errors: Object,
        studentHobbies: Array
    },
    setup(props) {
        const form = useForm({
            hobbies: ['', '', '']
        })

        const areAllHobbiesFilled = computed(() => {
            return form.hobbies.every(hobby => hobby.trim() !== '')
        })

        const submit = () => {
            form.post(route('profile-onboarding.hobbies'))
        }

        const goBack = () => {
            router.get(route('profile-onboarding.step', 4))
        }

        return {
            form,
            areAllHobbiesFilled,
            submit,
            goBack
        }
    }
}
</script>