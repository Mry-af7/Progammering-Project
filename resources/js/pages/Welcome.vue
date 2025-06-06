<template>
    <div class="min-h-screen bg-orange-50">
        <Head title="Welcome" />
        
        <!-- Navigation -->
        <nav class="bg-orange-50 py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">E</span>
                            </div>
                            <div>
                                <div class="text-black font-bold text-lg">erasmus</div>
                                <div class="text-xs text-gray-600 -mt-1">HOGESCHOOL BRUSSEL</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center space-x-2">
                        <button class="bg-orange-500 text-white px-6 py-2 rounded-full font-medium hover:bg-orange-600 transition-colors">
                            Home
                        </button>
                        <button class="bg-orange-500 text-white px-6 py-2 rounded-full font-medium hover:bg-orange-600 transition-colors">
                            Info
                        </button>
                        <button class="bg-orange-500 text-white px-6 py-2 rounded-full font-medium hover:bg-orange-600 transition-colors">
                            Favorieten
                        </button>
                        <button class="bg-orange-500 text-white px-6 py-2 rounded-full font-medium hover:bg-orange-600 transition-colors">
                            Contact
                        </button>
                        
                        <!-- Search -->
                        <div class="relative ml-4">
                            <input 
                                type="text" 
                                placeholder="Search" 
                                class="bg-gray-300 text-gray-700 px-4 py-2 rounded-full pl-10 w-40 focus:outline-none focus:ring-2 focus:ring-orange-500"
                            >
                            <svg class="w-4 h-4 text-gray-600 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        
                        <!-- Profile Icon -->
                        <div class="ml-4">
                            <div class="w-10 h-10 bg-gray-400 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div>
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Start je carrière.<br>
                        <span>Ontdek talent</span>
                    </h1>
                    
                    <p class="text-gray-700 text-lg mb-8 max-w-md">
                        Waar studenten en werkgevers samen de toekomst vormgeven.
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <Link 
                            :href="route('register')"
                            class="bg-orange-500 text-white px-8 py-4 rounded-full font-semibold text-center hover:bg-orange-600 transition-colors shadow-lg"
                        >
                            Ik ben een student
                        </Link>
                        <Link 
                            :href="route('login')"
                            class="border-2 border-orange-500 text-orange-500 px-8 py-4 rounded-full font-semibold text-center hover:bg-orange-500 hover:text-white transition-colors"
                        >
                            Ik ben een bedrijf
                        </Link>
                    </div>
                </div>
                
                <!-- Right Illustration -->
                <div class="flex justify-center lg:justify-end">
                    <div class="relative">
                        <div class="w-80 h-80 bg-blue-200 rounded-3xl flex items-center justify-center relative overflow-hidden">
                            <!-- Business people illustration -->
                            <div class="text-center">
                                <div class="flex items-end justify-center space-x-4 mb-4">
                                    <!-- Person 1 -->
                                    <div class="relative">
                                        <div class="w-16 h-20 bg-orange-400 rounded-t-full"></div>
                                        <div class="w-12 h-12 bg-orange-300 rounded-full absolute -top-6 left-2"></div>
                                        <div class="w-20 h-16 bg-blue-800 rounded-t-lg -mt-2"></div>
                                    </div>
                                    
                                    <!-- Person 2 -->
                                    <div class="relative">
                                        <div class="w-16 h-24 bg-blue-600 rounded-t-full"></div>
                                        <div class="w-12 h-12 bg-orange-200 rounded-full absolute -top-6 left-2"></div>
                                        <div class="w-20 h-16 bg-blue-900 rounded-t-lg -mt-2"></div>
                                    </div>
                                </div>
                                
                                <!-- Connection points -->
                                <div class="absolute top-8 left-8 w-4 h-4 bg-blue-600 rounded-full border-4 border-white"></div>
                                <div class="absolute top-8 right-8 w-4 h-4 bg-blue-600 rounded-full border-4 border-white"></div>
                                <div class="absolute bottom-8 left-8 w-4 h-4 bg-blue-600 rounded-full border-4 border-white"></div>
                                <div class="absolute bottom-8 right-8 w-4 h-4 bg-blue-600 rounded-full border-4 border-white"></div>
                            </div>
                            
                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-24 h-6 bg-orange-400 rounded-t-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dream Job Section -->
        <section class="bg-white py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    Op zoek naar jouw droomjob?
                </h2>
                <p class="text-gray-600 text-lg max-w-3xl mx-auto leading-relaxed">
                    Wij brengen je in rechtstreeks contact met echte bedrijven die op zoek zijn naar talent zoals jij. Vind werk dat bij je past en ontdek kansen voor jouw perfecte start.
                </p>
            </div>
        </section>

        <!-- How it Works Section -->
        <section class="bg-orange-50 py-20">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Hoe werkt het?</h2>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Step 1 -->
                    <div class="text-center">
                        <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Maak een account</h3>
                        <p class="text-gray-600">Registreer je gratis en maak je profiel compleet</p>
                    </div>

                    <!-- Step 2 -->  
                    <div class="text-center">
                        <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Ontdek vacatures</h3>
                        <p class="text-gray-600">Zoek door honderden vacatures van topbedrijven</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center">
                        <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Start je carrière</h3>
                        <p class="text-gray-600">Solliciteer direct en start jouw droomcarrière</p>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <Link 
                        :href="route('register')"
                        class="bg-orange-500 text-white px-8 py-4 rounded-full font-semibold hover:bg-orange-600 transition-colors shadow-lg inline-block"
                    >
                        Start nu gratis
                    </Link>
                </div>
            </div>
        </section>

        <!-- Partner Companies Section -->
        <section class="bg-white py-20">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">
                        Toonaangevende ondernemingen<br>
                        werken met ons
                    </h2>
                </div>
                
                <!-- Company Logos Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 items-center justify-items-center">
                    <!-- Logo placeholders - replace with actual company logos -->
                    <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">B</span>
                    </div>
                    <div class="w-16 h-16 bg-orange-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">C</span>
                    </div>
                    <div class="w-16 h-16 bg-blue-400 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">D</span>
                    </div>
                    <div class="w-16 h-16 bg-green-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">E</span>
                    </div>
                    <div class="w-16 h-16 bg-green-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">F</span>
                    </div>
                    <div class="w-16 h-16 bg-red-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">G</span>
                    </div>
                    <div class="w-16 h-16 bg-red-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">H</span>
                    </div>
                    <div class="w-16 h-16 bg-purple-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">I</span>
                    </div>
                    <div class="w-16 h-16 bg-gray-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">J</span>
                    </div>
                    <div class="w-16 h-16 bg-indigo-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">K</span>
                    </div>
                </div>
                
                <div class="text-center mt-12">
                    <p class="text-gray-600 font-medium">Klaar voor de volgende?</p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-orange-500 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div>
                        <h3 class="font-bold text-lg mb-4">Erasmus</h3>
                        <p class="text-orange-100 text-sm">
                            Hogeschool Brussel<br>
                            Connecting talent with opportunity
                        </p>
                    </div>
                    
                    <!-- Links Columns -->
                    <div>
                        <h4 class="font-semibold mb-4">Voor studenten</h4>
                        <ul class="space-y-2 text-orange-100 text-sm">
                            <li><a href="#" class="hover:text-white transition-colors">Vind vacatures</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">CV tips</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Interview tips</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">Voor bedrijven</h4>
                        <ul class="space-y-2 text-orange-100 text-sm">
                            <li><a href="#" class="hover:text-white transition-colors">Plaats vacature</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Zoek talent</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Prijzen</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">Over ons</h4>
                        <ul class="space-y-2 text-orange-100 text-sm">
                            <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Privacy</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Voorwaarden</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-orange-400 mt-8 pt-8 text-center text-orange-100 text-sm">
                    <p>&copy; 2025 Erasmus Hogeschool Brussel. Alle rechten voorbehouden.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'

export default {
    name: 'Welcome',
    components: {
        Head,
        Link,
    },
  }
</script>