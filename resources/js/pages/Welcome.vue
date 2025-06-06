<template>
  <div class="min-h-screen bg-[#fff6f1] text-gray-900">
    <!-- NAVIGATION -->
    <header class="flex justify-between items-center p-6 max-w-7xl mx-auto">
      <!-- Logo -->
      <div class="flex items-center space-x-2">
        <img src="/images/ehb-logo.svg" alt="Erasmus Hogeschool Brussel" class="h-10" />
        <span class="font-semibold text-lg">erasmus</span>
      </div>

      <!-- Navigation Buttons -->
      <nav class="flex gap-4">
        <Link
          v-for="item in navItems"
          :key="item.label"
          :href="item.href"
          class="bg-[#f26522] text-white px-4 py-2 rounded hover:bg-[#e85516] font-medium transition"
        >
          {{ item.label }}
        </Link>
      </nav>

      <!-- Search & Avatar -->
      <div class="flex items-center space-x-2">
        <div class="flex items-center bg-gray-200 px-3 py-1 rounded-full">
          <Search class="w-4 h-4 mr-2 text-gray-600" />
          <input
            type="text"
            placeholder="Search"
            class="bg-transparent outline-none text-sm text-gray-700 placeholder-gray-500"
          />
        </div>
        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
          <User class="w-4 h-4 text-white" />
        </div>
      </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center justify-between p-6">
      <!-- Left: Text -->
      <div class="text-center lg:text-left space-y-6 max-w-xl">
        <h1 class="text-4xl font-bold">Start je carrière.<br />Ontdek talent</h1>
        <p class="text-lg text-gray-700">
          Waar studenten en werkgevers samen de toekomst vormgeven.
        </p>
        <div class="flex flex-wrap justify-center lg:justify-start gap-4">
          <Link
            href="/register?type=student"
            class="bg-[#f26522] text-white px-5 py-2 rounded-md hover:bg-[#e85516] transition font-medium"
          >
            Ik ben een student
          </Link>
          <Link
            href="/register?type=bedrijf"
            class="border border-[#f26522] text-[#f26522] px-5 py-2 rounded-md hover:bg-[#fff0e6] transition font-medium"
          >
            Ik ben een bedrijf
          </Link>
        </div>
      </div>

      <!-- Right: Illustration -->
      <div class="mt-10 lg:mt-0">
        <img src="/images/illustration.svg" alt="Handshake Illustration" class="w-72 mx-auto lg:mx-0" />
      </div>
    </main>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { Search, User } from 'lucide-vue-next';

const navItems = [
  { label: 'Home', href: '/' },
  { label: 'Info', href: '/info' },
  { label: 'Favorieten', href: '/favorieten' },
  { label: 'Contact', href: '/contact' },
];
</script>
