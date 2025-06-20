<!-- resources/js/Components/Profile/PersonalInfoForm.vue -->
<template>
    <form @submit.prevent="submitForm" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">
                    Phone Number *
                </label>
                <input
                    id="phone"
                    v-model="form.phone"
                    type="tel"
                    required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    :class="{ 'border-red-300': errors.phone }"
                />
                <p v-if="errors.phone" class="mt-1 text-sm text-red-600">{{ errors.phone }}</p>
            </div>

            <!-- Date of Birth -->
            <div>
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">
                    Date of Birth *
                </label>
                <input
                    id="date_of_birth"
                    v-model="form.date_of_birth"
                    type="date"
                    required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    :class="{ 'border-red-300': errors.date_of_birth }"
                />
                <p v-if="errors.date_of_birth" class="mt-1 text-sm text-red-600">{{ errors.date_of_birth }}</p>
            </div>
        </div>

        <!-- Profile Photo -->
        <div>
            <label class="block text-sm font-medium text-gray-700">
                Profile Photo
            </label>
            <div class="mt-1 flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <img
                        v-if="photoPreview || student.profile_photo"
                        :src="photoPreview || `/storage/${student.profile_photo}`"
                        alt="Profile photo"
                        class="h-16 w-16 rounded-full object-cover"
                    />
                    <div
                        v-else
                        class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center"
                    >
                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <input
                        ref="photoInput"
                        type="file"
                        accept="image/*"
                        @change="handlePhotoChange"
                        class="hidden"
                    />
                    <button
                        type="button"
                        @click="$refs.photoInput.click()"
                        class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        {{ photoPreview || student.profile_photo ? 'Change' : 'Upload' }}
                    </button>
                </div>
            </div>
            <p v-if="errors.profile_photo" class="mt-1 text-sm text-red-600">{{ errors.profile_photo }}</p>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button
                type="submit"
                :disabled="processing"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <span v-if="!processing">Save Personal Information</span>
                <span v-else>Saving...</span>
            </button>
        </div>
    </form>
</template>

<script setup>
import { ref, reactive, watch } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    student: Object
})

const emit = defineEmits(['updated', 'loading'])

const form = reactive({
    phone: props.student.phone || '',
    date_of_birth: props.student.date_of_birth || '',
    profile_photo: null
})

const errors = ref({})
const processing = ref(false)
const photoPreview = ref(null)

const handlePhotoChange = (event) => {
    const file = event.target.files[0]
    if (file) {
        form.profile_photo = file
        
        // Create preview
        const reader = new FileReader()
        reader.onload = (e) => {
            photoPreview.value = e.target.result
        }
        reader.readAsDataURL(file)
    }
}

const submitForm = async () => {
    processing.value = true
    emit('loading', true)
    errors.value = {}

    const formData = new FormData()
    formData.append('phone', form.phone)
    formData.append('date_of_birth', form.date_of_birth)
    
    if (form.profile_photo) {
        formData.append('profile_photo', form.profile_photo)
    }

    try {
        const response = await axios.post(route('profile.personal-info'), formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })

        if (response.data.success) {
            emit('updated', {
                completion_percentage: response.data.completion_percentage,
                section: 'personal_info'
            })
            
            // Show success message
            console.log(response.data.message)
        }
    } catch (error) {
        if (error.response?.status === 422) {
            errors.value = error.response.data.errors
        }
        console.error('Error updating personal info:', error)
    } finally {
        processing.value = false
        emit('loading', false)
    }
}
</script>