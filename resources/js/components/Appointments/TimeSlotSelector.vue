<template>
    <div class="mb-8">
        <label class="block text-sm font-semibold text-gray-900 mb-3">
            Beschikbare tijdsloten <span class="text-red-500">*</span>
            <button type="button" @click="$emit('refresh')" 
                    class="ml-2 text-orange-600 hover:text-orange-700 text-xs font-normal underline"
                    :disabled="refreshing">
                {{ refreshing ? 'Vernieuwen...' : 'Vernieuwen' }}
            </button>
        </label>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            <div v-for="slot in timeSlots" :key="slot.id" 
                 :class="[
                    'border-2 rounded-xl p-4 cursor-pointer transition-all text-center transform hover:scale-105',
                    localValue === slot.id 
                        ? 'border-orange-500 bg-orange-50 shadow-lg' 
                        : slot.is_available 
                            ? 'border-gray-200 hover:border-orange-300 hover:bg-orange-50' 
                            : 'border-gray-100 bg-gray-50 cursor-not-allowed opacity-50'
                 ]"
                 @click="selectSlot(slot)">
                <div class="font-semibold text-gray-900 text-sm mb-1">{{ formatTime(slot.start_time) }}</div>
                <div class="text-xs text-gray-600">{{ formatDuration(slot) }}</div>
                <div v-if="!slot.is_available" class="text-xs text-red-500 font-medium mt-1">Bezet</div>
                <div v-else-if="localValue === slot.id" class="text-xs text-orange-600 font-medium mt-1">✓ Geselecteerd</div>
            </div>
        </div>
        <div v-if="errors.length" class="mt-2 text-sm text-red-600">
            {{ errors[0] }}
        </div>
    </div>
</template>

<script setup>
import { computed, ref, watch } from 'vue';

const props = defineProps({
    modelValue: {
        type: [String, Number, null],
        default: null
    },
    timeSlots: {
        type: Array,
        default: () => []
    },
    errors: {
        type: Array,
        default: () => []
    },
    refreshing: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['update:modelValue', 'refresh']);

const localValue = ref(props.modelValue);

watch(() => props.modelValue, (newValue) => {
    localValue.value = newValue;
});

const selectSlot = (slot) => {
    if (!slot.is_available) return;
    localValue.value = slot.id;
        emit('update:modelValue', slot.id);
};

const formatTime = (time) => {
    if (!time) return '';
    const date = new Date(time);
    return date.toLocaleTimeString('nl-BE', { hour: '2-digit', minute: '2-digit' });
};

const formatDuration = (slot) => {
    if (!slot.start_time || !slot.end_time) return '';
    const start = new Date(slot.start_time);
    const end = new Date(slot.end_time);
    const duration = Math.round((end - start) / (1000 * 60));
    return `${duration} minuten`;
};
</script> 