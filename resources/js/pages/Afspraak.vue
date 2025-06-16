<template>
  <div class="min-h-screen bg-orange-50">
      <Head title="Plan je afspraak - Erasmus Speeddate" />
      
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
                  
                  <!-- Desktop Navigation Links -->
                  <div class="hidden md:flex items-center space-x-1">
                      <Link href="/" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Home</Link>
                      <Link href="/info" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Info</Link>
                      <Link href="/afspraak" class="px-4 py-2 text-orange-600 font-medium">Afspraak</Link>
                      <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Contact</Link>
                      
                      <div class="flex items-center ml-6">
                          <Link href="/login" class="px-6 py-2 text-orange-600 hover:text-orange-700 font-medium transition-colors">Inloggen</Link>
                      </div>
                  </div>
              </div>
          </div>
      </nav>

      <!-- Main Content -->
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
          <!-- Header Section -->
          <div class="text-center mb-12">
              <div class="flex justify-center mb-6">
                  <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center shadow-lg">
                      <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                  </div>
              </div>
              <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                  Plan je <span class="text-orange-500">Career Launch gesprek</span>
              </h1>
              <p class="text-gray-600 text-xl max-w-3xl mx-auto leading-relaxed">
                  Ontmoet face-to-face de bedrijven die je interesseren. 
                  Kies een bedrijf en tijdslot voor een persoonlijk gesprek van 15 minuten.
              </p>
          </div>

          <!-- Booking Steps -->
          <div class="mb-12">
              <div class="flex items-center justify-center space-x-2 mb-8 overflow-x-auto">
                  <div class="flex items-center">
                      <div :class="currentStep >= 1 ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-600'" 
                           class="w-10 h-10 rounded-full flex items-center justify-center font-semibold">1</div>
                      <span class="ml-2 text-sm font-medium text-gray-700">Event selecteren</span>
                  </div>
                  <div class="w-6 h-0.5 bg-gray-300"></div>
                  <div class="flex items-center">
                      <div :class="currentStep >= 2 ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-600'" 
                           class="w-10 h-10 rounded-full flex items-center justify-center font-semibold">2</div>
                      <span class="ml-2 text-sm font-medium text-gray-700">Bedrijf kiezen</span>
                  </div>
                  <div class="w-6 h-0.5 bg-gray-300"></div>
                  <div class="flex items-center">
                      <div :class="currentStep >= 3 ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-600'" 
                           class="w-10 h-10 rounded-full flex items-center justify-center font-semibold">3</div>
                      <span class="ml-2 text-sm font-medium text-gray-700">Tijdslot kiezen</span>
                  </div>
                  <div class="w-6 h-0.5 bg-gray-300"></div>
                  <div class="flex items-center">
                      <div :class="currentStep >= 4 ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-600'" 
                           class="w-10 h-10 rounded-full flex items-center justify-center font-semibold">4</div>
                      <span class="ml-2 text-sm font-medium text-gray-700">Gegevens invullen</span>
                  </div>
                  <div class="w-6 h-0.5 bg-gray-300"></div>
                  <div class="flex items-center">
                      <div :class="currentStep >= 5 ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-600'" 
                           class="w-10 h-10 rounded-full flex items-center justify-center font-semibold">5</div>
                      <span class="ml-2 text-sm font-medium text-gray-700">Bevestiging</span>
                  </div>
              </div>
          </div>

          <!-- Step 1: Event Selection -->
          <div v-if="currentStep === 1" class="bg-white rounded-3xl shadow-lg p-8 mb-8">
              <h2 class="text-2xl font-bold text-gray-900 mb-6">Welkom bij Career Launch</h2>
              
              <!-- Career Launch Event Info -->
              <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-2xl p-6 mb-8">
                  <div class="flex items-start justify-between">
                          <div>
                          <h3 class="text-2xl font-semibold text-gray-900 mb-2">Career Launch Event</h3>
                          <p class="text-gray-600 mb-4">Ontmoet bedrijven en vind je perfecte stage of eerste job via persoonlijke gesprekken van 15 minuten.</p>
                          
                          <div class="grid md:grid-cols-2 gap-4 mb-6">
                              <div class="flex items-center text-gray-700">
                                  <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                  </svg>
                                  <span><strong>Datum:</strong> 15 maart 2025</span>
                          </div>
                              <div class="flex items-center text-gray-700">
                                  <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                  </svg>
                                  <span><strong>Tijd:</strong> 09:00 - 17:00</span>
                          </div>
                              <div class="flex items-center text-gray-700">
                                  <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                  </svg>
                                  <span><strong>Locatie:</strong> Campus Brussel</span>
                              </div>
                              <div class="flex items-center text-gray-700">
                                  <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                  </svg>
                                  <span><strong>25+ bedrijven</strong> aanwezig</span>
                              </div>
                          </div>
                          
                          <!-- Benefits -->
                          <div class="space-y-2">
                              <div class="flex items-center text-sm text-gray-600">
                                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                                  <span>Persoonlijke gesprekken van 15 minuten</span>
                              </div>
                              <div class="flex items-center text-sm text-gray-600">
                                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                                  <span>Directe feedback en netwerkmogelijkheden</span>
                              </div>
                              <div class="flex items-center text-sm text-gray-600">
                                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                  </svg>
                                  <span>Kans op stages en jobmogelijkheden</span>
                              </div>
                              </div>
                          </div>
                          <div class="text-right">
                          <div class="bg-white rounded-xl p-4 shadow-sm">
                              <div class="text-2xl font-bold text-orange-600">50</div>
                              <div class="text-sm text-gray-600">plekken vrij</div>
                          </div>
                      </div>
                  </div>
              </div>
              
              <div class="flex justify-between items-center">
                  <div class="text-sm text-gray-600">
                      <span class="font-medium text-orange-600">Volgende stap:</span> Kies het bedrijf waarmee je een gesprek wilt
                  </div>
                  <button @click="selectCareerLaunchEvent" 
                          class="px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-xl font-semibold transition-colors">
                      Deelnemen aan Career Launch
                  </button>
              </div>
          </div>

          <!-- Step 2: Company Selection -->
          <div v-if="currentStep === 2" class="bg-white rounded-3xl shadow-lg p-8 mb-8">
              <h2 class="text-2xl font-bold text-gray-900 mb-6">Kies een bedrijf</h2>
              
              <!-- Event info banner -->
              <div class="bg-orange-50 border-l-4 border-orange-500 p-4 mb-6">
                  <div class="flex">
                      <div class="flex-shrink-0">
                          <svg class="h-5 w-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                          </svg>
                      </div>
                      <div class="ml-3">
                          <p class="text-sm text-orange-700">
                              <strong>Career Launch Event</strong> • 15 maart 2025 • Campus Brussel
                          </p>
                          <p class="text-xs text-orange-600 mt-1">Selecteer het bedrijf waarmee je een 15-minuten gesprek wilt plannen.</p>
                      </div>
                  </div>
              </div>
              
              <!-- Companies grid -->
              <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                  <div v-for="company in companies" :key="company.id"
                       @click="selectCompany(company)"
                       :class="selectedCompany?.id === company.id ? 'ring-2 ring-orange-500 bg-orange-50' : 'hover:shadow-lg hover:border-orange-200'"
                       class="border border-gray-200 rounded-xl p-4 cursor-pointer transition-all">
                      <div class="flex items-start space-x-3">
                          <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                              <span class="text-lg font-bold text-gray-600">{{ company.name?.charAt(0) || '?' }}</span>
                          </div>
                          <div class="flex-1 min-w-0">
                              <h3 class="font-semibold text-gray-900 truncate">{{ company.name || 'Onbekend bedrijf' }}</h3>
                              <p class="text-sm text-gray-600 mb-2">{{ company.description || 'Geen beschrijving' }}</p>
                              <div class="flex items-center justify-between">
                                  <div class="flex items-center text-xs text-gray-500">
                                      <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded">{{ company.sector || 'Algemeen' }}</span>
                                  </div>
                                  <div class="text-xs text-green-600 font-medium">
                                      {{ company.openPositions || 0 }} posities open
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              
              <div class="flex justify-between">
                  <button @click="prevStep" class="px-8 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors">
                      Vorige stap
                  </button>
                  <button @click="nextStep" 
                          :disabled="!selectedCompany"
                          :class="selectedCompany ? 'bg-orange-500 hover:bg-orange-600' : 'bg-gray-300 cursor-not-allowed'"
                          class="px-8 py-3 text-white rounded-xl font-semibold transition-colors">
                      Volgende stap
                  </button>
              </div>
          </div>

          <!-- Step 3: Time Slot Selection -->
          <div v-if="currentStep === 3" class="bg-white rounded-3xl shadow-lg p-8 mb-8">
              <h2 class="text-2xl font-bold text-gray-900 mb-6">Kies je tijdslot</h2>
              
              <!-- Company & Event info banner -->
              <div v-if="selectedEvent && selectedCompany" class="bg-orange-50 border-l-4 border-orange-500 p-4 mb-6">
                  <div class="flex">
                      <div class="flex-shrink-0">
                          <svg class="h-5 w-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                          </svg>
                      </div>
                      <div class="ml-3">
                          <p class="text-sm text-orange-700">
                              <strong>{{ selectedCompany.name }}</strong> gesprek • {{ selectedEvent.date }} • {{ selectedEvent.location }}
                          </p>
                          <p class="text-xs text-orange-600 mt-1">Gesprek duurt 15 minuten. Er zijn 5 minuten tussen gesprekken om te wisselen.</p>
                      </div>
                  </div>
              </div>
              
              <!-- Loading state -->
              <div v-if="loading" class="flex justify-center items-center py-12">
                  <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-orange-500"></div>
                  <span class="ml-3 text-gray-600">Tijdslots laden...</span>
              </div>
              
              <!-- No timeslots available -->
              <div v-else-if="timeSlots.length === 0" class="text-center py-12">
                  <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                      <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                  </div>
                  <h3 class="text-lg font-semibold text-gray-900 mb-2">Geen tijdslots beschikbaar</h3>
                  <p class="text-gray-600">Er zijn momenteel geen tijdslots beschikbaar voor dit event.</p>
              </div>
              
              <!-- Timeslots grid -->
              <div v-else class="mb-8">
                  <h3 class="text-lg font-semibold text-gray-900 mb-4">Beschikbare tijdslots (15 minuten per gesprek)</h3>
                  <div class="grid md:grid-cols-4 lg:grid-cols-5 gap-3">
                      <div v-for="slot in timeSlots" :key="slot.id"
                           @click="selectTimeSlot(slot)"
                           :class="selectedTimeSlot?.id === slot.id ? 'ring-2 ring-orange-500 bg-orange-50 border-orange-300' : slot.available ? 'hover:shadow-md hover:border-orange-200 bg-white' : 'opacity-50 cursor-not-allowed bg-gray-50'"
                           class="border border-gray-200 rounded-lg p-3 cursor-pointer transition-all text-center">
                          <div class="font-semibold text-sm text-gray-900">{{ slot.time.split(' - ')[0] }}</div>
                          <div class="text-xs text-gray-600 mb-1">{{ slot.time.split(' - ')[1] }}</div>
                          <div v-if="slot.available" class="text-xs text-green-600 font-medium">
                              ✓ Beschikbaar
                          </div>
                          <div v-else class="text-xs text-red-500 font-medium">
                              ✗ Bezet
                          </div>
                      </div>
                  </div>
                  
                  <!-- Legend -->
                  <div class="mt-4 flex items-center justify-center space-x-6 text-sm text-gray-600">
                      <div class="flex items-center">
                          <div class="w-4 h-4 bg-white border border-gray-200 rounded mr-2"></div>
                          <span>Beschikbaar</span>
                      </div>
                      <div class="flex items-center">
                          <div class="w-4 h-4 bg-orange-50 border border-orange-300 rounded mr-2"></div>
                          <span>Geselecteerd</span>
                      </div>
                      <div class="flex items-center">
                          <div class="w-4 h-4 bg-gray-50 border border-gray-200 rounded mr-2 opacity-50"></div>
                          <span>Bezet</span>
                      </div>
                  </div>
              </div>
              
              <div class="flex justify-between">
                  <button @click="prevStep" class="px-8 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors">
                      Vorige stap
                  </button>
                  <button @click="nextStep" 
                          :disabled="!selectedTimeSlot || loading"
                          :class="selectedTimeSlot && !loading ? 'bg-orange-500 hover:bg-orange-600' : 'bg-gray-300 cursor-not-allowed'"
                          class="px-8 py-3 text-white rounded-xl font-semibold transition-colors">
                      <span v-if="loading">Laden...</span>
                      <span v-else>Volgende stap</span>
                  </button>
              </div>
          </div>

          <!-- Step 4: Personal Details -->
          <div v-if="currentStep === 4" class="bg-white rounded-3xl shadow-lg p-8 mb-8">
              <h2 class="text-2xl font-bold text-gray-900 mb-6">Jouw gegevens</h2>
              
              <!-- Error message -->
              <div v-if="Object.keys(form.errors).length > 0" class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
                  <div class="flex">
                      <div class="flex-shrink-0">
                          <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                          </svg>
                      </div>
                      <div class="ml-3">
                          <p class="text-sm text-red-700">Er zijn fouten in het formulier. Controleer de velden hieronder.</p>
                      </div>
                  </div>
              </div>
              
              <div class="grid md:grid-cols-2 gap-6">
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-2">Voornaam *</label>
                      <input v-model="form.first_name" 
                             type="text" 
                             required
                             :class="form.errors.first_name ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-orange-500'"
                             class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:border-transparent">
                      <div v-if="form.errors.first_name" class="text-red-500 text-sm mt-1">{{ form.errors.first_name }}</div>
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-2">Achternaam *</label>
                      <input v-model="form.last_name" 
                             type="text" 
                             required
                             :class="form.errors.last_name ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-orange-500'"
                             class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:border-transparent">
                      <div v-if="form.errors.last_name" class="text-red-500 text-sm mt-1">{{ form.errors.last_name }}</div>
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-2">E-mailadres *</label>
                      <input v-model="form.email" 
                             type="email" 
                             required
                             :class="form.errors.email ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-orange-500'"
                             class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:border-transparent">
                      <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
                  </div>
                  <div>
                      <label class="block text-sm font-medium text-gray-700 mb-2">Telefoonnummer</label>
                      <input v-model="form.phone" 
                             type="tel" 
                             class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                  </div>
                  <div class="md:col-span-2">
                      <label class="block text-sm font-medium text-gray-700 mb-2">Studierichting *</label>
                      <select v-model="form.study_program" 
                              required
                              :class="form.errors.study_program ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-orange-500'"
                              class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:border-transparent">
                          <option value="">Selecteer je studierichting</option>
                          <option value="Toegepaste Informatica">Toegepaste Informatica</option>
                          <option value="Business Management">Business Management</option>
                          <option value="Marketing">Marketing</option>
                          <option value="Accountancy-Fiscaliteit">Accountancy-Fiscaliteit</option>
                          <option value="Communicatiemanagement">Communicatiemanagement</option>
                          <option value="Financie- en Verzekeringswezen">Financie- en Verzekeringswezen</option>
                          <option value="Andere">Andere</option>
                      </select>
                      <div v-if="form.errors.study_program" class="text-red-500 text-sm mt-1">{{ form.errors.study_program }}</div>
                  </div>
                  <div class="md:col-span-2">
                      <label class="block text-sm font-medium text-gray-700 mb-2">Motivatie (optioneel)</label>
                      <textarea v-model="form.motivation" 
                                rows="4"
                                placeholder="Waarom wil je deelnemen aan dit speeddate event? Wat hoop je te bereiken?"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent"></textarea>
                      <div class="text-xs text-gray-500 mt-1">Dit helpt bedrijven om beter te begrijpen wat je zoekt.</div>
                  </div>
              </div>
              <div class="flex justify-between mt-8">
                  <button @click="prevStep" 
                          :disabled="form.processing"
                          class="px-8 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors disabled:opacity-50">
                      Vorige stap
                  </button>
                  <button @click="nextStep" 
                          :disabled="!isFormValid || form.processing"
                          :class="isFormValid && !form.processing ? 'bg-orange-500 hover:bg-orange-600' : 'bg-gray-300 cursor-not-allowed'"
                          class="px-8 py-3 text-white rounded-xl font-semibold transition-colors flex items-center">
                      <svg v-if="form.processing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                      </svg>
                      <span v-if="form.processing">Boeken...</span>
                      <span v-else>Afspraak bevestigen</span>
                  </button>
              </div>
          </div>

          <!-- Step 5: Confirmation -->
          <div v-if="currentStep === 5" class="bg-white rounded-3xl shadow-lg p-8 mb-8">
              <div class="text-center">
                  <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                      <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                  </div>
                  <h2 class="text-3xl font-bold text-gray-900 mb-4">Gesprek bevestigd! 🎉</h2>
                  <p class="text-gray-600 text-lg mb-8">
                      Je gesprek met {{ selectedCompany?.name }} is succesvol geboekt. We hebben een bevestigingsmail gestuurd naar {{ form.email }}.
                  </p>
                  
                  <div class="bg-orange-50 rounded-2xl p-6 mb-8 text-left">
                      <h3 class="font-semibold text-gray-900 mb-4">Jouw Career Launch gesprek:</h3>
                      <div class="space-y-3">
                          <div class="flex justify-between">
                              <span class="text-gray-600">Event:</span>
                              <span class="font-medium">{{ selectedEvent?.title }}</span>
                          </div>
                          <div class="flex justify-between">
                              <span class="text-gray-600">Bedrijf:</span>
                              <span class="font-medium">{{ selectedCompany?.name }}</span>
                          </div>
                          <div class="flex justify-between">
                              <span class="text-gray-600">Datum:</span>
                              <span class="font-medium">{{ selectedEvent?.date }}</span>
                          </div>
                          <div class="flex justify-between">
                              <span class="text-gray-600">Tijdslot:</span>
                              <span class="font-medium">{{ selectedTimeSlot?.time }}</span>
                          </div>
                          <div class="flex justify-between">
                              <span class="text-gray-600">Duur:</span>
                              <span class="font-medium">15 minuten</span>
                          </div>
                          <div class="flex justify-between">
                              <span class="text-gray-600">Locatie:</span>
                              <span class="font-medium">{{ selectedEvent?.location }}</span>
                          </div>
                          <div class="flex justify-between">
                              <span class="text-gray-600">Naam:</span>
                              <span class="font-medium">{{ form.first_name }} {{ form.last_name }}</span>
                          </div>
                      </div>
                  </div>

                  <div class="flex flex-col sm:flex-row gap-4 justify-center">
                      <button @click="downloadCalendar" class="inline-flex items-center px-6 py-3 border border-orange-500 text-orange-500 rounded-xl font-semibold hover:bg-orange-500 hover:text-white transition-colors">
                          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                          </svg>
                          Toevoegen aan kalender
                      </button>
                      <Link href="/login" class="inline-flex items-center px-6 py-3 bg-orange-500 text-white rounded-xl font-semibold hover:bg-orange-600 transition-colors">
                          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                          </svg>
                          Inloggen voor meer opties
                      </Link>
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
                          <li><Link href="/afspraak" class="hover:text-white transition-colors">Speeddate events</Link></li>
                      </ul>
                  </div>
                  
                  <div>
                      <h4 class="font-semibold mb-4">Voor bedrijven</h4>
                      <ul class="space-y-2 text-orange-100 text-sm">
                          <li><Link href="/bedrijven" class="hover:text-white transition-colors">Browse studenten</Link></li>
                      </ul>
                  </div>
                  
                  <div>
                      <h4 class="font-semibold mb-4">Support</h4>
                      <ul class="space-y-2 text-orange-100 text-sm">
                          <li><Link href="/contact" class="hover:text-white transition-colors">Contact</Link></li>
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
import { ref, computed, onMounted } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
  events: {
    type: Array,
    default: () => [
      {
        id: 1,
        title: 'Career Launch Event',
        description: 'Ontmoet bedrijven en vind je perfecte stage of eerste job via persoonlijke gesprekken',
        date: '15 maart 2025',
        time: '09:00 - 17:00',
        location: 'Campus Brussel - Hoofdgebouw',
        companies: 25,
        spotsLeft: 50
      }
    ]
  },
  companies: {
    type: Array,
    default: () => [
      { id: 1, name: 'Accenture', logo: '/images/logos/accenture.png', description: 'Technology & Consulting', openPositions: 8, sector: 'IT' },
      { id: 2, name: 'Capgemini', logo: '/images/logos/capgemini.png', description: 'Digital Transformation', openPositions: 5, sector: 'IT' },
      { id: 3, name: 'Delaware', logo: '/images/logos/delaware.png', description: 'Business & Technology Solutions', openPositions: 3, sector: 'IT' },
      { id: 4, name: 'BNP Paribas Fortis', logo: '/images/logos/bnp.png', description: 'Banking & Finance', openPositions: 6, sector: 'Finance' },
      { id: 5, name: 'Colruyt Group', logo: '/images/logos/colruyt.png', description: 'Retail & Technology', openPositions: 4, sector: 'Retail' },
      { id: 6, name: 'Flexso', logo: '/images/logos/flexso.png', description: 'SAP Solutions', openPositions: 2, sector: 'IT' }
    ]
  }
});

