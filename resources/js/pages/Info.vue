<template>
    <div id="top" class="info-page">
      <Head title="Info" />
  
      <!-- Header -->
      <header class="header">
        <div class="header-container">
          <!-- logo + tekst -->
          <a href="/" class="logo-link">
            <div class="logo-icon">E</div>
            <div class="logo-text">
              <span class="logo-title">erasmus</span>
              <span class="logo-subtitle">HOGESCHOOL BRUSSEL</span>
            </div>
          </a>
  
          <!-- desktop nav + login -->
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
            <Link href="/login" class="login-button">
              Inloggen <i class="fas fa-sign-in-alt"></i>
            </Link>
          </div>
  
          <!-- mobiele toggle -->
          <button
            class="mobile-menu-button mobile-only"
            @click="isMenuOpen = !isMenuOpen"
            aria-label="Toggle menu"
          >☰</button>
        </div>
  
        <!-- mobiele nav + login -->
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
          <Link href="/login" class="login-button mobile-login">
            Inloggen <i class="fas fa-sign-in-alt"></i>
          </Link>
        </div>
      </header>
  
      <!-- Main Content -->
      <main class="main-content">
        <div class="page-header">
          <div class="header-box">
            <h1 class="header-title">Info</h1>
            <div class="header-underline"></div>
          </div>
        </div>
        <section class="content-section">
          <div class="content-inner">
            <h2 class="content-title">
              Career Launch 2025: Ontmoet de toekomst van technologie en design!
            </h2>
            <div class="text-block">
              <div class="text-segment">
                <div class="segment-heading">
                  <span class="segment-icon"></span>
                  Voor studenten:
                </div>
                <div class="segment-text">
                  <p>Op zoek naar een nieuw job om je technische en IT-vaardigheden te versterken? Grijp dan de kans om deel te nemen aan de Career Launch 2025, georganiseerd door het departement Design & Technologie van de Erasmushogeschool Brussel.</p>
                  <p>Op 25 juni 2025 komen de beste bedrijven samen voor het netwerkevent van de design & technologie opleidingen. Dit is jouw kans om de beste bedrijven uit topopleidingen zoals Multimedia & Creatieve Technologie, Toegepaste Informatica en Internet of Things te ontmoeten.</p>
                </div>
              </div>
              <div class="highlight-section">
                <div class="highlight-heading">
                  <span class="highlight-icon"></span>
                  Waarom je erbij moet zijn:
                </div>
                <ul class="highlight-list">
                  <li class="highlight-item">Ontmoet getalenteerde studenten die klaar zijn om jouw bedrijf te versterken.</li>
                  <li class="highlight-item">Presenteer jouw organisatie aan potentiële stagiairs, bachelorproefpartners en toekomstige medewerkers.</li>
                  <li class="highlight-item">Breid je netwerk uit en leg waardevolle contacten met de volgende generatie professionals.</li>
                </ul>
              </div>
              <div class="notice-section">
                <p>Mis deze kans zeker niet en zet 25 juni 2025 alvast in je agenda. Schrijf je hieronder in om op de hoogte te blijven!</p>
              </div>
            </div>
            <div class="cta-section">
              <div class="cta-box">
                <h3 class="cta-title">Klaar om deel te nemen?</h3>
                <p class="cta-subtitle">Registreer je nu voor Career Launch 2025</p>
                <Link href="/register" class="cta-button">Schrijf je nu in</Link>
              </div>
            </div>
          </div>
        </section>
      </main>
  
      <!-- Footer -->
      <footer class="page-footer">
        <div class="footer-column">
          <a href="/home">
              <a href="/home"><div class="logo-icon">E</div><span class="footer-titel">erasmus</span></a>
        <p>Hogeschool Brussel</p>
        <p>Connecting talent with opportunity</p>
        <h3>Volg ons</h3>
          </a>
          <p>Hogeschool Brussel</p>
          <p>Connecting talent met opportunity</p>
          <h3>Volg ons</h3>
          <ul class="social-icons">
            <li><a href="https://www.linkedin.com/school/erasmus-hogeschool-brussel/" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin fa-lg"></i></a></li>
            <li><a href="https://www.instagram.com/erasmushogeschool/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram fa-lg"></i></a></li>
          </ul>
        </div>
        <div class="footer-Contact">
          <h3>Contact</h3>
          <ul>
            <li>Email: <a href="mailto:gdt.kaai.student@ehb.be">gdt.kaai.student@ehb.be</a></li>
            <li>Tel: <a href="tel:+3225233737">02 523 37 37</a></li>
          </ul>
        </div>
        <div class="footer-group">
          <div class="footer-hulp">
            <h3>Hulp</h3>
            <a href="/faq">FAQ</a>
          </div>
          <div class="footer-over-ons">
            <h3>Over Ons</h3>
            <ul>
                <Link :href="route('wiezijnwe')">Wie zijn we?</Link>
            </ul>
          </div>
        </div>
        <hr class="horizontale-lijn" />
        <p>© 2025 Erasmus Hogeschool Brussel. Alle rechten voorbehouden.</p>
      </footer>
    </div>
  </template>
  
  <script setup>
  import { Head, Link } from '@inertiajs/vue3'
  import { ref } from 'vue'
  import { router, usePage } from '@inertiajs/vue3'
  

  
  const page = usePage()
  const path = page.url.split('/')[1]
  const keyMap = { '': 'home', info: 'info', favorieten: 'fav', contact: 'contact', wiezijnwe: 'wie zijn we' }
  const activeTab = ref(keyMap[path] || 'home')
  
  const navItems = [
    { key: 'home', label: 'Home' },
    { key: 'info', label: 'Info' },
    { key: 'fav', label: 'Favorieten' },
    { key: 'contact', label: 'Contact' },
  ]
  
  const isMenuOpen = ref(false)
  
  function navigate(key) {
    const routes = {
      home: '/',
      info: '/info',
      fav: '/favorieten',
      contact: '/contact',
      wiezijnwe: '/wiezijnwe',
    }
    router.visit(routes[key])
  }
  </script>
  
  <style scoped>
  @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
  
  /* === Pagina achtergrond === */
  .info-page {
    background-color: #FFF7ED;
  }
  
  /* === Header & Nav === */
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
    padding: 0 16px;
    height: 74px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .logo-link {
    display: flex; 
    align-items: center;
     text-decoration: none;
  }
  .logo-icon {
    width: 2.5rem; 
    height: 2.4rem;
    background: #DC2626; 
    border-radius: 0.75rem;
    color: #FFF;
     font-size: 1.3rem; 
     font-weight: 700;
    display: flex; 
    align-items: center; 
    justify-content: center;
  }
  .logo-text { 
    margin-left: 0.75rem; 
    line-height: 1; }
  .logo-title {
    display: block; 
    font-size: 1.25rem; 
    font-weight: 700;
    color: #111827; 
    text-transform: lowercase;
  }
  .logo-subtitle {
    display: block;
     font-size: 0.75rem;
      font-weight: 400;
    color: #6B7280;
     text-transform: uppercase; 
     margin-top: 2px;
  }
  .header-actions { display: flex; 
    align-items:center; 
    gap: 1.5rem; }
  .nav-tabs { 
    display: flex; 
    gap: 1.5rem; }
  .nav-tab {
    background: none; 
    border: none; 
    padding: 0.5rem 0;
    font-size: 1rem; 
    font-weight: 500;
     color: #374151;
    cursor: pointer; 
    position: relative; 
    transition: color .2s;
  }
  .nav-tab:hover, .nav-tab.active { 
    color: #EF4444; }
  .nav-tab.active::after {
    content: ''; 
    position: absolute; 
    bottom: -0.4rem; left: 0;
    width: 100%; 
    height: 2px; 
    background: #EF4444; 
    border-radius: 1px;
  }
  .login-button {
    display:inline-flex; 
    align-items: center; 
    gap: 0.5rem;
    padding: 0.5rem 1rem;
     background: #EF4444; 
     color: #FFF;
    font-weight: 600;
     font-size: 0.95rem; 
     border-radius: 0.375rem;
    text-decoration: none;
  }
  .login-button i { font-size: 1rem; }
  .mobile-menu-button {
    background: none;
     border: none;
      font-size: 1.75rem; 
      color: #374151;
  }
  .mobile-only { display: none; }
  @media (max-width: 768px) {
    .desktop-only { display: none; }
    .mobile-only { display: block; }
    .mobile {
      background: #FFF7ED; 
      border-top: 1px solid #E2E8F0;
      padding: 12px 16px;
    }
    .mobile-nav {
         display: flex; 
         flex-direction: column; 
        gap: 1rem;
         margin-bottom: 1rem; }
    .mobile-nav .nav-tab { 
        width: 100%; 
        text-align: left; 
        padding: 0.5rem 0; }
    .mobile-login { 
        justify-content: center; 
        width: 100%; }
  }
  
  /* === Main Content === */
  .main-content {
    max-width: 72rem;
     margin: 0 auto;
      padding: 3rem 1rem;
  }
  .page-header {
     margin-bottom: 3rem; }
  .header-box {
    background: #FFF;
     border-radius: 1.5rem;
    padding: 2rem; 
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
  }
  .header-title {
    font-size: 2.25rem; 
    font-weight: 700;
     color: #1F2937; 
     margin-bottom: 1rem;
  }
  .header-underline {
    width: 5rem; height: 0.25rem;
    background: linear-gradient(to right, #F97316, #EF4444);
    border-radius: 9999px;
  }
  .content-section {
    background: #FFF;
     border-radius: 1.5rem;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
     overflow: hidden;
  }
  .content-inner { padding: 2rem; }
  .content-title {
    font-size: 1.875rem;
     font-weight: 700; 
     color: #1F2937;
    margin-bottom: 2rem;
  }
  .text-block { margin-bottom: 1rem; }
  .segment-heading {
    display: flex; 
    align-items: center; 
    font-size: 1.5rem;
    font-weight: 600; 
    color: #1F2937;
     margin-bottom: 1.5rem;
  }
  .segment-icon {
    width: 2rem;
     height: 2rem;
      background: #F97316;
    border-radius: 0.5rem;
     margin-right: 0.75rem;
  }
  .segment-text p {
    color: #4B5563;
     font-size: 1.125rem; 
     line-height: 1.75rem;
    margin-top: 1.5rem;
  }
  .highlight-section {
    background: linear-gradient(to right, #fa6c14, #cb4a4a);
    border-radius: 1rem;
     padding: 2rem; 
     margin: 2rem 0;
  }
  .highlight-heading {
    display: flex; 
    align-items: center; 
    font-size: 1.25rem;
    font-weight: 600; 
    color: #1F2937; 
    margin-bottom: 1.5rem;
  }
  .highlight-icon {
    width: 1.5rem;
     height: 1.5rem; 
     background: #F97316;
    border-radius: 9999px; 
    margin-right: 0.75rem;
  }
  .notice-section {
    border-left: 0.25rem solid #F97316; 
    padding: 1rem 1.5rem; 
    color: #1F2937;
  }
  .cta-section { margin-top: 3rem; 
    text-align: center; }
  .cta-box {
    background: linear-gradient(
        to right, #F97316, #EF4444);
    border-radius: 1rem; 
    padding: 2rem; 
    color: #FFF;
  }
  .cta-title { 
    font-size: 1.5rem; 
    font-weight: 700; 
    margin-bottom: 1rem; }
  .cta-subtitle 
  { color: #FFEFE6;
     margin-bottom: 1.5rem; }
  .cta-button {
    background: #FFF; 
    color: #F97316; 
    padding: 0.75rem 2rem;
    border-radius: 0.75rem;
     font-weight: 600; 
     text-decoration: none;
  }
  
  /* === Footer Styles === */
  .page-footer {
    display: flex; 
    flex-wrap: wrap; 
    background: #F97316; 
    color: #FFF;
    padding: 2rem 1rem; gap: 1rem; 
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
  }
  .footer-column, .footer-Contact, .footer-group {
    flex: 1 1 100%;
     display: flex; 
     flex-direction: column; gap: 0.5rem;
  }
  .footer-column .logo-icon {
    width: 2.5rem; 
    height: 2.4rem; 
    background: #DC2626;
    border-radius: 0.75rem; 
    color: #FFF; 
    font-size: 1.3rem; 
    font-weight: 700;
    display: flex; 
    align-items: center; 
    justify-content: center; 
    margin-bottom: 0.5rem;
  }
  .footer-titel { 
    font-weight: 700; 
    font-size: 1.25rem;
     text-transform: lowercase; }
  .footer-Contact h3, .footer-hulp h3, .footer-over-ons h3 {
    margin: 0;
     font-size: 1rem;
      font-weight: 600;
  }
  .page-footer a {
     color: #FFF; 
     text-decoration: none; }
  .page-footer a:hover {
     text-decoration: underline; }
  .social-icons { 
    display: flex; 
    gap: 0.5rem; 
    list-style: none; 
    padding: 0; 
    margin: 0; }
  .footer-group { 
    display: flex;
     flex-direction: column; 
     gap: 1rem; }
  @media (min-width: 1024px) {
    .footer-column, .footer-Contact, .footer-group {
      flex: 1 1 25%;
       min-width: 200px;
    }
    .footer-group { flex-direction: row; }
    .footer-group > div { flex: 1; }
  }
  .horizontale-lijn {
    width: 100%; 
    border: none; 
    border-top: 1px solid #FED7AA;
    margin: 1.5rem 0 1rem;
  }
  .page-footer > p {
    width: 100%;
     text-align: center; 
     font-size: 0.95rem; 
     margin: 0;
  }
  </style>
