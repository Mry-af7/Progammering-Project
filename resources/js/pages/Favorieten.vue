<template>
  <div class="min-h-screen bg-orange-50">
      <Head title="Mijn Favorieten - Career Launch 2025" />
      
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
                      <Link href="/info" class="text-gray-700 hover:text-orange-600 font-medium transition-colors">Info</Link>
                      <Link href="/favorieten" class="text-orange-600 font-medium border-b-2 border-orange-600 pb-1">Favorieten</Link>
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
                      <Link href="/info" class="block text-gray-700 hover:text-orange-600 font-medium py-2 transition-colors">Info</Link>
                      <Link href="/favorieten" class="block text-orange-600 font-medium py-2">Favorieten</Link>
                      <Link href="/contact" class="block text-gray-700 hover:text-orange-600 font-medium py-2 transition-colors">Contact</Link>
                      <Link href="/inloggen" class="block bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-lg font-medium text-center mt-4">Inloggen</Link>
                  </div>
              </div>
          </div>
      </nav>

      <!-- Hero Section -->
      <section class="py-16 lg:py-20">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
              <div class="text-center mb-12">
                  <div class="inline-flex items-center px-4 py-2 bg-orange-100 rounded-full text-orange-700 text-sm font-medium mb-6">
                      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                      </svg>
                      Mijn Favorieten
                  </div>
                  <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                      Jouw
                      <span class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">
                          favoriete bedrijven
                      </span>
                  </h1>
                  <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                      Houd je interessante bedrijven bij en vind snel terug wat je zoekt voor je toekomstige carrière.
                  </p>
        </div>
      </div>
      </section>

    <!-- Main Content -->
      <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
          
          <!-- Statistics Bar -->
          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
              <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                  <div class="text-center">
                      <div class="text-2xl font-bold text-gray-900">{{ favorites.length }}</div>
                      <div class="text-sm text-gray-500">Favorieten</div>
                  </div>
                  <div class="text-center">
                      <div class="text-2xl font-bold text-gray-900">{{ uniqueIndustries.length }}</div>
                      <div class="text-sm text-gray-500">Industrieën</div>
                  </div>
                  <div class="text-center">
                      <div class="text-2xl font-bold text-gray-900">{{ totalEmployees }}</div>
                      <div class="text-sm text-gray-500">Totaal werknemers</div>
                  </div>
                  <div class="text-center">
                      <div class="text-2xl font-bold text-gray-900">{{ uniqueLocations.length }}</div>
                      <div class="text-sm text-gray-500">Locaties</div>
                  </div>
              </div>
        </div>

          <!-- Filter & Search Bar -->
          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8" v-if="favorites.length > 0">
              <div class="flex flex-col md:flex-row gap-4">
                  <div class="flex-1">
                      <div class="relative">
                          <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                          </svg>
                          <input 
                              v-model="searchQuery"
                              type="text" 
                              placeholder="Zoek in favorieten..." 
                              class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                          >
                      </div>
                  </div>
                  <div class="flex gap-2">
                      <select v-model="selectedIndustry" class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                          <option value="">Alle industrieën</option>
                          <option v-for="industry in uniqueIndustries" :key="industry" :value="industry">{{ industry }}</option>
                      </select>
                      <button @click="clearFilters" class="px-4 py-3 text-gray-500 hover:text-gray-700 transition-colors">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                          </svg>
            </button>
          </div>
              </div>
          </div>

          <!-- Favorites Grid -->
          <div v-if="filteredFavorites.length > 0">
              <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                  <div 
                      v-for="company in filteredFavorites" 
                      :key="company.id"
                      class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 overflow-hidden"
                  >
                      <!-- Company Card Header -->
                      <div class="relative p-6 bg-gradient-to-br from-gray-50 to-white">
                          <!-- Favorite Button -->
                          <button
                              @click="removeFromFavorites(company.id)"
                              class="absolute top-4 right-4 w-12 h-12 rounded-xl flex items-center justify-center transition-all duration-300 bg-red-100 text-red-600 hover:bg-red-200"
                          >
                              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                              </svg>
                          </button>

                          <!-- Company Logo -->
                          <div class="flex justify-center mb-4">
                              <div class="w-20 h-20 bg-white rounded-2xl shadow-md flex items-center justify-center hover:shadow-lg transition-shadow cursor-pointer" @click="openModal(company)">
                                  <img
                                      :src="company.src"
                                      :alt="company.name"
                                      class="max-w-16 max-h-16 object-contain"
                                  />
                              </div>
                          </div>

                          <!-- Company Name -->
                          <h3 class="text-xl font-bold text-gray-900 text-center mb-2 group-hover:text-orange-600 transition-colors cursor-pointer" @click="openModal(company)">
                              {{ company.name }}
                          </h3>

                          <!-- Industry Tag -->
                          <div class="flex justify-center mb-3">
                              <span class="px-3 py-1 bg-orange-100 text-orange-600 text-sm font-medium rounded-full">
                                  {{ company.industry }}
                              </span>
        </div>
      </div>

                      <!-- Company Info -->
                      <div class="p-6 pt-0">
                          <!-- Specialization -->
                          <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                              {{ company.specialisatie }}
                          </p>

                          <!-- Company Details -->
                          <div class="space-y-2 mb-4">
                              <div class="flex items-center text-sm text-gray-500">
                                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                  </svg>
                                  {{ company.location }}
                              </div>
                              <div class="flex items-center text-sm text-gray-500">
                                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                  </svg>
                                  {{ company.employees }} medewerkers
          </div>
        </div>

                          <!-- Tags -->
                          <div class="flex flex-wrap gap-1 mb-4">
                              <span
                                  v-for="tag in company.tags.slice(0, 3)"
                                  :key="tag"
                                  class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md"
                              >
                                  {{ tag }}
                              </span>
                              <span v-if="company.tags.length > 3" class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md">
                                  +{{ company.tags.length - 3 }}
                              </span>
                </div>

                          <!-- Action Buttons -->
                          <div class="flex gap-2">
                              <button
                                  @click="openModal(company)"
                                  class="flex-1 bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition-colors font-medium"
                              >
                                  Meer info
                              </button>
                              <a
                                  :href="company.website"
                                  target="_blank"
                                  class="px-4 py-2 border border-orange-600 text-orange-600 rounded-lg hover:bg-orange-50 transition-colors"
                                  title="Bezoek website"
                              >
                                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                  </svg>
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
              </div>
              
          <!-- Empty State -->
          <div v-else-if="favorites.length === 0" class="text-center py-16">
              <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-12 max-w-md mx-auto">
                  <div class="w-20 h-20 bg-gradient-to-r from-orange-100 to-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                      <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                      </svg>
                  </div>
                  <h3 class="text-2xl font-bold text-gray-900 mb-4">Nog geen favorieten</h3>
                  <p class="text-gray-600 mb-8 leading-relaxed">
                      Ontdek interessante bedrijven en voeg ze toe aan je favorieten om snel terug te vinden.
                  </p>
                  <Link 
                      href="/bedrijven" 
                      class="inline-flex items-center bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-3 rounded-xl font-medium hover:shadow-lg transition-all duration-300"
                  >
                      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                      </svg>
                      Ontdek bedrijven
                  </Link>
              </div>
                </div>
                
          <!-- No Results State -->
          <div v-else-if="filteredFavorites.length === 0" class="text-center py-16">
              <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-12 max-w-md mx-auto">
                  <div class="w-20 h-20 bg-gradient-to-r from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                      <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                      </svg>
                  </div>
                  <h3 class="text-2xl font-bold text-gray-900 mb-4">Geen resultaten gevonden</h3>
                  <p class="text-gray-600 mb-8">
                      Probeer je zoekopdracht aan te passen of verwijder filters.
                  </p>
                  <button 
                      @click="clearFilters"
                      class="inline-flex items-center bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-3 rounded-xl font-medium hover:shadow-lg transition-all duration-300"
                  >
                      Filters wissen
                  </button>
              </div>
          </div>

          <!-- Quick Actions -->
          <div v-if="favorites.length > 0" class="mt-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-3xl p-8 text-white">
              <div class="text-center">
                  <h3 class="text-2xl font-bold mb-4">Klaar voor de volgende stap?</h3>
                  <p class="text-orange-100 mb-6 max-w-2xl mx-auto">
                      Je hebt {{ favorites.length }} interessante bedrijven geselecteerd. Tijd om contact te maken en je droomcarrière te starten!
                  </p>
                  <div class="flex flex-col sm:flex-row gap-4 justify-center">
                      <Link 
                          href="/bedrijven" 
                          class="inline-flex items-center bg-white text-orange-600 px-6 py-3 rounded-xl font-medium hover:bg-orange-50 transition-colors"
                      >
                          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                          </svg>
                          Meer bedrijven ontdekken
                      </Link>
                      <button 
                          @click="exportFavorites"
                          class="inline-flex items-center border-2 border-white text-white px-6 py-3 rounded-xl font-medium hover:bg-white hover:text-orange-600 transition-all duration-300"
                      >
                          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                          </svg>
                          Exporteer lijst
                  </button>
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
          <div v-if="toast.show" :class="['fixed top-4 right-4 bg-white rounded-xl shadow-lg p-4 z-50 flex items-center max-w-sm border-l-4', toast.type === 'success' ? 'border-green-500' : toast.type === 'error' ? 'border-red-500' : 'border-blue-500']">
              <span class="flex-1">{{ toast.message }}</span>
              <button @click="toast.show = false" class="ml-4 text-gray-400 hover:text-gray-600 transition-colors">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                  </svg>
              </button>
          </div>
      </Transition>

      <!-- Enhanced Modal -->
      <div
          v-if="showModal && geselecteerdBedrijf"
          class="fixed inset-0 z-50 overflow-y-auto"
          @click.self="closeModal"
      >
          <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center">
              <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" @click="closeModal"></div>

              <div class="relative bg-white rounded-3xl shadow-2xl max-w-4xl w-full transform transition-all">
                  <!-- Modal Header -->
                  <div class="relative bg-gradient-to-br from-orange-100 to-orange-200 px-8 py-6 rounded-t-3xl">
                      <button
                          @click="closeModal"
                          class="absolute top-6 right-6 p-2 rounded-full bg-white/80 hover:bg-white text-gray-600 hover:text-gray-900 transition-all"
                      >
                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                          </svg>
                      </button>

                      <div class="flex items-center space-x-6">
                          <div class="w-20 h-20 bg-white rounded-3xl shadow-lg flex items-center justify-center">
                              <img
                                  :src="geselecteerdBedrijf.src"
                                  :alt="geselecteerdBedrijf.name"
                                  class="max-w-16 max-h-16 object-contain"
                              />
                          </div>
                          <div class="text-left">
                              <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ geselecteerdBedrijf.name }}</h2>
                              <div class="flex items-center gap-3">
                                  <span class="px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-full">
                                      {{ geselecteerdBedrijf.industry }}
                                  </span>
                                  <span class="text-gray-600">{{ geselecteerdBedrijf.location }}</span>
                              </div>
                          </div>
                      </div>
                  </div>

                  <!-- Modal Content -->
                  <div class="px-8 py-6">
                      <div class="grid md:grid-cols-2 gap-8">
                          <!-- Left Column -->
                          <div class="space-y-6">
                              <div>
                                  <h3 class="text-lg font-semibold text-gray-900 mb-3">Specialisatie</h3>
                                  <p class="text-gray-600">{{ geselecteerdBedrijf.specialisatie }}</p>
                              </div>

                              <div>
                                  <h3 class="text-lg font-semibold text-gray-900 mb-3">Over het bedrijf</h3>
                                  <p class="text-gray-600 leading-relaxed">{{ geselecteerdBedrijf.beschrijving }}</p>
                              </div>

                              <div>
                                  <h3 class="text-lg font-semibold text-gray-900 mb-3">Technologieën & Skills</h3>
                                  <div class="flex flex-wrap gap-2">
                                      <span
                                          v-for="tag in geselecteerdBedrijf.tags"
                                          :key="tag"
                                          class="px-3 py-1 bg-blue-100 text-blue-600 text-sm rounded-full"
                                      >
                                          {{ tag }}
                                      </span>
                                  </div>
                              </div>
                          </div>

                          <!-- Right Column -->
                          <div class="space-y-6">
                              <div>
                                  <h3 class="text-lg font-semibold text-gray-900 mb-3">Contact Informatie</h3>
                                  <div class="space-y-3">
                                      <div class="flex items-center text-gray-600">
                                          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                          </svg>
                                          {{ geselecteerdBedrijf.adres }}
                                      </div>
                                      <div class="flex items-center text-gray-600">
                                          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                          </svg>
                                          {{ geselecteerdBedrijf.telefoon }}
                                      </div>
                                      <div class="flex items-center text-gray-600">
                                          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                          </svg>
                                          {{ geselecteerdBedrijf.email }}
                                      </div>
                                  </div>
                              </div>

                              <div>
                                  <h3 class="text-lg font-semibold text-gray-900 mb-3">Bedrijfsinformatie</h3>
                                  <div class="space-y-3">
                                      <div class="flex items-center text-gray-600">
                                          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                          </svg>
                                          {{ geselecteerdBedrijf.employees }} medewerkers
                                      </div>
                                      <div class="flex items-center text-gray-600">
                                          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                          </svg>
                                          Opgericht in {{ geselecteerdBedrijf.founded }}
                                      </div>
                                  </div>
                              </div>

                              <div class="pt-4">
                                  <a
                                      :href="geselecteerdBedrijf.website"
                                      target="_blank"
                                      class="inline-flex items-center justify-center w-full px-6 py-3 bg-orange-600 text-white rounded-xl font-medium hover:bg-orange-700 transition-colors"
                                  >
                                      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                      </svg>
                                      Bezoek website
                                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref, computed, watch, onMounted, Transition } from 'vue'

