<template>
  <div id="top" class="over-ons-page">
    <!-- Header -->
    <header class="header">
      <div class="header-container">
        <!-- logo + tekst -->
          <div class="logo-section">
          <a href="/home"><div class="logo-icon">E</div></a>

          <div class="logo-text">
           <a href="/home"><span class="logo-title">erasmus</span></a>
           <a href="/home"><span class="logo-subtitle">HOGESCHOOL BRUSSEL</span></a>
          </div>
        </div>

        <link 
           rel="stylesheet" 
           href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
           integrity="sha512-pn7rmv03+Wv9y6Q5xX6YbNlT8R1krh6x3GQXV8XUKPqhBwY/cpzuqF1VvRDKPeXtskEOnjU7+XvA1r8+p/HS5A==" 
           crossorigin="anonymous" 
           referrerpolicy="no-referrer" 
/>

        <!-- desktop nav + zoek -->
        <div class="header-actions desktop-only">
          <nav class="nav-tabs">
            <button
              v-for="item in navItems"
              :key="item.key"
              :class="['nav-tab', { active: item.key === activeTab }]"
              @click="navigate(item.key)"
            >
              {{ item.label }}
            </button>
          </nav>
          <div class="search-container">
            <input
              type="search"
              placeholder="Search"
              v-model="searchTerm"
              @keyup.enter="doSearch"
              class="search-input"
            />
            <span class="search-icon">🔍</span>
            <!-- bij geen resultaat -->
            <div v-if="noResult" class="no-result">
              Geen resultaten (meer) gevonden voor “{{ searchTerm }}”
            </div>
          </div>
        </div>

        <!-- mobiele versie -->
        <button
          class="mobile-menu-button mobile-only"
          @click="isMenuOpen = !isMenuOpen"
          aria-label="Toggle menu"
        >
          ☰
        </button>
      </div>

      <!-- mobiele versie -->
      <div v-if="isMenuOpen" class="mobile mobile-only">
        <nav class="mobile-nav">
          <button
            v-for="item in navItems"
            :key="item.key"
            :class="['nav-tab', { active: item.key === activeTab }]"
            @click="navigate(item.key); isMenuOpen = false"
          >
            {{ item.label }}
          </button>
        </nav>
        <div class="search-container">
          <input
            type="search"
            placeholder="Search"
            v-model="searchTerm"
            @keyup.enter="doSearch"
            class="search-input"
          />
          <span class="search-icon">🔍</span>
          <!-- bij geen resultaat -->
          <div v-if="noResult" class="no-result">
            Geen resultaten gevonden voor “{{ searchTerm }}”
          </div>
        </div>
      </div>
    </header>
    

    <!-- Main Content “Wie zijn we?” -->
    <section class="intro">
      <h1 class="title">Wie zijn we?</h1>
      <p>Wij zijn een team van studenten aan de Erasmus Hogeschool Brussel, Campus KAAI.</p>
      <p>Onze missie is om studenten te ondersteunen in hun academische en persoonlijke ontwikkeling.</p>
      <p>We organiseren evenementen, bieden vacature mogelijkheden en creëren een community waar iedereen zich welkom voelt.</p>
      <p>Onze focus ligt op inclusiviteit, samenwerking en het delen van kennis.</p>
      <p>Of je nu op zoek bent naar je allereerste bijbaan of flexibele studentenjob: wij brengen je snel in contact met werkgevers die echt waarde hechten aan jouw talent.</p>
      <br>
      <section class="campus-afbeelding">
          <img src="https://wmimages.bruzz.be/styles/1f8c29ed4efcaed916a7e270e4064aaa5d961eac/2019-09/ehb.jpg?style=W3sianBlZyI6eyJxdWFsaXR5Ijo3MH19LHsicmVzaXplIjp7ImZpdCI6Imluc2lkZSIsIndpZHRoIjoxMjk2LCJoZWlnaHQiOjg2NCwid2l0aG91dEVubGFyZ2VtZW50Ijp0cnVlfX1d&sign=68fc6e13e1b1174d338988a4c6477394860b43ab962beb454c2791177f007c19" alt="Campus kaai"
          class="campus-image">
      </section>
      <p class="subtitle">Over ons</p>

      <section class="team-info">
        <h2>Maak kennis met ons team!</h2>
        <p>We zijn een diverse groep studenten met verschillende achtergronden en interesses.</p>
        <p>Onze teamleden zijn gepassioneerd over technologie en het creëren van een inclusieve omgeving.</p>
        <p>We geloven in samenwerking en het delen van kennis om elkaar te helpen groeien.</p>
        <p>Hieronder vind je meer informatie over onze teamleden:</p>
        <ul>
          <li><strong>Jawad Zannou</strong> - Student: Toegepaste informatica</li>
          <li><strong>Amine Zerouali</strong> - Student: Toegepaste informatica</li>
          <li><strong>Amina Saidi</strong> - Student: Toegepaste informatica</li>
          <li><strong>Rania El Hakiki</strong> - Student: Toegepaste informatica</li>
          <li><strong>Maryam Afallah</strong> - Student: Toegepaste informatica</li>
          <li><strong>Asma M'Barki</strong> - Student: Toegepaste informatica</li>
        </ul>
      </section>

      <!-- Team Cards Section -->
      <section class="team-info">
        <h2>Meer informatie en bereikbaar via LinkedIn:</h2>
        <div class="team-grid">
          <a
            v-for="lid in team"
            :key="lid.naam"
            :href="lid.linkedin"
            class="team-card"
            target="_blank"
            rel="noopener noreferrer"
          >
            <div class="card-text">
              <strong>{{ lid.naam }}</strong>
              <span class="role">– {{ lid.functie }}</span>
            </div>
            <div class="linkedin-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34 34">
                <path
                  d="M34,34h-7V23c0-2.5-0.1-5.7-3.5-5.7c-3.5,0-4,2.7-4,5.6v10h-7V11h6.7v3.1h0.1
                     c0.9-1.7,3.2-3.5,6.6-3.5
                     c7.1,0,8.5,4.7,8.5,10.8V34z
                     M5,8C2.2,8,0,5.8,0,3S2.2-2,5-2s5,2.2,5,5
                     S7.8,8,5,8z
                     M1.5,34h7V11h-7V34z"
                  fill="#0A66C2"
                />
              </svg>
            </div>
          </a>
        </div>
      </section>
    </section>

    <!-- Footer -->
    <footer class="page-footer">
      <div class="footer-column">
              <a href="/home"><div class="logo-icon">E</div><span class="footer-titel">erasmus</span></a>
        <p>Hogeschool Brussel</p>
        <p>Connecting talent with opportunity</p>
        <h3>Volg ons</h3>
        <ul class="social-list">
      
          <ul class="social-icons">
