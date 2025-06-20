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
import { Search, User } from 'lucide-vue-next';
import { ref } from 'vue';

const mobileMenuOpen = ref(false);

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  industry: '',
  description: '',
  location: '',
});

const submitCompany = () => {
  form.post(route('register.bedrijf'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
    <div class="min-h-screen bg-orange-50">
        <Head title="Register Bedrijf" />
        
        <!-- Navigation -->
        <nav class="bg-orange-50/90 backdrop-blur-sm shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <Link href="/" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-lg">E</span>
                        </div>
                        <div>
                            <div class="text-gray-900 font-bold text-xl">erasmus</div>
                            <div class="text-xs text-gray-600 -mt-1">HOGESCHOOL BRUSSEL</div>
                        </div>
                    </Link>
                    
                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-gray-700 hover:bg-orange-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Desktop Navigation Links -->
                    <div class="hidden md:flex items-center space-x-1">
                        <Link href="/" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Home</Link>
                        <Link href="/info" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Info</Link>
                        <Link href="/bedrijven" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Bedrijven</Link>
                        <Link href="/afspraak" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Afspraak</Link>
                        <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Contact</Link>
                        
                        <div class="flex items-center ml-6">
                            <Link href="/login" class="px-6 py-2 text-orange-600 hover:text-orange-700 font-medium transition-colors">Inloggen</Link>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile menu -->
                <div v-show="mobileMenuOpen" class="md:hidden mt-4 pb-4 border-t border-orange-200">
                    <div class="flex flex-col space-y-2 pt-4">
                        <Link href="/" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Home</Link>
                        <Link href="/info" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Info</Link>
                        <Link href="/bedrijven" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Bedrijven</Link>
                        <Link href="/afspraak" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Afspraak</Link>
                        <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Contact</Link>
                        <Link href="/login" class="px-4 py-2 text-orange-600 hover:text-orange-700 font-medium">Inloggen</Link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Registration Card -->
            <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-8 py-6 text-center">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-2xl lg:text-3xl font-bold text-white mb-2">
                        Inschrijving bedrijf
                    </h1>
                    <p class="text-orange-100">Ontdek getalenteerde Erasmus studenten voor jouw bedrijf</p>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <!-- Benefits Section -->
                    <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-2xl p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Waarom bij ons registreren?
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-600">
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span>Toegang tot 1,200+ getalenteerde studenten</span>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span>Directe matching voor stages en jobs</span>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span>Speeddate events voor persoonlijk contact</span>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span>Voorgescreende kandidaten uit topopleidingen</span>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Form -->
                    <form @submit.prevent="submitCompany" class="space-y-6">
                        <!-- Company Name Field -->
                        <div>
                            <Label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Bedrijfsnaam
                            </Label>
                            <Input
                                id="name"
                                v-model="form.name"
                                type="text"
                                required
                                placeholder="Bijv. Microsoft"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                            />
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>

                        <!-- Email Field -->
                        <div>
                            <Label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Emailadres
                            </Label>
                            <Input
                                id="email"
                                v-model="form.email"
                                type="email"
                                required
                                placeholder="email@bedrijf.be"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                            />
                            <InputError :message="form.errors.email" class="mt-2" />
                        </div>

                        <!-- Password Field -->
                        <div>
                            <Label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Wachtwoord
                            </Label>
                            <Input
                                id="password"
                                v-model="form.password"
                                type="password"
                                required
                                placeholder="Wachtwoord"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                            />
                            <InputError :message="form.errors.password" class="mt-2" />
                        </div>

                        <!-- Password Confirmation Field -->
                        <div>
                            <Label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                Herhaal wachtwoord
                            </Label>
                            <Input
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                required
                                placeholder="Herhaal wachtwoord"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                            />
                            <InputError :message="form.errors.password_confirmation" class="mt-2" />
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="text-right">
                            <TextLink 
                                :href="route('password.request')" 
                                class="text-sm text-orange-600 hover:text-orange-700 font-medium"
                            >
                                Wachtwoord vergeten?
                            </TextLink>
                        </div>

                        <!-- Submit Button -->
                        <Button
                            type="submit"
                            class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-semibold py-4 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl"
                            :disabled="form.processing"
                        >
                            <LoaderCircle v-if="form.processing" class="h-5 w-5 animate-spin mr-2" />
                            <svg v-else class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Maak bedrijfsprofiel aan
                        </Button>

                        <!-- Login Link -->
                        <div class="text-center pt-4 border-t border-gray-100">
                            <span class="text-sm text-gray-600">Heb je al een account? </span>
                            <TextLink
                                :href="route('login')"
                                class="text-orange-600 hover:text-orange-700 font-semibold"
                            >
                                Log in
                            </TextLink>
                        </div>
                    </form>
                </div>
            </div>

            <!-- What's Next Section -->
            <div class="mt-8 bg-white rounded-2xl p-6 shadow-sm">
                <div class="text-center">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Wat gebeurt er hierna?</h3>
                    <p class="text-gray-600 text-sm">
                        Na registratie krijg je toegang tot ons platform waar je direct kunt beginnen met het browsen van studentprofielen en het plaatsen van vacatures.
                    </p>
                </div>
            </div>

            <!-- Trust Indicators -->
            <div class="mt-8 grid md:grid-cols-3 gap-4 text-center">
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <div class="text-2xl font-bold text-orange-600 mb-1">150+</div>
                    <div class="text-xs text-gray-600">Actieve bedrijven</div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <div class="text-2xl font-bold text-orange-600 mb-1">1,200+</div>
                    <div class="text-xs text-gray-600">Geregistreerde studenten</div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <div class="text-2xl font-bold text-orange-600 mb-1">89%</div>
                    <div class="text-xs text-gray-600">Succesvolle matches</div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gradient-to-r from-orange-500 to-red-600 text-white py-16">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
              <div>
                <div class="flex items-center space-x-3 mb-4">
                  <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <span class="text-white font-bold text-lg">E</span>
                  </div>
                  <div class="text-white font-bold text-xl">erasmus</div>
                </div>
                <p class="text-orange-100 text-sm mb-4">
                  Hogeschool Brussel<br />
                  Connecting talent with opportunity
                </p>
                <div class="flex space-x-4">
                  <a href="#" class="text-orange-200 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                    </svg>
                  </a>
                  <a href="#" class="text-orange-200 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                  </a>
                </div>
              </div>

              <div>
                <h4 class="font-semibold mb-4">Voor studenten</h4>
                <ul class="space-y-2 text-orange-100 text-sm">
                  <li><Link href="/register?type=student" class="hover:text-white transition-colors">Maak je profiel</Link></li>
                  <li><Link href="/info" class="hover:text-white transition-colors">Career Launch Info</Link></li>
                  <li><Link href="/bedrijven" class="hover:text-white transition-colors">Ontdek bedrijven</Link></li>
                </ul>
              </div>

              <div>
                <h4 class="font-semibold mb-4">Contact</h4>
                <ul class="space-y-2 text-orange-100 text-sm">
                  <li><a href="mailto:gdt.kaai.student@ehb.be" class="hover:text-white transition-colors">gdt.kaai.student@ehb.be</a></li>
                  <li><a href="tel:+3225233737" class="hover:text-white transition-colors">02 523 37 37</a></li>
                  <li>Nijverheidskaai 170, 1070 Anderlecht</li>
                </ul>
              </div>

              <div>
                <h4 class="font-semibold mb-4">Over Ons</h4>
                <ul class="space-y-2 text-orange-100 text-sm">
                  <li><Link href="/wiezijnwe" class="hover:text-white transition-colors">Wie zijn we?</Link></li>
                  <li><Link href="/faq" class="hover:text-white transition-colors">FAQ</Link></li>
                  <li><a href="#" class="hover:text-white transition-colors">Onze opleidingen</a></li>
                  <li><a href="#" class="hover:text-white transition-colors">Privacy beleid</a></li>
                </ul>
              </div>
            </div>

            <div class="border-t border-orange-400 mt-12 pt-8 text-center text-orange-100 text-sm">
              <p>&copy; 2025 Erasmus Hogeschool Brussel. Alle rechten voorbehouden.</p>
            </div>
          </div>
        </footer>
    </div>
</template>