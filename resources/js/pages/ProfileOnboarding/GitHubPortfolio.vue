<template>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                GitHub & Portfolio
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Step {{ currentStep }} of 6: Links
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
                            <label for="github_link" class="block text-sm font-medium text-gray-700">
                                GitHub Profile (Optional)
                            </label>
                            <div class="mt-1">
                                <input
                                    id="github_link"
                                    v-model="form.github_link"
                                    type="url"
                                    placeholder="https://github.com/username"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                />
                                <div v-if="errors.github_link" class="mt-1 text-sm text-red-600">{{ errors.github_link }}</div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Portfolio Links (Optional)
                            </label>
                            
                            <div v-for="(portfolio, index) in form.portfolios" :key="index" class="space-y-2 mb-4 p-4 border border-gray-200 rounded-md">
                                <div>
                                    <input
                                        v-model="portfolio.name"
                                        type="text"
                                        placeholder="Portfolio name (e.g., Personal Website)"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    />
                                </div>
                                <div>
                                    <input
                                        v-model="portfolio.url"
                                        type="url"
                                        placeholder="https://your-portfolio.com"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    />
                                </div>
                                <button
                                    type="button"
                                    @click="removePortfolio(index)"
                                    class="text-red-600 text-sm hover:text-red-800"
                                >
                                    Remove
                                </button>
                            </div>

                            <button
                                type="button"
                                @click="addPortfolio"
                                class="w-full mt-2 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            >
                                Add Portfolio Link
                            </button>
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
                                class="flex-1 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
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

export default {
    props: {
        student: Object,
        currentStep: Number,
        errors: Object
    },
    setup(props) {
        const form = useForm({
            github_link: props.student?.github_link || '',
            portfolios: []
        })

        const addPortfolio = () => {
            form.portfolios.push({ name: '', url: '' })
        }

        const removePortfolio = (index) => {
            form.portfolios.splice(index, 1)
        }

        const submit = () => {
            form.post(route('profile-onboarding.github-portfolio'))
        }

        const goBack = () => {
            router.get(route('profile-onboarding'))
        }

        return {
            form,
            addPortfolio,
            removePortfolio,
            submit,
            goBack
        }
    }
}
</script>