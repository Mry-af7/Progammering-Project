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
                            <Link href="/login" class="px-6 py-2 text-orange-600 hover:text-orange-700 font-medium transition-colors">Inloggen</Link>
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
                        <Link href="/login" class="px-4 py-2 text-orange-600 hover:text-orange-700 font-medium">Inloggen</Link>
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
            </div>
        </section>

        <!-- Main Content -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Left Column - Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-orange-100 p-8">
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">📝 Jouw afspraak plannen</h2>
                            <p class="text-gray-600">Vul onderstaande gegevens in om een persoonlijke speeddate in te plannen.</p>
                        </div>

                        <!-- Bedrijf Selection -->
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-900 mb-3">
                                Bedrijf <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select v-model="selectedBedrijf" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors appearance-none bg-white">
                                    <option value="">Selecteer een bedrijf</option>
                                    <option v-for="bedrijf in bedrijven" :key="bedrijf.id" :value="bedrijf.id">
                                        {{ bedrijf.naam }}
                                    </option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Bedrijf Info Card -->
                            <div v-if="selectedBedrijfInfo" class="mt-4 bg-orange-50 rounded-xl p-4 border border-orange-100">
                                <div class="flex items-start space-x-4">
                                    <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-red-500 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                        {{ selectedBedrijfInfo.naam.charAt(0) }}
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-900 mb-1">{{ selectedBedrijfInfo.naam }}</h4>
                                        <p class="text-gray-600 text-sm mb-3">{{ selectedBedrijfInfo.beschrijving }}</p>
                                        <div class="flex flex-wrap gap-2">
                                            <span v-for="tag in selectedBedrijfInfo.tags" :key="tag" class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-medium">
                                                {{ tag }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tijdslot Selection -->
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-900 mb-3">
                                Beschikbare tijdsloten <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                <div v-for="slot in beschikbareTijdslots" :key="slot.id" 
                                     :class="[
                                        'border-2 rounded-xl p-4 cursor-pointer transition-all text-center',
                                        selectedTijdslot === slot.id 
                                            ? 'border-orange-500 bg-orange-50 shadow-lg' 
                                            : slot.beschikbaar 
                                                ? 'border-gray-200 hover:border-orange-300 hover:bg-orange-50' 
                                                : 'border-gray-100 bg-gray-50 cursor-not-allowed opacity-50'
                                     ]"
                                     @click="selectTijdslot(slot.id, slot.beschikbaar)">
                                    <div class="font-semibold text-gray-900 text-sm mb-1">{{ slot.tijd }}</div>
                                    <div class="text-xs text-gray-600">{{ slot.info }}</div>
                                    <div v-if="!slot.beschikbaar" class="text-xs text-red-500 font-medium mt-1">Bezet</div>
                                    <div v-else-if="selectedTijdslot === slot.id" class="text-xs text-orange-600 font-medium mt-1">✓ Geselecteerd</div>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Info -->
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">
                                    Voornaam <span class="text-red-500">*</span>
                                </label>
                                <input type="text" v-model="formData.voornaam" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" 
                                       placeholder="Je voornaam" />
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">
                                    Achternaam <span class="text-red-500">*</span>
                                </label>
                                <input type="text" v-model="formData.achternaam" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" 
                                       placeholder="Je achternaam" />
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">
                                    E-mailadres <span class="text-red-500">*</span>
                                </label>
                                <input type="email" v-model="formData.email" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" 
                                       placeholder="je.email@student.ehb.be" />
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">
                                    Telefoon
                                </label>
                                <input type="tel" v-model="formData.telefoon" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" 
                                       placeholder="+32 xxx xx xx xx" />
                            </div>
                        </div>

                        <!-- Study Program -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Studierichting <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select v-model="formData.studierichting" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors appearance-none bg-white">
                                    <option value="">Selecteer je studierichting</option>
                                    <option v-for="richting in studierichtingen" :key="richting" :value="richting">
                                        {{ richting }}
                                    </option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Notes -->
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Extra informatie
                            </label>
                            <textarea v-model="formData.notities" 
                                      class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors resize-none" 
                                      rows="4"
                                      placeholder="Zijn er specifieke onderwerpen die je wilt bespreken? Heb je vragen over stages, jobs of de bedrijfscultuur?"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button @click="submitAfspraak" 
                                :disabled="!isFormValid || isSubmitting"
                                :class="[
                                    'w-full px-8 py-4 rounded-xl font-semibold text-lg transition-all transform',
                                    isFormValid && !isSubmitting
                                        ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white hover:from-orange-600 hover:to-red-600 hover:shadow-lg hover:scale-105'
                                        : 'bg-gray-300 text-gray-500 cursor-not-allowed'
                                ]">
                            <span v-if="isSubmitting" class="inline-flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Bevestigen...
                            </span>
                            <span v-else class="inline-flex items-center">
                                📅 Afspraak bevestigen
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Right Column - Info -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Tips Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-orange-100 p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            💡 Tips voor je speeddate
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    🎯
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 text-sm">Bereid je voor</div>
                                    <div class="text-gray-600 text-sm">Bekijk de bedrijfswebsite en denk na over vragen die je wilt stellen.</div>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    💼
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 text-sm">Neem je CV mee</div>
                                    <div class="text-gray-600 text-sm">Zorg voor een bijgewerkte versie en een korte pitch over jezelf.</div>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    🤝
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 text-sm">Wees authentiek</div>
                                    <div class="text-gray-600 text-sm">Laat je persoonlijkheid zien en stel oprechte vragen.</div>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    ⏰
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 text-sm">Kom op tijd</div>
                                    <div class="text-gray-600 text-sm">Plan 5-10 minuten extra voor onverwachte vertragingen.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event Info Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-orange-100 p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            📍 Event informatie
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                    📅
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Datum</div>
                                    <div class="text-gray-600">25 maart 2025</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                    📍
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Locatie</div>
                                    <div class="text-gray-600">Erasmushogeschool Brussel<br>Campus Kaai</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                    ⏰
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Duur per gesprek</div>
                                    <div class="text-gray-600">15 minuten</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                    👥
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Max. deelnemers</div>
                                    <div class="text-gray-600">20 per tijdslot</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Card -->
                    <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl p-6 border border-orange-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">💬 Hulp nodig?</h3>
                        <p class="text-gray-600 mb-4">Heb je vragen over het afspraaksysteem of het Career Launch event?</p>
                        <div class="space-y-3">
                            <a href="mailto:careerlaunch@ehb.be" class="flex items-center text-orange-600 hover:text-orange-700 transition-colors">
                                <span class="mr-2">📧</span>
                                <span class="font-medium">careerlaunch@ehb.be</span>
                            </a>
                            <a href="tel:+3226091300" class="flex items-center text-orange-600 hover:text-orange-700 transition-colors">
                                <span class="mr-2">📞</span>
                                <span class="font-medium">+32 2 609 13 00</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Success Modal -->
        <div v-if="showSuccessModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-2xl max-w-md w-full p-6 transform scale-100 transition-transform">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">🎉 Afspraak bevestigd!</h3>
                    <p class="text-gray-600 mb-6">Je afspraak is succesvol ingepland!</p>
                    
                    <div class="bg-gray-50 rounded-xl p-4 mb-6 text-left">
                        <div class="text-sm space-y-2">
                            <div><strong>Bedrijf:</strong> {{ getSelectedBedrijfNaam() }}</div>
                            <div><strong>Tijdstip:</strong> {{ getSelectedTijdslotInfo() }}</div>
                            <div><strong>Naam:</strong> {{ formData.voornaam }} {{ formData.achternaam }}</div>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-6">
                        Een bevestigingsmail wordt verstuurd naar <strong>{{ formData.email }}</strong>
                    </p>
                    
                    <div class="flex space-x-3">
                        <button @click="downloadCalendar" class="flex-1 px-4 py-2 border border-orange-500 text-orange-600 rounded-xl font-medium hover:bg-orange-50 transition-colors">
                            📅 Agenda
                        </button>
                        <button @click="closeSuccessModal" class="flex-1 px-4 py-2 bg-orange-500 text-white rounded-xl font-medium hover:bg-orange-600 transition-colors">
                            Sluiten
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-orange-500 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center">
                                <span class="text-white font-bold text-lg">E</span>
                            </div>
                            <div class="text-white font-bold text-xl">erasmus</div>
                        </div>
                        <p class="text-orange-100 text-sm mb-4">
                            Hogeschool Brussel<br>
                            Connecting talent with opportunity
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">Voor studenten</h4>
                        <ul class="space-y-2 text-orange-100 text-sm">
                            <li><Link href="/register?type=student" class="hover:text-white transition-colors">Maak je profiel</Link></li>
                            <li><Link href="/info" class="hover:text-white transition-colors">Career Launch Info</Link></li>
                            <li><Link href="/afspraak" class="hover:text-white transition-colors">Speeddate plannen</Link></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">Voor bedrijven</h4>
                        <ul class="space-y-2 text-orange-100 text-sm">
                            <li><Link href="/companies" class="hover:text-white transition-colors">Browse studenten</Link></li>
                            <li><Link href="/contact" class="hover:text-white transition-colors">Partnership</Link></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">Support</h4>
                        <ul class="space-y-2 text-orange-100 text-sm">
                            <li><Link href="/contact" class="hover:text-white transition-colors">Contact</Link></li>
                            <li><Link href="/privacy" class="hover:text-white transition-colors">Privacy beleid</Link></li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-orange-400 mt-12 pt-8 text-center text-orange-100 text-sm">
                    <p>&copy; 2025 Erasmus Hogeschool Brussel. Alle rechten voorbehouden.</p>
                </div>
            </div>
        </footer>

        <!-- Toast Notification -->
        <div v-if="toast.show" :class="[
            'fixed top-4 right-4 max-w-sm w-full bg-white rounded-xl shadow-lg border-l-4 p-4 z-50 transform transition-all duration-300',
            toast.type === 'success' ? 'border-green-500' : toast.type === 'error' ? 'border-red-500' : 'border-blue-500'
        ]">
            <div class="flex items-center">
                <span class="text-2xl mr-3">{{ toast.icon }}</span>
                <div class="flex-1">
                    <p class="text-gray-900 font-medium">{{ toast.message }}</p>
                </div>
                <button @click="hideToast" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

