<template>
    <div class="min-h-screen bg-orange-50">
        <Head title="Welcome" />
        
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
                        <Link href="/students" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Student Profiles</Link>
                        <Link href="/companies" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Voor Bedrijven</Link>
                        <Link href="/events" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Speeddate Events</Link>
                        <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Contact</Link>
                        <Link href="/login" class="px-4 py-2 text-orange-600 hover:text-orange-700 font-medium">Inloggen</Link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div class="mb-6">
                        <span class="bg-orange-100 text-orange-700 px-4 py-2 rounded-full text-sm font-semibold">
                            🔥 247 studenten ontdekt deze maand
                        </span>
                    </div>
                    
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Showcase je talent.
                        <span class="text-orange-500">
                            Laat bedrijven jou vinden
                        </span>
                    </h1>
                    
                    <p class="text-gray-600 text-xl mb-10 max-w-lg leading-relaxed">
                        Stop met eindeloos solliciteren. Bouw één keer je profiel en laat stage- en jobkansen naar jou toe komen.
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <Link href="/register?type=student" class="bg-orange-500 text-white px-8 py-4 rounded-xl font-semibold text-center hover:bg-orange-600 hover:shadow-lg transition-all">
                            Start mijn profiel (gratis)
                        </Link>
                        <Link href="/students" class="border-2 border-orange-500 text-orange-500 px-8 py-4 rounded-xl font-semibold text-center hover:bg-orange-500 hover:text-white transition-all">
                            Bekijk student profielen
                        </Link>
                    </div>
                    
                    <!-- Trust indicators -->
                    <div class="flex items-center gap-6 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Altijd gratis voor studenten</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Directe contact met werkgevers</span>
                        </div>
                    </div>
                    
                    <!-- Login link for existing users -->
                    <p class="text-gray-500 text-sm text-center sm:text-left mt-6">
                        Heb je al een profiel? 
                        <Link href="/login" class="text-orange-600 hover:text-orange-700 font-medium">Log hier in</Link>
                    </p>
                </div>
                
                <!-- Hero Illustration -->
                <div class="flex justify-center lg:justify-end">
                    <div class="relative">
                        <div class="w-80 h-80 bg-gradient-to-br from-orange-100 to-red-100 rounded-3xl flex items-center justify-center relative overflow-hidden shadow-2xl">
                            <!-- Profile cards floating -->
                            <div class="absolute top-6 left-6 bg-white rounded-xl p-3 shadow-lg transform rotate-12 animate-pulse">
                                <div class="w-8 h-8 bg-orange-400 rounded-full mb-2"></div>
                                <div class="w-16 h-2 bg-gray-200 rounded"></div>
                                <div class="w-12 h-1 bg-gray-100 rounded mt-1"></div>
                            </div>
                            
                            <div class="absolute top-8 right-6 bg-white rounded-xl p-3 shadow-lg transform -rotate-6 animate-bounce">
                                <div class="w-8 h-8 bg-red-400 rounded-full mb-2"></div>
                                <div class="w-16 h-2 bg-gray-200 rounded"></div>
                                <div class="w-12 h-1 bg-gray-100 rounded mt-1"></div>
                            </div>
                            
                            <div class="absolute bottom-8 left-8 bg-white rounded-xl p-3 shadow-lg transform rotate-6">
                                <div class="w-8 h-8 bg-orange-300 rounded-full mb-2"></div>
                                <div class="w-16 h-2 bg-gray-200 rounded"></div>
                                <div class="w-12 h-1 bg-gray-100 rounded mt-1"></div>
                            </div>
                            
                            <!-- Central connection visual -->
                            <div class="text-center">
                                <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div class="text-gray-700 font-semibold text-sm">Instant Match</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How it Works Section -->
        <section class="bg-white py-20">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Hoe het werkt</h2>
                    <p class="text-gray-600 text-lg">Van profiel tot droomjob in 3 stappen</p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8 relative">
                    <!-- Connection lines -->
                    <div class="hidden md:block absolute top-8 left-1/3 right-1/3 h-0.5 bg-gradient-to-r from-orange-200 via-orange-300 to-orange-200"></div>
                    
                    <div class="text-center group relative">
                        <div class="w-16 h-16 bg-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform relative z-10">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">1. Bouw je profiel</h3>
                        <p class="text-gray-600">Showcase je skills, projecten en ambities. Vertel je verhaal en laat zien wat je uniek maakt.</p>
                    </div>

                    <div class="text-center group relative">
                        <div class="w-16 h-16 bg-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform relative z-10">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">2. Word ontdekt</h3>
                        <p class="text-gray-600">Bedrijven browsen door profielen en voegen interessante studenten toe aan hun favorieten.</p>
                    </div>

                    <div class="text-center group relative">
                        <div class="w-16 h-16 bg-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform relative z-10">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">3. Maak contact</h3>
                        <p class="text-gray-600">Chat met geïnteresseerde bedrijven en plan speeddate sessies voor persoonlijk contact.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Student Success Stories -->
        <section class="bg-orange-50 py-20">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">
                        Succesverhalen van onze studenten
                    </h2>
                    <p class="text-gray-600 text-lg">Echte studenten, echte resultaten</p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-orange-400 rounded-full flex items-center justify-center text-white font-bold">
                                L
                            </div>
                            <div class="ml-3">
                                <div class="font-semibold text-gray-900">Lisa M.</div>
                                <div class="text-sm text-gray-600">Toegepaste Informatica</div>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">"Binnen 2 weken had ik 5 bedrijven die contact opnamen. Nu doe ik stage bij Accenture!"</p>
                        <div class="text-sm text-orange-600 font-semibold">Stage → Fulltime aanbod</div>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-red-400 rounded-full flex items-center justify-center text-white font-bold">
                                T
                            </div>
                            <div class="ml-3">
                                <div class="font-semibold text-gray-900">Thomas V.</div>
                                <div class="text-sm text-gray-600">Business Management</div>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">"De speeddate events zijn geweldig. Directe feedback en echt contact met HR managers."</p>
                        <div class="text-sm text-orange-600 font-semibold">Studentjob → Stage pipeline</div>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-orange-300 rounded-full flex items-center justify-center text-white font-bold">
                                S
                            </div>
                            <div class="ml-3">
                                <div class="font-semibold text-gray-900">Sarah K.</div>
                                <div class="text-sm text-gray-600">Marketing</div>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">"Veel beter dan LinkedIn. Hier weten bedrijven echt wat Erasmus studenten kunnen."</p>
                        <div class="text-sm text-orange-600 font-semibold">Meerdere aanbiedingen</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Speeddate CTA Section -->
        <section class="bg-white py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-3xl p-8">
                    <div class="flex items-center justify-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4">
                        Klaar om bedrijven te ontmoeten die jou leuk vinden?
                    </h3>
                    
                    <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto leading-relaxed">
                        Neem deel aan onze speeddate events en ontmoet face-to-face de bedrijven die je hebben gefavoreerd. Persoonlijk contact maakt het verschil!
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-6">
                        <Link href="/afspraak" class="inline-flex items-center bg-gradient-to-r from-orange-500 to-red-500 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:from-orange-600 hover:to-red-600 hover:shadow-lg transition-all transform hover:scale-105">
    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
    </svg>
    Plan je afspraak
