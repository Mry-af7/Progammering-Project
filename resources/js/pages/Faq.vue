<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref, onMounted, computed } from 'vue'

const mobileMenuOpen = ref(false)
const searchQuery = ref('')
const selectedCategory = ref('all')
const animatedItems = ref(new Set())

const categories = [
  { id: 'all', name: 'Alle vragen', icon: '📋' },
  { id: 'account', name: 'Account & Aanmelden', icon: '👤' },
  { id: 'platform', name: 'Platform & Functies', icon: '🔧' },
  { id: 'stages', name: 'Stages & Bedrijven', icon: '🏢' },
  { id: 'support', name: 'Ondersteuning', icon: '💬' }
]

const faqItems = [
  {
    id: 1,
    category: 'account',
    question: 'Hoe meld ik me aan voor Career Launch 2025?',
    answer: 'Je maakt eenvoudig een account aan via de knop "Ik ben een student" of "Ik ben een bedrijf" op de homepage. Vul je persoonlijke gegevens in, upload je CV en activeer je account via de verificatie-email die je binnen enkele minuten ontvangt.',
    tags: ['aanmelden', 'registreren', 'account']
  },
  {
    id: 2,
    category: 'platform',
    question: 'Is het platform volledig gratis te gebruiken?',
    answer: 'Ja, Career Launch 2025 is volledig gratis voor studenten van Erasmus Hogeschool Brussel. Alle functies, van het browsen van bedrijven tot het plannen van gesprekken, zijn zonder kosten beschikbaar.',
    tags: ['gratis', 'kosten', 'prijs']
  },
  {
    id: 3,
    category: 'stages',
    question: 'Hoe kan ik zien welke bedrijven deelnemen en welke stageplaatsen zij aanbieden?',
    answer: 'Op de homepage vind je een overzicht van onze premium partners. Daarnaast kun je via de bedrijvenpagina alle deelnemende organisaties bekijken, filteren op sector, locatie en type stage. Elk bedrijfsprofiel toont beschikbare posities en vereisten.',
    tags: ['bedrijven', 'stages', 'aanbod']
  },
  {
    id: 4,
    category: 'platform',
    question: 'Kan ik tegelijkertijd contact opnemen met meerdere bedrijven?',
    answer: 'Absoluut! Je kunt afspraken plannen met verschillende bedrijven door specifieke tijdslots te reserveren. Ons intelligente planningSysteem voorkomt dubbele boekingen en stuurt automatisch herinneringen.',
    tags: ['meerdere', 'bedrijven', 'planning']
  },
  {
    id: 5,
    category: 'account',
    question: 'Hoe upload ik mijn CV en motivatiebrief?',
    answer: 'Je CV wordt geüpload tijdens de accountaanmaak en kan altijd worden bijgewerkt in je profiel. Motivatiebrieven kun je per bedrijf toevoegen - dit is optioneel maar wel aanbevolen voor een persoonlijke touch.',
    tags: ['cv', 'motivatiebrief', 'documenten']
  },
  {
    id: 6,
    category: 'support',
    question: 'Wat als ik nog geen relevante werkervaring heb?',
    answer: 'Geen probleem! Stages zijn er juist voor om ervaring op te doen. Veel bedrijven zoeken specifiek naar gemotiveerde studenten zonder ervaring. Focus op je studieresultaten, projecten en persoonlijke eigenschappen.',
    tags: ['ervaring', 'beginner', 'student']
  },
  {
    id: 7,
    category: 'stages',
    question: 'Hoe betrouwbaar en veilig zijn de bedrijven op het platform?',
    answer: 'Alle bedrijven worden zorgvuldig gescreend door Erasmus Hogeschool Brussel. We werken alleen met erkende organisaties die voldoen aan onze kwaliteitseisen en eerder succesvolle stages hebben begeleid.',
    tags: ['betrouwbaar', 'veilig', 'kwaliteit']
  },
  {
    id: 8,
    category: 'platform',
    question: 'Op welke criteria kan ik filteren bij het zoeken naar stages?',
    answer: 'Ons geavanceerde zoeksysteem biedt filters voor: locatie (Brussel, Nederland, internationaal), sector (IT, Marketing, Finance, etc.), stagetype (fulltime/parttime), duur, vergoeding en competenties. Ook kun je zoeken op bedrijfsgrootte en cultuur.',
    tags: ['zoeken', 'filteren', 'criteria']
  },
  {
    id: 9,
    category: 'account',
    question: 'Kunnen internationale studenten ook deelnemen?',
    answer: 'Ja! Career Launch 2025 staat open voor alle studenten, ongeacht nationaliteit. Sommige bedrijven bieden zelfs specifiek internationale stages aan. Check wel altijd de visa-vereisten voor stages buiten België.',
    tags: ['internationaal', 'studenten', 'nationaliteit']
  },
  {
    id: 10,
    category: 'support',
    question: 'Wat zeggen andere studenten over hun ervaringen?',
    answer: 'Op onze homepage vind je echte succesverhalen van studenten. Daarnaast heeft elk bedrijf reviews en ratings van vorige stagiairs. Gemiddeld geven studenten ons platform een 4.8/5 sterren score.',
    tags: ['reviews', 'ervaringen', 'feedback']
  },
  {
    id: 11,
    category: 'platform',
    question: 'Hoe werkt het matchingssysteem?',
    answer: 'Ons AI-gestuurde systeem analyseert je profiel, vaardigheden en voorkeuren om de meest relevante stageplaatsen voor te stellen. Hoe completer je profiel, hoe beter de matches die je ontvangt.',
    tags: ['matching', 'ai', 'aanbevelingen']
  },
  {
    id: 12,
    category: 'support',
    question: 'Krijg ik begeleiding tijdens het sollicitatieproces?',
    answer: 'Ja! We bieden gratis workshops over CV-schrijven, sollicitatiegesprekken en netwerkvaardigheden. Ook kun je persoonlijke feedback krijgen van onze carrièrecoaches via de platform-chat.',
    tags: ['begeleiding', 'coaching', 'workshops']
  }
]

