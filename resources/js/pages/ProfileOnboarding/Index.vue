<template>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-2xl">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Complete Your Profile
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Step {{ currentStep }} of 6: Basic Information
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
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Full Name *
                            </label>
                            <div class="mt-1">
                                <input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Enter your full name"
                                />
                                <div v-if="errors.name" class="mt-1 text-sm text-red-600">{{ errors.name }}</div>
                            </div>
                        </div>

                        <!-- Major -->
                        <div>
                            <label for="major" class="block text-sm font-medium text-gray-700">
                                Major/Field of Study *
                            </label>
                            <div class="mt-1">
                                <input
                                    id="major"
                                    v-model="form.major"
                                    type="text"
                                    required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="e.g., Computer Science, Web Development"
                                />
                                <div v-if="errors.major" class="mt-1 text-sm text-red-600">{{ errors.major }}</div>
                            </div>
                        </div>

                        <!-- Year of Study -->
                        <div>
                            <label for="year_of_study" class="block text-sm font-medium text-gray-700">
                                Year of Study *
                            </label>
                            <div class="mt-1">
                                <select
                                    id="year_of_study"
                                    v-model="form.year_of_study"
                                    required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                >
                                    <option value="">Select your year</option>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                    <option value="Graduate">Graduate Student</option>
                                    <option value="Bootcamp">Bootcamp Student</option>
                                </select>
                                <div v-if="errors.year_of_study" class="mt-1 text-sm text-red-600">{{ errors.year_of_study }}</div>
                            </div>
                        </div>

                        <!-- About Me -->
                        <div>
                            <label for="about_me" class="block text-sm font-medium text-gray-700">
                                About Me
                            </label>
                            <div class="mt-1 mb-3 p-3 bg-blue-50 rounded-lg border-l-4 border-blue-400">
                                <p class="text-sm text-blue-800 mb-2">💡 <strong>Tips for a great bio:</strong></p>
                                <ul class="text-xs text-blue-700 space-y-1">
                                    <li>• What are you passionate about in tech?</li>
                                    <li>• What are your career goals?</li>
                                </ul>
                            </div>
                            <div class="mt-1">
                                <textarea
                                    id="about_me"
                                    v-model="form.about_me"
                                    rows="4"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Tell recruiters about yourself, your passion for tech, and your career goals..."
                                ></textarea>
                                <div v-if="errors.about_me" class="mt-1 text-sm text-red-600">{{ errors.about_me }}</div>
                            </div>
                        </div>

                        <!-- LinkedIn URL -->
                        <div>
                            <label for="linkedin_url" class="block text-sm font-medium text-gray-700">
                                LinkedIn Profile (Optional)
                            </label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-blue-500 text-sm">🔗</span>
                                </div>
                                <input
                                    id="linkedin_url"
                                    v-model="form.linkedin_url"
                                    type="url"
                                    class="appearance-none block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="https://linkedin.com/in/yourprofile"
                                />
                                <div v-if="errors.linkedin_url" class="mt-1 text-sm text-red-600">{{ errors.linkedin_url }}</div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Highly recommended! Recruiters will use this to contact you.</p>
                        </div>

                        <!-- Custom Professional Link -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="custom_link_title" class="block text-sm font-medium text-gray-700">
                                    Link Title (Optional)
                                </label>
                                <div class="mt-1">
                                    <input
                                        id="custom_link_title"
                                        v-model="form.custom_link_title"
                                        type="text"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="e.g., Personal Website, Twitter"
                                    />
                                    <div v-if="errors.custom_link_title" class="mt-1 text-sm text-red-600">{{ errors.custom_link_title }}</div>
                                </div>
                            </div>
                            <div>
                                <label for="custom_link_url" class="block text-sm font-medium text-gray-700">
                                    Link URL (Optional)
                                </label>
                                <div class="mt-1">
                                    <input
                                        id="custom_link_url"
                                        v-model="form.custom_link_url"
                                        type="url"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="https://yourwebsite.com"
                                    />
                                    <div v-if="errors.custom_link_url" class="mt-1 text-sm text-red-600">{{ errors.custom_link_url }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50"
                            >
                                <span v-if="form.processing">Processing...</span>
                                <span v-else>Next Step</span>
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

export default {
    props: {
        student: Object,
        currentStep: Number,
        errors: Object
    },
    setup(props) {
        const form = useForm({
            name: props.student?.name || '',
            major: props.student?.major || '',
            year_of_study: props.student?.year_of_study || '',
            about_me: props.student?.about_me || '',
            linkedin_url: props.student?.linkedin_url || '',
            custom_link_title: props.student?.custom_link_title || '',
            custom_link_url: props.student?.custom_link_url || ''
        })

        const submit = () => {
            form.post(route('profile-onboarding.basic-info'))
        }

        return {
            form,
            submit
        }
    }
}
</script>