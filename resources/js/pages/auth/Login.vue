<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { ref } from 'vue';
const activeTab = ref<'bedrijf' | 'student'>('bedrijf');
import { Link } from '@inertiajs/vue3';
import { Search, User } from 'lucide-vue-next';

const navItems = [
  { label: 'Home', href: '/' },
  { label: 'Info', href: '/info' },
  { label: 'Favorieten', href: '/favorieten' },
  { label: 'Contact', href: '/contact' },
];



defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
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
      v-for="item in navItems"
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

    <main class="max-w-md mx-auto p-6 mt-8 bg-transparent">
        <!--nie zeker, mssch verandere-->
        <h1 class="text-lg font-semibold border-b border-gray-300 pb-2 mb-6 text-center">
          Login / Aanmelden
        </h1>

        <Head title="Log in" />
        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>
        <!--plak-->
        <div class="flex justify-center gap-4 mb-6">
          <button
           :class="[
             'px-4 py-2 rounded font-semibold transition',
              activeTab === 'bedrijf' ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-600'
        ]"
          @click="activeTab = 'bedrijf'"
          type="button">
          Bedrijven
          </button>
  <button
    :class="[
      'px-4 py-2 rounded font-semibold transition',
      activeTab === 'student' ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-600'
    ]"
    @click="activeTab = 'student'"
    type="button"
  >
    Studenten
  </button>
</div>

<p class="text-center text-sm text-muted-foreground mb-2">
  Je logt momenteel in als: 
  <strong>{{ activeTab === 'bedrijf' ? 'Bedrijf' : 'Student' }}</strong>
</p>

        
<form @submit.prevent="submit" class="flex flex-col gap-6">
<div class="grid gap-6">

<!-- Alleen zichtbaar als de gebruiker 'student' heeft gekozen

<div v-if="activeTab === 'student'" class="grid gap-2">
  <Label for="studentennummer">Studentennummer</Label>
  <Input
    id="studentennummer"
    type="text"
    :tabindex="1"
    placeholder="Bijv. S123456"
  />
</div>
-->
<div class="grid gap-2">
 <Label for="email">Email address</Label>
  <Input 
    id="email" 
    type="email" 
    class="bg-gray-200 placeholder-gray-500 text-gray-800 rounded px-3 py-2"
    required autofocus 
    :tabindex="1" 
    autocomplete="email" 
    v-model="form.email"
    placeholder="email@example.com"/>                    
  <InputError :message="form.errors.email" />
</div>

<div class="grid gap-2">
 <div class="flex items-center justify-between">
  <Label for="password">Password</Label>
   <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm" :tabindex="5"> 
     Forgot password?
   </TextLink>
 </div>
  <Input
    id="password"
    type="password"
    class="bg-gray-200 placeholder-gray-500 text-gray-800 rounded px-3 py-2"
    required
    :tabindex="2"
    autocomplete="current-password"
    v-model="form.password"
    placeholder="Password"/>
  <InputError :message="form.errors.password" />
</div>

<div class="flex items-center justify-between">
 <Label for="remember" class="flex items-center space-x-3">
  <Checkbox id="remember" v-model="form.remember" :tabindex="3" />
   <span>Remember me</span>
 </Label>
</div>

 <Button
   type="submit"
   class="mt-4 w-full bg-[#f26522] hover:bg-[#e85516] text-white font-semibold py-2 rounded transition"
   :tabindex="4"
   :disabled="form.processing">
  <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
   Log in
 </Button>
</div>

<div class="text-center text-sm text-muted-foreground">
  Don't have an account?
 <TextLink :href="route('register')" :tabindex="5">Sign up</TextLink>
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