</Link>
                        
                        <div class="text-sm text-gray-600">
                            <strong class="text-orange-600">Volgende event:</strong> 15 maart 2025
                        </div>
                    </div>
                    
                    <div class="flex justify-center items-center gap-6 text-sm text-gray-500">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Gratis deelname</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Directe feedback</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Netwerk uitbreiden</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Company Partners -->
        <section class="bg-orange-50 py-20">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    Bedrijven die onze studenten ontdekken
                </h2>
                <p class="text-gray-600 text-lg mb-12">
                    Meer dan 150+ bedrijven zoeken actief naar Erasmus talent
                </p>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-12 items-center justify-items-center max-w-5xl mx-auto mb-12">
                    <!-- Company logos with hover effects -->
                    <div class="flex flex-col items-center space-y-3 grayscale hover:grayscale-0 transition-all duration-300 opacity-70 hover:opacity-100">
                        <div class="flex items-center justify-center h-16 w-32 bg-white rounded-lg shadow-sm p-4">
                            <img src="/images/logos/accenture-logo.svg" alt="Accenture" class="h-8 w-auto max-w-24">
                        </div>
                        <span class="text-xs font-medium text-gray-600">12 stages deze maand</span>
                    </div>

                    <div class="flex flex-col items-center space-y-3 grayscale hover:grayscale-0 transition-all duration-300 opacity-70 hover:opacity-100">
                        <div class="flex items-center justify-center h-16 w-32 bg-white rounded-lg shadow-sm p-4">
                            <img src="/images/logos/capgemini-logo.svg" alt="Capgemini" class="h-8 w-auto max-w-24">
                        </div>
                        <span class="text-xs font-medium text-gray-600">8 studentjobs open</span>
                    </div>

                    <div class="flex flex-col items-center space-y-3 grayscale hover:grayscale-0 transition-all duration-300 opacity-70 hover:opacity-100">
                        <div class="flex items-center justify-center h-16 w-32 bg-white rounded-lg shadow-sm p-4">
                            <img src="/images/logos/delaware-logo.svg" alt="delaware" class="h-8 w-auto max-w-24">
                        </div>
                        <span class="text-xs font-medium text-gray-600">Actief recruiterend</span>
                    </div>

                    <div class="flex flex-col items-center space-y-3 grayscale hover:grayscale-0 transition-all duration-300 opacity-70 hover:opacity-100">
                        <div class="flex items-center justify-center h-16 w-32 bg-white rounded-lg shadow-sm p-4">
                            <img src="/images/logos/inetum-realdolmen-logo.svg" alt="Inetum-Realdolmen" class="h-8 w-auto max-w-24">
                        </div>
                        <span class="text-xs font-medium text-gray-600">15 new positions</span>
                    </div>

                    <div class="flex flex-col items-center space-y-3 grayscale hover:grayscale-0 transition-all duration-300 opacity-70 hover:opacity-100">
                        <div class="flex items-center justify-center h-16 w-32 bg-white rounded-lg shadow-sm p-4">
                            <img src="/images/logos/flexo-logo.svg" alt="Flexso" class="h-8 w-auto max-w-24">
                        </div>
                        <span class="text-xs font-medium text-gray-600">Hiring graduates</span>
                    </div>

                    <div class="flex flex-col items-center space-y-3 grayscale hover:grayscale-0 transition-all duration-300 opacity-70 hover:opacity-100">
                        <div class="flex items-center justify-center h-16 w-32 bg-white rounded-lg shadow-sm p-4">
                            <img src="/images/logos/colruyt-group-logo.svg" alt="Colruyt Group" class="h-8 w-auto max-w-24">
                        </div>
                        <span class="text-xs font-medium text-gray-600">Tech & Retail roles</span>
                    </div>

                    <div class="flex flex-col items-center space-y-3 grayscale hover:grayscale-0 transition-all duration-300 opacity-70 hover:opacity-100">
                        <div class="flex items-center justify-center h-16 w-32 bg-white rounded-lg shadow-sm p-4">
                            <img src="/images/logos/bnp-paribas-fortis-logo.svg" alt="BNP Paribas Fortis" class="h-8 w-auto max-w-24">
                        </div>
                        <span class="text-xs font-medium text-gray-600">Finance internships</span>
                    </div>

                    <div class="flex flex-col items-center space-y-3 grayscale hover:grayscale-0 transition-all duration-300 opacity-70 hover:opacity-100">
                        <div class="flex items-center justify-center h-16 w-32 bg-white rounded-lg shadow-sm p-4">
                            <img src="/images/logos/euricom-logo.svg" alt="Safran" class="h-8 w-auto max-w-24">
                        </div>
                        <span class="text-xs font-medium text-gray-600">Engineering opportunities</span>
                    </div>
                </div>
            </div>
            <div class="mt-4 flex justify-center">
            <Link
  href="/alle-bedrijven"
  class="inline-flex items-center bg-gradient-to-r from-orange-500 to-red-500 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:from-orange-600 hover:to-red-600 hover:shadow-lg transition-all transform hover:scale-105"
