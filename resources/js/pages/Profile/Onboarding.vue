<template>
    <Head title="Complete Your Profile" />
    
    <div class="min-h-screen bg-gradient-to-br from-orange-50 to-red-50 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Complete Your Profile</h1>
                    <span class="text-sm text-gray-600 dark:text-gray-400">Step {{ currentStep }} of {{ totalSteps }}</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 h-2 rounded-full transition-all duration-300" 
                         :style="{ width: (currentStep / totalSteps) * 100 + '%' }">
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 border border-gray-200 dark:border-gray-700">
                <!-- Step 1: Basic Information -->
                <div v-if="currentStep === 1" class="space-y-6">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-4">
                            👋
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Welcome! Let's get to know you</h2>
                        <p class="text-gray-600 dark:text-gray-400">Tell us about yourself to personalize your experience</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">First Name *</label>
                            <input v-model="profileData.first_name" type="text" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Last Name *</label>
                            <input v-model="profileData.last_name" type="text" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number</label>
                            <input v-model="profileData.phone" type="tel" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Location</label>
                            <input v-model="profileData.location" type="text" placeholder="City, Country" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Step 2: Education -->
                <div v-else-if="currentStep === 2" class="space-y-6">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-4">
                            🎓
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Education Background</h2>
                        <p class="text-gray-600 dark:text-gray-400">Tell us about your academic journey</p>
                    </div>

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Major/Field of Study *</label>
                                <input v-model="profileData.major" type="text" placeholder="e.g., Computer Science" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Specialization</label>
                                <input v-model="profileData.specialization" type="text" placeholder="e.g., Software Engineering" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Education Entries -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Educational Institutions</h3>
                            <div v-for="(education, index) in profileData.education" :key="index" class="p-4 border border-gray-200 dark:border-gray-600 rounded-lg">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Degree/Certificate</label>
                                        <input v-model="education.degree" type="text" placeholder="Bachelor's in..." class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Institution</label>
                                        <input v-model="education.institution" type="text" placeholder="University name" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                                    </div>
                                    <div class="flex items-end space-x-2">
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Years</label>
                                            <input v-model="education.year_range" type="text" placeholder="2020-2024" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                                        </div>
                                        <button @click="removeEducation(index)" class="px-3 py-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg">🗑️</button>
                                    </div>
                                </div>
                            </div>
                            <button @click="addEducation" class="w-full py-3 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-gray-600 dark:text-gray-400 hover:border-blue-500 hover:text-blue-500 transition-colors">
                                + Add Education
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Technical Skills -->
                <div v-else-if="currentStep === 3" class="space-y-6">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-violet-500 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-4">
                            ⚡
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Technical Skills</h2>
                        <p class="text-gray-600 dark:text-gray-400">What technologies do you work with?</p>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Add Skills</label>
                            <div class="flex space-x-2">
                                <input v-model="newSkill" @keyup.enter="addSkill" type="text" placeholder="e.g., JavaScript, Python, React..." class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <button @click="addSkill" class="px-6 py-3 bg-gradient-to-r from-purple-500 to-violet-500 text-white rounded-lg font-medium hover:shadow-lg transition-shadow">
                                    Add
                                </button>
                            </div>
                        </div>

                        <!-- Skills Display -->
                        <div v-if="profileData.technical_skills.length > 0">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Your Skills</h3>
                            <div class="flex flex-wrap gap-3">
                                <div v-for="(skill, index) in profileData.technical_skills" :key="index" 
                                     class="flex items-center space-x-2 px-4 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-200 rounded-full">
                                    <span>{{ skill.name }}</span>
                                    <button @click="togglePrimarySkill(index)" :class="[
                                        'text-xs px-2 py-1 rounded-full border transition-colors',
                                        skill.is_primary 
                                            ? 'bg-orange-500 text-white border-orange-500' 
                                            : 'bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-400 border-gray-300 dark:border-gray-600 hover:border-orange-500'
                                    ]">
                                        {{ skill.is_primary ? 'Primary' : 'Mark Primary' }}
                                    </button>
                                    <button @click="removeSkill(index)" class="text-red-500 hover:text-red-700 ml-2">×</button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Mark your strongest skills as "Primary"</p>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Languages -->
                <div v-else-if="currentStep === 4" class="space-y-6">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-4">
                            🌍
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Languages</h2>
                        <p class="text-gray-600 dark:text-gray-400">What languages do you speak?</p>
                    </div>

                    <div class="space-y-4">
                        <div v-for="(language, index) in profileData.languages" :key="index" class="p-4 border border-gray-200 dark:border-gray-600 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Language</label>
                                    <input v-model="language.name" type="text" placeholder="English, French..." class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Flag Emoji</label>
                                    <input v-model="language.flag" type="text" placeholder="🇺🇸" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Proficiency</label>
                                    <select v-model="language.proficiency" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                                        <option>Beginner</option>
                                        <option>Intermediate</option>
                                        <option>Advanced</option>
                                        <option>Fluent</option>
                                        <option>Native</option>
                                    </select>
                                </div>
                                <button @click="removeLanguage(index)" class="px-3 py-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg">🗑️</button>
                            </div>
                        </div>
                        <button @click="addLanguage" class="w-full py-3 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-gray-600 dark:text-gray-400 hover:border-green-500 hover:text-green-500 transition-colors">
                            + Add Language
                        </button>
                    </div>
                </div>

                <!-- Step 5: Hobbies & Interests -->
                <div v-else-if="currentStep === 5" class="space-y-6">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-rose-500 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-4">
                            🎨
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Interests & Hobbies</h2>
                        <p class="text-gray-600 dark:text-gray-400">What do you enjoy doing in your free time?</p>
                    </div>

                    <div class="space-y-4">
                        <div v-for="(hobby, index) in profileData.hobbies" :key="index" class="p-4 border border-gray-200 dark:border-gray-600 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Hobby/Interest</label>
                                    <input v-model="hobby.name" type="text" placeholder="Photography, Gaming..." class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Icon Emoji</label>
                                    <input v-model="hobby.icon" type="text" placeholder="📸 🎮 🏃" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                                </div>
                                <button @click="removeHobby(index)" class="px-3 py-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg">🗑️</button>
                            </div>
                        </div>
                        <button @click="addHobby" class="w-full py-3 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-gray-600 dark:text-gray-400 hover:border-pink-500 hover:text-pink-500 transition-colors">
                            + Add Hobby
                        </button>
                    </div>
                </div>

                <!-- Step 6: GitHub & Portfolio -->
                <div v-else-if="currentStep === 6" class="space-y-6">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-gray-700 to-gray-900 rounded-full flex items-center justify-center text-white text-2xl mx-auto mb-4">
                            💼
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Portfolio & GitHub</h2>
                        <p class="text-gray-600 dark:text-gray-400">Showcase your work and coding activity</p>
                    </div>

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">GitHub Username</label>
                                <input v-model="profileData.github_username" type="text" placeholder="your-username" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Number of Projects</label>
                                <input v-model.number="profileData.projects_count" type="number" min="0" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Portfolio Projects -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Featured Projects (Optional)</h3>
                            <div v-for="(project, index) in profileData.portfolio" :key="index" class="p-4 border border-gray-200 dark:border-gray-600 rounded-lg">
                                <div class="space-y-3">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Project Name</label>
                                            <input v-model="project.name" type="text" placeholder="My Awesome App" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                                        </div>
                                        <div class="flex items-end">
                                            <button @click="removeProject(index)" class="px-3 py-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg ml-auto">🗑️</button>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Technologies Used</label>
                                        <input v-model="project.technologies" type="text" placeholder="React, Node.js, MongoDB" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                                        <textarea v-model="project.description" rows="2" placeholder="Brief description of your project..." class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white text-sm"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button @click="addProject" class="w-full py-3 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-gray-600 dark:text-gray-400 hover:border-gray-500 hover:text-gray-700 transition-colors">
                                + Add Project
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between pt-8 border-t border-gray-200 dark:border-gray-700">
                    <button 
                        v-if="currentStep > 1"
                        @click="previousStep" 
                        class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                    >
                        Previous
                    </button>
                    <div v-else></div>
                    
                    <button 
                        v-if="currentStep < totalSteps"
                        @click="nextStep"
                        :disabled="!canProceed"
                        :class="[
                            'px-6 py-3 rounded-lg font-medium transition-all',
                            canProceed 
                                ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white hover:shadow-lg' 
                                : 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 cursor-not-allowed'
                        ]"
                    >
                        Next Step
                    </button>
                    <button 
                        v-else
                        @click="completeProfile"
                        :disabled="!canProceed"
                        :class="[
                            'px-8 py-3 rounded-lg font-medium transition-all',
                            canProceed 
                                ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white hover:shadow-lg' 
                                : 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 cursor-not-allowed'
                        ]"
                    >
                        Complete Profile
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { Head } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'