const filteredFAQs = computed(() => {
  let filtered = faqItems

  if (selectedCategory.value !== 'all') {
    filtered = filtered.filter(item => item.category === selectedCategory.value)
  }

  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(item => 
      item.question.toLowerCase().includes(query) ||
      item.answer.toLowerCase().includes(query) ||
      item.tags.some(tag => tag.toLowerCase().includes(query))
    )
  }

  return filtered
})

function isActive(page) {
  return page === 'faq'
}

function toggleFAQ(id) {
  if (animatedItems.value.has(id)) {
    animatedItems.value.delete(id)
  } else {
    animatedItems.value.add(id)
  }
}

onMounted(() => {
  // Animate items on scroll
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-fade-in')
      }
    })
  })

  document.querySelectorAll('.faq-item').forEach(item => {
    observer.observe(item)
  })
})
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-red-50">
    <Head title="FAQ - Career Launch 2025 Pro" />
    
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md shadow-lg border-b border-gray-100 sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <!-- Logo -->
          <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center shadow-lg transform hover:scale-105 transition-transform">
              <span class="text-white font-bold text-xl">E</span>
            </div>
            <div class="font-bold text-xl text-gray-900">erasmus</div>
            <div class="hidden sm:block text-sm text-gray-500 font-medium">HOGESCHOOL BRUSSEL</div>
          </div>
          
          <!-- Desktop Navigation -->
          <div class="hidden md:flex items-center space-x-8">
            <Link href="/" class="text-gray-700 hover:text-orange-600 font-medium transition-all duration-300 hover:scale-105">Home</Link>
            <Link href="/info" class="text-gray-700 hover:text-orange-600 font-medium transition-all duration-300 hover:scale-105">Info</Link>
            <Link href="/favorieten" class="text-orange-600 font-semibold border-b-2 border-orange-600 pb-1">FAQ</Link>
            <Link href="/contact" class="text-gray-700 hover:text-orange-600 font-medium transition-all duration-300 hover:scale-105">Contact</Link>
            <Link href="/inloggen" class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-2.5 rounded-full font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">Inloggen</Link>
          </div>
          
          <!-- Mobile menu button -->
          <div class="md:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-orange-600 focus:outline-none p-2 rounded-lg hover:bg-orange-50 transition-colors">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>
          </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div v-show="mobileMenuOpen" class="md:hidden border-t border-gray-100 py-4 bg-white/95 backdrop-blur-sm">
          <div class="space-y-2">
            <Link href="/" class="block text-gray-700 hover:text-orange-600 font-medium py-3 px-4 rounded-lg hover:bg-orange-50 transition-colors">Home</Link>
            <Link href="/info" class="block text-gray-700 hover:text-orange-600 font-medium py-3 px-4 rounded-lg hover:bg-orange-50 transition-colors">Info</Link>
            <Link href="/favorieten" class="block text-orange-600 font-semibold py-3 px-4 bg-orange-50 rounded-lg">FAQ</Link>
            <Link href="/contact" class="block text-gray-700 hover:text-orange-600 font-medium py-3 px-4 rounded-lg hover:bg-orange-50 transition-colors">Contact</Link>
            <Link href="/inloggen" class="block bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-3 rounded-lg font-semibold text-center mt-4 hover:shadow-lg transition-shadow">Inloggen</Link>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative py-20 px-4">
      <div class="absolute inset-0 bg-gradient-to-r from-orange-500/5 to-red-500/5"></div>
      <div class="relative max-w-4xl mx-auto text-center">
        <div class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-medium mb-6">
          <span class="w-2 h-2 bg-orange-500 rounded-full mr-2 animate-pulse"></span>
          Hulp & Ondersteuning
        </div>
        <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
          Veel <span class="gradient-text">gestelde vragen</span>
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
          Vind snel antwoorden op je vragen over Career Launch 2025. Ons support team heeft de meest voorkomende vragen verzameld.
        </p>
        
        <!-- Search Bar -->
        <div class="relative max-w-xl mx-auto mb-8">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </div>
          <input 
            v-model="searchQuery"
            type="text" 
            placeholder="Zoek in veelgestelde vragen..." 
            class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-orange-500 focus:border-transparent shadow-lg backdrop-blur-sm bg-white/90 text-gray-900 placeholder-gray-500 transition-all duration-300"
          />
        </div>
      </div>
    </section>

    <!-- Categories -->
    <section class="max-w-6xl mx-auto px-4 mb-12">
      <div class="flex flex-wrap justify-center gap-4">
        <button 
          v-for="category in categories" 
          :key="category.id"
          @click="selectedCategory = category.id"
          :class="[
            'flex items-center space-x-2 px-6 py-3 rounded-full font-medium transition-all duration-300 transform hover:scale-105',
            selectedCategory === category.id 
              ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-lg' 
              : 'bg-white text-gray-700 hover:bg-orange-50 hover:text-orange-600 border border-gray-200 shadow-sm'
          ]"
        >
          <span class="text-lg">{{ category.icon }}</span>
          <span>{{ category.name }}</span>
        </button>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="max-w-4xl mx-auto px-4 pb-20">
      <div class="space-y-4">
        <div 
          v-for="faq in filteredFAQs" 
          :key="faq.id"
          class="faq-item bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-xl hover:scale-[1.02]"
        >
          <details class="group">
            <summary 
              class="flex items-center justify-between p-6 cursor-pointer hover:bg-orange-50 transition-colors duration-300"
              @click="toggleFAQ(faq.id)"
            >
              <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ faq.question }}</h3>
              <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center text-white font-bold transition-transform duration-300 group-open:rotate-45">
                +
              </div>
            </summary>
            <div class="px-6 pb-6 pt-2 border-t border-gray-100 bg-gray-50">
              <p class="text-gray-700 leading-relaxed">{{ faq.answer }}</p>
              <div class="flex flex-wrap gap-2 mt-4">
                <span 
                  v-for="tag in faq.tags" 
                  :key="tag"
                  class="px-3 py-1 bg-orange-100 text-orange-700 text-sm rounded-full font-medium"
                >
                  #{{ tag }}
                </span>
              </div>
            </div>
          </details>
        </div>
      </div>

      <!-- No Results -->
      <div v-if="filteredFAQs.length === 0" class="text-center py-12">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
          </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Geen resultaten gevonden</h3>
        <p class="text-gray-600 mb-4">Probeer een andere zoekterm of categorie.</p>
        <button 
          @click="searchQuery = ''; selectedCategory = 'all'"
          class="px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-full font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105"
        >
          Alle vragen tonen
        </button>
      </div>

      <!-- Contact CTA -->
      <div class="mt-16 text-center">
        <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl p-8 text-white">
          <h3 class="text-2xl font-bold mb-4">Nog steeds geen antwoord gevonden?</h3>
          <p class="text-orange-100 mb-6 max-w-2xl mx-auto">
            Ons support team staat voor je klaar! We beantwoorden je vraag binnen 24 uur.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <Link href="/contact" class="inline-flex items-center px-8 py-3 bg-white text-orange-600 rounded-full font-semibold hover:bg-gray-50 transition-all duration-300 transform hover:scale-105">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
              </svg>
              Contact opnemen
            </Link>
            <a href="mailto:gdt.kaai.student@ehb.be" class="inline-flex items-center px-8 py-3 bg-white/20 text-white rounded-full font-semibold hover:bg-white/30 transition-all duration-300 transform hover:scale-105">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
              Direct e-mailen
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Enhanced Footer -->
    <footer class="bg-gradient-to-r from-orange-500 to-red-600 text-white py-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8">
          <div>
            <div class="flex items-center space-x-3 mb-6">
              <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <span class="text-white font-bold text-xl">E</span>
              </div>
              <div class="text-white font-bold text-xl">erasmus</div>
            </div>
            <p class="text-orange-100 text-sm mb-6 leading-relaxed">
              Hogeschool Brussel<br />
              Connecting talent with opportunity.<br />
              Jouw carrière begint hier.
            </p>
            <div class="flex space-x-4">
              <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-orange-200 hover:text-white hover:bg-white/30 transition-all duration-300">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                </svg>
              </a>
              <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-orange-200 hover:text-white hover:bg-white/30 transition-all duration-300">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
              </a>
            </div>
          </div>

          <div>
            <h4 class="font-semibold mb-6 text-lg">Voor studenten</h4>
            <ul class="space-y-3 text-orange-100">
              <li><Link href="/register?type=student" class="hover:text-white transition-colors flex items-center">
                <span class="w-1.5 h-1.5 bg-orange-300 rounded-full mr-3"></span>
                Maak je profiel
              </Link></li>
              <li><Link href="/info" class="hover:text-white transition-colors flex items-center">
                <span class="w-1.5 h-1.5 bg-orange-300 rounded-full mr-3"></span>
                Career Launch Info
              </Link></li>
              <li><Link href="/bedrijven" class="hover:text-white transition-colors flex items-center">
                <span class="w-1.5 h-1.5 bg-orange-300 rounded-full mr-3"></span>
                Ontdek bedrijven
              </Link></li>
            </ul>
          </div>

          <div>
            <h4 class="font-semibold mb-6 text-lg">Contact & Support</h4>
            <ul class="space-y-3 text-orange-100">
              <li><a href="mailto:gdt.kaai.student@ehb.be" class="hover:text-white transition-colors flex items-center">
                <span class="w-1.5 h-1.5 bg-orange-300 rounded-full mr-3"></span>
                gdt.kaai.student@ehb.be
              </a></li>
              <li><a href="tel:+3225233737" class="hover:text-white transition-colors flex items-center">
                <span class="w-1.5 h-1.5 bg-orange-300 rounded-full mr-3"></span>
                02 523 37 37
              </a></li>
              <li class="flex items-start">
                <span class="w-1.5 h-1.5 bg-orange-300 rounded-full mr-3 mt-2"></span>
                <span>Nijverheidskaai 170<br />1070 Anderlecht</span>
              </li>
            </ul>
          </div>

          <div>
            <h4 class="font-semibold mb-6 text-lg">Over Ons</h4>
            <ul class="space-y-3 text-orange-100">
              <li><Link href="/Wiezijnwe" class="hover:text-white transition-colors flex items-center">
                <span class="w-1.5 h-1.5 bg-orange-300 rounded-full mr-3"></span>
                Wie zijn we?
              </Link></li>
              <li><a href="#" class="hover:text-white transition-colors flex items-center">
                <span class="w-1.5 h-1.5 bg-orange-300 rounded-full mr-3"></span>
                Onze opleidingen
              </a></li>
              <li><a href="#" class="hover:text-white transition-colors flex items-center">
                <span class="w-1.5 h-1.5 bg-orange-300 rounded-full mr-3"></span>
                Privacy beleid
              </a></li>
            </ul>
          </div>
        </div>

        <div class="border-t border-orange-400 mt-12 pt-8 text-center text-orange-100">
          <p>&copy; 2025 Erasmus Hogeschool Brussel. Alle rechten voorbehouden.</p>
          <p class="mt-2 text-sm">Gemaakt met ❤️ voor onze studenten</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<style scoped>
