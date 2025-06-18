<template>
    <div class="min-h-screen bg-orange-50">
        <Head title="Info - Career Launch 2025" />
        
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-lg">E</span>
                        </div>
                        <div class="font-bold text-xl text-gray-900">erasmus</div>
                        <div class="hidden sm:block text-sm text-gray-500">HOGESCHOOL BRUSSEL</div>
                    </div>
                    
                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-8">
                        <Link href="/" class="text-gray-700 hover:text-orange-600 font-medium transition-colors">Home</Link>
                        <Link href="/info" class="text-orange-600 font-medium border-b-2 border-orange-600 pb-1">Info</Link>
                        <Link href="/favorieten" class="text-gray-700 hover:text-orange-600 font-medium transition-colors">Favorieten</Link>
                        <Link href="/contact" class="text-gray-700 hover:text-orange-600 font-medium transition-colors">Contact</Link>
                        <Link href="/inloggen" class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300">Inloggen</Link>
                    </div>
                    
                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-orange-600 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Mobile Navigation -->
                <div v-show="mobileMenuOpen" class="md:hidden border-t border-gray-100 py-4">
                    <div class="space-y-2">
                        <Link href="/" class="block text-gray-700 hover:text-orange-600 font-medium py-2 transition-colors">Home</Link>
                        <Link href="/info" class="block text-orange-600 font-medium py-2">Info</Link>
                        <Link href="/favorieten" class="block text-gray-700 hover:text-orange-600 font-medium py-2 transition-colors">Favorieten</Link>
                        <Link href="/contact" class="block text-gray-700 hover:text-orange-600 font-medium py-2 transition-colors">Contact</Link>
                        <Link href="/inloggen" class="block bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-lg font-medium text-center mt-4">Inloggen</Link>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Hero Section -->
        <section class="relative overflow-hidden py-20 lg:py-32">
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center px-4 py-2 bg-orange-100 rounded-full text-orange-700 text-sm font-medium mb-6">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Career Launch 2025
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-bold text-gray-900 mb-6 leading-tight">
                        Ontmoet de toekomst van
                        <span class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">
                            technologie & design
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Het grootste netwerkevent voor design & technologie studenten. 
                        Waar talent en bedrijven samenkomen voor de toekomst.
                    </p>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            
            <!-- Event Info Cards -->
            <div class="grid lg:grid-cols-3 gap-8 mb-16">
                <!-- Date Card -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Event Datum</h3>
                    <p class="text-gray-600 mb-4">Zet deze belangrijke datum in je agenda</p>
                    <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-lg p-4">
                        <p class="text-2xl font-bold text-orange-600">DD-MM-YYYY</p>
                        <p class="text-sm text-gray-500">Meer details volgen binnenkort</p>
                    </div>
                </div>

                <!-- Location Card -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Locatie</h3>
                    <p class="text-gray-600 mb-4">Erasmushogeschool Brussel</p>
                    <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-lg p-4">
                        <p class="font-semibold text-gray-900">Campus Kaai</p>
                        <p class="text-sm text-gray-500">Nieuwpoortkaaien 29, 1000 Brussel</p>
                    </div>
                </div>

                <!-- Time Card -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Tijdstip</h3>
                    <p class="text-gray-600 mb-4">Een hele dag vol mogelijkheden</p>
                    <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-lg p-4">
                        <p class="font-semibold text-gray-900">09:00 - 17:00</p>
                        <p class="text-sm text-gray-500">Inclusief lunch & networking</p>
                    </div>
                </div>
            </div>

            <!-- Target Audience Section -->
            <div class="mb-16">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 p-8 text-white">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold">Voor studenten</h2>
                        </div>
                        <p class="text-xl text-orange-100 leading-relaxed">
                            Ben je klaar om je carrière een boost te geven? Dit is jouw moment om te schitteren!
                        </p>
                    </div>
                    
                    <div class="p-8 lg:p-12">
                        <div class="grid lg:grid-cols-2 gap-8 items-center">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-6">Waarom je erbij moet zijn</h3>
                                <div class="space-y-4">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 mb-1">Ontmoet topbedrijven</h4>
                                            <p class="text-gray-600">Direct contact met recruiters van toonaangevende tech bedrijven</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start space-x-4">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 mb-1">Showcase je talent</h4>
                                            <p class="text-gray-600">Presenteer jouw projecten en vind je droomstage of -job</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start space-x-4">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 mb-1">Bouw je netwerk</h4>
                                            <p class="text-gray-600">Leg waardevolle contacten met professionals en medestudenten</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl p-8">
                                <h4 class="text-xl font-bold text-gray-900 mb-4">Opleidingen die deelnemen:</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                                        <span class="text-gray-700">Multimedia & Creatieve Technologie</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                        <span class="text-gray-700">Toegepaste Informatica</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-orange-400 rounded-full"></div>
                                        <span class="text-gray-700">Internet of Things</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How it Works Section -->
            <div class="mb-16">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Hoe het werkt</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Van aanmelding tot job: in 3 eenvoudige stappen naar jouw toekomst
                    </p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <span class="text-2xl font-bold text-white">1</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Registreer je</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Meld je aan voor het event en upload je CV en portfolio om jezelf voor te stellen
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <span class="text-2xl font-bold text-white">2</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Netwerk & Ontdek</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Bezoek bedrijfsstands, volg presentaties en maak direct contact met recruiters
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <span class="text-2xl font-bold text-white">3</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Start je carrière</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Ontvang jobaanbiedingen, stageplaatsen of partnerschappen voor je bachelorproef
                        </p>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-3xl p-12 text-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-black/5"></div>
                    <div class="relative">
                        <h3 class="text-3xl lg:text-4xl font-bold mb-4">Klaar om je toekomst vorm te geven?</h3>
                        <p class="text-xl text-orange-100 mb-8 max-w-2xl mx-auto">
                            Schrijf je nu in voor Career Launch 2025 en ontdek de eindeloze mogelijkheden die op je wachten
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <Link href="/register" class="inline-flex items-center justify-center bg-white text-orange-600 px-8 py-4 rounded-xl font-semibold hover:bg-orange-50 transition-all duration-300 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Schrijf je nu in
                            </Link>
                            <a href="#" class="inline-flex items-center justify-center border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-orange-600 transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Meer informatie
                            </a>
                        </div>
                        
                        <div class="mt-8 grid grid-cols-3 gap-8 max-w-md mx-auto">
                            <div class="text-center">
                                <div class="text-2xl font-bold">50+</div>
                                <div class="text-sm text-orange-200">Bedrijven</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">500+</div>
                                <div class="text-sm text-orange-200">Studenten</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">100+</div>
                                <div class="text-sm text-orange-200">Job kansen</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gradient-to-r from-orange-500 to-red-600 text-white py-16">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
              <div>
                <div class="flex items-center space-x-3 mb-4">
                  <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <span class="text-white font-bold text-lg">E</span>
                  </div>
                  <div class="text-white font-bold text-xl">erasmus</div>
                  
                </div>
                <p class="text-orange-100 text-sm mb-4">
                  Hogeschool Brussel<br />
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

              <div>
                <h4 class="font-semibold mb-4">Voor studenten</h4>
                <ul class="space-y-2 text-orange-100 text-sm">
                  <li><Link href="/register?type=student" class="hover:text-white transition-colors">Maak je profiel</Link></li>
                  <li><Link href="/info" class="hover:text-white transition-colors">Career Launch Info</Link></li>
                  <li><Link href="/bedrijven" class="hover:text-white transition-colors">Ontdek bedrijven</Link></li>
                </ul>
              </div>

              <div>
                <h4 class="font-semibold mb-4">Contact</h4>
                <ul class="space-y-2 text-orange-100 text-sm">
                  <li><a href="mailto:gdt.kaai.student@ehb.be" class="hover:text-white transition-colors">gdt.kaai.student@ehb.be</a></li>
                  <li><a href="tel:+3225233737" class="hover:text-white transition-colors">02 523 37 37</a></li>
                  <li>Nijverheidskaai 170, 1070 Anderlecht</li>
                </ul>
              </div>

              <div>
                <h4 class="font-semibold mb-4">Over Ons</h4>
                <ul class="space-y-2 text-orange-100 text-sm">
                  <li><Link href="/Wiezijnwe" class="hover:text-white transition-colors">Wie zijn we?</Link></li>
                  <li><Link href="/faq" class="hover:text-white transition-colors">FAQ</Link></li>
                  <li><a href="#" class="hover:text-white transition-colors">Onze opleidingen</a></li>
                  <li><a href="#" class="hover:text-white transition-colors">Privacy beleid</a></li>
                </ul>
              </div>
            </div>

            <div class="border-t border-orange-400 mt-12 pt-8 text-center text-orange-100 text-sm">
              <p>&copy; 2025 Erasmus Hogeschool Brussel. Alle rechten voorbehouden.</p>
            </div>
          </div>
        </footer>

        <!-- Toast Notification -->
        <Transition
            enter-active-class="transition ease-out duration-300"
            enter-from-class="opacity-0 translate-y-2"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition ease-in duration-200"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 translate-y-2"
        >
            <div v-if="toast.show" :class="['fixed top-4 right-4 bg-white rounded-xl shadow-lg p-4 z-50 flex items-center max-w-sm border-l-4', toast.type === 'success' ? 'border-green-500' : 'border-blue-500']">
                <span class="flex-1">{{ toast.message }}</span>
                <button @click="toast.show = false" class="ml-4 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </Transition>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref, Transition } from 'vue'

const mobileMenuOpen = ref(false)
const toast = ref({ show: false, message: '', type: 'info' })

function showToast(message, type = 'info') {
    toast.value = { show: true, message, type }
    setTimeout(() => toast.value.show = false, 3000)
}
</script>