const currentStep = ref(1)
const totalSteps = 6
const newSkill = ref('')

const profileData = ref({
    first_name: '',
    last_name: '',
    phone: '',
    location: '',
    major: '',
    specialization: '',
    github_username: '',
    projects_count: 0,
    
    education: [
        { degree: '', institution: '', year_range: '' }
    ],
    
    technical_skills: [] as Array<{name: string, is_primary: boolean}>,
    
    languages: [
        { name: '', flag: '', proficiency: 'Intermediate' }
    ],
    
    hobbies: [
        { name: '', icon: '' }
    ],
    
    portfolio: [] as Array<{name: string, technologies: string, description: string}>
})

const canProceed = computed(() => {
    switch (currentStep.value) {
        case 1:
            return profileData.value.first_name.length > 0 && profileData.value.last_name.length > 0
        case 2:
            return profileData.value.major.length > 0
        case 3:
            return profileData.value.technical_skills.length > 0
        case 4:
            return profileData.value.languages.every(lang => lang.name.length > 0)
        case 5:
            return profileData.value.hobbies.every(hobby => hobby.name.length > 0)
        case 6:
            return true // Optional step
        default:
            return true
    }
})

const nextStep = () => {
    if (canProceed.value && currentStep.value < totalSteps) {
        currentStep.value++
    }
}

