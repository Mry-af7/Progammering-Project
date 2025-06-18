<script setup>
import { Head, Link } from '@inertiajs/vue3'

function isActive(page) {
  return page === 'faq'


}


</script>
<template>
  
  <div class="min-h-screen bg-orange-50">
      <Head title="FAQ - Career Launch 2025" />
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

  <div class="faq-wrapper">

   <h1>Veel <span class="gradient-text">gestelde vragen</span></h1>
   <p>Hier vinden jullie de meest gestelde vragen.</p>

  <section class="faq">

   <details>
    <summary>Hoe meld ik me aan?</summary>
    <p>Je maakt een account aan via de knop "Ik ben een student" of "Ik ben een bedrijf" links op de homepage. Vul je gegevens in en activeer je account via de e-mail die je ontvangt.</p>
   </details>

   <details>
    <summary>Is het gratis?</summary>
    <p>Ja, het platform is volledig gratis voor studenten.</p>
   </details>

   <details>
    <summary>Hoe kan ik zien welke bedrijven er meedoen en welke stageplaatsen zij aanbieden?</summary>
    <p>Als je naar beneden gaat scrollen dan kun je al een overzicht zien van een van de beste bedrijven met wie we werken.</p>
   </details>

   <details>
    <summary>Kan ik meerdere bedrijven tegelijkertijd benaderen?</summary>
    <p>Ja, je kan afspraken nemen met meerdere bedrijven door verschillende tijden te reserveren voor elk bedrijf waarin je interesse hebt.</p>
   </details>

   <details>
    <summary>Voeg ik mijn CV en motivatiebrief toe?</summary>
    <p>Je CV voeg je al toe wanneer je je account aanmaakt. Een motivatiebrief toevoegen is altijd optioneel bij het contacteren van bedrijven.</p>
   </details>
  
   <details>
    <summary>Wat als ik geen ervaring heb?</summary>
    <p>Dat is helemaal geen probleem! Het doel van stages is juist om ervaring op te doen dus dat maakt helemaal niet uit.</p>
   </details>

   <details>
    <summary>Hoe betrouwbaar zijn de bedrijven op deze site?</summary>
    <p>Dit zijn allemaal betrijven die hebben gewerkt met het Erasmushogeschool dus deze bedrijven zijn 100% betrouwbaar!</p>
   </details>

   <details>
    <summary>Waar kan ik allemaal op filteren bij het zoeken van een stageplek?</summary>
    <p>Wanneer het gaat om een stageplek zoeken is er heel veel variatie. Je kan filteren op locatie; zo kun je dus een stageplek vinden hier in Brussel, maar mocht je een buitenlandse ervaring willen dan zijn er ook stageplekken verkrijgbaar in Utrecht! Je kan ook filteren op industrie. Heb je meer interesse in development of fascineert data jou, dan vind je hier zeker iets.
    </p>
   </details>

   <details>
    <summary>Kan ik deze site gebruiken als ik geen Belgische student ben?</summary>
    <p>Deze site is gemaakt voor studenten, zodat ze een stageplek kunnen vinden dus het maakt helemaal niet uit of je niet Belgisch bent.</p>
   </details>

   <details>
    <summary>Wat vinden andere studenten hiervan?</summary>
    <p>Op deze site kun je de meningen van andere studenten terugvinden (homepage), waar ze hun succesverhalen delen.</p>
   </details>

<p>
  Als je geen antwoord vindt op jouw vraag, neem gerust <a href="/contact" class="contact"> contact met ons</a> op.
</p>

  </section>

  </div>
  </div>

  




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

</template>

<style scoped>

h1 {
  text-align: center;
   font-size: 3.75rem; 
  font-weight: bold;
  color: #111827; 
  margin-bottom: 1.5rem; 
  line-height: 1.2; 
  text-align: center;
}

.gradient-text {
  background: linear-gradient(to right, #f97316, #ef4444); /* from-orange-500 to-red-500 */
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  color: transparent;
}


p {
  text-align: center;
  font-size: 1.25rem; 
  color: #4b5563;     
  max-width: 42rem;    
  margin-left: auto;
  margin-right: auto;  
  line-height: 1.75rem; 
}


.contact-link {
  color: #979797;
  text-decoration: underline;
  font-weight: bold;
}

.contact-link:hover {
  color: #979797;
}


/* Algemene layout */
.contact-wrapper {
  font-family: 'Segoe UI', sans-serif;
  background-color: #fceee6;
  color: #000;
  line-height: 1.6;
}

details {
  background: white;
  padding: 1rem;
  margin: 1rem 0;
  border: 1px solid #ccc;
  border-radius: 8px;
  transition: all 0.3s ease;
}

details:hover {
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  border-color: #e95c2a;
}


summary {
  font-weight: bold;
  cursor: pointer;
  list-style: none;
  position: relative;
  padding-right: 1.5rem;
}

summary::after {
  content: '+';
  position: absolute;
  color: #e95c2a;
  right: 0;
  top: 0;
}

details[open] summary::after {
  content: '-';
  color: #e95c2a;
}

details p {
  margin-top: 0.5rem;
}

.faq {
  max-width: 700px;
  margin: 2rem auto;
  padding: 2rem;
  background-color: white;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}


.faq h2 {
  font-size: 2rem;
  font-weight: bold;
  color: #e95c2a;
  text-align: center;
  position: relative;
  margin-bottom: 1rem;
}

.faq h2::after {
  content: '';
  display: block;
  width: 60px;
  height: 4px;
  background-color: #e95c2a;
  margin: 0.5rem auto 0;
  border-radius: 2px;
}

.faq p {
  text-align: center;
  color: #555;
  font-size: 1rem;
  margin-bottom: 2rem;
}

 .faq-wrapper {
  background-color: oklch(98% 0.016 73.684);/* lichtoranje achtergrond */
  padding: 3rem 1rem;
}


</style>

<style>
body {
  background-color:oklch(98% 0.016 73.684);
  margin: 0;
  padding: 0;
}

.contact{
  text-decoration: underline;
  margin-top: 1rem;
  text-decoration-color: orange;
}



</style>
