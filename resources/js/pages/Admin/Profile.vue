<template>
  <div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="px-4 py-6 sm:px-0">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-6">
              <h2 class="text-2xl font-bold text-gray-900">Admin Profile</h2>
              <p class="text-gray-600 mt-1">Manage your account information and preferences</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
              <!-- Profile Information -->
              <div class="lg:col-span-2">
                <div class="bg-gray-50 p-6 rounded-lg">
                  <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Information</h3>
                  
                  <form @submit.prevent="updateProfile" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                          First Name
                        </label>
                        <input
                          v-model="form.firstname"
                          type="text"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        />
                      </div>
                      
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                          Last Name
                        </label>
                        <input
                          v-model="form.lastname"
                          type="text"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        />
                      </div>
                    </div>
                    
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                      </label>
                      <input
                        v-model="form.email"
                        type="email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                      />
                    </div>
                    
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-2">
                        Bio
                      </label>
                      <textarea
                        v-model="form.bio"
                        rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        placeholder="Tell us about yourself..."
                      ></textarea>
                    </div>
                    
                    <div class="flex justify-end">
                      <button
                        type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-medium"
                        :disabled="processing"
                      >
                        {{ processing ? 'Updating...' : 'Update Profile' }}
                      </button>
                    </div>
                  </form>
                </div>
              </div>

              <!-- Profile Picture -->
              <div>
                <div class="bg-gray-50 p-6 rounded-lg">
                  <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Picture</h3>
                  
                  <div class="text-center">
                    <div class="w-32 h-32 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                      <span class="text-white font-bold text-2xl">{{ getUserInitials() }}</span>
                    </div>
                    
                    <button class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm">
                      Change Photo
                    </button>
                  </div>
                </div>
                
                <!-- Account Stats -->
                <div class="bg-gray-50 p-6 rounded-lg mt-6">
                  <h3 class="text-lg font-medium text-gray-900 mb-4">Account Statistics</h3>
                  
                  <div class="space-y-3">
                    <div class="flex justify-between">
                      <span class="text-sm text-gray-600">Member since</span>
                      <span class="text-sm font-medium text-gray-900">{{ formatDate(user.created_at) }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                      <span class="text-sm text-gray-600">Last login</span>
                      <span class="text-sm font-medium text-gray-900">{{ formatDate(user.last_login_at) }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                      <span class="text-sm text-gray-600">Role</span>
                      <span class="text-sm font-medium text-gray-900">{{ user.role }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'

const props = defineProps({
  user: {
    type: Object,
    default: () => ({})
  }
})

const processing = ref(false)

const form = reactive({
  firstname: props.user.firstname || '',
  lastname: props.user.lastname || '',
  email: props.user.email || '',
  bio: props.user.bio || ''
})

const getUserInitials = () => {
  const first = props.user.firstname?.charAt(0) || ''
  const last = props.user.lastname?.charAt(0) || ''
  return `${first}${last}`.toUpperCase()
}

const formatDate = (date) => {
  if (!date) return 'N/A'
  return new Date(date).toLocaleDateString()
}

const updateProfile = () => {
  processing.value = true
  // Handle profile update logic here
  setTimeout(() => {
    processing.value = false
  }, 1000)
}
</script> 