// State
const mobileMenuOpen = ref(false)
const searchQuery = ref('')
const selectedIndustry = ref('')
const showModal = ref(false)
const geselecteerdBedrijf = ref(null)
const toast = ref({ show: false, message: '', type: 'info' })

// Initialize favorites state if not exists
if (!window.favoritesState) {
    window.favoritesState = ref([])
}

// Use window.favoritesState as the source of truth
const favorites = computed(() => window.favoritesState?.value || [])

// Computed properties for filtering
const filteredFavorites = computed(() => {
    let result = favorites.value

    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase()
        result = result.filter(company => 
            company.name.toLowerCase().includes(query) ||
            company.specialisatie.toLowerCase().includes(query) ||
            company.beschrijving.toLowerCase().includes(query) ||
            company.industry.toLowerCase().includes(query) ||
            company.location.toLowerCase().includes(query) ||
            company.tags.some(tag => tag.toLowerCase().includes(query))
        )
    }

    if (selectedIndustry.value) {
        result = result.filter(company => company.industry === selectedIndustry.value)
    }

    return result
})

// Computed properties for statistics
const uniqueIndustries = computed(() => {
    const industries = favorites.value.map(company => company.industry)
    return [...new Set(industries)].sort()
})

const uniqueLocations = computed(() => {
    const locations = favorites.value.map(company => company.location)
    return [...new Set(locations)].sort()
})

