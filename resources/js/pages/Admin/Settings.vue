<template>
  <div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="px-4 py-6 sm:px-0">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-6">
              <h2 class="text-2xl font-bold text-gray-900">Admin Settings</h2>
              <p class="text-gray-600 mt-1">Manage system configuration and preferences</p>
            </div>

            <form @submit.prevent="updateSettings" class="space-y-6">
              <!-- General Settings -->
              <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">General Settings</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                      Site Name
                    </label>
                    <input
                      v-model="form.site_name"
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                      placeholder="Erasmus Career Platform"
                    />
                  </div>
                  
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                      Site Description
                    </label>
                    <input
                      v-model="form.site_description"
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                      placeholder="Career platform for students and companies"
                    />
                  </div>
                </div>
              </div>

              <!-- System Settings -->
              <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">System Settings</h3>
                
                <div class="space-y-4">
                  <div class="flex items-center justify-between">
                    <div>
                      <label class="text-sm font-medium text-gray-700">Maintenance Mode</label>
                      <p class="text-sm text-gray-500">Enable maintenance mode to restrict access</p>
                    </div>
                    <div class="flex items-center">
                      <input
                        v-model="form.maintenance_mode"
                        type="checkbox"
                        class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded"
                      />
                    </div>
                  </div>
                  
                  <div class="flex items-center justify-between">
                    <div>
                      <label class="text-sm font-medium text-gray-700">Email Notifications</label>
                      <p class="text-sm text-gray-500">Send email notifications for new registrations</p>
                    </div>
                    <div class="flex items-center">
                      <input
                        v-model="form.email_notifications"
                        type="checkbox"
                        class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded"
                      />
                    </div>
                  </div>
                  
                  <div class="flex items-center justify-between">
                    <div>
                      <label class="text-sm font-medium text-gray-700">Auto-approve Companies</label>
                      <p class="text-sm text-gray-500">Automatically approve new company registrations</p>
                    </div>
                    <div class="flex items-center">
                      <input
                        v-model="form.auto_approve_companies"
                        type="checkbox"
                        class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded"
                      />
                    </div>
                  </div>
                </div>
              </div>

              <!-- Security Settings -->
              <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Security Settings</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                      Session Timeout (minutes)
                    </label>
                    <input
                      v-model="form.session_timeout"
                      type="number"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                      placeholder="120"
                    />
                  </div>
                  
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                      Max Login Attempts
                    </label>
                    <input
                      v-model="form.max_login_attempts"
                      type="number"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                      placeholder="5"
                    />
                  </div>
                </div>
              </div>

              <!-- Save Button -->
              <div class="flex justify-end">
                <button
                  type="submit"
                  class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-medium"
                  :disabled="processing"
                >
                  {{ processing ? 'Saving...' : 'Save Settings' }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  settings: {
    type: Object,
    default: () => ({})
  }
})

const processing = ref(false)

const form = reactive({
  site_name: props.settings.site_name || 'Erasmus Career Platform',
  site_description: props.settings.site_description || '',
  maintenance_mode: props.settings.maintenance_mode === 'on',
  email_notifications: props.settings.email_notifications === 'on',
  auto_approve_companies: props.settings.auto_approve_companies === 'on',
  session_timeout: props.settings.session_timeout || 120,
  max_login_attempts: props.settings.max_login_attempts || 5
})

const updateSettings = () => {
  processing.value = true
  
  const formData = {
    ...form,
    maintenance_mode: form.maintenance_mode ? 'on' : 'off',
    email_notifications: form.email_notifications ? 'on' : 'off',
    auto_approve_companies: form.auto_approve_companies ? 'on' : 'off'
  }
  
  router.post(route('admin.settings.update'), formData, {
    onFinish: () => {
      processing.value = false
    }
  })
}
</script> 