<template>
    <div class="appointment-booking">
      <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
          <!-- Header -->
          <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Maak een afspraak</h1>
            <p class="text-gray-600">Plan een gesprek met jouw favoriete bedrijf</p>
          </div>
  
          <!-- Progress Steps -->
          <div class="mb-8">
            <div class="flex items-center justify-center">
              <div v-for="(step, index) in steps" :key="index" class="flex items-center">
                <div class="flex items-center">
                  <div 
                    :class="[
                      'w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium',
                      currentStep > index 
                        ? 'bg-orange-500 text-white' 
                        : currentStep === index 
                          ? 'bg-orange-100 text-orange-600 border-2 border-orange-500'
                          : 'bg-gray-200 text-gray-500'
                    ]"
                  >
                    {{ index + 1 }}
                  </div>
                  <span :class="['ml-2 text-sm font-medium', currentStep >= index ? 'text-gray-900' : 'text-gray-500']">
                    {{ step }}
                  </span>
                </div>
                <div v-if="index < steps.length - 1" class="w-12 h-px bg-gray-300 mx-4"></div>
              </div>
            </div>
          </div>
  
          <!-- Form Card -->
          <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <form @submit.prevent="submitAppointment" class="p-6">
              
              <!-- Step 0: Bedrijf Selectie -->
              <div v-show="currentStep === 0" class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Selecteer een bedrijf</h2>
                
                <!-- Search Bar -->
                <div class="relative">
                  <input
                    v-model="companySearch"
                    type="text"
                    placeholder="Zoek naar een bedrijf..."
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                  >
                  <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                  </svg>
                </div>
  
                <!-- Company Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                  <div
                    v-for="company in filteredCompanies"
                    :key="company.id"
                    @click="selectCompany(company)"
                    :class="[
                      'p-4 border-2 rounded-lg cursor-pointer transition-all duration-200 hover:shadow-md',
                      selectedCompany?.id === company.id 
                        ? 'border-orange-500 bg-orange-50' 
                        : 'border-gray-200 hover:border-orange-300'
                    ]"
                  >
                    <div class="flex items-center space-x-3">
                      <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex items-center justify-center text-white font-bold">
                        {{ company.name.charAt(0) }}
                      </div>
                      <div>
                        <h3 class="font-medium text-gray-900">{{ company.name }}</h3>
                        <p class="text-sm text-gray-500">{{ company.type }}</p>
                        <div class="flex items-center mt-1">
                          <div class="flex text-yellow-400">
                            <svg v-for="i in 5" :key="i" class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                              <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                          </div>
                          <span class="text-xs text-gray-500 ml-1">({{ company.rating }})</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
  
              <!-- Step 1: Datum & Tijd Selectie -->
              <div v-show="currentStep === 1" class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Selecteer datum en tijd</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                  <!-- Calendar -->
                  <div>
                    <h3 class="font-medium text-gray-900 mb-3">Kies een datum</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                      <!-- Calendar Header -->
                      <div class="flex items-center justify-between mb-4">
                        <button 
                          type="button"
                          @click="previousMonth"
                          class="p-1 hover:bg-gray-200 rounded"
                        >
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                          </svg>
                        </button>
                        <h4 class="text-lg font-medium">{{ currentMonthYear }}</h4>
                        <button 
                          type="button"
                          @click="nextMonth"
                          class="p-1 hover:bg-gray-200 rounded"
                        >
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                          </svg>
                        </button>
                      </div>
  
                      <!-- Days of Week -->
                      <div class="grid grid-cols-7 gap-1 mb-2">
                        <div v-for="day in daysOfWeek" :key="day" class="text-center text-sm font-medium text-gray-500 py-2">
                          {{ day }}
                        </div>
                      </div>
  
                      <!-- Calendar Days -->
                      <div class="grid grid-cols-7 gap-1">
                        <button
                          v-for="date in calendarDays"
                          :key="date.date"
                          type="button"
                          @click="selectDate(date)"
                          :disabled="!date.available || date.isPast"
                          :class="[
                            'h-10 w-10 text-sm rounded-lg transition-colors duration-200',
                            date.isToday ? 'bg-blue-100 text-blue-600' : '',
                            selectedDate === date.date && date.available 
                              ? 'bg-orange-500 text-white' 
                              : date.available && !date.isPast
                                ? 'hover:bg-orange-100 text-gray-900'
                                : 'text-gray-400 cursor-not-allowed',
                            !date.inCurrentMonth ? 'text-gray-300' : ''
                          ]"
                        >
                          {{ date.day }}
                        </button>
                      </div>
                    </div>
                  </div>
  
                  <!-- Time Slots -->
                  <div>
                    <h3 class="font-medium text-gray-900 mb-3">Beschikbare tijdsloten</h3>
                    <div v-if="selectedDate" class="space-y-3">
                      <div v-for="period in timePeriods" :key="period.name" class="space-y-2">
                        <h4 class="text-sm font-medium text-gray-700">{{ period.name }}</h4>
                        <div class="grid grid-cols-2 gap-2">
                          <button
                            v-for="slot in period.slots"
                            :key="slot.time"
                            type="button"
                            @click="selectTimeSlot(slot)"
                            :disabled="!slot.available"
                            :class="[
                              'p-3 text-sm border rounded-lg transition-all duration-200',
                              selectedTimeSlot?.time === slot.time
                                ? 'border-orange-500 bg-orange-50 text-orange-700'
                                : slot.available
                                  ? 'border-gray-300 hover:border-orange-300 hover:bg-orange-50'
                                  : 'border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed'
                            ]"
                          >
                            {{ slot.time }}
                            <span v-if="!slot.available" class="block text-xs">Bezet</span>
                          </button>
                        </div>
                      </div>
                    </div>
                    <div v-else class="text-gray-500 text-center py-8">
                      Selecteer eerst een datum
                    </div>
                  </div>
                </div>
              </div>
  
              <!-- Step 2: Persoonlijke Gegevens -->
              <div v-show="currentStep === 2" class="space-y-6">
                <div class="flex justify-between items-center mb-4">
                  <h2 class="text-xl font-semibold text-gray-900">Persoonlijke gegevens</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Voornaam *</label>
                    <input
                      v-model="personalInfo.firstName"
                      type="text"
                      required
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                      :class="{ 'border-red-500': errors.firstName }"
                    >
                    <p v-if="errors.firstName" class="mt-1 text-sm text-red-600">{{ errors.firstName }}</p>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Achternaam *</label>
                    <input
                      v-model="personalInfo.lastName"
                      type="text"
                      required
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                      :class="{ 'border-red-500': errors.lastName }"
                    >
                    <p v-if="errors.lastName" class="mt-1 text-sm text-red-600">{{ errors.lastName }}</p>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">E-mail *</label>
                    <input
                      v-model="personalInfo.email"
                      type="email"
                      required
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                      :class="{ 'border-red-500': errors.email }"
                    >
                    <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email }}</p>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Telefoonnummer *</label>
                    <input
                      v-model="personalInfo.phone"
                      type="tel"
                      required
                      pattern="[0-9+\s-()]{10,}"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                      :class="{ 'border-red-500': errors.phone }"
                      placeholder="+32 4XX XX XX XX"
                    >
                    <p v-if="errors.phone" class="mt-1 text-sm text-red-600">{{ errors.phone }}</p>
                  </div>
                </div>

                <!-- Studie Informatie -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Studierichting *</label>
                    <select
                      v-model="personalInfo.studyField"
                      required
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                      :class="{ 'border-red-500': errors.studyField }"
                    >
                      <option value="">Selecteer je studierichting</option>
                      <option value="computer_science">Computer Science</option>
                      <option value="business">Business</option>
                      <option value="engineering">Engineering</option>
                      <option value="design">Design</option>
                      <option value="other">Andere</option>
                    </select>
                    <p v-if="errors.studyField" class="mt-1 text-sm text-red-600">{{ errors.studyField }}</p>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Studiejaar *</label>
                    <select
                      v-model="personalInfo.studyYear"
                      required
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                      :class="{ 'border-red-500': errors.studyYear }"
                    >
                      <option value="">Selecteer je studiejaar</option>
                      <option value="1">1e Bachelor</option>
                      <option value="2">2e Bachelor</option>
                      <option value="3">3e Bachelor</option>
                      <option value="4">1e Master</option>
                      <option value="5">2e Master</option>
                    </select>
                    <p v-if="errors.studyYear" class="mt-1 text-sm text-red-600">{{ errors.studyYear }}</p>
                  </div>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Onderwerp gesprek *</label>
                  <select
                    v-model="personalInfo.subject"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                    :class="{ 'border-red-500': errors.subject }"
                  >
                    <option value="">Selecteer een onderwerp</option>
                    <option value="stage">Stage mogelijkheden</option>
                    <option value="thesis">Thesis begeleiding</option>
                    <option value="job">Vacature bespreking</option>
                    <option value="collaboration">Samenwerking</option>
                    <option value="other">Anders</option>
                  </select>
                  <p v-if="errors.subject" class="mt-1 text-sm text-red-600">{{ errors.subject }}</p>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Extra informatie</label>
                  <textarea
                    v-model="personalInfo.notes"
                    rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                    placeholder="Vertel ons meer over wat je wilt bespreken..."
                  ></textarea>
                </div>
              </div>
  
              <!-- Step 3: Bevestiging -->
              <div v-show="currentStep === 3" class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Bevestig uw afspraak</h2>
                
                <div class="bg-gray-50 rounded-lg p-6">
                  <div class="space-y-4">
                    <div class="flex justify-between">
                      <span class="font-medium text-gray-700">Bedrijf:</span>
                      <span>{{ selectedCompany?.name }}</span>
                    </div>
                    <div class="flex justify-between">
                      <span class="font-medium text-gray-700">Datum:</span>
                      <span>{{ formatDate(selectedDate) }}</span>
                    </div>
                    <div class="flex justify-between">
                      <span class="font-medium text-gray-700">Tijd:</span>
                      <span>{{ selectedTimeSlot?.time }}</span>
                    </div>
                    <div class="flex justify-between">
                      <span class="font-medium text-gray-700">Naam:</span>
                      <span>{{ personalInfo.firstName }} {{ personalInfo.lastName }}</span>
                    </div>
                    <div class="flex justify-between">
                      <span class="font-medium text-gray-700">E-mail:</span>
                      <span>{{ personalInfo.email }}</span>
                    </div>
                    <div class="flex justify-between">
                      <span class="font-medium text-gray-700">Onderwerp:</span>
                      <span>{{ getSubjectLabel(personalInfo.subject) }}</span>
                    </div>
                  </div>
                </div>
  
                <!-- Login Section -->
                <div v-if="!isLoggedIn" class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                  <div class="text-center">
                    <h3 class="text-lg font-medium text-blue-900 mb-2">Account vereist voor bevestiging</h3>
                    <p class="text-blue-700 mb-4">
                      Om uw afspraak te bevestigen heeft u een account nodig. U kunt inloggen met een bestaand account of als gast doorgaan.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                      <button
                        type="button"
                        @click="redirectToLogin"
                        class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition-colors duration-200"
                      >
                        Inloggen / Registreren
                      </button>
                      <button
                        type="button"
                        @click="continueAsGuest"
                        class="border border-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200"
                      >
                        Doorgaan als gast
                      </button>
                    </div>
                  </div>
                </div>
  
                <!-- Logged in confirmation -->
                <div v-else class="bg-green-50 border border-green-200 rounded-lg p-4">
                  <div class="flex">
                    <svg class="w-5 h-5 text-green-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="ml-3">
                      <h3 class="text-sm font-medium text-green-800">Ingelogd</h3>
                      <p class="text-sm text-green-700 mt-1">
                        Welkom terug, {{ currentUser?.firstName }}! Uw afspraak wordt gekoppeld aan uw account.
                      </p>
                    </div>
                  </div>
                </div>
  
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                  <div class="flex">
                    <svg class="w-5 h-5 text-blue-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="ml-3">
                      <h3 class="text-sm font-medium text-blue-800">Belangrijk</h3>
                      <p class="text-sm text-blue-700 mt-1">
                        U ontvangt een bevestigingsmail met alle details en eventuele voorbereiding voor het gesprek.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
  
              <!-- Navigation Buttons -->
              <div class="flex justify-between mt-8">
                <button
                  v-if="currentStep > 0"
                  type="button"
                  @click="previousStep"
                  class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-500"
                >
                  Vorige
                </button>
                <div class="flex-1"></div>
                <button
                  v-if="currentStep < steps.length - 1"
                  type="button"
                  @click="nextStep"
                  class="px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500"
                  :disabled="!canProceed"
                >
                  Volgende
                </button>
                <button
                  v-else
                  type="submit"
                  class="px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500"
                  :disabled="!isFormValid"
                >
                  Afspraak Bevestigen
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
  
      <!-- Success Modal -->
      <div v-if="showSuccessModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-md mx-4">
          <div class="text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Afspraak bevestigd!</h3>
            <p class="text-gray-600 mb-6">Uw afspraak is succesvol geboekt. U ontvangt binnenkort een bevestigingsmail.</p>
            <button
              @click="resetForm"
              class="w-full bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors duration-200"
            >
              Nieuwe afspraak maken
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AppointmentBooking',
    data() {
      return {
        currentStep: 0,
        steps: ['Bedrijf', 'Datum & Tijd', 'Persoonlijke gegevens', 'Bevestiging'],
        
        // Authentication (moved to end)
        isLoggedIn: false,
        currentUser: null,
        showLoginPrompt: false,
        
        // Company selection
        companySearch: '',
        selectedCompany: null,
        companies: [
          { id: 1, name: 'TechCorp Belgium', type: 'Software Development', rating: 4.8 },
          { id: 2, name: 'Digital Solutions', type: 'IT Consulting', rating: 4.6 },
          { id: 3, name: 'InnovateLab', type: 'Startup Incubator', rating: 4.9 },
          { id: 4, name: 'DataDriven Analytics', type: 'Data Science', rating: 4.7 },
          { id: 5, name: 'CloudTech Services', type: 'Cloud Computing', rating: 4.5 },
          { id: 6, name: 'CyberSec Pro', type: 'Cybersecurity', rating: 4.8 }
        ],
  
        // Date & time selection
        currentDate: new Date(),
        selectedDate: null,
        selectedTimeSlot: null,
        daysOfWeek: ['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'],
  
        // Personal information
        personalInfo: {
          firstName: '',
          lastName: '',
          email: '',
          phone: '',
          studyField: '',
          studyYear: '',
          subject: '',
          notes: ''
        },
  
        // Form state
        isSubmitting: false,
        showSuccessModal: false,
        errors: {}
      }
    },
  
    computed: {
      filteredCompanies() {
        if (!this.companySearch) return this.companies;
        return this.companies.filter(company => 
          company.name.toLowerCase().includes(this.companySearch.toLowerCase()) ||
          company.type.toLowerCase().includes(this.companySearch.toLowerCase())
        );
      },
  
      currentMonthYear() {
        return this.currentDate.toLocaleDateString('nl-BE', { 
          month: 'long', 
          year: 'numeric' 
        });
      },
  
      calendarDays() {
        const year = this.currentDate.getFullYear();
        const month = this.currentDate.getMonth();
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const startDate = new Date(firstDay);
        startDate.setDate(startDate.getDate() - ((firstDay.getDay() + 6) % 7));
        
        const days = [];
        const today = new Date();
        today.setHours(0, 0, 0, 0);
  
        for (let i = 0; i < 42; i++) {
          const date = new Date(startDate);
          date.setDate(startDate.getDate() + i);
          
          const isToday = date.getTime() === today.getTime();
          const isPast = date < today;
          const inCurrentMonth = date.getMonth() === month;
          const available = inCurrentMonth && !isPast && date.getDay() !== 0 && date.getDay() !== 6; // Exclude weekends
  
          days.push({
            date: date.toISOString().split('T')[0],
            day: date.getDate(),
            isToday,
            isPast,
            inCurrentMonth,
            available
          });
        }
  
        return days;
      },
  
      timePeriods() {
        if (!this.selectedDate) return [];
        
        return [
          {
            name: 'Ochtend',
            slots: [
              { time: '09:00', available: true },
              { time: '09:30', available: true },
              { time: '10:00', available: false },
              { time: '10:30', available: true },
              { time: '11:00', available: true },
              { time: '11:30', available: true }
            ]
          },
          {
            name: 'Middag',
            slots: [
              { time: '13:00', available: true },
              { time: '13:30', available: true },
              { time: '14:00', available: true },
              { time: '14:30', available: false },
              { time: '15:00', available: true },
              { time: '15:30', available: true }
            ]
          },
          {
            name: 'Namiddag',
            slots: [
              { time: '16:00', available: true },
              { time: '16:30', available: true },
              { time: '17:00', available: false },
              { time: '17:30', available: true }
            ]
          }
        ];
      },
  
      canProceed() {
        switch (this.currentStep) {
          case 0: return this.selectedCompany !== null;
          case 1: return this.selectedDate && this.selectedTimeSlot;
          case 2: return this.personalInfo.firstName && this.personalInfo.lastName && 
                        this.personalInfo.email && this.personalInfo.subject;
          case 3: return this.isLoggedIn || this.showLoginPrompt;
          default: return true;
        }
      },
  
      isFormValid() {
        return (
          this.personalInfo.firstName &&
          this.personalInfo.lastName &&
          this.personalInfo.email &&
          this.personalInfo.phone &&
          this.personalInfo.studyField &&
          this.personalInfo.studyYear &&
          this.personalInfo.subject
        );
      }
    },
  
    methods: {
      // Company selection
      selectCompany(company) {
        this.selectedCompany = company;
      },
  
      // Authentication with existing login page
      redirectToLogin() {
        // Save current appointment data in sessionStorage before redirect
        const appointmentData = {
          company: this.selectedCompany,
          date: this.selectedDate,
          timeSlot: this.selectedTimeSlot,
          personalInfo: this.personalInfo
        };
        sessionStorage.setItem('pendingAppointment', JSON.stringify(appointmentData));
        
        // Redirect to existing login page
        window.location.href = '/login?redirect=' + encodeURIComponent(window.location.pathname);
      },
  
      continueAsGuest() {
        this.showLoginPrompt = true;
      },
  
      // Check if user returned from login
      checkLoginStatus() {
        // This method would check if user is logged in (from Laravel session/JWT)
        // For demo purposes, we'll check URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('logged_in') === 'true') {
          this.isLoggedIn = true;
          this.currentUser = {
            firstName: urlParams.get('firstName') || 'John',
            lastName: urlParams.get('lastName') || 'Doe',
            email: urlParams.get('email') || 'john@example.com'
          };
          
          // Restore appointment data if available
          const savedData = sessionStorage.getItem('pendingAppointment');
          if (savedData) {
            const data = JSON.parse(savedData);
            this.selectedCompany = data.company;
            this.selectedDate = data.date;
            this.selectedTimeSlot = data.timeSlot;
            this.personalInfo = data.personalInfo;
            sessionStorage.removeItem('pendingAppointment');
            this.currentStep = 3; // Go to confirmation step
          }
        }
      },
  
      // Navigation
      nextStep() {
        if (this.canProceed && this.currentStep < 3) {
          this.currentStep++;
        }
      },
  
      previousStep() {
        if (this.currentStep > 0) {
          this.currentStep--;
        }
      },
  
      // Calendar navigation
      previousMonth() {
        this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1, 1);
      },
  
      nextMonth() {
        this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 1);
      },
  
      // Date & time selection
      selectDate(date) {
        if (date.available && !date.isPast) {
          this.selectedDate = date.date;
          this.selectedTimeSlot = null; // Reset time slot when date changes
        }
      },
  
      selectTimeSlot(slot) {
        if (slot.available) {
          this.selectedTimeSlot = slot;
        }
      },
  
      // Utility methods
      formatDate(dateStr) {
        if (!dateStr) return '';
        const date = new Date(dateStr);
        return date.toLocaleDateString('nl-BE', {
          weekday: 'long',
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        });
      },
  
      getSubjectLabel(value) {
        const subjects = {
          stage: 'Stage mogelijkheden',
          thesis: 'Thesis begeleiding',
          job: 'Vacature bespreking',
          collaboration: 'Samenwerking',
          other: 'Anders'
        };
        return subjects[value] || value;
      },
  
      // Form submission
      async submitAppointment() {
        this.isSubmitting = true;
        
        const appointmentData = {
          company: this.selectedCompany,
          date: this.selectedDate,
          time: this.selectedTimeSlot.time,
          personalInfo: this.personalInfo
        };
  
        try {
          // Simulate API call
          await new Promise(resolve => setTimeout(resolve, 2000));
          
          // Here you would normally send data to your Laravel backend
          console.log('Appointment data:', appointmentData);
          
          this.showSuccessModal = true;
        } catch (error) {
          console.error('Error submitting appointment:', error);
          // Handle error (show error message, etc.)
        } finally {
          this.isSubmitting = false;
        }
      },
  
      resetForm() {
        this.currentStep = 0;
        this.selectedCompany = null;
        this.selectedDate = null;
        this.selectedTimeSlot = null;
        this.personalInfo = {
          firstName: '',
          lastName: '',
          email: '',
          phone: '',
          studyField: '',
          studyYear: '',
          subject: '',
          notes: ''
        };
        this.showSuccessModal = false;
        this.showLoginPrompt = false;
        this.errors = {};
      }
    },
  
    mounted() {
      // Check if user is returning from login
      this.checkLoginStatus();
    }
  }
  </script>
  
  <style scoped>
  .appointment-booking {
    min-height: 100vh;
    background-color: #f9fafb;
  }
  </style>