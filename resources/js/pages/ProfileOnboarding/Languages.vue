<template>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-2xl">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Languages You Speak
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Step {{ currentStep }} of 6: Select languages and fluency levels
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-2xl">
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
                                Select Languages (Select at least one)
                            </label>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div 
                                    v-for="language in languages" 
                                    :key="language.id" 
                                    class="border border-gray-200 rounded-lg p-4"
                                    :class="{ 'border-blue-500 bg-blue-50': isLanguageSelected(language.id) }"
                                >
                                    <div class="flex items-center mb-2">
                                        <input
                                            :id="`language-${language.id}`"
                                            type="checkbox"
                                            :value="language.id"
                                            @change="toggleLanguage(language)"
                                            :checked="isLanguageSelected(language.id)"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                        />
                                        <label :for="`language-${language.id}`" class="ml-2 block text-sm font-medium text-gray-900">
                                            {{ language.name }}
                                        </label>
                                    </div>
                                    
                                    <div v-if="isLanguageSelected(language.id)" class="mt-2">
                                        <select
                                            v-model="getSelectedLanguage(language.id).fluency_level"
                                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        >
                                            <option value="">Select fluency</option>
                                            <option value="Basic">Basic</option>
                                            <option value="Conversational">Conversational</option>
                                            <option value="Business">Business</option>
                                            <option value="Fluent">Fluent</option>
                                            <option value="Native">Native</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div v-if="errors.languages" class="mt-2 text-sm text-red-600">{{ errors.languages }}</div>
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
                                :disabled="form.languages.length === 0"
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

export default {
    props: {
        student: Object,
        currentStep: Number,
        errors: Object,
        languages: Array,
        studentLanguages: Array
    },
    setup(props) {
        const form = useForm({
            languages: []
        })

        const isLanguageSelected = (languageId) => {
            return form.languages.some(language => language.language_id === languageId)
        }

        const getSelectedLanguage = (languageId) => {
            return form.languages.find(language => language.language_id === languageId)
        }

        const toggleLanguage = (language) => {
            const index = form.languages.findIndex(l => l.language_id === language.id)
            
            if (index > -1) {
                form.languages.splice(index, 1)
            } else {
                form.languages.push({
                    language_id: language.id,
                    fluency_level: ''
                })
            }
        }

        const submit = () => {
            // Validate that all selected languages have fluency levels
            const hasIncompleteFluency = form.languages.some(language => !language.fluency_level)
            
            if (hasIncompleteFluency) {
                alert('Please select fluency level for all languages')
                return
            }
            
            form.post(route('profile-onboarding.languages'))
        }

        const goBack = () => {
            router.get(route('profile-onboarding.step', 3))
        }

        return {
            form,
            isLanguageSelected,
            getSelectedLanguage,
            toggleLanguage,
            submit,
            goBack
        }
    }
}
</script>