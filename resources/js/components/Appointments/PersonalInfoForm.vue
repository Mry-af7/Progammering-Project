<template>
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Persoonlijke informatie</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Voornaam -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Voornaam <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       v-model="localData.voornaam"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                       :class="{ 'border-red-300': hasError('voornaam') }"
                       @input="updateData">
                <div v-if="hasError('voornaam')" class="mt-1 text-sm text-red-600">
                    {{ getError('voornaam') }}
                </div>
            </div>

            <!-- Achternaam -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Achternaam <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       v-model="localData.achternaam"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                       :class="{ 'border-red-300': hasError('achternaam') }"
                       @input="updateData">
                <div v-if="hasError('achternaam')" class="mt-1 text-sm text-red-600">
                    {{ getError('achternaam') }}
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    E-mailadres <span class="text-red-500">*</span>
                </label>
                <input type="email" 
                       v-model="localData.email"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                       :class="{ 'border-red-300': hasError('email') }"
                       @input="updateData">
                <div v-if="hasError('email')" class="mt-1 text-sm text-red-600">
                    {{ getError('email') }}
                </div>
            </div>

            <!-- Telefoon -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Telefoonnummer <span class="text-red-500">*</span>
                </label>
                <input type="tel" 
                       v-model="localData.telefoon"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                       :class="{ 'border-red-300': hasError('telefoon') }"
                       @input="updateData">
                <div v-if="hasError('telefoon')" class="mt-1 text-sm text-red-600">
                    {{ getError('telefoon') }}
                </div>
            </div>
        </div>

        <!-- Motivatie -->
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Motivatie <span class="text-red-500">*</span>
            </label>
            <textarea v-model="localData.motivatie"
                      rows="4"
                      class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                      :class="{ 'border-red-300': hasError('motivatie') }"
                      @input="updateData"
                      placeholder="Vertel waarom je interesse hebt in dit bedrijf..."></textarea>
            <div v-if="hasError('motivatie')" class="mt-1 text-sm text-red-600">
                {{ getError('motivatie') }}
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    modelValue: {
        type: Object,
        required: true
    },
    errors: {
        type: Array,
        default: () => []
    }
});

const emit = defineEmits(['update:modelValue']);

const localData = ref({ ...props.modelValue });

watch(() => props.modelValue, (newValue) => {
    localData.value = { ...newValue };
});

const updateData = () => {
    emit('update:modelValue', { ...localData.value });
};

const hasError = (field) => {
    return props.errors.some(error => error.toLowerCase().includes(field.toLowerCase()));
};

const getError = (field) => {
    return props.errors.find(error => error.toLowerCase().includes(field.toLowerCase())) || '';
};
</script> 