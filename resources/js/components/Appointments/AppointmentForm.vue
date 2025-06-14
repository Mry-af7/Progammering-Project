<template>
    <div class="bg-white rounded-2xl shadow-sm border border-orange-100 p-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">📝 Jouw afspraak plannen</h2>
            <p class="text-gray-600">Vul onderstaande gegevens in om een persoonlijke speeddate in te plannen.</p>
        </div>

        <!-- Error Alert -->
        <div v-if="formErrors.length > 0" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
            <div class="flex items-start space-x-3">
                <div class="w-6 h-6 text-red-600 mt-0.5">❌</div>
                <div>
                    <h4 class="text-red-800 font-medium mb-2">Er zijn fouten gevonden:</h4>
                    <ul class="text-red-700 text-sm space-y-1">
                        <li v-for="error in formErrors" :key="error">• {{ error }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <form @submit.prevent="submitForm">
            <!-- Bedrijf Selection -->
            <CompanySelector 
                v-model="selectedBedrijf"
                :companies="companies"
                :errors="formErrors"
                @update:modelValue="onBedrijfChange"
            />

            <!-- Tijdslot Selection -->
            <TimeSlotSelector
                v-model="selectedTijdslot"
                :timeSlots="timeSlots"
                :errors="formErrors"
                @refresh="refreshTimeSlots"
                :refreshing="refreshingSlots"
            />

            <!-- Personal Info -->
            <PersonalInfoForm
                v-model="formData"
                :errors="formErrors"
                @update:modelValue="updateFormData"
            />

            <div class="mt-8">
                <button type="submit" 
                        class="w-full bg-orange-600 text-white py-3 px-6 rounded-xl font-semibold hover:bg-orange-700 transition-colors focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                        :disabled="isSubmitting">
                    {{ isSubmitting ? 'Bezig met verwerken...' : 'Afspraak bevestigen' }}
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, defineEmits } from 'vue';
import CompanySelector from './CompanySelector.vue';
import TimeSlotSelector from './TimeSlotSelector.vue';
import PersonalInfoForm from './PersonalInfoForm.vue';

const props = defineProps({
    companies: {
        type: Array,
        required: true
    },
    timeSlots: {
        type: Array,
        required: true
    }
});

const emit = defineEmits(['submit', 'bedrijf-change', 'refresh-slots']);

const selectedBedrijf = ref('');
const selectedTijdslot = ref(null);
const formData = ref({
    voornaam: '',
    achternaam: '',
    email: '',
    telefoon: '',
    motivatie: ''
});
const formErrors = ref([]);
const isSubmitting = ref(false);
const refreshingSlots = ref(false);

const onBedrijfChange = (value) => {
    selectedBedrijf.value = value;
    emit('bedrijf-change', value);
};

const refreshTimeSlots = async () => {
    refreshingSlots.value = true;
    emit('refresh-slots');
    refreshingSlots.value = false;
};

const updateFormData = (data) => {
    formData.value = { ...formData.value, ...data };
};

const submitForm = async () => {
    if (!selectedBedrijf.value || !selectedTijdslot.value) {
        formErrors.value = ['Selecteer een bedrijf en tijdslot'];
        return;
    }

    isSubmitting.value = true;
    formErrors.value = [];

    try {
        const formDataToSubmit = {
            selectedBedrijf: selectedBedrijf.value,
            selectedTijdslot: selectedTijdslot.value,
            formData: formData.value
        };

        emit('submit', formDataToSubmit);
    } catch (error) {
        console.error('Error submitting form:', error);
        formErrors.value = ['Er is een fout opgetreden bij het versturen van het formulier'];
    } finally {
        isSubmitting.value = false;
    }
};
</script> 