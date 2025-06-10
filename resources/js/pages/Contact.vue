<template>
  <div class="contact-wrapper">
    <!-- Navigatie -->
    <header class="nav">
      <img src="/images/erasmus-logo.png" alt="Logo" class="logo" />

      <nav class="nav-menu">
        <button :class="{ active: isActive('home') }">Home</button>
        <button :class="{ active: isActive('info') }">Info</button>
        <button :class="{ active: isActive('fav') }">Favorieten</button>
        <button :class="{ active: isActive('contact') }">Contact</button>
        <input type="search" placeholder="Zoek..." class="search" />
      </nav>
    </header>

    <!-- Inhoud -->
    <main class="main">
      <h1>Contacteer ons</h1>
      <hr />

      <section>
        <h2>Mail</h2>
        <ul>
          <li><strong>Mail EhB:</strong> <a href="mailto:gdt.kaai.student@ehb.be">gdt.kaai.student@ehb.be</a></li>
          <li><strong>Algemeen:</strong> <a href="mailto:info@ehb.be">info@ehb.be</a></li>
        </ul>
      </section>

      <section>
        <h2>Telefoonnummer</h2>
        <p><a href="tel:+3225233737">02 523 37 37</a></p>
      </section>

      <section>
        <h2>Adres</h2>
        <p>Nijverheidskaai 170, 1070 Anderlecht</p>
        <iframe
  class="map"
  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2519.039912671353!2d4.322273015745595!3d50.8365139795281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3c37b41d22fd3%3A0xe6b6b5f9b8f7e94!2sErasmushogeschool%20Brussel!5e0!3m2!1snl!2sbe!4v1687361774367!5m2!1snl!2sbe"
  width="100%"
  height="300"
  style="border:0;"
  loading="lazy"
  referrerpolicy="no-referrer-when-downgrade"
  :allowfullscreen="true"
>

        ></iframe>
      </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
      <div>
        <h3>Contact</h3>
        <p>E-mail: <a href="mailto:gdt.kaai.student@ehb.be">gdt.kaai.student@ehb.be</a></p>
        <p>Tel: <a href="tel:+3225233737">02 523 37 37</a></p>
      </div>
      <div>
        <h3>Hulp</h3>
        <p>*FAQ</p>
      </div>
      <div>
        <h3>Over Ons</h3>
        <p>*Wie zijn we?</p>
      </div>
    </footer>
  </div>
</template>

<script setup lang="ts">
// Voor router ondersteuning (optioneel later)
// const route = useRoute();

function isActive(page: string) {
  return page === 'contact'; // Simuleer actieve pagina
}
</script>

<style scoped>
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

/* Inhoud */
.main {
  max-width: 800px;
  margin: auto;
  padding: 2rem 1rem;
}

h1 {
  font-size: 2rem;
  margin-bottom: 1rem;
}

section {
  margin-top: 1.5rem;
}

.map {
  margin-top: 1rem;
  border-radius: 8px;
}

/* Footer */
.footer {
  background-color: #e95c2a;
  color: white;
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  padding: 2rem 1rem;
  text-align: left;
}

.footer div {
  min-width: 200px;
  margin-bottom: 1rem;
}

.footer h3 {
  text-decoration: underline;
}

a {
  color: inherit;
  text-decoration: underline;
}

a:hover {
  text-decoration: none;
}

/* Responsive */
@media (max-width: 768px) {
  .nav {
    flex-direction: column;
    align-items: flex-start;
  }

  .footer {
    flex-direction: column;
    text-align: center;
    align-items: center;
  }
}
</style>
