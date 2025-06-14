<template>
    <div class="min-h-screen bg-orange-50">
        <Head title="Afspraak maken" />
        
        <!-- Navigation -->
        <nav class="bg-orange-50/90 backdrop-blur-sm shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <Link href="/" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-lg">E</span>
                        </div>
                        <div>
                            <div class="text-gray-900 font-bold text-xl">erasmus</div>
                            <div class="text-xs text-gray-600 -mt-1">HOGESCHOOL BRUSSEL</div>
                        </div>
                    </Link>
                    
                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-gray-700 hover:bg-orange-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Desktop Navigation Links -->
                    <div class="hidden md:flex items-center space-x-1">
                        <Link href="/" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Home</Link>
                        <Link href="/info" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Info</Link>
                        <Link href="/afspraak" class="px-4 py-2 text-orange-600 bg-orange-100 rounded-lg font-medium transition-colors">Afspraak</Link>
                        <Link href="/favorieten" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Favorieten</Link>
                        <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Contact</Link>
                        
                        <div class="flex items-center ml-6">
                            <Link v-if="!$page.props.auth.user" href="/login" class="px-6 py-2 text-orange-600 hover:text-orange-700 font-medium transition-colors">Inloggen</Link>
                            <div v-else class="flex items-center space-x-4">
                                <span class="text-sm text-gray-600">Welkom, {{ $page.props.auth.user.firstname }}!</span>
                                <Link href="/dashboard" class="px-4 py-2 text-orange-600 hover:text-orange-700 font-medium transition-colors">Dashboard</Link>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile menu -->
                <div v-show="mobileMenuOpen" class="md:hidden mt-4 pb-4 border-t border-orange-200">
                    <div class="flex flex-col space-y-2 pt-4">
                        <Link href="/" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Home</Link>
                        <Link href="/info" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Info</Link>
                        <Link href="/afspraak" class="px-4 py-2 text-orange-600 font-medium">Afspraak</Link>
                        <Link href="/favorieten" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Favorieten</Link>
                        <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Contact</Link>
                        <Link v-if="!$page.props.auth.user" href="/login" class="px-4 py-2 text-orange-600 hover:text-orange-700 font-medium">Inloggen</Link>
                        <Link v-else href="/dashboard" class="px-4 py-2 text-orange-600 hover:text-orange-700 font-medium">Dashboard</Link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Header Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center mb-12">
                <div class="mb-6">
                    <span class="bg-orange-100 text-orange-700 px-4 py-2 rounded-full text-sm font-semibold">
                        📅 Career Launch 2025 - 25 maart
                    </span>
                </div>
                
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    Afspraak maken
                </h1>
                
                <p class="text-gray-600 text-xl mb-8 max-w-3xl mx-auto leading-relaxed">
                    Plan een persoonlijke speeddate met jouw droombedrijf om je carrière te versnellen.
                </p>

                <!-- Auth Check Warning -->
                <div v-if="!$page.props.auth.user" class="max-w-md mx-auto mb-8 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 text-yellow-600 mt-0.5">⚠️</div>
                        <div class="text-left">
                            <p class="text-yellow-800 font-medium text-sm mb-1">Inloggen vereist</p>
                            <p class="text-yellow-700 text-sm">Je moet ingelogd zijn om een afspraak te maken.</p>
                            <Link href="/login" class="inline-block mt-2 text-yellow-800 hover:text-yellow-900 font-medium text-sm underline">
                                Nu inloggen →
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Left Column - Form -->
                <div class="lg:col-span-2">
                    <AppointmentForm
                        :companies="companies"
                        :time-slots="timeSlots"
                        @submit="handleSubmit"
                        @bedrijf-change="handleBedrijfChange"
                        @refresh-slots="refreshTimeSlots"
                    />
                </div>

                <!-- Right Column - Info -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-orange-100 p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">ℹ️ Informatie</h3>
                        
                        <div class="space-y-6">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Wat is een speeddate?</h4>
                                <p class="text-gray-600 text-sm">
                                    Een speeddate is een kort gesprek van 15 minuten met een recruiter of HR-manager van een bedrijf. 
                                    Het is een kans om jezelf te presenteren en meer te leren over het bedrijf.
                                </p>
                            </div>

                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Voorbereiding</h4>
                                <ul class="text-gray-600 text-sm space-y-2">
                                    <li class="flex items-start">
                                        <span class="text-orange-500 mr-2">•</span>
                                        Bereid je voor op het gesprek
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-orange-500 mr-2">•</span>
                                        Neem je CV mee
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-orange-500 mr-2">•</span>
                                        Stel relevante vragen
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Locatie</h4>
                                <p class="text-gray-600 text-sm">
                                    De speeddates vinden plaats op de campus van Erasmushogeschool Brussel.
                                    Je ontvangt de exacte locatie na bevestiging van je afspraak.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appointments List -->
            <div class="mt-8" v-if="$page.props.auth.user">
                <AppointmentList />
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import axios from 'axios';
import AppointmentForm from '@/Components/Appointments/AppointmentForm.vue';
import AppointmentList from '@/Components/Appointments/AppointmentList.vue';

const mobileMenuOpen = ref(false);
const companies = ref([]);
const timeSlots = ref([]);

onMounted(async () => {
    await loadCompanies();
    await loadTimeSlots();
});

const loadCompanies = async () => {
    try {
        const response = await fetch('/api/companies');
        companies.value = await response.json();
    } catch (error) {
        console.error('Error loading companies:', error);
    }
};

const loadTimeSlots = async () => {
    try {
        const response = await fetch('/api/time-slots');
        timeSlots.value = await response.json();
    } catch (error) {
        console.error('Error loading time slots:', error);
    }
};

const handleBedrijfChange = async (companyId) => {
    if (companyId) {
        await loadTimeSlots(companyId);
    }
};

const refreshTimeSlots = async () => {
    await loadTimeSlots();
};

const handleSubmit = async (formData) => {
    try {
        const response = await fetch('/api/appointments', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(formData)
        });

        if (response.ok) {
            window.location.href = '/dashboard';
        } else {
            const data = await response.json();
            // Handle validation errors
            console.error('Error creating appointment:', data);
        }
    } catch (error) {
        console.error('Error submitting form:', error);
    }
};
</script>