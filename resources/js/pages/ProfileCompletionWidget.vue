<!-- resources/js/Components/Profile/ProfileCompletionWidget.vue -->
<template>
    <div v-if="showWidget" class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Profile Completion
                        </dt>
                        <dd class="text-lg font-medium text-gray-900">
                            {{ completionPercentage }}% Complete
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <Link
                    :href="route('profile.complete')"
                    class="font-medium text-indigo-700 hover:text-indigo-900"
                >
                    Complete your profile
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    completionPercentage: Number,
    showWidget: Boolean
})
</script>