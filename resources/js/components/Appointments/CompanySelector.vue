<template>
    <div class="mb-8">
        <label class="block text-sm font-semibold text-gray-900 mb-3">
            Selecteer een bedrijf <span class="text-red-500">*</span>
        </label>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div v-for="company in companies" :key="company.id" 
                 :class="[
                    'border-2 rounded-xl p-4 cursor-pointer transition-all transform hover:scale-105',
                    localValue === company.id 
                        ? 'border-orange-500 bg-orange-50 shadow-lg' 
                        : 'border-gray-200 hover:border-orange-300 hover:bg-orange-50'
                 ]"
                 @click="selectCompany(company)">
                <div class="flex items-center space-x-4">
                    <img :src="`/images/logos/${company.id}-logo.svg`" 
                         :alt="company.name"
                         class="w-12 h-12 object-contain"
                         @error="handleImageError">
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ company.name }}</h3>
                        <p class="text-sm text-gray-600">{{ company.description }}</p>
                    </div>
                </div>
                <div v-if="localValue === company.id" class="mt-2 text-xs text-orange-600 font-medium">
                    ✓ Geselecteerd
                </div>
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
    companies: {
        type: Array,
        default: () => []
    },
    errors: {
        type: Array,
        default: () => []
    }
});

const emit = defineEmits(['update:modelValue']);

const localValue = ref(props.modelValue);

watch(() => props.modelValue, (newValue) => {
    localValue.value = newValue;
});

const selectCompany = (company) => {
    localValue.value = company.id;
    emit('update:modelValue', company.id);
};

const handleImageError = (event) => {
    event.target.src = '/images/logos/default-company-logo.svg';
};
</script> 