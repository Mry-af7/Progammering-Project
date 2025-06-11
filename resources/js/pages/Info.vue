<template>
    <div class="info-page">
      <!-- Header -->
      <header class="header">
        <div class="header-container">
          <img src="/images/erasmus-logo.png" alt="Erasmus" class="logo" />
          <nav class="nav-tabs">
            <button v-for="item in navItems" :key="item.key" 
                    :class="['nav-tab', { active: item.key === 'info' }]" 
                    @click="navigate(item.key)">
              {{ item.label }}
            </button>
          </nav>
          <div class="search-container">
            <input type="search" placeholder="Search" v-model="searchTerm" class="search-input" />
            <span class="search-icon">🔍</span>
          </div>
        </div>
      </header>
  
      <!-- Main Content -->
      <main class="main">
        <div class="container">
          <div class="page-header">
            <h1 class="title">Info</h1>
            <div class="underline"></div>
          </div>
  
          <!-- Content -->
          <div class="content">
            <h2 class="event-title">Career Launch 2025: Ontmoet de toekomst van technologie en design!</h2>
            
            <div class="section">
              <h3>Voor studenten:</h3>
              
              <p>Op zoek naar een nieuw job om je technische en IT-vaardigheden te versterken? Grijp dan de kans om deel te nemen aan de Career Launch 2025, georganiseerd door het departement Design & Technologie van de Erasmushogeschool Brussel.</p>
              
              <p>Op DD-MM-YYYY komen de beste bedrijven samen voor het netwerkevent van de design & technologie opleidingen. Dit is jouw kans om de beste bedrijven uit topopleidingen zoals Multimedia & Creatieve Technologie, Toegepaste Informatica, en Internet of Things te ontmoeten.</p>
              
              <div class="benefits">
                <h4>Waarom je erbij moet zijn:</h4>
                <ul>
                  <li>Ontmoet getalenteerde studenten die klaar zijn om jouw bedrijf te versterken.</li>
                  <li>Presenteer jouw organisatie aan potentiële stagiairs, bachelorproefpartners en toekomstige medewerkers.</li>
                  <li>Breid je netwerk uit en leg waardevolle contacten met de volgende generatie professionals.</li>
                </ul>
              </div>
              
              <p>Mis deze kans zeker niet en zet DD-MM-YYYY alvast in je agenda. Schrijf je hieronder in om op de hoogte te blijven!</p>
            </div>
          </div>
        </div>
      </main>
  
      <!-- Footer -->
      <footer class="footer">
        <div class="footer-container">
          <!-- Contact Section -->
          <div class="footer-section contact">
            <h3>Contact</h3>
            <div class="contact-item">
              <span class="label">*E-mail</span>
            </div>
            <div class="contact-item">
              <span class="label">*Telefoon</span>
            </div>
          </div>
  
          <!-- Help Section -->
          <div class="footer-section help">
            <h3>Hulp</h3>
            <div class="help-item">
              <span class="label">*FAQ</span>
            </div>
          </div>
  
          <!-- Over Ons Section -->
          <div class="footer-section about">
            <h3>Over Ons</h3>
            <div class="about-item">
              <span class="label">*Wie zijn we?</span>
            </div>
          </div>
  
          <!-- Right Contact Section -->
          <div class="footer-section contact-right">
            <h3>Contact</h3>
            <div class="contact-item">
              <span class="label">*E-mail</span>
            </div>
            <div class="contact-item">
              <span class="label">*Telefoon</span>
            </div>
          </div>
        </div>
      </footer>
  
      <!-- Toast -->
      <div v-if="toast.show" :class="['toast', `toast-${toast.type}`]">
        {{ toast.message }}
        <button @click="toast.show = false">×</button>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import { router } from '@inertiajs/vue3'
  
  const searchTerm = ref('')
  const toast = ref({ show: false, message: '', type: 'info' })
  
  const navItems = [
    { key: 'home', label: 'Home' },
    { key: 'info', label: 'Info' },
    { key: 'favorieten', label: 'Favorieten' },
    { key: 'contact', label: 'Contact' }
  ]
  
  function navigate(page) {
    const routes = { 
      home: '/', 
      info: '/info', 
      favorieten: '/favorieten', 
      contact: '/contact' 
    }
    router.visit(routes[page])
  }
  
  function showToast(message, type = 'info') {
    toast.value = { show: true, message, type }
    setTimeout(() => toast.value.show = false, 3000)
  }
  </script>
  
  <style scoped>
  .info-page {
    min-height: 100vh;
    background: #f8fafc;
    font-family: system-ui, sans-serif;
    display: flex;
    flex-direction: column;
  }
  
  /* Header */
  .header {
    background: white;
    border-bottom: 1px solid #e2e8f0;
    position: sticky;
    top: 0;
    z-index: 100;
  }
  
  .header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    align-items: center;
    height: 64px;
    gap: 48px;
  }
  
  .logo { height: 32px; }
  
  .nav-tabs {
    display: flex;
    gap: 8px;
    flex: 1;
  }
  
  .nav-tab {
    padding: 8px 16px;
    border: none;
    background: transparent;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    color: #64748b;
    transition: all 0.2s;
  }
  
  .nav-tab:hover { background: #f1f5f9; color: #334155; }
  .nav-tab.active { background: #dc5a41; color: white; }
  
  .search-container { position: relative; }
  
  .search-input {
    width: 240px;
    padding: 8px 12px 8px 36px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 14px;
    background: #f9fafb;
  }
  
  .search-input:focus {
    outline: none;
    border-color: #dc5a41;
    background: white;
    box-shadow: 0 0 0 3px rgba(220, 90, 65, 0.1);
  }
  
  .search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
  }
  
  /* Main */
  .main { 
    flex: 1;
    background: white;
  }
  
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 32px 24px;
  }
  
  .page-header { 
    margin-bottom: 32px;
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 16px;
  }
  
  .title {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
  }
  
  .underline {
    width: 60px;
    height: 3px;
    background: #dc5a41;
    margin-top: 8px;
    border-radius: 2px;
  }
  
  /* Content */
  .content {
    max-width: 800px;
    line-height: 1.6;
  }
  
  .event-title {
    font-size: 24px;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 24px 0;
    line-height: 1.3;
  }
  
  .section h3 {
    font-size: 20px;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 16px 0;
  }
  
  .content p {
    color: #374151;
    margin: 0 0 16px 0;
    font-size: 16px;
  }
  
  .benefits {
    margin: 24px 0;
  }
  
  .benefits h4 {
    font-size: 18px;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 12px 0;
  }
  
  .benefits ul {
    list-style: disc;
    margin-left: 20px;
    color: #374151;
  }
  
  .benefits li {
    margin-bottom: 8px;
  }
  
  /* Footer */
  .footer {
    background: #dc5a41;
    color: white;
    margin-top: auto;
  }
  
  .footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 48px 24px;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    gap: 48px;
  }
  
  .footer-section h3 {
    font-size: 18px;
    font-weight: 600;
    margin: 0 0 24px 0;
    color: white;
  }
  
  .contact-item, .help-item, .about-item {
    margin-bottom: 16px;
  }
  
  .label {
    color: #fed7aa;
    font-size: 14px;
  }
  
  /* Toast */
  .toast {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    display: flex;
    align-items: center;
    padding: 16px;
    max-width: 400px;
    z-index: 1000;
    border-left: 4px solid;
  }
  
  .toast-success { border-left-color: #10b981; }
  .toast-info { border-left-color: #3b82f6; }
  
  .toast button {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: #9ca3af;
    margin-left: 12px;
  }
  
  /* Responsive */
  @media (max-width: 1024px) {
    .footer-container {
      grid-template-columns: 1fr 1fr;
      gap: 32px;
    }
  }
  
  @media (max-width: 768px) {
    .header-container { 
      flex-wrap: wrap; 
      height: auto; 
      padding: 16px; 
      gap: 16px; 
    }
    
    .nav-tabs { 
      order: 3; 
      width: 100%; 
      justify-content: center; 
    }
    
    .search-input { width: 200px; }
    .container { padding: 20px 16px; }
    .event-title { font-size: 20px; }
    
    .footer-container {
      grid-template-columns: 1fr;
      gap: 24px;
      text-align: center;
    }
  }
  </style>