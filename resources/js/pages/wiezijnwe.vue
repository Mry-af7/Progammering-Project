<template>
  <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-orange-50">
    <Head title="Wie zijn we? - Career Launch 2025" />
    
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
            <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors rounded-lg hover:bg-orange-50">Contact</Link>
            <Link href="/Wiezijnwe" class="px-4 py-2 text-orange-600 bg-orange-100 rounded-lg font-medium">Wie zijn we?</Link>
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
            <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium rounded-lg">Contact</Link>
            <Link href="/Wiezijnwe" class="px-4 py-2 text-orange-600 bg-orange-100 font-medium rounded-lg">Wie zijn we?</Link>
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
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
          Ons Team
        </div>
        <h1 class="text-5xl lg:text-6xl font-bold bg-gradient-to-r from-gray-900 via-orange-600 to-red-600 bg-clip-text text-transparent mb-6">
          Wie zijn we?
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
          Wij zijn een team van gedreven studenten aan de Erasmus Hogeschool Brussel, Campus KAAI. 
          Samen werken we aan Career Launch 2025 om studenten en bedrijven te verbinden.
        </p>
      </div>
    </section>

    <!-- Mission Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
      <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="grid lg:grid-cols-2 gap-0">
          <!-- Content -->
          <div class="p-8 lg:p-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Onze Missie</h2>
            <div class="space-y-4 text-gray-600 leading-relaxed">
              <p class="text-lg">
                Onze missie is om studenten te ondersteunen in hun academische en persoonlijke ontwikkeling door waardevolle connecties te faciliteren.
              </p>
              <p>
                We organiseren evenementen, bieden vacature mogelijkheden en creëren een community waar iedereen zich welkom voelt.
              </p>
              <p>
                Onze focus ligt op inclusiviteit, samenwerking en het delen van kennis om elkaar te helpen groeien.
              </p>
              <p>
                Of je nu op zoek bent naar je allereerste bijbaan of flexibele studentenjob: wij brengen je snel in contact met werkgevers die echt waarde hechten aan jouw talent.
              </p>
            </div>

            <!-- Values -->
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
              <div class="text-center p-4 bg-orange-50 rounded-2xl">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                  <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                  </svg>
                </div>
                <h3 class="font-semibold text-gray-900">Inclusiviteit</h3>
                <p class="text-sm text-gray-600 mt-1">Iedereen is welkom</p>
              </div>

              <div class="text-center p-4 bg-blue-50 rounded-2xl">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                  <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                  </svg>
                </div>
                <h3 class="font-semibold text-gray-900">Samenwerking</h3>
                <p class="text-sm text-gray-600 mt-1">Samen sterker</p>
              </div>

              <div class="text-center p-4 bg-green-50 rounded-2xl">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                  <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                  </svg>
                </div>
                <h3 class="font-semibold text-gray-900">Kennis delen</h3>
                <p class="text-sm text-gray-600 mt-1">Leren van elkaar</p>
              </div>
            </div>
          </div>

          <!-- Campus Image -->
          <div class="relative">
            <img
              src="https://wmimages.bruzz.be/styles/1f8c29ed4efcaed916a7e270e4064aaa5d961eac/2019-09/ehb.jpg"
              alt="Erasmus Hogeschool Brussel Campus"
              class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-gradient-to-r from-orange-500/20 to-transparent"></div>
            <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-sm rounded-lg px-4 py-2 shadow-lg">
              <p class="text-sm font-medium text-gray-900">📍 Campus KAAI, Erasmus Hogeschool Brussel</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Team Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Maak kennis met ons team!</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
          We zijn een diverse groep studenten met verschillende achtergronden en interesses, 
          gepassioneerd over technologie en het creëren van een inclusieve omgeving.
        </p>
      </div>

      <!-- Team Stats -->
      <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
          <div>
            <div class="text-3xl font-bold text-orange-600">{{ team.length }}</div>
            <div class="text-sm text-gray-500">Teamleden</div>
          </div>
          <div>
            <div class="text-3xl font-bold text-blue-600">1</div>
            <div class="text-sm text-gray-500">Studierichting</div>
          </div>
          <div>
            <div class="text-3xl font-bold text-green-600">100%</div>
            <div class="text-sm text-gray-500">Toewijding</div>
          </div>
          <div>
            <div class="text-3xl font-bold text-purple-600">2025</div>
            <div class="text-sm text-gray-500">Career Launch</div>
          </div>
        </div>
      </div>

      <!-- Team Grid -->
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="(lid, index) in team"
          :key="lid.naam"
          class="group bg-white rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100"
        >
          <!-- Avatar -->
          <div class="flex items-center justify-center mb-6">
            <div class="w-20 h-20 bg-gradient-to-br from-orange-400 to-red-500 rounded-2xl flex items-center justify-center text-white font-bold text-2xl group-hover:scale-110 transition-transform duration-300">
              {{ lid.naam.charAt(0) }}
            </div>
          </div>

          <!-- Name & Role -->
          <div class="text-center mb-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ lid.naam }}</h3>
            <p class="text-gray-600">{{ lid.functie }}</p>
            <div class="inline-flex items-center px-3 py-1 bg-orange-100 text-orange-600 text-sm font-medium rounded-full mt-2">
              Toegepaste Informatica
            </div>
          </div>

          <!-- Skills/Interests -->
          <div class="mb-6">
            <div class="flex flex-wrap gap-2 justify-center">
              <span
                v-for="skill in getRandomSkills()"
                :key="skill"
                class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md"
              >
                {{ skill }}
              </span>
            </div>
          </div>

          <!-- LinkedIn Button -->
          <div class="text-center">
            <a
              v-if="lid.linkedin"
              :href="lid.linkedin"
              target="_blank"
              rel="noopener noreferrer"
              class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-xl font-medium hover:bg-blue-700 transition-colors group"
            >
              <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
              </svg>
              LinkedIn
            </a>
            <div v-else class="text-gray-400 text-sm">
              LinkedIn binnenkort beschikbaar
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Study Program Info -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
      <div class="bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-3xl p-8 text-white relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute -top-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
        <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-white/5 rounded-full"></div>
        
        <div class="relative z-10 text-center">
          <div class="flex items-center justify-center mb-6">
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
              </svg>
            </div>
          </div>
          <h3 class="text-3xl font-bold mb-4">Toegepaste Informatica</h3>
          <p class="text-white/90 mb-6 max-w-2xl mx-auto text-lg">
            We studeren allemaal Toegepaste Informatica aan de Erasmus Hogeschool Brussel, 
            een praktijkgerichte opleiding die ons voorbereidt op de digitale toekomst.
          </p>
          
          <div class="grid md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-sm">
              <h4 class="font-semibold mb-2">💻 Programmeren</h4>
              <p class="text-white/80 text-sm">Web development, mobile apps, software engineering</p>
            </div>
            <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-sm">
              <h4 class="font-semibold mb-2">🔐 Cybersecurity</h4>
              <p class="text-white/80 text-sm">Netwerk beveiliging, ethical hacking, data protection</p>
            </div>
            <div class="bg-white/10 rounded-2xl p-6 backdrop-blur-sm">
              <h4 class="font-semibold mb-2">📊 Data Science</h4>
              <p class="text-white/80 text-sm">Big data, machine learning, business intelligence</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
      <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 text-center">
        <div class="max-w-3xl mx-auto">
          <h3 class="text-3xl font-bold text-gray-900 mb-4">Klaar om mee te doen?</h3>
          <p class="text-xl text-gray-600 mb-8">
            Ontdek alle deelnemende bedrijven en vind jouw perfecte match tijdens Career Launch 2025!
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <Link href="/bedrijven" class="inline-flex items-center bg-gradient-to-r from-orange-500 to-red-500 text-white px-8 py-4 rounded-2xl font-semibold text-lg hover:shadow-lg transition-all duration-300">
              <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
              </svg>
              Ontdek bedrijven
            </Link>
            <Link href="/contact" class="inline-flex items-center bg-gray-100 text-gray-700 px-8 py-4 rounded-2xl font-semibold text-lg hover:bg-gray-200 transition-all duration-300">
              <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
              </svg>
              Neem contact op
            </Link>
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
              <a href="https://www.linkedin.com/school/erasmus-hogeschool-brussel/" target="_blank" class="text-orange-200 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
              </a>
              <a href="https://www.instagram.com/erasmushogeschool/" target="_blank" class="text-orange-200 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987c6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.611-3.197-1.559-.748-.947-1.197-2.25-1.197-3.679 0-1.429.449-2.732 1.197-3.679.749-.948 1.9-1.559 3.197-1.559s2.448.611 3.197 1.559c.748.947 1.197 2.25 1.197 3.679 0 1.429-.449 2.732-1.197 3.679-.749.948-1.9 1.559-3.197 1.559zm7.718 0c-1.297 0-2.448-.611-3.197-1.559-.748-.947-1.197-2.25-1.197-3.679 0-1.429.449-2.732 1.197-3.679.749-.948 1.9-1.559 3.197-1.559s2.448.611 3.197 1.559c.748.947 1.197 2.25 1.197 3.679 0 1.429-.449 2.732-1.197 3.679-.749.948-1.9 1.559-3.197 1.559z"/>
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

