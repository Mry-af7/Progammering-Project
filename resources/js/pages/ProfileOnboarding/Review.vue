<template>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-3xl">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Review Your Profile
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Step {{ currentStep }} of 6: Review and complete your profile
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-3xl">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <!-- Progress Bar -->
                <div class="mb-8">
                    <div class="bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" :style="`width: ${(currentStep / 6) * 100}%`"></div>
                    </div>
                </div>

                <div class="space-y-8">
                    <!-- Basic Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <p><span class="font-medium">Name:</span> {{ student.name }}</p>
                            <p><span class="font-medium">Email:</span> {{ student.email }}</p>
                            <p><span class="font-medium">Major:</span> {{ student.major }}</p>
                        </div>
                    </div>

                    <!-- GitHub & Portfolio -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Links</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <p>
                                <span class="font-medium">GitHub:</span> 
                                <span v-if="student.github_link">
                                    <a :href="student.github_link" target="_blank" class="text-blue-600 hover:text-blue-800">{{ student.github_link }}</a>
                                </span>
                                <span v-else class="text-gray-500">Not provided</span>
                            </p>
                            <div v-if="student.portfolios && student.portfolios.length > 0">
                                <span class="font-medium">Portfolio Links:</span>
                                <ul class="mt-2 space-y-1">
                                    <li v-for="portfolio in student.portfolios" :key="portfolio.id" class="ml-4">
                                        <span class="font-medium">{{ portfolio.name }}:</span>
                                        <a :href="portfolio.url" target="_blank" class="text-blue-600 hover:text-blue-800 ml-2">{{ portfolio.url }}</a>
                                    </li>
                                </ul>
                            </div>
                            <p v-else class="text-gray-500">No portfolio links added</p>
                        </div>
                    </div>

                    <!-- Skills -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">IT Skills</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div v-if="student.skills && student.skills.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div v-for="skill in student.skills" :key="skill.id" class="flex justify-between">
                                    <span>{{ skill.name }}</span>
                                    <span class="text-sm text-gray-600 bg-white px-2 py-1 rounded">{{ skill.pivot.proficiency_level }}</span>
                                </div>
                            </div>
                            <p v-else class="text-gray-500">No skills added</p>
                        </div>
                    </div>

                    <!-- Languages -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Languages</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div v-if="student.languages && student.languages.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div v-for="language in student.languages" :key="language.id" class="flex justify-between">
                                    <span>{{ language.name }}</span>
                                    <span class="text-sm text-gray-600 bg-white px-2 py-1 rounded">{{ language.pivot.fluency_level }}</span>
                                </div>
                            </div>
                            <p v-else class="text-gray-500">No languages added</p>
                        </div>
                    </div>

                    <!-- Hobbies -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Hobbies</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div v-if="student.hobbies && student.hobbies.length > 0" class="flex flex-wrap gap-2">
                                <span v-for="hobby in student.hobbies" :key="hobby.id" class="bg-white px-3 py-1 rounded-full text-sm">
                                    {{ hobby.name }}
                                </span>
                            </div>
                            <p v-else class="text-gray-500">No hobbies added</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-4 pt-6">
                        <button
                            type="button"
                            @click="goBack"
                            class="flex-1 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            Back
                        </button>
                        <button
                            type="button"
                            @click="complete"
                            class="flex-1 py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                        >
                            Complete Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { router } from '@inertiajs/vue3'

export default {
    props: {
        student: Object,
        currentStep: Number
    },
    setup(props) {
        const complete = () => {
            router.post(route('profile-onboarding.complete'))
        }

        const goBack = () => {
            router.get(route('profile-onboarding.step', 5))
        }

        return {
            complete,
            goBack
        }
    }
}
</script>