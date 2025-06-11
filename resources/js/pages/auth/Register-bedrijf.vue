<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

import { Link } from '@inertiajs/vue3';
import { Search } from 'lucide-vue-next';



const form = useForm({
  company_name: '',
  email: '',
  password: '',
  password_confirmation: '',
  role: 'bedrijf',
});

const submitCompany = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>  
  <div class="min-h-screen bg-[#fff6f1] text-gray-900">
    <header class="bg-orange-50 py-4">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center">

      <!-- Logo -->
      <div class="flex items-center space-x-2">
        <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
          <span class="text-white font-bold text-sm">E</span>
        </div>
        <div>
          <div class="text-black font-bold text-lg">erasmus</div>
          <div class="text-xs text-gray-600 -mt-1">HOGESCHOOL BRUSSEL</div>
        </div>
      </div>

      <!-- Navigation -->
      <nav class="flex gap-4">
        <Link
          v-for="item in [
            { label: 'Home', href: '/' },
            { label: 'Info', href: '/info' },
            { label: 'Favorieten', href: '/favorieten' },
            { label: 'Contact', href: '/contact' }
          ]"
          :key="item.label"
          :href="item.href"
          class="bg-orange-500 text-white px-6 py-2 rounded-full font-medium hover:bg-orange-600 transition-colors"
        >
          {{ item.label }}
        </Link>
      </nav>

      <!-- Search + Avatar -->
      <div class="flex items-center space-x-2">
        <div class="relative ml-4">
          <input 
            type="text" 
            placeholder="Search" 
            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-full pl-10 w-40 focus:outline-none focus:ring-2 focus:ring-orange-500"
          >
          <Search class="w-4 h-4 text-gray-600 absolute left-3 top-2.5" />
        </div>

        <div class="w-10 h-10 bg-gray-400 rounded-full flex items-center justify-center">
          <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
          </svg>
        </div>
      </div>

    </div>
  </div>
</header>
  <main class="max-w-xl mx-auto p-6 mt-8 bg-transparent">
    <h1 class="text-lg font-semibold border-b border-gray-300 pb-2 mb-6 text-center">
      Inschrijving bedrijf
    </h1>

    <Head title="Register Bedrijf" />

    <form @submit.prevent="submitCompany" class="flex flex-col gap-6">
      <div class="grid gap-6">
        <div class="grid gap-2">
          <Label for="company_name">Bedrijfsnaam</Label>
          <Input
             id="company_name"
             v-model="form.company_name"
             type="text"
             required
             placeholder="Bijv. Microsoft"
             class="bg-[#E6E6E6] text-black placeholder:text-black border-none"/>
          <InputError :message="form.errors.company_name" />
        </div>

        <div class="grid gap-2">
          <Label for="email">Emailadres</Label>
          <Input
             id="email"
             v-model="form.email"
             type="email"
             required
             placeholder="email@bedrijf.be"
             class="bg-[#E6E6E6] text-black placeholder:text-black border-none"/>
          <InputError :message="form.errors.email" />
        </div>

        <div class="grid gap-2">
          <Label for="password">Wachtwoord</Label>
          <Input
             id="password"
             v-model="form.password"
             type="password"
             required
             placeholder="Wachtwoord"
             class="bg-[#E6E6E6] text-black placeholder:text-black border-none"/>
          <InputError :message="form.errors.password" />
        </div>

        <div class="grid gap-2">
          <Label for="password_confirmation">Herhaal wachtwoord</Label>
          <Input
             id="password_confirmation"
             v-model="form.password_confirmation"
             type="password"
             required
             placeholder="Herhaal wachtwoord"
             class="bg-[#E6E6E6] text-black placeholder:text-black border-none"/>
          <InputError :message="form.errors.password_confirmation" />
        </div>

        <!-- Wachtwoord vergeten link -->
         <div class="text-right text-sm">
             <TextLink :href="route('password.request')" class="underline underline-offset-4">
              Wachtwoord vergeten?
             </TextLink>
         </div>

        <Button type="submit" class="w-full bg-[#F26C2A] text-white hover:bg-[#e45b1c]" :disabled="form.processing">
          <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
          Maak bedrijfsprofiel aan
        </Button>
      </div>

      <div class="text-center text-sm text-muted-foreground mt-2">
        Heb je al een account?
        <TextLink :href="route('login')" class="underline underline-offset-4">Log in</TextLink>
      </div>
    </form>
</main>
<footer class="bg-orange-500 text-white py-12 mt-16">
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