.gradient-text {
  background: linear-gradient(135deg, #f97316, #ef4444);
  -webkit-background-clip: text;
  -moz-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
  -moz-text-fill-color: transparent;
  text-fill-color: transparent;
}

.animate-fade-in {
  animation: fadeInUp 0.6s ease-out forwards;
}

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

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(135deg, #f97316, #ef4444);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(135deg, #ea580c, #dc2626);
}

/* Enhanced details styling */
details {
  transition: all 0.3s ease;
}

details[open] {
  transform: translateY(-2px);
}

details summary {
  list-style: none;
}

details summary::-webkit-details-marker {
  display: none;
}

/* Smooth height animation for details content */
details[open] > div {
  animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
  from {
    opacity: 0;
    max-height: 0;
  }
  to {
    opacity: 1;
    max-height: 200px;
  }
}

/* Hover effects */
.faq-item:hover {
  transform: translateY(-4px) scale(1.01);
  box-shadow: 0 20px 40px rgba(249, 115, 22, 0.15);
}

/* Search input focus effect */
input:focus {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(249, 115, 22, 0.2);
}

/* Button hover animations */
button:hover {
  transform: translateY(-2px);
}

/* Category button active state */
.category-active {
  box-shadow: 0 8px 25px rgba(249, 115, 22, 0.3);
}

/* Loading animation */
@keyframes pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
  }
}