const currentStep = ref(1);
const selectedEvent = ref(null);
const selectedCompany = ref(null);
const timeSlots = ref([]);
const selectedTimeSlot = ref(null);
const events = computed(() => props.events);
const companies = computed(() => props.companies);
const loading = ref(false);
const appointmentId = ref(null);

// Inertia form voor appointment booking
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
});

const isFormValid = computed(() => {
  return (
    form.first_name &&
    form.last_name &&
    form.email &&
    form.study_program
  );
});

function selectCareerLaunchEvent() {
  selectedEvent.value = events.value[0]; // Selecteer automatisch het Career Launch event
  selectedCompany.value = null;
  selectedTimeSlot.value = null;
  timeSlots.value = [];
  form.clearErrors();
  currentStep.value = 2;
}

function selectEvent(event) {
  selectedEvent.value = event;
  selectedCompany.value = null;
  selectedTimeSlot.value = null;
  timeSlots.value = [];
  form.clearErrors();
}

function selectCompany(company) {
  selectedCompany.value = company;
  selectedTimeSlot.value = null;
  timeSlots.value = [];
  form.clearErrors();
  
  // Zorg ervoor dat het event is geselecteerd voordat tijdslots worden opgehaald
  if (!selectedEvent.value && events.value.length > 0) {
    selectedEvent.value = events.value[0]; // Auto-selecteer Career Launch event
  }
  
  if (selectedEvent.value) {
    fetchTimeSlots(selectedEvent.value.id, company.id);
  }
}