const totalEmployees = computed(() => {
    return favorites.value.reduce((total, company) => {
        const employees = parseInt(company.employees.replace(/\D/g, '')) || 0
        return total + employees
    }, 0)
})

// Methods
const removeFromFavorites = (companyId) => {
    if (window.favoritesState) {
        const index = window.favoritesState.value.findIndex(company => company.id === companyId)
        if (index > -1) {
            const company = window.favoritesState.value[index]
            window.favoritesState.value.splice(index, 1)
            showToast(`${company.name} verwijderd uit favorieten`, 'success')
            
            // Update local storage
            try {
                localStorage.setItem('favorites', JSON.stringify(window.favoritesState.value))
            } catch (e) {
                console.warn('Could not save to localStorage:', e)
            }
        }
    }
}

const clearFilters = () => {
    searchQuery.value = ''
    selectedIndustry.value = ''
}

const openModal = (company) => {
    geselecteerdBedrijf.value = company
    showModal.value = true
    document.body.style.overflow = 'hidden'
}

const closeModal = () => {
    showModal.value = false
    geselecteerdBedrijf.value = null
    document.body.style.overflow = 'auto'
}

const exportFavorites = () => {
    if (favorites.value.length === 0) {
        showToast('Geen favorieten om te exporteren', 'error')
        return
    }

    const data = favorites.value.map(company => ({
        Bedrijf: company.name,
        Industrie: company.industry,
        Locatie: company.location,
        Medewerkers: company.employees,
        Specialisatie: company.specialisatie,
        Website: company.website
    }))
    
    const csv = [
        Object.keys(data[0]).join(','),
        ...data.map(row => Object.values(row).map(val => `"${val}"`).join(','))
    ].join('\n')
    
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' })
    const url = URL.createObjectURL(blob)
    const a = document.createElement('a')
    a.href = url
    a.download = 'mijn-favorieten.csv'
    document.body.appendChild(a)
    a.click()
    document.body.removeChild(a)
    URL.revokeObjectURL(url)
    
    showToast('Favorieten geëxporteerd!', 'success')
}

