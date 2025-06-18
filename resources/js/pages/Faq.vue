<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
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

function isActive(page: string) {
  return page === 'faq'
}

function toggleFAQ(id: number) {
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
  <AppLayout>
    <Head title="FAQ - Career Launch 2025 Pro" />
    
    <!-- Hero Section -->
    <section class="py-16 lg:py-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <div class="inline-flex items-center px-4 py-2 bg-orange-100 rounded-full text-orange-700 text-sm font-medium mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Veelgestelde Vragen
          </div>
          <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
            Alles wat je wilt weten over
            <span class="bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">
              Career Launch 2025
            </span>
          </h1>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Vind snel antwoorden op je vragen over ons platform, stages, bedrijven en meer. 
            Kan je het antwoord niet vinden? Neem dan contact met ons op!
          </p>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
      
      <!-- Search & Filter Bar -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
        <div class="flex flex-col lg:flex-row gap-4">
          <div class="flex-1">
            <div class="relative">
              <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
              <input 
                v-model="searchQuery"
                type="text" 
                placeholder="Zoek in FAQ..." 
                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent"
              >
            </div>
          </div>
          <div class="flex gap-2">
            <select v-model="selectedCategory" class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent">
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.icon }} {{ category.name }}
              </option>
            </select>
            <button @click="searchQuery = ''; selectedCategory = 'all'" class="px-4 py-3 text-gray-500 hover:text-gray-700 transition-colors">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- FAQ Grid -->
      <div v-if="filteredFAQs.length > 0" class="space-y-6">
        <div 
          v-for="item in filteredFAQs" 
          :key="item.id"
          class="faq-item bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300"
        >
          <button
            @click="toggleFAQ(item.id)"
            class="w-full p-6 text-left flex items-center justify-between hover:bg-gray-50 transition-colors"
          >
            <div class="flex-1">
              <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ item.question }}</h3>
              <div class="flex flex-wrap gap-2">
                <span
                  v-for="tag in item.tags.slice(0, 3)"
                  :key="tag"
                  class="px-2 py-1 bg-orange-100 text-orange-600 text-xs rounded-full"
                >
                  {{ tag }}
                </span>
              </div>
            </div>
            <div class="ml-4 flex-shrink-0">
              <svg 
                class="w-6 h-6 text-gray-400 transform transition-transform duration-200"
                :class="{ 'rotate-180': animatedItems.has(item.id) }"
                fill="none" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </button>
          
          <div 
            v-show="animatedItems.has(item.id)"
            class="px-6 pb-6 border-t border-gray-100"
          >
            <div class="pt-4 text-gray-600 leading-relaxed">
              {{ item.answer }}
            </div>
          </div>
        </div>
      </div>

      <!-- No Results State -->
      <div v-else class="text-center py-16">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
          <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Geen resultaten gevonden</h3>
        <p class="text-gray-600 mb-8 max-w-md mx-auto">
          Probeer andere zoektermen of filters om je vraag te vinden.
        </p>
        <button
          @click="searchQuery = ''; selectedCategory = 'all'"
          class="inline-flex items-center bg-orange-500 text-white px-6 py-3 rounded-xl font-medium hover:bg-orange-600 transition-colors"
        >
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
          </svg>
          Filters wissen
        </button>
      </div>

      <!-- Contact Section -->
      <div class="mt-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl p-8 text-center text-white">
        <h3 class="text-2xl font-bold mb-4">Nog vragen?</h3>
        <p class="text-orange-100 mb-6 max-w-2xl mx-auto">
          Kan je het antwoord op je vraag niet vinden? Ons team staat klaar om je te helpen!
        </p>
        <Link
          href="/contact"
          class="inline-flex items-center bg-white text-orange-600 px-6 py-3 rounded-xl font-medium hover:bg-gray-100 transition-colors"
        >
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
          </svg>
          Neem contact op
        </Link>
      </div>
    </main>
  </AppLayout>
</template>

<style scoped>
.animate-fade-in {
  animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  line-clamp: 2;
}
</style>