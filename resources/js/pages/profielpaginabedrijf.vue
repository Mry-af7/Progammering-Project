<script setup>
defineProps({
  company: Object
});
</script>

<template>
  <div class="min-h-screen bg-orange-50">

    <!-- Navigation -->
    <nav class="bg-orange-50 py-4">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
          <!-- Logo -->
          <div class="flex items-center">
            <div class="flex items-center space-x-2">
              <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                <span class="text-white font-bold text-sm">E</span>
              </div>
              <div>
                <div class="text-black font-bold text-lg">erasmus</div>
                <div class="text-xs text-gray-600 -mt-1">HOGESCHOOL BRUSSEL</div>
              </div>
            </div>
          </div>

          <!-- Navigation Links -->
          <div class="hidden md:flex items-center space-x-2">
            <button class="bg-orange-500 text-white px-6 py-2 rounded-full font-medium hover:bg-orange-600 transition-colors">Home</button>
            <button class="bg-orange-500 text-white px-6 py-2 rounded-full font-medium hover:bg-orange-600 transition-colors">Info</button>
            <button class="bg-orange-500 text-white px-6 py-2 rounded-full font-medium hover:bg-orange-600 transition-colors">Favorieten</button>
            <button class="bg-orange-500 text-white px-6 py-2 rounded-full font-medium hover:bg-orange-600 transition-colors">Contact</button>

            <!-- Search -->
            <div class="relative ml-4">
              <input type="text" placeholder="Search" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-full pl-10 w-40 focus:outline-none focus:ring-2 focus:ring-orange-500">
              <svg class="w-4 h-4 text-gray-600 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </div>

            <!-- Profile Icon -->
            <div class="ml-4">
              <div class="w-10 h-10 bg-gray-400 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Bedrijfsprofiel -->
    <div class="flex flex-col items-center justify-center p-8">
      <h1 class="text-2xl font-bold mb-4">Welkom, {{ company.company_name }}!</h1>

      <div class="grid gap-4 text-left text-gray-700">
        <p><strong>Sector:</strong> {{ company.sector }}</p>
        <p><strong>Email:</strong> {{ company.email }}</p>
        <p><strong>Locatie:</strong> {{ company.location }}</p>
        <p><strong>Website:</strong> <a :href="company.website" target="_blank" class="text-blue-600 hover:underline">{{ company.website }}</a></p>
        <p><strong>Beschrijving:</strong> {{ company.description }}</p>
      </div>
    </div>

    <!-- Footer -->
    <footer class="bg-orange-500 text-white py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8">
          <div>
            <h3 class="font-bold text-lg mb-4">Erasmus</h3>
            <p class="text-orange-100 text-sm">
              Hogeschool Brussel<br>
              Connecting talent with opportunity
            </p>
          </div>

          <div>
            <h4 class="font-semibold mb-4">Voor studenten</h4>
            <ul class="space-y-2 text-orange-100 text-sm">
              <li><a href="#" class="hover:text-white transition-colors">Vind vacatures</a></li>
              <li><a href="#" class="hover:text-white transition-colors">CV tips</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Interview tips</a></li>
            </ul>
          </div>

          <div>
            <h4 class="font-semibold mb-4">Voor bedrijven</h4>
            <ul class="space-y-2 text-orange-100 text-sm">
              <li><a href="#" class="hover:text-white transition-colors">Plaats vacature</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Zoek talent</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Prijzen</a></li>
            </ul>
          </div>

          <div>
            <h4 class="font-semibold mb-4">Over ons</h4>
            <ul class="space-y-2 text-orange-100 text-sm">
              <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Privacy</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Voorwaarden</a></li>
            </ul>
          </div>
        </div>

        <div class="border-t border-orange-400 mt-8 pt-8 text-center text-orange-100 text-sm">
          <p>&copy; 2025 Erasmus Hogeschool Brussel. Alle rechten voorbehouden.</p>
        </div>
      </div>
    </footer>

  </div>
</template>
