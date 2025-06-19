<template>
    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-orange-50">
      <Head title="Contact - Career Launch 2025" />
      
      <!-- Navigation -->
      <nav class="bg-white/80 backdrop-blur-lg shadow-lg sticky top-0 z-40 border-b border-orange-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <Link href="/" class="flex items-center space-x-3 group">
              <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-700 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                <span class="text-white font-bold text-lg">E</span>
              </div>
              <div>
                <div class="text-gray-900 font-bold text-xl">erasmus</div>
                <div class="text-xs text-gray-600 -mt-1">HOGESCHOOL BRUSSEL</div>
              </div>
            </Link>
  
            <!-- Mobile menu button -->
            <div class="md:hidden">
              <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-gray-700 hover:bg-orange-100 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
              </button>
            </div>
  
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1">
              <Link href="/" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors rounded-lg hover:bg-orange-50">Home</Link>
              <Link href="/info" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors rounded-lg hover:bg-orange-50">Info</Link>
              <Link href="/bedrijven" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors rounded-lg hover:bg-orange-50">Bedrijven</Link>
              <Link href="/favorieten" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors rounded-lg hover:bg-orange-50 relative">
                Favorieten
                <span v-if="favoritenCount > 0" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                  {{ favoritenCount }}
                </span>
              </Link>
              <Link href="/contact" class="px-4 py-2 text-orange-600 bg-orange-100 rounded-lg font-medium">Contact</Link>
              <div class="flex items-center ml-6">
                <Link href="/login" class="px-6 py-2 text-orange-600 hover:text-orange-700 font-medium transition-colors">Inloggen</Link>
              </div>
            </div>
          </div>
  
          <!-- Mobile menu -->
          <div v-show="mobileMenuOpen" class="md:hidden mt-4 pb-4 border-t border-orange-200">
            <div class="flex flex-col space-y-2 pt-4">
              <Link href="/" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium rounded-lg">Home</Link>
              <Link href="/info" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium rounded-lg">Info</Link>
              <Link href="/bedrijven" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium rounded-lg">Bedrijven</Link>
              <Link href="/favorieten" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium rounded-lg">Favorieten</Link>
              <Link href="/contact" class="px-4 py-2 text-orange-600 bg-orange-100 font-medium rounded-lg">Contact</Link>
              <Link href="/login" class="px-4 py-2 text-orange-600 hover:text-orange-700 font-medium rounded-lg">Inloggen</Link>
            </div>
          </div>
        </div>
      </nav>
  
      <!-- Hero Section -->
      <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
          <div class="inline-flex items-center px-4 py-2 bg-orange-100 rounded-full text-orange-700 text-sm font-medium mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            Neem Contact Op
          </div>
          <h1 class="text-5xl lg:text-6xl font-bold bg-gradient-to-r from-gray-900 via-orange-600 to-red-600 bg-clip-text text-transparent mb-6">
            We helpen je graag
          </h1>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Heb je vragen over Career Launch 2025? Neem contact met ons op via onderstaande kanalen. 
            Ons team staat klaar om je te helpen!
          </p>
        </div>
      </section>
  
      <!-- Contact Cards -->
      <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        <div class="grid lg:grid-cols-2 gap-8 mb-12">
          <!-- Email Card -->
          <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
            <div class="flex items-center mb-6">
              <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mr-6 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">E-mail</h2>
                <p class="text-gray-600">Stuur ons een bericht</p>
              </div>
            </div>
            
            <div class="space-y-4">
              <div class="bg-orange-50 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-3">
                  <strong class="text-gray-900 text-lg">Student Support</strong>
                  <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                </div>
                <a href="mailto:gdt.kaai.student@ehb.be" class="text-orange-600 hover:text-orange-700 font-semibold text-lg transition-colors block">
                  gdt.kaai.student@ehb.be
                </a>
                <p class="text-gray-600 text-sm mt-2">Voor vragen over Career Launch</p>
              </div>
              
              <div class="bg-gray-50 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-3">
                  <strong class="text-gray-900 text-lg">Algemene Info</strong>
                  <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                </div>
                <a href="mailto:info@ehb.be" class="text-orange-600 hover:text-orange-700 font-semibold text-lg transition-colors block">
                  info@ehb.be
                </a>
                <p class="text-gray-600 text-sm mt-2">Voor algemene vragen</p>
              </div>
            </div>
  
            <div class="mt-6">
              <a href="mailto:gdt.kaai.student@ehb.be" class="inline-flex items-center bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-3 rounded-xl font-medium hover:shadow-lg transition-all duration-300 group">
                <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                Stuur een e-mail
              </a>
            </div>
          </div>
  
          <!-- Phone Card -->
          <div class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
            <div class="flex items-center mb-6">
              <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mr-6 group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
              </div>
              <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Telefoon</h2>
                <p class="text-gray-600">Bel ons direct</p>
              </div>
            </div>
  
            <div class="bg-blue-50 rounded-2xl p-6 mb-6">
              <div class="flex items-center justify-between mb-3">
                <strong class="text-gray-900 text-lg">Hoofdlijn</strong>
                <div class="flex items-center space-x-2">
                  <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                  <span class="text-green-600 text-sm font-medium">Online</span>
                </div>
              </div>
              <a href="tel:+3225233737" class="text-blue-600 hover:text-blue-700 font-bold text-3xl transition-colors block">
                02 523 37 37
              </a>
              <p class="text-gray-600 text-sm mt-2">Ma-Vr: 9:00 - 17:00</p>
            </div>
  
            <div class="space-y-3">
              <div class="flex items-center text-gray-600">
                <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Nederlandse taalondersteuning
              </div>
              <div class="flex items-center text-gray-600">
                <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Snelle reactietijd
              </div>
              <div class="flex items-center text-gray-600">
                <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Persoonlijke ondersteuning
              </div>
            </div>
  
            <div class="mt-6">
              <a href="tel:+3225233737" class="inline-flex items-center bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-3 rounded-xl font-medium hover:shadow-lg transition-all duration-300 group">
                <svg class="w-5 h-5 mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                Bel nu
              </a>
            </div>
          </div>
        </div>
  
        <!-- Location Card -->
        <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
          <div class="p-8">
            <div class="flex items-center mb-6">
              <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-teal-500 rounded-2xl flex items-center justify-center mr-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
              </div>
              <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Bezoek ons</h2>
                <p class="text-gray-600">Kom langs op onze campus</p>
              </div>
            </div>
  
            <div class="grid md:grid-cols-2 gap-8 mb-6">
              <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Adres</h3>
                <div class="bg-green-50 rounded-2xl p-6">
                  <p class="text-gray-900 font-semibold text-lg mb-2">Erasmus Hogeschool Brussel</p>
                  <p class="text-gray-700 mb-3">Nijverheidskaai 170</p>
                  <p class="text-gray-700 mb-4">1070 Anderlecht, België</p>
                  <a href="https://maps.google.com/?q=Nijverheidskaai+170,+1070+Anderlecht" target="_blank" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Open in Google Maps
                  </a>
                </div>
              </div>
  
              <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Openingstijden</h3>
                <div class="space-y-3">
                  <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-700">Maandag - Vrijdag</span>
                    <span class="text-gray-900 font-semibold">9:00 - 17:00</span>
                  </div>
                  <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-gray-700">Zaterdag</span>
                    <span class="text-gray-900 font-semibold">10:00 - 14:00</span>
                  </div>
                  <div class="flex justify-between items-center py-2">
                    <span class="text-gray-700">Zondag</span>
                    <span class="text-red-600 font-semibold">Gesloten</span>
                  </div>
                </div>
              </div>
            </div>
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
            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-2 shadow-lg">
              <p class="text-sm font-medium text-gray-900">📍 Erasmus Hogeschool Brussel</p>
            </div>
          </div>
        </div>
      </section>
  
      <!-- FAQ Section -->
      <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100">
          <div class="text-center mb-8">
            <h3 class="text-3xl font-bold text-gray-900 mb-4">Veelgestelde vragen</h3>
            <p class="text-gray-600">Vind snel antwoorden op de meest gestelde vragen</p>
          </div>
  
          <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-orange-50 rounded-2xl p-6">
              <h4 class="text-lg font-semibold text-gray-900 mb-3">Wanneer is Career Launch 2025?</h4>
              <p class="text-gray-600">Het evenement vindt plaats in het voorjaar van 2025. Exacte datum volgt binnenkort.</p>
            </div>
  
            <div class="bg-blue-50 rounded-2xl p-6">
              <h4 class="text-lg font-semibold text-gray-900 mb-3">Hoe kan ik me registreren?</h4>
              <p class="text-gray-600">Registratie is mogelijk via de website. Klik op 'Inloggen' en maak een account aan.</p>
            </div>
  
            <div class="bg-green-50 rounded-2xl p-6">
              <h4 class="text-lg font-semibold text-gray-900 mb-3">Is deelname gratis?</h4>
              <p class="text-gray-600">Ja, deelname aan Career Launch is volledig gratis voor alle studenten van Erasmus Hogeschool.</p>
            </div>
  
            <div class="bg-purple-50 rounded-2xl p-6">
              <h4 class="text-lg font-semibold text-gray-900 mb-3">Welke bedrijven doen mee?</h4>
              <p class="text-gray-600">Bekijk alle deelnemende bedrijven op de <Link href="/bedrijven" class="text-purple-600 hover:text-purple-700 font-medium">bedrijven pagina</Link>.</p>
            </div>
          </div>
        </div>
      </section>
  
      <!-- CTA Section -->
      <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="bg-gradient-to-r from-orange-500 via-red-500 to-pink-500 rounded-3xl p-8 text-white text-center relative overflow-hidden">
          <!-- Background decoration -->
          <div class="absolute inset-0 bg-black/10"></div>
          <div class="absolute -top-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
          <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-white/5 rounded-full"></div>
          
          <div class="relative z-10">
            <div class="flex items-center justify-center mb-6">
              <div class="w-20 h-20 bg-white/20 rounded-3xl flex items-center justify-center">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
              </div>
            </div>
            <h3 class="text-4xl font-bold mb-4">Nog vragen?</h3>
            <p class="text-white/90 mb-8 max-w-2xl mx-auto text-lg">
              Ons team staat klaar om je te helpen. Neem contact met ons op en we beantwoorden al je vragen over Career Launch 2025!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
              <a href="mailto:gdt.kaai.student@ehb.be" class="inline-flex items-center bg-white text-orange-600 px-8 py-4 rounded-2xl font-semibold text-lg hover:bg-orange-50 transition-all duration-300 shadow-lg hover:shadow-xl">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                Stuur een e-mail
              </a>
              <a href="tel:+3225233737" class="inline-flex items-center bg-white/10 text-white border-2 border-white/20 px-8 py-4 rounded-2xl font-semibold text-lg hover:bg-white/20 transition-all duration-300 backdrop-blur-sm">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                Bel ons nu
              </a>
            </div>
          </div>
        </div>
      </section>
  
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
    </div>
  </template>
  
  <script setup>
  import { Head, Link } from '@inertiajs/vue3'
  import { ref, computed, onMounted } from 'vue'
  
  // State
  const mobileMenuOpen = ref(false)
  
  // Get favorites count for navigation badge
  const favoritenCount = computed(() => {
      return window.favoritesState?.value?.length || 0
  })
  
  // Close mobile menu when clicking outside
  onMounted(() => {
      document.addEventListener('click', (e) => {
          if (!e.target.closest('nav') && mobileMenuOpen.value) {
              mobileMenuOpen.value = false
          }
      })
  })
  </script>
  
  <style scoped>
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
  }
  
  .group:hover .group-hover\:rotate-12 {
    transform: rotate(12deg);
  }
  
  .group:hover .group-hover\:animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
  }
  </style>