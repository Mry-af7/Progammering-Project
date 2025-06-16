<template>
    <div class="min-h-screen bg-orange-50">
        <Head title="Contact" />
        
        <Navigation />

        <!-- Main Content -->
        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Page Header -->
            <div class="mb-12">
                <div class="bg-white rounded-3xl p-8 shadow-sm">
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Contacteer ons</h1>
                    <div class="w-20 h-1 bg-gradient-to-r from-orange-500 to-red-500 rounded-full"></div>
                </div>
            </div>

            <!-- Contact Sections -->
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Mail Section -->
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Mail</h2>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex flex-col sm:flex-row sm:items-center">
                            <strong class="text-gray-900 mb-1 sm:mb-0 sm:mr-2">Mail EhB:</strong> 
                            <a href="mailto:gdt.kaai.student@ehb.be" class="text-orange-600 hover:text-orange-700 font-medium transition-colors">gdt.kaai.student@ehb.be</a>
                        </li>
                        <li class="flex flex-col sm:flex-row sm:items-center">
                            <strong class="text-gray-900 mb-1 sm:mb-0 sm:mr-2">Algemeen:</strong> 
                            <a href="mailto:info@ehb.be" class="text-orange-600 hover:text-orange-700 font-medium transition-colors">info@ehb.be</a>
                        </li>
                    </ul>
                </div>

                <!-- Phone Section -->
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Telefoonnummer</h2>
                    </div>
                    <p>
                        <a href="tel:+3225233737" class="text-2xl font-semibold text-orange-600 hover:text-orange-700 transition-colors">02 523 37 37</a>
                    </p>
                </div>
            </div>

            <!-- Address & Map Section -->
            <div class="mt-8">
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow">
                    <div class="p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Adres</h2>
                        </div>
                        <p class="text-lg text-gray-600 mb-6">Nijverheidskaai 170, 1070 Anderlecht</p>
                    </div>
                    
                    <!-- Map -->
                    <div class="relative">
                        <iframe
                            class="w-full h-80 lg:h-96"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2519.039912671353!2d4.322273015745595!3d50.8365139795281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3c37b41d22fd3%3A0xe6b6b5f9b8f7e94!2sErasmushogeschool%20Brussel!5e0!3m2!1snl!2sbe!4v1687361774367!5m2!1snl!2sbe"
                            style="border:0;"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>
            </div>

            <!-- Quick Contact CTA -->
            <div class="mt-12">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl p-8 text-white text-center">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Heb je vragen?</h3>
                    <p class="text-orange-100 mb-6">Neem gerust contact met ons op. We helpen je graag verder!</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="mailto:gdt.kaai.student@ehb.be" class="bg-white text-orange-600 px-6 py-3 rounded-xl font-semibold hover:bg-orange-50 transition-colors">
                            Stuur een e-mail
                        </a>
                        <a href="tel:+3225233737" class="bg-white/10 text-white border border-white/20 px-6 py-3 rounded-xl font-semibold hover:bg-white/20 transition-colors">
                            Bel ons nu
                        </a>
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
                            <li>E-mail: <a href="mailto:gdt.kaai.student@ehb.be" class="hover:text-white transition-colors">gdt.kaai.student@ehb.be</a></li>
                            <li>Tel: <a href="tel:+3225233737" class="hover:text-white transition-colors">02 523 37 37</a></li>
                        </ul>
                    </div>
                    
                    <!-- Hulp Section -->
                    <div>
                        <h3 class="font-semibold mb-4">Hulp</h3>
                        
              <Link href="/faq">FAQ</Link>
                    </div>
                    
                    <!-- Over Ons Section -->
                    <div>
                        <h3 class="font-semibold mb-4">Over Ons</h3>
                        <ul class="space-y-2 text-orange-100 text-sm">
                            <li>
                                <Link href="/Wiezijnwe">Wie zijn we?</Link>
                                 </li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-orange-400 mt-12 pt-8 text-center text-orange-100 text-sm">
                    <p>&copy; 2025 Erasmus Hogeschool Brussel. Alle rechten voorbehouden.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue'

const mobileMenuOpen = ref(false)
const searchTerm = ref('')
</script>