const showToast = (message, type = 'info') => {
    toast.value = { show: true, message, type }
    setTimeout(() => toast.value.show = false, 3000)
}

// Global function to add to favorites (for use from other pages)
if (!window.addToFavorites) {
    window.addToFavorites = (company) => {
        if (!window.favoritesState) {
            window.favoritesState = ref([])
        }
        
        const exists = window.favoritesState.value.find(fav => fav.id === company.id)
        if (!exists) {
            window.favoritesState.value.push(company)
            try {
                localStorage.setItem('favorites', JSON.stringify(window.favoritesState.value))
            } catch (e) {
                console.warn('Could not save to localStorage:', e)
            }
            // Use a global toast function if available, otherwise just log
            if (window.showGlobalToast) {
                window.showGlobalToast(`${company.name} toegevoegd aan favorieten!`, 'success')
            } else {
                console.log(`${company.name} toegevoegd aan favorieten!`)
            }
            return true
        } else {
            if (window.showGlobalToast) {
                window.showGlobalToast(`${company.name} staat al in je favorieten`, 'info')
            } else {
                console.log(`${company.name} staat al in je favorieten`)
            }
            return false
        }
    }
}

// Global remove function
if (!window.removeFromFavorites) {
    window.removeFromFavorites = removeFromFavorites
}

// Make toast function globally available
window.showGlobalToast = showToast

// Load favorites from localStorage on mount
onMounted(() => {
    try {
        const saved = localStorage.getItem('favorites')
        if (saved && window.favoritesState) {
            window.favoritesState.value = JSON.parse(saved)
        }
    } catch (e) {
        console.warn('Could not load from localStorage:', e)
    }
    
    // Close modal on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && showModal.value) {
            closeModal()
        }
    })
})
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>