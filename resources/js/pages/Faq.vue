
<script setup>
function isActive(page) {
  return page === 'faq'
}
</script>
<template>
 <div class="faq">
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
  </div>

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

  </section>



</template>

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

</style>