async function fetchTimeSlots(eventId, companyId) {
  loading.value = true;
  try {
    const res = await axios.get(`/api/events/${eventId}/companies/${companyId}/timeslots`);
    timeSlots.value = res.data.time_slots.map(slot => ({
      id: slot.id,
      time: slot.time_range || slot.time,
      duration: 15, // Standaard 15 minuten voor alle slots
      available: slot.available,
      spotsLeft: slot.spots_left || 0
    }));
  } catch (e) {
    // Fallback data voor development - realistische 15-minuten tijdslots voor de hele dag
    timeSlots.value = [
      { id: 1, time: '09:00 - 09:15', duration: 15, available: true, spotsLeft: 1 },
      { id: 2, time: '09:15 - 09:30', duration: 15, available: true, spotsLeft: 1 },
      { id: 3, time: '09:30 - 09:45', duration: 15, available: false, spotsLeft: 0 },
      { id: 4, time: '09:45 - 10:00', duration: 15, available: true, spotsLeft: 1 },
      { id: 5, time: '10:15 - 10:30', duration: 15, available: true, spotsLeft: 1 },
      { id: 6, time: '10:30 - 10:45', duration: 15, available: true, spotsLeft: 1 },
      { id: 7, time: '10:45 - 11:00', duration: 15, available: true, spotsLeft: 1 },
      { id: 8, time: '11:15 - 11:30', duration: 15, available: false, spotsLeft: 0 },
      { id: 9, time: '11:30 - 11:45', duration: 15, available: true, spotsLeft: 1 },
      { id: 10, time: '11:45 - 12:00', duration: 15, available: true, spotsLeft: 1 },
      { id: 11, time: '13:00 - 13:15', duration: 15, available: true, spotsLeft: 1 },
      { id: 12, time: '13:15 - 13:30', duration: 15, available: true, spotsLeft: 1 },
      { id: 13, time: '13:30 - 13:45', duration: 15, available: true, spotsLeft: 1 },
      { id: 14, time: '13:45 - 14:00', duration: 15, available: false, spotsLeft: 0 },
      { id: 15, time: '14:15 - 14:30', duration: 15, available: true, spotsLeft: 1 },
      { id: 16, time: '14:30 - 14:45', duration: 15, available: true, spotsLeft: 1 },
      { id: 17, time: '14:45 - 15:00', duration: 15, available: true, spotsLeft: 1 },
      { id: 18, time: '15:15 - 15:30', duration: 15, available: true, spotsLeft: 1 },
      { id: 19, time: '15:30 - 15:45', duration: 15, available: true, spotsLeft: 1 },
      { id: 20, time: '15:45 - 16:00', duration: 15, available: true, spotsLeft: 1 }
    ];
  } finally {
    loading.value = false;
  }
}