const mobileMenuOpen = ref(false)
const selectedBedrijf = ref('')
const selectedTijdslot = ref('')
const isSubmitting = ref(false)
const showSuccessModal = ref(false)
const toast = ref({ show: false, message: '', type: 'info', icon: 'ℹ️' })

const formData = ref({
    voornaam: '',
    achternaam: '',
    email: '',
    telefoon: '',
    studierichting: '',
    notities: ''
})

const bedrijven = ref([
    {
        id: 'microsoft',
        naam: 'Microsoft Belgium',
        beschrijving: 'Tech giant met focus op cloud computing, AI en enterprise solutions.',
        tags: ['Cloud', 'AI', 'Enterprise']
    },
    {
        id: 'accenture',
        naam: 'Accenture',
        beschrijving: 'Global consultancy diensten in technologie en digitale transformatie.',
        tags: ['Consulting', 'Digital', 'Innovation']
    },
    {
        id: 'deloitte',
        naam: 'Deloitte Digital',
        beschrijving: 'Digitale innovatie en consultancy voor enterprise klanten.',
        tags: ['Digital', 'Strategy', 'Tech']
    },
    {
        id: 'proximus',
        naam: 'Proximus',
        beschrijving: 'Telecom leader met focus op 5G, IoT en digitale services.',
        tags: ['Telecom', '5G', 'IoT']
    },
    {
        id: 'colruyt',
        naam: 'Colruyt Group IT',
        beschrijving: 'Retail technologie en e-commerce innovaties.',
        tags: ['Retail', 'E-commerce', 'Innovation']
    }
])

