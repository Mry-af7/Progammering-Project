<template>
    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-red-50">
    <Head title="Plan je afspraak - Erasmus Career Launch" />
    
    <!-- Premium Navigation -->
    <MainNavigation activePage="afspraak" />
    
    <!-- Hero Section -->
    <div class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-orange-600 to-red-600 opacity-5"></div>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center">
        <div class="flex justify-center mb-8">
            <div class="w-24 h-24 bg-gradient-to-br from-orange-500 via-red-500 to-pink-500 rounded-3xl flex items-center justify-center shadow-2xl">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
            Plan je <span class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">Career Launch</span> gesprek
        </h1>
        <p class="text-gray-600 text-xl max-w-4xl mx-auto leading-relaxed mb-8">
            Ontmoet face-to-face de bedrijven die je interesseren. 
            Kies een bedrijf en tijdslot voor een persoonlijk gesprek van 15 minuten.
        </p>
        
        <!-- Success Indicators -->
        <div class="flex items-center justify-center space-x-8 text-sm text-gray-600">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>250+ succesvolle matches</span>
            </div>
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>85% tevredenheidsscore</span>
            </div>
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>Top bedrijven</span>
            </div>
        </div>
    </div>
    </div>
    </div>
    
    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
    <!-- Premium Progress Steps -->
    <div class="mb-16">
    <div class="flex items-center justify-center space-x-4 mb-8 overflow-x-auto pb-4">
        <div v-for="(step, index) in progressSteps" :key="index" class="flex items-center">
            <div class="flex items-center">
                <div :class="currentStep >= step.number ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-lg scale-110' : 'bg-gray-200 text-gray-600'" 
                     class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg transition-all duration-300 relative">
                    <span v-if="currentStep > step.number" class="absolute">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <span v-else>{{ step.number }}</span>
                </div>
                <div class="ml-3 text-left">
                    <div class="text-sm font-semibold" :class="currentStep >= step.number ? 'text-orange-600' : 'text-gray-700'">
                        {{ step.title }}
                    </div>
                    <div class="text-xs text-gray-500">{{ step.subtitle }}</div>
                </div>
            </div>
            <div v-if="index < progressSteps.length - 1" 
                 :class="currentStep > step.number ? 'bg-gradient-to-r from-orange-500 to-red-500' : 'bg-gray-300'"
                 class="w-8 h-1 rounded-full mx-4 transition-all duration-300"></div>
        </div>
    </div>
    </div>
    
    <!-- Step 1: Event Selection -->
    <div v-if="currentStep === 1" class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 mb-8">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Welkom bij Career Launch</h2>
        <p class="text-gray-600 text-lg">Het premium speeddate event van Erasmus Hogeschool Brussel</p>
    </div>
    
    <div class="bg-gradient-to-br from-orange-50 via-red-50 to-pink-50 rounded-3xl p-8 mb-8 border border-orange-100">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <div class="flex items-center mb-4">
                    <div class="w-4 h-4 bg-green-500 rounded-full mr-3 animate-pulse"></div>
                    <span class="text-sm font-semibold text-green-700 uppercase tracking-wide">Live Event</span>
                </div>
                
                <h3 class="text-3xl font-bold text-gray-900 mb-3">Career Launch Event 2025</h3>
                <p class="text-gray-700 mb-6 text-lg leading-relaxed">
                    Het exclusieve speeddate event waar ambitieuze studenten topbedrijven ontmoeten 
                    voor stages, jobs en carrièremogelijkheden.
                </p>
                
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div class="flex items-center text-gray-700 bg-white/60 rounded-xl p-3">
                        <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <div class="font-semibold">15 maart 2025</div>
                            <div class="text-sm text-gray-600">Zaterdag</div>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-700 bg-white/60 rounded-xl p-3">
                        <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <div class="font-semibold">09:00 - 17:00</div>
                            <div class="text-sm text-gray-600">8 uur netwerkgelegenheid</div>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-700 bg-white/60 rounded-xl p-3">
                        <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <div class="font-semibold">Campus Brussel</div>
                            <div class="text-sm text-gray-600">Hoofdgebouw - Zaal A1.01</div>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-700 bg-white/60 rounded-xl p-3">
                        <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <div>
                            <div class="font-semibold">{{ companies.length }}+ Premium Bedrijven</div>
                            <div class="text-sm text-gray-600">Fortune 500 & Scale-ups</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="ml-8 text-center">
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="text-4xl font-bold text-orange-600 mb-1">{{ availableSpots }}</div>
                    <div class="text-sm text-gray-600 font-medium">plekken beschikbaar</div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
                        <div class="bg-gradient-to-r from-orange-500 to-red-500 h-2 rounded-full transition-all duration-500" 
                             :style="`width: ${(availableSpots / totalSpots) * 100}%`"></div>
                    </div>
                    <div class="text-xs text-gray-500 mt-2">van {{ totalSpots }} plekken</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="flex justify-between items-center">
        <div class="text-gray-600">
            <span class="font-semibold text-orange-600">Volgende stap:</span> 
            <span class="ml-2">Kies het bedrijf waarmee je een gesprek wilt</span>
        </div>
        <button @click="selectCareerLaunchEvent" 
                class="px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white rounded-2xl font-bold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
            Deelnemen aan Career Launch
        </button>
    </div>
    </div>
    
    <!-- Step 2: Company Selection -->
    <div v-if="currentStep === 2" class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 mb-8">
    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Kies je droomwerkgever</h2>
    
    <div class="bg-orange-50 border-l-4 border-orange-500 p-6 mb-8 rounded-r-xl">
        <div class="flex items-center">
            <svg class="h-6 w-6 text-orange-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <p class="font-semibold text-orange-800">Career Launch Event • 15 maart 2025 • Campus Brussel</p>
                <p class="text-orange-700 text-sm mt-1">Selecteer het bedrijf waarmee je een 15-minuten één-op-één gesprek wilt plannen.</p>
            </div>
        </div>
    </div>
    
    <!-- Company Search & Filter -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input v-model="companySearchTerm" 
                       type="text" 
                       placeholder="Zoek bedrijven, specialisaties, technologieën..."
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent">
            </div>
            <div>
                <select v-model="selectedSector" 
                        class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option value="">Alle sectoren</option>
                    <option v-for="sector in availableSectors" :key="sector" :value="sector">{{ sector }}</option>
                </select>
            </div>
            <div>
                <select v-model="companiesPerPage" 
                        class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <option :value="9">9 per pagina</option>
                    <option :value="12">12 per pagina</option>
                    <option :value="18">18 per pagina</option>
                </select>
            </div>
        </div>
    </div>
    
    <!-- Results Summary -->
    <div class="flex justify-between items-center mb-6">
        <p class="text-gray-600">
            <span class="font-semibold text-gray-900">{{ filteredCompanies.length }}</span> 
            {{ filteredCompanies.length === 1 ? 'bedrijf gevonden' : 'bedrijven gevonden' }}
        </p>
        <p class="text-sm text-gray-500">
            Pagina {{ currentCompanyPage }} van {{ totalCompanyPages }}
        </p>
    </div>
    
    <!-- Companies grid with pagination -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div v-for="company in paginatedCompanies" :key="company.id"
             @click="selectCompany(company)"
             :class="selectedCompany?.id === company.id ? 'ring-2 ring-orange-500 bg-orange-50 border-orange-300 scale-105' : 'hover:shadow-xl hover:border-orange-200 hover:scale-102'"
             class="border border-gray-200 rounded-2xl p-6 cursor-pointer transition-all duration-300 bg-white">
            <div class="flex items-start space-x-4">
                <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm">
                    <span class="text-2xl font-bold text-gray-600">{{ company.name?.charAt(0) || '?' }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-gray-900 text-lg mb-2 truncate">{{ company.name || 'Onbekend bedrijf' }}</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ company.specialisatie || 'Geen beschrijving' }}</p>
                    <div class="flex items-center justify-between">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                            {{ company.industry || 'Algemeen' }}
                        </span>
                        <div class="text-right">
                            <div class="text-green-600 font-bold text-sm">{{ company.openPositions || Math.floor(Math.random() * 15) + 3 }} posities</div>
                            <div class="text-xs text-gray-500">beschikbaar</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Selection indicator -->
            <div v-if="selectedCompany?.id === company.id" class="mt-4 flex items-center text-orange-600">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-semibold text-sm">Geselecteerd</span>
            </div>
        </div>
    </div>
    
    <!-- Company Pagination -->
    <div v-if="totalCompanyPages > 1" class="flex justify-center mb-8">
        <nav class="flex items-center space-x-1">
            <button
                @click="changeCompanyPage(currentCompanyPage - 1)"
                :disabled="currentCompanyPage === 1"
                class="px-3 py-2 rounded-lg text-gray-500 hover:text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
    
            <template v-for="page in totalCompanyPages" :key="page">
                <button
                    v-if="page === 1 || page === totalCompanyPages || Math.abs(page - currentCompanyPage) <= 2"
                    @click="changeCompanyPage(page)"
                    :class="[
                        'px-4 py-2 rounded-lg font-medium transition-colors',
                        page === currentCompanyPage
                            ? 'bg-orange-600 text-white'
                            : 'text-gray-700 hover:text-orange-600 hover:bg-orange-50'
                    ]"
                >
                    {{ page }}
                </button>
                <span v-else-if="Math.abs(page - currentCompanyPage) === 3" class="px-2 text-gray-400">...</span>
            </template>
    
            <button
                @click="changeCompanyPage(currentCompanyPage + 1)"
                :disabled="currentCompanyPage === totalCompanyPages"
                class="px-3 py-2 rounded-lg text-gray-500 hover:text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </nav>
    </div>
    
    <div class="flex justify-between items-center">
        <button @click="prevStep" 
                class="px-8 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-300">
            ← Vorige stap
        </button>
        <button @click="nextStep" 
                :disabled="!selectedCompany"
                :class="selectedCompany ? 'bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 shadow-lg hover:shadow-xl' : 'bg-gray-300 cursor-not-allowed'"
                class="px-8 py-3 text-white rounded-xl font-semibold transition-all duration-300">
            Volgende stap →
        </button>
    </div>
    </div>
    
    <!-- Step 3: Time Slot Selection -->
    <div v-if="currentStep === 3" class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 mb-8">
    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Kies je perfecte tijdslot</h2>
    
    <div v-if="selectedCompany" class="bg-gradient-to-r from-orange-50 to-red-50 border border-orange-200 p-6 mb-8 rounded-2xl">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center mr-4">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="font-bold text-gray-900 text-lg">{{ selectedCompany.name }} gesprek</p>
                <p class="text-gray-600">15 maart 2025 • Campus Brussel</p>
                <p class="text-orange-600 text-sm mt-1">💬 Gesprek duurt 15 minuten • 5 minuten pauze tussen gesprekken</p>
            </div>
        </div>
    </div>
    
    <!-- Time periods -->
    <div class="space-y-8 mb-8">
        <div v-for="period in timePeriods" :key="period.name">
            <h3 class="font-semibold text-gray-900 mb-4 text-lg flex items-center">
                <span class="mr-3">{{ period.emoji }}</span>
                {{ period.name }}
            </h3>
            <div class="grid md:grid-cols-4 lg:grid-cols-6 gap-3">
                <div v-for="slot in period.slots" :key="slot.id"
                     @click="selectTimeSlot(slot)"
                     :class="getTimeSlotClass(slot)"
                     class="border rounded-xl p-4 cursor-pointer transition-all duration-300 text-center relative overflow-hidden">
                    
                    <!-- Selection indicator -->
                    <div v-if="selectedTimeSlot?.id === slot.id" 
                         class="absolute top-2 right-2">
                        <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    
                    <div class="font-bold text-gray-900 text-lg mb-1">{{ slot.startTime }}</div>
                    <div class="text-sm text-gray-600 mb-2">{{ slot.endTime }}</div>
                    <div v-if="slot.available" class="text-xs font-semibold text-green-600 bg-green-100 rounded-full px-2 py-1">
                        ✓ Beschikbaar
                    </div>
                    <div v-else class="text-xs font-semibold text-red-500 bg-red-100 rounded-full px-2 py-1">
                        ✗ Bezet
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Legend -->
    <div class="flex items-center justify-center space-x-8 text-sm border-t border-gray-200 pt-6 mb-8">
        <div class="flex items-center">
            <div class="w-4 h-4 bg-white border-2 border-gray-300 rounded mr-2"></div>
            <span class="text-gray-600">Beschikbaar</span>
        </div>
        <div class="flex items-center">
            <div class="w-4 h-4 bg-orange-100 border-2 border-orange-500 rounded mr-2"></div>
            <span class="text-gray-600">Geselecteerd</span>
        </div>
        <div class="flex items-center">
            <div class="w-4 h-4 bg-gray-100 border-2 border-gray-300 rounded mr-2 opacity-50"></div>
            <span class="text-gray-600">Bezet</span>
        </div>
    </div>
    
    <div class="flex justify-between items-center">
        <button @click="prevStep" 
                class="px-8 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-300">
            ← Vorige stap
        </button>
        <button @click="nextStep" 
                :disabled="!selectedTimeSlot"
                :class="selectedTimeSlot ? 'bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 shadow-lg hover:shadow-xl' : 'bg-gray-300 cursor-not-allowed'"
                class="px-8 py-3 text-white rounded-xl font-semibold transition-all duration-300">
            Volgende stap →
        </button>
    </div>
    </div>
    
    <!-- Step 4: Personal Details -->
    <div v-if="currentStep === 4" class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 mb-8">
    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Vertel ons over jezelf</h2>
    
    <!-- Booking Summary -->
    <div class="bg-gradient-to-r from-green-50 to-blue-50 border border-green-200 rounded-2xl p-6 mb-8">
        <h3 class="font-bold text-gray-900 mb-4 text-lg">📋 Jouw Career Launch gesprek:</h3>
        <div class="grid md:grid-cols-3 gap-4 text-sm">
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 mr-2">Bedrijf:</span>
                <span class="text-gray-900">{{ selectedCompany?.name }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 mr-2">Datum:</span>
                <span class="text-gray-900">15 maart 2025</span>
            </div>
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 mr-2">Tijd:</span>
                <span class="text-gray-900">{{ selectedTimeSlot?.startTime }} - {{ selectedTimeSlot?.endTime }}</span>
            </div>
        </div>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8">
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-3">Voornaam *</label>
            <input v-model="form.first_name" 
                   type="text" 
                   required
                   class="w-full px-6 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent text-lg">
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-3">Achternaam *</label>
            <input v-model="form.last_name" 
                   type="text" 
                   required
                   class="w-full px-6 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent text-lg">
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-3">E-mailadres *</label>
            <input v-model="form.email" 
                   type="email" 
                   required
                   class="w-full px-6 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent text-lg">
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-3">Telefoonnummer</label>
            <input v-model="form.phone" 
                   type="tel" 
                   class="w-full px-6 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent text-lg">
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-bold text-gray-700 mb-3">Studierichting *</label>
            <select v-model="form.study_program" 
                    required
                    class="w-full px-6 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent text-lg">
                <option value="">Selecteer je studierichting</option>
                <option value="Toegepaste Informatica">Toegepaste Informatica</option>
                <option value="Business Management">Business Management</option>
                <option value="Marketing">Marketing</option>
                <option value="Accountancy-Fiscaliteit">Accountancy-Fiscaliteit</option>
                <option value="Communicatiemanagement">Communicatiemanagement</option>
                <option value="Financie- en Verzekeringswezen">Financie- en Verzekeringswezen</option>
                <option value="Andere">Andere</option>
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-bold text-gray-700 mb-3">Motivatie (optioneel)</label>
            <textarea v-model="form.motivation" 
                      rows="4"
                      placeholder="Waarom wil je bij dit bedrijf werken? Wat zijn je doelen en verwachtingen van dit gesprek?"
                      class="w-full px-6 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent text-lg"></textarea>
            <div class="text-sm text-gray-500 mt-2">💡 Dit helpt het bedrijf om zich beter voor te bereiden op jullie gesprek.</div>
        </div>
    </div>
    
    <div class="flex justify-between items-center mt-10">
        <button @click="prevStep" 
                class="px-8 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-300">
            ← Vorige stap
        </button>
        <button @click="bookAppointment" 
                :disabled="!isFormValid"
                :class="isFormValid ? 'bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 shadow-lg hover:shadow-xl' : 'bg-gray-300 cursor-not-allowed'"
                class="px-10 py-4 text-white rounded-xl font-bold transition-all duration-300 text-lg">
            ✨ Afspraak Bevestigen
        </button>
    </div>
    </div>
    
    <!-- Step 5: Confirmation -->
    <div v-if="currentStep === 5" class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 mb-8">
    <div class="text-center">
        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-8 animate-pulse">
            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Gesprek succesvol geboekt! 🎉</h2>
        <p class="text-gray-600 text-xl mb-8 max-w-2xl mx-auto">
            Fantastisch! Je gesprek met <span class="font-bold text-orange-600">{{ selectedCompany?.name }}</span> 
            is bevestigd.
        </p>
        
        <div class="bg-gradient-to-br from-orange-50 via-red-50 to-pink-50 rounded-3xl p-8 mb-8 text-left border border-orange-100">
            <h3 class="font-bold text-gray-900 mb-6 text-2xl text-center">📅 Jouw Career Launch Details</h3>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex justify-between py-2 border-b border-gray-200">
                        <span class="text-gray-600 font-medium">Bedrijf:</span>
                        <span class="font-bold">{{ selectedCompany?.name }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200">
                        <span class="text-gray-600 font-medium">Datum:</span>
                        <span class="font-bold">15 maart 2025</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200">
                        <span class="text-gray-600 font-medium">Tijdslot:</span>
                        <span class="font-bold">{{ selectedTimeSlot?.startTime }} - {{ selectedTimeSlot?.endTime }}</span>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between py-2 border-b border-gray-200">
                        <span class="text-gray-600 font-medium">Duur:</span>
                        <span class="font-bold">15 minuten</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200">
                        <span class="text-gray-600 font-medium">Locatie:</span>
                        <span class="font-bold">Campus Brussel</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200">
                        <span class="text-gray-600 font-medium">Deelnemer:</span>
                        <span class="font-bold">{{ form.first_name }} {{ form.last_name }}</span>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button @click="downloadCalendar" 
                    class="inline-flex items-center px-8 py-4 border-2 border-orange-500 text-orange-600 rounded-2xl font-bold hover:bg-orange-500 hover:text-white transition-all duration-300">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                📅 Toevoegen aan kalender
            </button>
            <a href="/login" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-2xl font-bold hover:from-orange-600 hover:to-red-600 transition-all duration-300 shadow-lg hover:shadow-xl">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                🚀 Bekijk je profiel
            </a>
        </div>
    </div>
    </div>
    </div>
    
    <!-- Premium Footer -->
    <footer class="bg-gradient-to-r from-orange-500 to-red-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center space-x-3 mb-4">
                    <img src="/images/logos/ehb-logo.png" alt="EHB logo" class="w-10 h-10 object-contain" />
                    <div class="text-white font-bold text-xl">erasmus</div>
                </div>
                <p class="text-orange-100 text-sm mb-4">
                    Hogeschool Brussel<br />
                    Connecting talent with opportunity
                </p>
                <div class="flex space-x-4">
                    <a href="https://www.linkedin.com/school/erasmus-hogeschool-brussel/" target="_blank" class="text-orange-200 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/erasmushogeschool/" target="_blank" class="text-orange-200 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987c6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.611-3.197-1.559-.748-.947-1.197-2.25-1.197-3.679 0-1.429.449-2.732 1.197-3.679.749-.948 1.9-1.559 3.197-1.559s2.448.611 3.197 1.559c.748.947 1.197 2.25 1.197 3.679 0 1.429-.449 2.732-1.197 3.679-.749.948-1.9 1.559-3.197 1.559z"/>
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
                    <li><Link href="/wiezijnwe" class="hover:text-white transition-colors">Wie zijn we?</Link></li>
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
    </div>
    </template>
    
    <script setup>
    import { Head, useForm } from '@inertiajs/vue3'
    import { ref, computed, onMounted, watch } from 'vue'
    import MainNavigation from '@/components/MainNavigation.vue'
    
    const props = defineProps({
    events: {
    type: Array,
    default: () => [
    {
    id: 1,
    title: 'Career Launch Event 2025',
    description: 'Het premium speeddate event van Erasmus Hogeschool Brussel',
    date: '15 maart 2025',
    time: '09:00 - 17:00',
    location: 'Campus Brussel - Hoofdgebouw',
    companies: 26,
    spotsLeft: 42
    }
    ]
    },
    companies: {
    type: Array,
    default: () => [
    { id: 1, name: 'Accenture', specialisatie: 'Consulting, digitale transformatie, technologie en outsourcing', industry: 'Consulting', location: 'Brussel', openPositions: 12 },
    { id: 2, name: 'Acolad', specialisatie: 'Vertalingen, lokalisatie, content en multimedia‑diensten', industry: 'Translation & Localization', location: 'Brussel', openPositions: 8 },
    { id: 3, name: 'Amista', specialisatie: 'SAP ERP, integratie & technologie, intelligente documentflows, digital learning', industry: 'SAP & ERP', location: 'Lier', openPositions: 6 },
    { id: 4, name: 'ARHS GROUP', specialisatie: 'Softwareontwikkeling, data science, infrastructure services, digital trust', industry: 'Software Development', location: 'Zaventem', openPositions: 15 },
    { id: 5, name: 'Avelon', specialisatie: 'SAP‑workflows, Procure‑to‑Pay, Master‑Data Governance, SIM/VIM', industry: 'SAP & ERP', location: 'Utrecht', openPositions: 7 },
    { id: 6, name: 'Axxes', specialisatie: 'IT‑consulting, software engineering, data, cloud, devops, QA', industry: 'IT Consulting', location: 'Antwerpen', openPositions: 9 },
    { id: 7, name: 'Bizztalent', specialisatie: 'IT‑consultancy, tijdelijke IT‑staffing, infrastructuuroplossingen', industry: 'IT Consulting', location: 'Gent', openPositions: 5 },
    { id: 8, name: 'Blents', specialisatie: 'IT consultancy, software development, digital solutions', industry: 'IT Consulting', location: 'Antwerpen', openPositions: 8 },
    { id: 9, name: 'BNP Paribas', specialisatie: 'Banking, financial services, digitale banking solutions, fintech', industry: 'Financial Services', location: 'Brussel', openPositions: 10 },
    { id: 10, name: 'Capgemini', specialisatie: 'Digital transformation, consulting, technology services, engineering', industry: 'Consulting', location: 'Diegem', openPositions: 12 },
    { id: 11, name: 'Colibri', specialisatie: 'Software development, custom applications, web development', industry: 'Software Development', location: 'Gent', openPositions: 6 },
    { id: 12, name: 'Colruyt Group', specialisatie: 'Retail technology, e-commerce, supply chain, digital innovation', industry: 'Retail Technology', location: 'Halle', openPositions: 14 },
    { id: 13, name: 'Delaware', specialisatie: 'IT-consulting, cloud- en ERP-oplossingen, digitale transformatie', industry: 'IT Consulting', location: 'Kortrijk', openPositions: 18 },
    { id: 14, name: 'Dilaco', specialisatie: 'Digital solutions, web development, e-commerce, mobile applications', industry: 'Digital Agency', location: 'Zaventem', openPositions: 4 },
    { id: 15, name: 'Eezee', specialisatie: 'User experience, interface design, digital products, frontend development', industry: 'UX/UI Design', location: 'Brussel', openPositions: 5 },
    { id: 16, name: 'Euricom', specialisatie: 'Software development, training, consultancy, modern web technologies', industry: 'Software Development', location: 'Antwerpen', openPositions: 7 },
    { id: 17, name: 'Equans', specialisatie: 'Smart building solutions, industrial automation, digitale infrastructuur', industry: 'Industrial Technology', location: 'Auderghem', openPositions: 9 },
    { id: 18, name: 'Exclusive Networks', specialisatie: 'Cybersecurity, cloud solutions, network infrastructure, technology distribution', industry: 'Cybersecurity', location: 'Diegem', openPositions: 11 },
    { id: 19, name: 'Flexso', specialisatie: 'SAP solutions, business process optimization, digital transformation', industry: 'SAP & ERP', location: 'Gent', openPositions: 13 },
    { id: 20, name: 'Gumption', specialisatie: 'Data & AI, cloud platforms, modern application development', industry: 'Data & AI', location: 'Gent', openPositions: 8 },
    { id: 21, name: 'Nexios IT', specialisatie: 'IT infrastructure, cloud services, managed services, cybersecurity', industry: 'IT Infrastructure', location: 'Mechelen', openPositions: 6 },
    { id: 22, name: 'Nomios', specialisatie: 'Network infrastructure, cybersecurity, cloud connectivity, data center', industry: 'Network & Security', location: 'Diegem', openPositions: 7 },
    { id: 23, name: 'Persolis', specialisatie: 'HR technology, payroll solutions, workforce management', industry: 'HR Technology', location: 'Brussel', openPositions: 5 },
    { id: 24, name: 'Safran', specialisatie: 'Aerospace technology, defense systems, high-tech engineering', industry: 'Aerospace & Defense', location: 'Zaventem', openPositions: 9 },
    { id: 25, name: 'Simac', specialisatie: 'IT solutions, digital workspace, business applications, managed services', industry: 'IT Services', location: 'Antwerpen', openPositions: 6 },
    { id: 26, name: 'Sopra Steria', specialisatie: 'Digital transformation, consulting, software development, systems integration', industry: 'Digital Transformation', location: 'Brussel', openPositions: 11 }
    ]
    }
    })
    
    // State management
    const currentStep = ref(1)
    const selectedEvent = ref(null)
    const selectedCompany = ref(null)
    const selectedTimeSlot = ref(null)
    
    // Company pagination
    const currentCompanyPage = ref(1)
    const companiesPerPage = ref(9)
    
    // Filter states
    const companySearchTerm = ref('')
    const selectedSector = ref('')
    
    // Progress steps
    const progressSteps = ref([
    { number: 1, title: 'Event selecteren', subtitle: 'Kies je event' },
    { number: 2, title: 'Bedrijf kiezen', subtitle: 'Pick your target' },
    { number: 3, title: 'Tijdslot kiezen', subtitle: 'Perfect timing' },
    { number: 4, title: 'Gegevens invullen', subtitle: 'Tell your story' },
    { number: 5, title: 'Bevestiging', subtitle: 'All set!' }
    ])
    
    // Enhanced time periods with extended hours (09:00 - 17:00)
    const timePeriods = ref([
    {
    name: 'Ochtend (09:00 - 12:00)',
    emoji: '🌅',
    slots: [
    { id: 1, startTime: '09:00', endTime: '09:15', available: true },
    { id: 2, startTime: '09:20', endTime: '09:35', available: true },
    { id: 3, startTime: '09:40', endTime: '09:55', available: false },
    { id: 4, startTime: '10:00', endTime: '10:15', available: true },
    { id: 5, startTime: '10:20', endTime: '10:35', available: true },
    { id: 6, startTime: '10:40', endTime: '10:55', available: true },
    { id: 7, startTime: '11:00', endTime: '11:15', available: false },
    { id: 8, startTime: '11:20', endTime: '11:35', available: true },
    { id: 9, startTime: '11:40', endTime: '11:55', available: true }
    ]
    },
    {
    name: 'Middag (13:00 - 15:00)',
    emoji: '🍽️',
    slots: [
    { id: 10, startTime: '13:00', endTime: '13:15', available: true },
    { id: 11, startTime: '13:20', endTime: '13:35', available: true },
    { id: 12, startTime: '13:40', endTime: '13:55', available: true },
    { id: 13, startTime: '14:00', endTime: '14:15', available: false },
    { id: 14, startTime: '14:20', endTime: '14:35', available: true },
    { id: 15, startTime: '14:40', endTime: '14:55', available: true }
    ]
    },
    {
    name: 'Namiddag (15:00 - 17:00)',
    emoji: '🌆',
    slots: [
    { id: 16, startTime: '15:00', endTime: '15:15', available: true },
    { id: 17, startTime: '15:20', endTime: '15:35', available: true },
    { id: 18, startTime: '15:40', endTime: '15:55', available: false },
    { id: 19, startTime: '16:00', endTime: '16:15', available: true },
    { id: 20, startTime: '16:20', endTime: '16:35', available: true },
    { id: 21, startTime: '16:40', endTime: '16:55', available: true }
    ]
    }
    ])
    
    // Form management
    const form = useForm({
    event_id: null,
    company_id: null,
    time_slot_id: null,
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    study_program: '',
    motivation: ''
    })
    
    // Computed properties
    const events = computed(() => props.events)
    const companies = computed(() => props.companies)
    const availableSpots = computed(() => selectedEvent.value?.spotsLeft || 42)
    const totalSpots = computed(() => 100)
    
    const availableSectors = computed(() => {
    const sectors = [...new Set(companies.value.map(company => company.industry))]
    return sectors.sort()
    })
    
    const filteredCompanies = computed(() => {
    let filtered = companies.value
    
    if (companySearchTerm.value) {
    const searchTerm = companySearchTerm.value.toLowerCase()
    filtered = filtered.filter(company => 
    company.name?.toLowerCase().includes(searchTerm) ||
    company.specialisatie?.toLowerCase().includes(searchTerm) ||
    company.industry?.toLowerCase().includes(searchTerm)
    )
    }
    
    if (selectedSector.value) {
    filtered = filtered.filter(company => company.industry === selectedSector.value)
    }
    
    return filtered
    })
    
    const totalCompanyPages = computed(() => {
    return Math.ceil(filteredCompanies.value.length / companiesPerPage.value)
    })
    
    const paginatedCompanies = computed(() => {
    const start = (currentCompanyPage.value - 1) * companiesPerPage.value
    const end = start + companiesPerPage.value
    return filteredCompanies.value.slice(start, end)
    })
    
    const isFormValid = computed(() => {
    return (
    form.first_name?.trim() &&
    form.last_name?.trim() &&
    form.email?.trim() &&
    form.study_program?.trim()
    )
    })
    
    // Methods
    function selectCareerLaunchEvent() {
    selectedEvent.value = events.value[0]
    currentStep.value = 2
    }
    
    function selectCompany(company) {
    selectedCompany.value = company
    selectedTimeSlot.value = null
    }
    
    function selectTimeSlot(slot) {
    if (!slot.available) return
    selectedTimeSlot.value = slot
    }
    
    function getTimeSlotClass(slot) {
    if (selectedTimeSlot.value?.id === slot.id) {
    return 'ring-2 ring-orange-500 bg-orange-100 border-orange-500 scale-105 shadow-lg'
    }
    if (!slot.available) {
    return 'opacity-50 cursor-not-allowed bg-gray-50 border-gray-200'
    }
    return 'hover:shadow-lg hover:border-orange-300 hover:scale-102 bg-white border-gray-200'
    }
    
    function changeCompanyPage(page) {
    if (page >= 1 && page <= totalCompanyPages.value) {
    currentCompanyPage.value = page
    // Scroll to companies section
    document.querySelector('.grid.md\\:grid-cols-2.lg\\:grid-cols-3')?.scrollIntoView({ 
    behavior: 'smooth', 
    block: 'start' 
    })
    }
    }
    
    function nextStep() {
    if (currentStep.value === 2 && !selectedCompany.value) {
    alert('Selecteer eerst een bedrijf om door te gaan.')
    return
    }
    if (currentStep.value === 3 && !selectedTimeSlot.value) {
    alert('Kies een tijdslot om door te gaan.')
    return
    }
    
    currentStep.value++
    }
    
    function prevStep() {
    if (currentStep.value > 1) {
    currentStep.value--
    }
    }
    
    function bookAppointment() {
    if (!isFormValid.value) {
    alert('Vul alle verplichte velden in.')
    return
    }
    
    form.event_id = selectedEvent.value.id
    form.company_id = selectedCompany.value.id
    form.time_slot_id = selectedTimeSlot.value.id
    
    // Simulate booking with loading state
    const loadingTimeout = setTimeout(() => {
    currentStep.value = 5
    }, 1500)
    
    // In real implementation, you would submit the form:
    // form.post('/api/appointments', {
    //     onSuccess: () => currentStep.value = 5,
    //     onError: (errors) => console.error(errors)
    // })
    }
    
    function downloadCalendar() {
  if (!selectedEvent.value || !selectedTimeSlot.value || !selectedCompany.value) return;

  try {
    const eventDate = '20250315'; // In juiste formaat
    const startTime = selectedTimeSlot.value.startTime.replace(':', '') + '00';
    const endTime = selectedTimeSlot.value.endTime.replace(':', '') + '00';

    const startDateTime = `${eventDate}T${startTime}`;
    const endDateTime = `${eventDate}T${endTime}`;

    const icsContent = `BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Erasmus Hogeschool Brussel//Career Launch//EN
BEGIN:VEVENT
UID:${Date.now()}@erasmus.be
DTSTAMP:${new Date().toISOString().replace(/[-:]/g, '').split('.')[0]}Z
DTSTART:${startDateTime}Z
DTEND:${endDateTime}Z
SUMMARY:Career Launch - ${selectedCompany.value.name}
DESCRIPTION:Speeddate gesprek met ${selectedCompany.value.name}\\nDeelnemer: ${form.first_name} ${form.last_name}\\nStudierichting: ${form.study_program || 'Niet opgegeven'}
LOCATION:Campus Brussel - Hoofdgebouw, Zaal A1.01
BEGIN:VALARM
TRIGGER:-PT30M
DESCRIPTION:Career Launch gesprek over 30 minuten
END:VALARM
END:VEVENT
END:VCALENDAR`;

    const blob = new Blob([icsContent], { type: 'text/calendar' });
    const url = window.URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = `career-launch-${selectedCompany.value.name.toLowerCase().replace(/\s+/g, '-')}.ics`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    window.URL.revokeObjectURL(url);
  } catch (error) {
    console.error('Calendar download error:', error);
    alert('Er was een probleem bij het downloaden van het kalenderbestand.');
  }
}

    
    // Watch for filter changes to reset pagination
    watch([companySearchTerm, selectedSector, companiesPerPage], () => {
    currentCompanyPage.value = 1
    })
    
    // Initialize
    onMounted(() => {
    if (!selectedEvent.value && events.value.length > 0) {
    selectedEvent.value = events.value[0]
    }
    })
    </script>
    
    <style scoped>
    /* Custom styles for enhanced UX */
    /* We don't need to define line-clamp-2 here as it's built into Tailwind */
    
    /* Enhanced hover effects */
    .hover\:scale-102:hover {
        transform: scale(1.02);
    }
    
    /* Smooth transitions for all interactive elements */
    * {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
    
    /* Custom scrollbar for better UX */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    /* Enhanced focus states for accessibility */
    input:focus,
    select:focus,
    textarea:focus,
    button:focus {
        outline: 2px solid #f97316;
        outline-offset: 2px;
    }
    
    /* Premium gradient animations */
    @keyframes gradient-shift {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }
    
    .bg-gradient-to-r {
        background-size: 200% 200%;
        animation: gradient-shift 6s ease infinite;
    }
    
    /* Loading state animations */
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }
    
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    /* Enhanced card hover effects */
    .group:hover .transform {
        transform: translateY(-4px);
    }
    
    /* Pro-level visual enhancements */
    .shadow-xl {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    /* Enhanced responsive design */
    @media (max-width: 768px) {
        .grid.md\:grid-cols-2.lg\:grid-cols-3 {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .px-8 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .text-5xl.lg\:text-6xl {
            font-size: 2.5rem;
            line-height: 1.2;
        }
    }
    
    /* Premium loading spinner */
    .loading-spinner {
        border: 3px solid #f3f4f6;
        border-top: 3px solid #f97316;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>