<li>
  <a href="https://www.linkedin.com/school/erasmus-hogeschool-brussel/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
    <!-- LinkedIn SVG -->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 448 512" fill="#FFFFFF">
      <path d="M100.28 448H7.4V148.9h92.88zm-46.44-339C24.08 109 0 84.92 0 55.72 0 26.06 24.78.08 53.83.08c29 0 53.77 26 53.77 55.64 0 29.2-24.78 53.28-53.76 53.28zM447.9 448h-92.68V302.4c0-34.7-.7-79.3-48.3-79.3-48.3 0-55.7 37.8-55.7 76.8V448h-92.7V148.9h89v40.8h1.3c12.4-23.4 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z"/>
    </svg>
  </a>
</li>
<li>
  <a href="https://www.instagram.com/erasmushogeschool/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
    <!-- Instagram SVG -->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 448 512" fill="#FFFFFF">
      <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9S160.5 370.8 224.1 370.8 339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.3 0-74.7-33.4-74.7-74.7 0-41.3 33.4-74.7 74.7-74.7s74.7 33.4 74.7 74.7c0 41.3-33.4 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.9-26.9 26.9-14.9 0-26.9-12-26.9-26.9s12-26.9 26.9-26.9c14.9 0 26.9 12 26.9 26.9zm76.1 27.2c-.1-54.3-44.3-98.3-98.6-98.3H98.6C44.3 65 0 109 0 163.3v185.3c0 54.3 44.3 98.3 98.6 98.3h185.3c54.3 0 98.5-44 98.6-98.3V163.3zM398.8 352c0 25.6-20.8 46.4-46.4 46.4H95.6c-25.6 0-46.4-20.8-46.4-46.4V159.6c0-25.6 20.8-46.4 46.4-46.4h256.8c25.6 0 46.4 20.8 46.4 46.4V352z"/>
    </svg>
  </a>
