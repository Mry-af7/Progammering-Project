<template>
    <div class="min-h-screen bg-orange-50">
        <Head title="Info" />
        
        <Navigation />
        
        <!-- Main Content -->
        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Page Header -->
            <div class="mb-12">
                <div class="bg-white rounded-3xl p-8 shadow-sm">
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Info</h1>
                    <div class="w-20 h-1 bg-gradient-to-r from-orange-500 to-red-500 rounded-full"></div>
                </div>
            </div>
 
            <!-- Content Section -->
            <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
                <div class="p-8 lg:p-12">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-8 leading-tight">
                        Career Launch 2025: Ontmoet de toekomst van technologie en design!
                    </h2>
                    
                    <div class="prose prose-lg max-w-none">
                        <div class="mb-8">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                                Voor studenten:
                            </h3>
                            
                            <div class="space-y-6 text-gray-600 text-lg leading-relaxed">
                                <p>Op zoek naar een nieuw job om je technische en IT-vaardigheden te versterken? Grijp dan de kans om deel te nemen aan de Career Launch 2025, georganiseerd door het departement Design & Technologie van de Erasmushogeschool Brussel.</p>
                                
                                <p>Op DD-MM-YYYY komen de beste bedrijven samen voor het netwerkevent van de design & technologie opleidingen. Dit is jouw kans om de beste bedrijven uit topopleidingen zoals Multimedia & Creatieve Technologie, Toegepaste Informatica, en Internet of Things te ontmoeten.</p>
                            </div>
                        </div>
                        
                        <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-2xl p-8 mb-8">
                            <h4 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                Waarom je erbij moet zijn:
                            </h4>
                            <ul class="space-y-4 text-gray-600">
                                <li class="flex items-start">
                                    <div class="w-2 h-2 bg-orange-500 rounded-full mt-3 mr-4 flex-shrink-0"></div>
                                    <span>Ontmoet getalenteerde studenten die klaar zijn om jouw bedrijf te versterken.</span>
                                </li>
                                <li class="flex items-start">
                                    <div class="w-2 h-2 bg-orange-500 rounded-full mt-3 mr-4 flex-shrink-0"></div>
                                    <span>Presenteer jouw organisatie aan potentiële stagiairs, bachelorproefpartners en toekomstige medewerkers.</span>
                                </li>
                                <li class="flex items-start">
                                    <div class="w-2 h-2 bg-orange-500 rounded-full mt-3 mr-4 flex-shrink-0"></div>
                                    <span>Breid je netwerk uit en leg waardevolle contacten met de volgende generatie professionals.</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="bg-white border-l-4 border-orange-500 pl-6 py-4">
                            <p class="text-gray-600 text-lg">Mis deze kans zeker niet en zet DD-MM-YYYY alvast in je agenda. Schrijf je hieronder in om op de hoogte te blijven!</p>
                        </div>
                    </div>
 
                    <!-- CTA Section -->
                    <div class="mt-12 text-center">
                        <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl p-8 text-white">
                            <h3 class="text-2xl font-bold mb-4">Klaar om deel te nemen?</h3>
                            <p class="text-orange-100 mb-6">Registreer je nu voor Career Launch 2025</p>
                            <Link href="/register" class="inline-block bg-white text-orange-600 px-8 py-3 rounded-xl font-semibold hover:bg-orange-50 transition-colors">
                                Schrijf je nu in
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </main>
 
        <!-- Footer -->
        <footer class="bg-orange-500 text-white py-16 mt-20">
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
                        <div class="flex space-x-4">
                            <a href="#" class="text-orange-200 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-orange-200 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Contact Section -->
                    <div>
                        <h3 class="font-semibold mb-4">Contact</h3>
                        <ul class="space-y-2 text-orange-100 text-sm">
                            <li>*E-mail</li>
                            <li>*Telefoon</li>
                        </ul>
                    </div>
                    
                    <!-- Hulp Section -->
                    <div>
                        <h3 class="font-semibold mb-4">Hulp</h3>
                        <ul class="space-y-2 text-orange-100 text-sm">
                            <li>*FAQ</li>
                        </ul>
                    </div>
                    
                    <!-- Over Ons Section -->
                    <div>
                        <h3 class="font-semibold mb-4">Over Ons</h3>
                        <ul class="space-y-2 text-orange-100 text-sm">
                            <li>*Wie zijn we?</li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-orange-400 mt-12 pt-8 text-center text-orange-100 text-sm">
                    <p>&copy; 2025 Erasmus Hogeschool Brussel. Alle rechten voorbehouden.</p>
                </div>
            </div>
        </footer>
 
        <!-- Toast -->
        <div v-if="toast.show" :class="['fixed top-4 right-4 bg-white rounded-xl shadow-lg p-4 z-50 flex items-center max-w-sm border-l-4', toast.type === 'success' ? 'border-green-500' : 'border-blue-500']">
            <span class="flex-1">{{ toast.message }}</span>
            <button @click="toast.show = false" class="ml-4 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
</template>
 
<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import Navigation from '@/components/Navigation.vue'
 
const mobileMenuOpen = ref(false)
const toast = ref({ show: false, message: '', type: 'info' })
 
function showToast(message, type = 'info') {
    toast.value = { show: true, message, type }
    setTimeout(() => toast.value.show = false, 3000)
}
</script>
 
