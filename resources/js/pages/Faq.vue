
<script setup>
function isActive(page) {
  return page === 'faq'
}
</script>
<template>
 <div class="nav">
    <header class="nav">
      <div class="logo-section">
          <a href="/home"><div class="logo-icon">E</div></a>
        </div>

      <nav class="nav-menu">
        <button :class="{ active: isActive('home') }">Home</button>
        <button :class="{ active: isActive('info') }">Info</button>
        <button :class="{ active: isActive('fav') }">Favorieten</button>
        <button :class="{ active: isActive('contact') }">Contact</button>
        <input type="search" placeholder="Zoek..." class="search" />
      </nav>
    </header>
  </div>

  <div class="faq-wrapper">
  <section class="faq">
   <h2>FAQ</h2>
   <p>Hier vinden jullie de meest gestelde vragen.</p>

   <details>
    <summary>Hoe meld ik me aan?</summary>
    <p>Je maakt een account aan via de knop “Ik ben een student” of “Ik ben een bedrijf” links op de homepage. Vul je gegevens in en activeer je account via de e-mail die je ontvangt.</p>
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
    <p>Ja, het platform is volledig gratis voor studenten.</p>
   </details>
  
<p>
  Als je geen antwoord vindt op jouw vraag, neem gerust <a href="/contact" class="contact"> contact met ons</a> op.
</p>

  </section>
  </div>

  




<footer class="bg-orange-500 text-white py-16 mt-20">
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
          <h3 class="font-semibold mb-4">Contact</h3>
            <ul class="space-y-2 text-orange-100 text-sm">
              <li>*E-mail</li>
              <li>*Telefoon</li>
           </ul>
        </div>
                    
                    <!-- Hulp Section -->
        <div>
          <h3 class="font-semibold mb-4">Hulp</h3>
            <ul class="space-y-2 text-orange-100 text-sm">
              <a href="/Faq">
                   *FAQ</a>
            </ul>
        </div>
                    
                    <!-- Over Ons Section -->
        <div>
          <h3 class="font-semibold mb-4">Over Ons</h3>
            <ul class="space-y-2 text-orange-100 text-sm">
              <li>*Wie zijn we?</li>
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

.contact-link {
  color: #e95c2a;
  text-decoration: underline;
  font-weight: bold;
}

.contact-link:hover {
  color: #c4440c;
}


/* Algemene layout */
.contact-wrapper {
  font-family: 'Segoe UI', sans-serif;
  background-color: #fceee6;
  color: #000;
  line-height: 1.6;
}

/* Navigatie */
.nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem;
  background-color: white;
  flex-wrap: wrap;
  gap: 1rem;
  
}

.logo {
  height: 50px;
}

.nav-menu {
  display: flex;
  align-items: center;
  gap: 0.8rem;
  flex-wrap: wrap;
}

.nav-menu button {
  background-color: #ffb195;
  border: none;
  padding: 0.4rem 0.9rem;
  border-radius: 5px;
  cursor: pointer;
  font-weight: bold;
  transition: background 0.3s;
}

.nav-menu button.active,
.nav-menu button:hover {
  background-color: #e95c2a;
  color: white;
}



.search {
  padding: 0.4rem 0.8rem;
  border: 1px solid #ccc;
  border-radius: 5px;
}

details {
  background: white;
  padding: 1rem;
  margin: 1rem 0;
  border: 1px solid #ccc;
  border-radius: 8px;
  transition: all 0.3s ease;
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
  background-color: #fff;
  border: 2px solid #e95c2a;
  border-radius: 8px;
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
  background-color: #fff1e6; /* lichtoranje achtergrond */
  padding: 3rem 1rem;
}

.faq {
  background-color: white;
  border-radius: 12px;
  padding: 2rem;
  max-width: 700px;
  margin: 0 auto;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}


</style>

<style>
body {
  background-color: #fff1e6;
  margin: 0;
  padding: 0;
}

.contact{
  text-decoration: underline;
  margin-top: 1rem;
  text-decoration-color: orange;
}

.logo-section {
  display: inline flex;
  align-items: center;
  flex-shrink: 0;
}
.logo {
  height: 20px;
  margin-right: 0 auto;
}
.logo-text {
  display: flex;
  flex-direction: column;
  line-height: 1;
}
.logo-title {
  font-size: 1.3rem;
  font-weight: 900;
  text-transform: lowercase;
  color: black;
}
.logo-subtitle {
  font-size: 0.8rem;
  font-weight: 400;
  color: grey;
  text-transform: uppercase;
}
.logo-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 2.5rem;
  height: 40px;
  margin-right: 0.5rem;
  background-color: #DC2626;
  border-radius: 0.75rem;
  font-family: sans-serif;
  font-size: 1.25rem; 
  font-weight: 700;  
  color: white;
}

</style>