function selectTimeSlot(slot) {
  if (!slot.available) return;
  selectedTimeSlot.value = slot;
  form.clearErrors();
}

function nextStep() {
  // Auto-selecteer Career Launch event als het nog niet geselecteerd is
  if (!selectedEvent.value && events.value.length > 0) {
    selectedEvent.value = events.value[0];
  }
  
  if (currentStep.value === 2 && !selectedCompany.value) return;
  if (currentStep.value === 3 && !selectedTimeSlot.value) return;
  if (currentStep.value === 4 && !isFormValid.value) return;
  if (currentStep.value === 4) {
    bookAppointment();
    return;
  }
  currentStep.value++;
}

function prevStep() {
  if (currentStep.value > 1) currentStep.value--;
}

function bookAppointment() {
  // Update form data
  form.event_id = selectedEvent.value.id;
  form.company_id = selectedCompany.value.id;
  form.time_slot_id = selectedTimeSlot.value.id;
  
  // Submit via Inertia
  form.post('/api/appointments', {
    onSuccess: (response) => {
      appointmentId.value = response.props.appointment?.id;
      currentStep.value = 5;
    },
    onError: (errors) => {
      // Errors are automatically handled by Inertia form
      console.error('Booking error:', errors);
    }
  });
}

const downloadCalendar = () => {
  // Generate ICS file for calendar
  const event = selectedEvent.value
  const timeSlot = selectedTimeSlot.value
  
  const startDate = new Date(event.date + ' ' + timeSlot.time.split(' - ')[0])
  const endDate = new Date(event.date + ' ' + timeSlot.time.split(' - ')[1])
  
  const icsContent = `BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Erasmus Hogeschool Brussel//Speeddate//EN
BEGIN:VEVENT
UID:${Date.now()}@erasmus.be
DTSTAMP:${new Date().toISOString().replace(/[-:]/g, '').split('.')[0]}Z
DTSTART:${startDate.toISOString().replace(/[-:]/g, '').split('.')[0]}Z
DTEND:${endDate.toISOString().replace(/[-:]/g, '').split('.')[0]}Z
SUMMARY:${event.title}
DESCRIPTION:Speeddate event met bedrijven
LOCATION:${event.location}
END:VEVENT
END:VCALENDAR`
  
  const blob = new Blob([icsContent], { type: 'text/calendar' })
  const url = window.URL.createObjectURL(blob)
  const link = document.createElement('a')
  link.href = url
  link.download = 'speeddate-afspraak.ics'
  link.click()
  window.URL.revokeObjectURL(url)
}

// Auto-selecteer Career Launch event wanneer component geladen wordt
onMounted(() => {
  if (!selectedEvent.value && events.value.length > 0) {
    selectedEvent.value = events.value[0];
  }
});
</script>