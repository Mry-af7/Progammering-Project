<!-- resources/js/Components/Profile/ProfileProgressBar.vue -->
<template>
    <div class="w-full">
        <div class="flex justify-between items-center mb-2">
            <span class="text-sm font-medium text-gray-700">Profile Completion</span>
            <span class="text-sm font-medium text-gray-900">{{ percentage }}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3">
            <div 
                class="h-3 rounded-full transition-all duration-500 ease-out"
                :class="progressBarClass"
                :style="{ width: percentage + '%' }"
            ></div>
        </div>
        <div class="mt-2 text-xs text-gray-500">
            {{ motivationalText }}
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    percentage: {
        type: Number,
        default: 0
    }
})

const progressBarClass = computed(() => {
    if (props.percentage >= 90) return 'bg-green-500'
    if (props.percentage >= 70) return 'bg-blue-500'
    if (props.percentage >= 50) return 'bg-yellow-500'
    return 'bg-red-500'
})

const motivationalText = computed(() => {
    if (props.percentage >= 90) return 'Excellent! Your profile is almost complete.'
    if (props.percentage >= 70) return 'Great progress! You can complete your onboarding now.'
    if (props.percentage >= 50) return 'Good start! Complete a few more sections to unlock all features.'
    return 'Let\'s get started! Complete your profile to personalize your experience.'
})
</script>