// Team data
const team = [
  { naam: 'Jawad Zannou', functie: 'Student', linkedin: 'https://www.linkedin.com/in/jawad-zannou-437abb359/' },
  { naam: 'Amine Zerouali', functie: 'Student', linkedin: 'https://www.linkedin.com/in/amine-zerouali-063124357/' }, 
  { naam: 'Amina Saidi', functie: 'Student', linkedin: 'https://www.linkedin.com/in/amina-saidi-a7a526352/' },
  { naam: 'Rania El Hakiki', functie: 'Student', linkedin: 'https://www.linkedin.com/in/rania-el-hakiki-723360286/' },
  { naam: 'Maryam Afallah', functie: 'Student', linkedin: '' },
  { naam: 'Asma M\'Barki', functie: 'Student', linkedin: 'https://www.linkedin.com/in/mbarkiasma' },
]

const skills = [
  'JavaScript', 'Python', 'Java', 'React', 'Vue.js', 'Node.js', 
  'Cybersecurity', 'Data Analysis', 'Machine Learning', 'DevOps',
  'Cloud Computing', 'Mobile Development', 'UI/UX Design', 'Databases'
]

// Get favorites count for navigation badge
const favoritenCount = computed(() => {
    return window.favoritesState?.value?.length || 0
})

// Generate random skills for each team member
const getRandomSkills = () => {
  const shuffled = [...skills].sort(() => 0.5 - Math.random())
  return shuffled.slice(0, 3)
}

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
</style>