</li>
</ul>

        </ul>
      </div>
      <div class="footer-Contact">
        <h3>Contact</h3>
        <ul>
          <li>Email: <a href="mailto:gdt.kaai.student@ehb.be">gdt.kaai.student@ehb.be</a></li>
          <li>Tel: <a href="tel:+3225233737">02 523 37 37</a></li>
        </ul>
      </div>
      <div class="footer-hulp">
        <h3>Hulp</h3>
        <a href="/faq">FAQ</a>
        </div>
      <div class="footer-over-ons">
        <h3>Over Ons</h3>
        <a href="#top">Wie zijn we?</a>
      </div>
      <br>
      <hr class="horizontale lijn">
      <div class="copywrite"></div>
      <p>© 2025 Erasmus Hogeschool Brussel. Alle rechten voorbehouden.</p>
    </footer>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

const page = usePage()
const path = page.url.split('/')[1]
const keyMap = {
  '':         'home',
  info:       'info',
  favorieten: 'fav',
  contact:    'contact',
  Wiezijnwe:  'wie zijn we'
}
const activeTab = ref(keyMap[path] || 'home')

const navItems = [
  { key: 'home',    label: 'Home' },
  { key: 'info',    label: 'Info' },
  { key: 'fav',     label: 'Favorieten' },
  { key: 'contact', label: 'Contact' },
]

const searchTerm = ref('')
const isMenuOpen = ref(false)
// houd bij of er geen resultaten zijn
const noResult = ref(false)

function navigate(key) {
  const routes = {
    home:      '/',
    info:      '/info',
    fav:       '/favorieten',
    contact:   '/contact',
    wiezijnwe: '/wiezijnwe',
  }
  router.visit(routes[key])
}


const team = [
  { naam: 'Jawad Zannou',   functie: 'Student', linkedin: 'https://www.linkedin.com/in/jawad-zannou-437abb359/' },
  { naam: 'Amine Zerouali',  functie: 'Student', linkedin: 'https://www.linkedin.com/in/amine-zerouali-063124357/' }, 
  { naam: 'Amina Saidi',     functie: 'Student', linkedin: 'https://www.linkedin.com/in/amina-saidi-a7a526352/' },
  { naam: 'Rania El Hakiki', functie: 'Student', linkedin: 'https://www.linkedin.com/in/rania-el-hakiki-723360286/' },
  { naam: 'Maryam Afallah',  functie: 'Student', linkedin: '' }, //nog geen LinkedIn
  { naam: 'Asma M\'Barki',   functie: 'Student', linkedin: 'https://www.linkedin.com/in/mbarkiasma' },
]