const beschikbareTijdslots = ref([
    { id: '1', tijd: '09:00 - 09:15', info: '25 maart 2025', beschikbaar: true },
    { id: '2', tijd: '09:20 - 09:35', info: '25 maart 2025', beschikbaar: true },
    { id: '3', tijd: '09:40 - 09:55', info: '25 maart 2025', beschikbaar: false },
    { id: '4', tijd: '10:00 - 10:15', info: '25 maart 2025', beschikbaar: true },
    { id: '5', tijd: '10:20 - 10:35', info: '25 maart 2025', beschikbaar: true },
    { id: '6', tijd: '10:40 - 10:55', info: '25 maart 2025', beschikbaar: false },
    { id: '7', tijd: '11:00 - 11:15', info: '25 maart 2025', beschikbaar: true },
    { id: '8', tijd: '11:20 - 11:35', info: '25 maart 2025', beschikbaar: true },
    { id: '9', tijd: '13:00 - 13:15', info: '25 maart 2025', beschikbaar: true },
    { id: '10', tijd: '13:20 - 13:35', info: '25 maart 2025', beschikbaar: false },
    { id: '11', tijd: '13:40 - 13:55', info: '25 maart 2025', beschikbaar: true },
    { id: '12', tijd: '14:00 - 14:15', info: '25 maart 2025', beschikbaar: true }
])

