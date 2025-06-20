<!-- resources/js/Pages/Profile/Complete.vue -->
<template>
    <AppLayout title="Complete Your Profile">
        <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Complete Your Profile</h1>
                    <p class="mt-2 text-lg text-gray-600">
                        Help us personalize your experience by completing your profile
                    </p>
                </div>

                <!-- Progress Bar -->
                <ProfileProgressBar 
                    :percentage="completionPercentage" 
                    class="mb-8"
                />

                <!-- Profile Sections -->
                <div class="space-y-6">
                    <!-- Personal Information -->
                    <ProfileSection
                        title="Personal Information"
                        :completed="!incompleteSections.personal_info"
                        :required="true"
                        :weight="25"
                    >
                        <PersonalInfoForm
                            :student="student"
                            @updated="handleSectionUpdate"
                            @loading="setLoading"
                        />
                    </ProfileSection>

                    <!-- Emergency Contact -->
                    <ProfileSection
                        title="Emergency Contact"
                        :completed="!incompleteSections.emergency_contact"
                        :required="true"
                        :weight="20"
                    >
                        <EmergencyContactForm
                            :student="student"
                            @updated="handleSectionUpdate"
                            @loading="setLoading"
                        />
                    </ProfileSection>

                    <!-- Academic Information -->
                    <ProfileSection
                        title="Academic Information"
                        :completed="!incompleteSections.academic_info"
                        :required="true"
                        :weight="25"
                    >
                        <AcademicInfoForm
                            :student="student"
                            :academic-programs="academicPrograms"
                            :academic-years="academicYears"
                            @updated="handleSectionUpdate"
                            @loading="setLoading"
                        />
                    </ProfileSection>

                    <!-- Preferences -->
                    <ProfileSection
                        title="Communication Preferences"
                        :completed="!incompleteSections.preferences"
                        :required="false"
                        :weight="15"
                    >
                        <PreferencesForm
                            :student="student"
                            @updated="handleSectionUpdate"
                            @loading="setLoading"
                        />
                    </ProfileSection>

                    <!-- Additional Information -->
                    <ProfileSection
                        title="Additional Information"
                        :completed="!incompleteSections.additional_info"
                        :required="false"
                        :weight="15"
                    >
                        <AdditionalInfoForm
                            :student="student"
                            @updated="handleSectionUpdate"
                            @loading="setLoading"
                        />
                    </ProfileSection>
                </div>

                <!-- Complete Button -->
                <div class="mt-8 text-center" v-if="completionPercentage >= 70">
                    <button
                        @click="completeOnboarding"
                        :disabled="loading"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span v-if="!loading">Complete Profile & Continue</span>
                        <span v-else class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Processing...
                        </span>
                    </button>
                </div>

                <!-- Skip Option (if completion >= 50%) -->
                <div class="mt-4 text-center" v-if="completionPercentage >= 50 && completionPercentage < 70">
                    <Link
                        :href="route('dashboard')"
                        class="text-sm text-gray-500 hover:text-gray-700"
                    >
                        Skip for now (you can complete this later)
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router, Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import ProfileProgressBar from '@/Components/Profile/ProfileProgressBar.vue'
import ProfileSection from '@/Components/Profile/ProfileSection.vue'
import PersonalInfoForm from '@/Components/Profile/PersonalInfoForm.vue'
import EmergencyContactForm from '@/Components/Profile/EmergencyContactForm.vue'
import AcademicInfoForm from '@/Components/Profile/AcademicInfoForm.vue'
import PreferencesForm from '@/Components/Profile/PreferencesForm.vue'
import AdditionalInfoForm from '@/Components/Profile/AdditionalInfoForm.vue'

const props = defineProps({
    student: Object,
    incompleteSections: Object,
    completionPercentage: Number,
    academicPrograms: Array,
    academicYears: Array
})

const loading = ref(false)
const completionPercentage = ref(props.completionPercentage)
const incompleteSections = ref(props.incompleteSections)

const setLoading = (state) => {
    loading.value = state
}

const handleSectionUpdate = (data) => {
    completionPercentage.value = data.completion_percentage
    
    // Refresh incomplete sections by removing completed ones
    if (data.section) {
        delete incompleteSections.value[data.section]
    }
}

const completeOnboarding = async () => {
    loading.value = true
    
    try {
        const response = await axios.post(route('profile.complete-onboarding'))
        
        if (response.data.success) {
            router.visit(route('dashboard'), {
                onSuccess: () => {
                    // Show success message
                    console.log('Profile completed successfully!')
                }
            })
        }
    } catch (error) {
        console.error('Error completing onboarding:', error)
    } finally {
        loading.value = false
    }
}
</script>