/* Responsive design improvements */
@media (max-width: 768px) {
  .faq-item {
    margin: 0 -1rem;
    border-radius: 0;
  }
  
  .faq-item:first-child {
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
  }
  
  .faq-item:last-child {
    border-bottom-left-radius: 1rem;
    border-bottom-right-radius: 1rem;
  }
}

/* Enhanced gradient backgrounds */
.gradient-bg-1 {
  background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 50%, #fdba74 100%);
}

.gradient-bg-2 {
  background: linear-gradient(135deg, #fef2f2 0%, #fecaca 50%, #fca5a5 100%);
}

/* Card glass effect */
.glass-card {
  background: rgba(255, 255, 255, 0.85);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

/* Text selection styling */
::selection {
  background: rgba(249, 115, 22, 0.2);
  color: #ea580c;
}

::-moz-selection {
  background: rgba(249, 115, 22, 0.2);
  color: #ea580c;
}

/* Focus states for accessibility */
button:focus,
input:focus,
a:focus {
  outline: 2px solid #f97316;
  outline-offset: 2px;
}

/* Enhanced mobile responsiveness */
@media (max-width: 640px) {
  .hero-title {
    font-size: 2.5rem;
    line-height: 1.1;
  }
  
  .search-container {
    padding: 0 1rem;
  }
  
  .category-buttons {
    gap: 0.5rem;
  }
  
  .category-button {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
  }
}

/* Dark mode support (optional) */
@media (prefers-color-scheme: dark) {
  .bg-white {
    background-color: rgba(255, 255, 255, 0.95);
  }
  
  .text-gray-900 {
    color: #1f2937;
  }
  
  .border-gray-100 {
    border-color: rgba(229, 231, 235, 0.5);
  }
}

/* Print styles */
@media print {
  .no-print {
    display: none !important;
  }
  
  .faq-item {
    break-inside: avoid;
    margin-bottom: 1rem;
  }
  
  details {
    border: 1px solid #ccc;
  }
  
  details[open] summary ~ * {
    display: block;
  }
}

/* High contrast mode support */
@media (prefers-contrast: high) {
  .gradient-text {
    background: #000;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  
  button {
    border: 2px solid currentColor;
  }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
  
  .animate-fade-in {
    animation: none;
  }
}

/* Enhanced typography */
body {
  font-feature-settings: "kern" 1, "liga" 1, "calt" 1;
  text-rendering: optimizeLegibility;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/* Improved focus indicators */
.focus-ring:focus {
  box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.5);
  border-color: #f97316;
}

/* Custom checkbox styling for categories */
input[type="checkbox"]:checked {
  background-color: #f97316;
  border-color: #f97316;
}

/* Enhanced button states */
.btn-primary {
  position: relative;
  overflow: hidden;
}

.btn-primary::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s;
}

.btn-primary:hover::before {
  left: 100%;
}

/* Improved accessibility */
.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border: 0;
}

/* Enhanced loading states */
.skeleton {
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: loading 1.5s infinite;
}

@keyframes loading {
  0% {
    background-position: 200% 0;
  }
  100% {
    background-position: -200% 0;
  }
}

/* Enhanced error states */
.error-state {
  color: #dc2626;
  background-color: #fef2f2;
  border-color: #fecaca;
}

.error-state:focus {
  border-color: #dc2626;
  box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}

/* Success states */
.success-state {
  color: #059669;
  background-color: #ecfdf5;
  border-color: #a7f3d0;
}

/* Enhanced tooltips */
.tooltip {
  position: relative;
}

.tooltip::before {
  content: attr(data-tooltip);
  position: absolute;
  bottom: 100%;
  left: 50%;
  transform: translateX(-50%);
  background: rgba(0, 0, 0, 0.8);
  color: white;
  padding: 0.5rem;
  border-radius: 0.25rem;
  font-size: 0.875rem;
  white-space: nowrap;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s;
}

.tooltip:hover::before {
  opacity: 1;
}
</style>