const previousStep = () => {
    if (currentStep.value > 1) {
        currentStep.value--
    }
}

// Skills management
const addSkill = () => {
    if (newSkill.value.trim()) {
        profileData.value.technical_skills.push({
            name: newSkill.value.trim(),
            is_primary: false
        })
        newSkill.value = ''
    }
}

const removeSkill = (index: number) => {
    profileData.value.technical_skills.splice(index, 1)
}

const togglePrimarySkill = (index: number) => {
    profileData.value.technical_skills[index].is_primary = !profileData.value.technical_skills[index].is_primary
}

// Education management
const addEducation = () => {
    profileData.value.education.push({ degree: '', institution: '', year_range: '' })
}

const removeEducation = (index: number) => {
    if (profileData.value.education.length > 1) {
        profileData.value.education.splice(index, 1)
    }
}

// Language management
const addLanguage = () => {
    profileData.value.languages.push({ name: '', flag: '', proficiency: 'Intermediate' })
}

const removeLanguage = (index: number) => {
    if (profileData.value.languages.length > 1) {
        profileData.value.languages.splice(index, 1)
    }
}

// Hobby management
const addHobby = () => {
    profileData.value.hobbies.push({ name: '', icon: '' })
}

const removeHobby = (index: number) => {
    if (profileData.value.hobbies.length > 1) {
        profileData.value.hobbies.splice(index, 1)
    }
}

// Project management
const addProject = () => {
    profileData.value.portfolio.push({ name: '', technologies: '', description: '' })
}

const removeProject = (index: number) => {
    profileData.value.portfolio.splice(index, 1)
}

const completeProfile = () => {
    // Clean up empty entries
    profileData.value.education = profileData.value.education.filter(edu => edu.degree || edu.institution)
    profileData.value.languages = profileData.value.languages.filter(lang => lang.name)
    profileData.value.hobbies = profileData.value.hobbies.filter(hobby => hobby.name)
    profileData.value.portfolio = profileData.value.portfolio.filter(project => project.name)
    
    console.log('Submitting profile data:', profileData.value)
    
    // Submit to Laravel backend - FIXED URL
    router.post('/profile/onboarding', profileData.value, {
    })
}
</script>