> Ontdek hier alle bedrijven!
</Link>

            </div>
        </section>

        <!-- Stats Section -->
        <section class="bg-white py-20">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8 text-center">
                    <div class="bg-orange-50 rounded-2xl p-6">
                        <div class="text-3xl font-bold text-orange-600 mb-2">1,247</div>
                        <div class="text-gray-600 font-medium">Actieve student profielen</div>
                    </div>
                    <div class="bg-orange-50 rounded-2xl p-6">
                        <div class="text-3xl font-bold text-orange-600 mb-2">150+</div>
                        <div class="text-gray-600 font-medium">Partner bedrijven</div>
                    </div>
                    <div class="bg-orange-50 rounded-2xl p-6">
                        <div class="text-3xl font-bold text-orange-600 mb-2">89%</div>
                        <div class="text-gray-600 font-medium">Vindt stage binnen 2 maanden</div>
                    </div>
                    <div class="bg-orange-50 rounded-2xl p-6">
                        <div class="text-3xl font-bold text-orange-600 mb-2">247</div>
                        <div class="text-gray-600 font-medium">Matches deze maand</div>
                    </div>
                </div>
            </div>
        </section>

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
                            <li><Link href="/afspraak" class="hover:text-white transition-colors">Speeddate events</Link></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">Voor bedrijven</h4>
                        <ul class="space-y-2 text-orange-100 text-sm">
                            <li><Link href="/companies" class="hover:text-white transition-colors">Browse studenten</Link></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">Support</h4>
                        <ul class="space-y-2 text-orange-100 text-sm">
                            <li><Link href="/contact" class="hover:text-white transition-colors">Contact</Link></li>
                            <!--<li><Link href="/privacy" class="hover:text-white transition-colors">Privacy beleid</Link></li> Misschien als extra toevoegen-->
                            <!--<li><Link href="/terms" class="hover:text-white transition-colors">Voorwaarden</Link></li> Misschien als extra toevoegen-->
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
</script>