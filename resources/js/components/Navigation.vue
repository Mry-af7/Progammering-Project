<template>
  <nav class="bg-white shadow-md py-4 px-8 flex justify-between items-center">
    <div class="flex items-center space-x-8">
      <Link href="/" class="text-lg font-bold text-orange-600">Career Launch</Link>
      <Link href="/" class="text-gray-700 hover:text-orange-600">Home</Link>
      <Link href="/info" class="text-gray-700 hover:text-orange-600">Info</Link>
      <Link href="/favorieten" class="text-gray-700 hover:text-orange-600">Favorieten</Link>
      <Link href="/contact" class="text-gray-700 hover:text-orange-600">Contact</Link>
    </div>
    <div>
      <Link href="/login" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Inloggen</Link>
    </div>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script> 