const studierichtingen = ref([
    'Multimedia & Creatieve Technologie',
    'Toegepaste Informatica',
    'Internet of Things',
    'Industrieel Ingenieur',
    'Grafische en Digitale Media',
    'Anders'
])

const selectedBedrijfInfo = computed(() => {
    return bedrijven.value.find(b => b.id === selectedBedrijf.value)
})

const isFormValid = computed(() => {
    return selectedBedrijf.value && 
           selectedTijdslot.value && 
           formData.value.voornaam.trim() && 
           formData.value.achternaam.trim() && 
           formData.value.email.trim() && 
           formData.value.studierichting
})

function selectTijdslot(slotId, beschikbaar) {
    if (beschikbaar) {
        selectedTijdslot.value = slotId
    }
}

async function submitAfspraak() {
    if (!isFormValid.value) return

    isSubmitting.value = true

    try {
        // Simulate API call
        await new Promise(resolve => setTimeout(resolve, 1500))
        
        showSuccessModal.value = true
        resetForm()
        showToast('Afspraak succesvol ingepland!', 'success', '✅')
    } catch (error) {
        showToast('Er is een fout opgetreden. Probeer opnieuw.', 'error', '❌')
    } finally {
        isSubmitting.value = false
    }
}

function resetForm() {
    selectedBedrijf.value = ''
    selectedTijdslot.value = ''
    formData.value = {
        voornaam: '',
        achternaam: '',
        email: '',
        telefoon: '',
        studierichting: '',
        notities: ''
    }
}

function closeSuccessModal() {
    showSuccessModal.value = false
}

function getSelectedBedrijfNaam() {
    const bedrijf = bedrijven.value.find(b => b.id === selectedBedrijf.value)
    return bedrijf ? bedrijf.naam : ''
}

function getSelectedTijdslotInfo() {
    const slot = beschikbareTijdslots.value.find(s => s.id === selectedTijdslot.value)
    return slot ? `${slot.tijd} - ${slot.info}` : ''
}

function downloadCalendar() {
    const bedrijfNaam = getSelectedBedrijfNaam()
    const tijdInfo = getSelectedTijdslotInfo()
    
    const icsContent = `BEGIN:VCALENDAR
VERSION:2.0
BEGIN:VEVENT
DTSTART:20250325T090000Z
DTEND:20250325T091500Z
SUMMARY:Speeddate met ${bedrijfNaam}
DESCRIPTION:Career Launch 2025 - Persoonlijke speeddate met ${bedrijfNaam}
LOCATION:Erasmushogeschool Brussel, Campus Kaai
END:VEVENT
END:VCALENDAR`
    
    const blob = new Blob([icsContent], { type: 'text/calendar' })
    const url = URL.createObjectURL(blob)
    const link = document.createElement('a')
    link.href = url
    link.download = `speeddate-${bedrijfNaam.toLowerCase().replace(/\s+/g, '-')}.ics`
    link.click()
    URL.revokeObjectURL(url)
}

function showToast(message, type = 'info', icon = 'ℹ️') {
    toast.value = { show: true, message, type, icon }
    setTimeout(() => {
        hideToast()
    }, 4000)
}

function hideToast() {
    toast.value.show = false
}
</script>