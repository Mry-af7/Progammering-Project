<template>
  <div class="min-h-screen bg-[#fff6f1] text-gray-900 flex flex-col">
    <!-- Navbar -->
    <header class="bg-white shadow-sm border-b">
      <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
          <img src="/images/ehb-logo.svg" alt="Erasmus Hogeschool Brussel" class="h-10" />
          <span class="text-xl font-semibold">erasmus</span>
        </div>

        <!-- Nav links -->
        <nav class="hidden md:flex gap-4">
          <Link
            v-for="item in navItems"
            :key="item.label"
            :href="item.href"
            class="text-sm font-medium px-4 py-2 rounded hover:bg-orange-100 transition"
            :class="{ 'bg-[#f26522] text-white': item.active }"
          >
            {{ item.label }}
          </Link>
        </nav>

        <!-- Search & User -->
        <div class="flex items-center gap-3">
          <form @submit.prevent="handleSearch" class="flex items-center bg-gray-100 px-3 py-1 rounded-full">
            <Search class="w-4 h-4 text-gray-500 mr-2" />
            <input
              v-model="search"
              type="text"
              placeholder="Zoeken"
              class="bg-transparent text-sm outline-none placeholder-gray-500"
            />
          </form>
          <div class="w-9 h-9 bg-gray-400 rounded-full flex items-center justify-center">
            <User class="w-5 h-5 text-white" />
          </div>
        </div>
      </div>
    </header>

    <!-- Hero -->
    <main class="flex-1">
      <div class="max-w-7xl mx-auto px-6 py-16 flex flex-col-reverse lg:flex-row items-center gap-12">
        <!-- Text -->
        <div class="text-center lg:text-left max-w-xl space-y-6">
          <h1 class="text-4xl font-bold leading-tight">
            Start je carrière.<br />
            Ontdek talent.
          </h1>
          <p class="text-lg text-gray-700">
            Waar studenten en werkgevers samen de toekomst vormgeven.
          </p>
          <div class="flex flex-wrap justify-center lg:justify-start gap-4">
            <Link
              href="/register?type=student"
              class="bg-[#f26522] text-white px-5 py-2 rounded hover:bg-[#e85516] transition font-medium"
            >
              Ik ben een student
            </Link>
            <Link
              href="/register?type=bedrijf"
              class="border border-[#f26522] text-[#f26522] px-5 py-2 rounded hover:bg-[#fff0e6] transition font-medium"
            >
              Ik ben een bedrijf
            </Link>
          </div>
        </div>

        <!-- Illustration -->
        <div class="w-full max-w-sm">
          <img src="/images/illustration.svg" alt="Handshake Illustration" class="w-full" />
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-auto">
      <div class="max-w-7xl mx-auto px-6 py-6 text-sm text-gray-500 text-center">
        © {{ new Date().getFullYear() }} Erasmus Hogeschool Brussel. Alle rechten voorbehouden.
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { Search, User } from 'lucide-vue-next';

const search = ref('');
const handleSearch = () => {
  if (search.value.trim()) {
    router.visit(`/search?query=${encodeURIComponent(search.value)}`);
  }
};

const navItems = [
  { label: 'Home', href: '/', active: true },
  { label: 'Info', href: '/info', active: false },
  { label: 'Favorieten', href: '/favorieten', active: false },
  { label: 'Contact', href: '/contact', active: false },
];
</script>
