<script setup lang="ts">

import { usePage, useForm } from '@inertiajs/vue3';

const roleType = usePage().url.includes('type=bedrijf') ? 'bedrijf' : 'student';


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

const navItems = [
  { label: 'Home', href: '/' },
  { label: 'Info', href: '/info' },
  { label: 'Favorieten', href: '/favorieten' },
  { label: 'Contact', href: '/contact' },
];


const form = useForm({
    firstname: '',
    lastname: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: roleType,
    company_name: '',
    age: '',
    gender: '',
    field_of_study: '',
    cv: {} as File | null,
});

const handleFileChange = (event: Event) => {
  const target = event.target as HTMLInputElement;
  form.cv = target.files?.[0] ?? null;
};

const submit = () => {
    form.post(route('register'), {
        forceFormData: true,
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

     <main class="max-w-xl mx-auto p-6 mt-8 bg-transparent">
    <h1 class="text-lg font-semibold border-b border-gray-300 pb-2 mb-6 text-center">
      Inschrijving
    </h1>

        <Head title="Register" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <!--VOORNAAM-->
                <div class="grid grid-cols-2 gap-4">
                  <div class="grid gap-2">
                   <Label for="firstname">Voornaam</Label>
                   <Input id="firstname" type="text" required :tabindex="1" v-model="form.firstname" placeholder="Voornaam"
                     class="bg-[#E6E6E6] text-black placeholder:text-black border-none" />
                   <InputError :message="form.errors.firstname" />
                  </div>

                <!--ACHTERNAAM-->
                <div class="grid gap-2">
                  <Label for="lastname">Achternaam</Label>
                  <Input id="lastname" type="text" required :tabindex="2" v-model="form.lastname" placeholder="Achternaam" 
                    class="bg-[#E6E6E6] text-black placeholder:text-black border-none" />
                  <InputError :message="form.errors.lastname" />
                </div>
               </div>

                <!--EMAIL-->
                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input id="email" type="email" required :tabindex="3" autocomplete="email" v-model="form.email" placeholder="email@example.com" 
                     class="bg-[#E6E6E6] text-black placeholder:text-black border-none"/>
                    <InputError :message="form.errors.email" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                
                <!--LEEFTIJD-->    
                <div class="grid gap-2">
                   <Label for="age">Leeftijd</Label>
                   <Input id="age" type="number" min="0" required :tabindex="4" v-model="form.age" placeholder="Leeftijd" 
                     class="bg-[#E6E6E6] text-black placeholder:text-black border-none"/>
                   <InputError :message="form.errors.age" />
                </div>
                 
                <!--GESLACHT-->
                <div class="grid gap-2">
                   <Label for="gender">Geslacht</Label>
                    <select
                       id="gender"
                       v-model="form.gender"
                       required
                       :tabindex="5"
                       class="w-full bg-[#E6E6E6] text-black rounded px-3 py-2 text-sm border-none focus:ring-1 focus:ring-black"
>

                      <option value="" disabled selected>Kies geslacht</option>
                      <option value="man">Man</option>
                      <option value="vrouw">Vrouw</option>
                      <option value="anders">Anders</option>
                    </select>
                   <InputError :message="form.errors.gender" />
                </div>
                </div> 

                <!--STUDEIRICHTING-->
                <div class="grid gap-2">
                   <Label for="field_of_study">Studierichting</Label>
                   <Input
                     id="field_of_study"
                     type="text"
                     required
                     :tabindex="6"
                     v-model="form.field_of_study"
                     placeholder="Bijv. Toegepaste informatica"
                     class="bg-[#E6E6E6] text-black placeholder:text-black border-none"/>
                   <InputError :message="form.errors.field_of_study" />
                </div>

                <!--CV-->
                <div class="grid gap-2">
                   <Label for="cv">Upload je CV</Label>
                   <input
                     id="cv"
                     type="file"
                     accept=".pdf,.doc,.docx"
                     @change="handleFileChange"
                     class="w-full bg-[#E6E6E6] text-black rounded px-3 py-2 text-sm border-none file:bg-gray-300 file:border-none file:px-3 file:py-1 file:mr-2 file:rounded file:text-black"
                     :tabindex="7"
                     />
                   <InputError :message="form.errors.cv" />
                </div>

                <!-- Only show this if user is a company -->
                <div v-if="roleType === 'bedrijf'" class="mt-4">
                    <label for="company_name" class="block text-sm font-medium">Bedrijfsnaam</label>
                    <input
                    v-model="form.company_name"
                    id="company_name"
                     type="text"
                     class="mt-1 block w-full border rounded px-3 py-2" 
                     :tabindex="8"/>
                    </div>
                
                <!--WACHTWOORD-->
                <div class="grid gap-2">
                    <Label for="password">Password</Label>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="9"
                        autocomplete="new-password"
                        v-model="form.password"
                        placeholder="Password"
                        class="bg-[#E6E6E6] text-black placeholder:text-black border-none"/>
                    <InputError :message="form.errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">Confirm password</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        required
                        :tabindex="10"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="Confirm password"
                        class="bg-[#E6E6E6] text-black placeholder:text-black border-none"/>
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <!-- Wachtwoord vergeten link -->
                <div class="text-right text-sm">
                    <TextLink :href="route('password.request')" class="underline underline-offset-4" :tabindex="11">Wachtwoord vergeten?</TextLink>
                </div>

                <Button
                   type="submit"
                   class="mt-2 w-full bg-[#F26C2A] text-white hover:bg-[#e45b1c]"
                   :tabindex="12"
                   :disabled="form.processing">
                   <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Maak profiel aan
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
             Heb je al een account?
             <TextLink :href="route('login')" class="underline underline-offset-4" :tabindex="13">Log in</TextLink>
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