function doSearch() {
  noResult.value = false
  const term = searchTerm.value.trim()
  if (!term) return

  const found = window.find(term)
  if (!found) {
    noResult.value = true
  }
  setTimeout(() => {
    noResult.value = false
  }, 6000)
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

.over-ons-page {
  min-height: 100vh;
  background: #FFF7ED;
  display: flex;
  flex-direction: column;
  font-family: 'Open Sans', sans-serif; 
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  letter-spacing: 0.5px;
  line-height: 1.6;
}


.header {
  background: #FFF7ED;
  border-bottom: 1px solid #E2E8F0;
  position: sticky;
  top: 0;
  z-index: 100;
}

.header-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 12px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 74px;
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

.header-actions {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-shrink: 0;
}


.desktop-only { display: flex; }
.mobile-only  { display: none; }


.nav-tabs {
  display: flex;
  gap: 5px;
  color: black;
}
.nav-tab {
  padding: 2px 6px;
  font-size: 1rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: 300;
  color: black;
  white-space: nowrap;
  transition: background .2s, color .2s;
}
.nav-tab:hover {
  background: #F97316;
}
@media (min-width: 700px) {
  .nav-tab {
    padding: 8px 16px;
    font-size: 1rem;
    font-weight: 300;
  }
}

.search-container {
  position: relative;
  min-height: 30px;
}
.search-input {
  width: 240px;
  padding: 8px 12px 8px 36px;
  border: 1px solid black;
  border-radius: 6px;
  background: #F9FAFB;
  transition: border-color 0.2s, background 10s;
}
.search-input:focus {
  border-color: #FB923C;
  background: #FFFFFF;
  color: black;
}
.search-icon {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: grey;
}

.no-result {
  margin-top: 4px;
  color: red; 
  font-size: 0.875rem;
}

.mobile-menu-button {
  background: transparent;
  border: none;
  font-size: 2rem;
  cursor: pointer;
  color: black;
}

.mobile {
  background: #FFF7ED;
  border-top: 1px solid #E2E8F0;
  padding: 8px 12px;
}
.mobile-nav {
  display: flex;
  flex-direction: column;
  gap: 8px;
  color: black;
}
.mobile-nav .nav-tab {
  text-align: left;
  width: 100%;
  padding: 8px 12px;
}


.intro {
  background: #FFFFFF;
  padding: 2rem;
  margin: 3rem auto;
  max-width: 800px;
  border-left: 4px solid #FB923C;
  border-radius: 0.5rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  font-family: 'Open Sans', sans-serif;
  color: #4A5568;
}


.intro .title,
.intro h1 {
  font-family: 'Merriweather', serif;
  font-size: 2.25rem;
  font-weight: 700;
  color: #FB923C;
  margin-bottom: 1rem;
}


.intro p {
  font-size: 1rem;
  line-height: 1.75;
  margin-bottom: 1rem;
  text-align: left;
}


.intro ul {
  margin: 1rem 0;
  padding-left: 1.5rem;
}
.intro ul li {
  margin-bottom: 0.5rem;
}


@media (max-width: 768px) {
  .intro {
    padding: 1.5rem;
    margin: 2rem auto;
  }
  .intro .title,
  .intro h1 {
    font-size: 1.75rem;
  }
  .intro p {
    font-size: 0.95rem;
  }
}


.title, h1{
  font-family: 'Open Sans', sans-serif;
  font-weight: 900;
  color: #FB923C;
  margin: 0;
  text-decoration:underline ;
  text-decoration-color: #FB923C;
  text-decoration-thickness: 5px;
  text-underline-offset: 0.6rem;
}
.title {
  font-size: 2.5rem;
  color: #FB923C;
  font-family: 'Open Sans', sans-serif;
  margin-bottom: 1.5rem;
  margin-top: 1rem;
  font-weight:900;
}
.subtitle {
  border-bottom: 1px solid #1F2937;
  display: inline-block;
  color: #FB923C;
  font-family: 'Open Sans', sans-serif;
}
.intro p {
  font-size: 1.5rem;
  line-height: 1.75;
  color: black;
  font-family: 'Open Sans', sans-serif;
  line-height: 2.25rem;
  font-weight: 500;
}
.campus-afbeelding{
  position: relative;
  width: 100%;
  max-width: none;
  overflow: hidden;
  border-radius: 8px;
  margin: 0.1rem 0rem 4rem 0rem;
  height: 300px;              
  object-fit: cover;
}
.campus-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.team-info {
  margin-top: 1rem;
  padding: 1rem;
  color: black;
  border-radius: 8px;
  background: #F3F4F6;
  font-family: 'Open Sans', sans-serif;
  border: 1px solid #E2E8F0;
}
.team-info h2 {
  color: #FB923C;
  margin-bottom: 1rem;
  font-size: 1.8rem;
  font-weight: 650;
  font-family: 'Open Sans', sans-serif;
}
.team-info ul {
  list-style: none;
  padding: 0;
}
.team-info li {
  margin: 1rem 0;
  font-size: 1.25rem;
  color: #374151;
}

.team-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 1rem;
}
.team-card {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #FFFFFF;
  padding: 1rem 1.5rem;
  border-radius: 6px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.05);
  text-decoration: none;
  color: inherit;
  transition: transform 0.2s, box-shadow 0.2s;
}
.team-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.card-text {
  font-size: 1.2rem;
  color: #1F2937;
}
.role {
  font-size: 1rem;
  color: #6B7280;
}
.linkedin-icon {
  width: 24px;
  height: 24px;
  fill: #0A66C2;
  margin-left: 8px;
}
.social-list {
  display: flex;
  gap: 0.5rem;
  align-items: center;
  padding: 0;
  margin: 2em 0;
}
.social-icons li {
  list-style:url(https://www.w3.org/2000/svg) none;
  margin: 0;
}
.social-icons {
  display: flex;
  gap: 0.5rem;
  align-items: center;
  padding: 0;
  margin: 0;
}

.footer-column .logo-icon {
  float: left;
  margin-right: 0.5rem;
}

.footer-column > h3:first-of-type {
  display: inline-block;
  vertical-align: middle;
  margin: 0;
}

.page-footer {
  display: flex;
  flex-wrap: wrap;
  background: #F97316;
  color: #FFFFFF;
  padding: 2rem 1rem;
  gap: 1rem;
  text-align: left;
  align-items: flex-start;
}

.page-footer > div {
  flex: 1 1 100%;
}


.footer-column {
  display: flex;
  flex-direction: column;
  gap: 0.2rem;
}
.footer-column .logo-icon {
  width: 2.5rem;
  margin-bottom: 0.3rem !important;
  margin: 0 auto; 
}
.footer-column h3 {
  margin: 0;
  font-size: 0.8rem;
  font-weight: 600;
}

.footer-titel {
  margin-left: 0.5rem;
  align-self: center;
  font-weight: 800;
  font-size: 1.2rem;
}
.footer-Contact,
.footer-hulp,
.footer-over\ ons {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}
.footer-hulp,
.footer-Contact {
  gap: 0rem;
}
.footer-Contact h3,
.footer-hulp h3,
.footer-over-ons h3 {
  margin-bottom: 0;
  font-size: 1rem;
  font-weight: 600;
}

.page-footer ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.page-footer a {
  color: white;
  text-decoration: none;
}
.page-footer a:hover {
  text-decoration: underline;
}

.copywrite,
.page-footer > p {
  width: 100%;
  margin-top: 0;
  font-size: 0.95rem;
  color: white;
  text-align: center;
}


@media (min-width: 768px) {
  .page-footer {
    justify-content: space-between;
    padding-top: 2rem;
  }
  .page-footer > div {
    flex: 1 1 calc(25% - 2rem);
  }
}


@media (max-width: 768px) {
  .desktop-only { display: none; }
  .mobile-only  { display: block; }
  .search-input { width: 100%; }
}
@media (max-width: 480px) {
  .logo { height: 24px; margin-right: 4px; }
  .nav-tab { padding: 2px 4px; font-size: 0.65rem; }
}

section {
  border: 1px solid #E2E8F0;
  border-radius: 0.75rem;
  padding: 1rem;
  margin: 2rem auto;
  width: 95%;
}

</style>