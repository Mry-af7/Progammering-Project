<script setup lang="ts">
import { usePage, useForm } from '@inertiajs/vue3';
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
import { route } from '@/lib/ziggy';

const mobileMenuOpen = ref(false);
const roleType = usePage().url.includes('type=bedrijf') ? 'bedrijf' : 'student';

const navItems = [
  { label: 'Home', href: '/' },
  { label: 'Info', href: '/info' },
  { label: 'Bedrijven', href: '/bedrijven' },
  { label: 'Afspraak', href: '/afspraak' },
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
    <div class="min-h-screen bg-orange-50">
        <Head title="Register" />
        
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-2xl lg:text-3xl font-bold text-white mb-2">
                        Inschrijving
                    </h1>
                    <p class="text-orange-100">
                        {{ roleType === 'bedrijf' ? 'Ontdek getalenteerde studenten voor jouw bedrijf' : 'Start je carrière en laat bedrijven jou ontdekken' }}
                    </p>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <!-- Benefits Section for Students -->
                    <div v-if="roleType === 'student'" class="bg-gradient-to-r from-orange-50 to-red-50 rounded-2xl p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Waarom registreren als student?
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-600">
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span>Laat bedrijven jou vinden</span>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span>Toegang tot exclusieve stage-aanbiedingen</span>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span>Deelnemen aan speeddate events</span>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span>Altijd gratis voor studenten</span>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Form -->
                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Name Fields -->
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <Label for="firstname" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Voornaam
                                </Label>
                                <Input 
                                    id="firstname" 
                                    type="text" 
                                    required 
                                    :tabindex="1" 
                                    v-model="form.firstname" 
                                    placeholder="Voornaam"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                                />
                                <InputError :message="form.errors.firstname" class="mt-2" />
                            </div>

                            <div>
                                <Label for="lastname" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Achternaam
                                </Label>
                                <Input 
                                    id="lastname" 
                                    type="text" 
                                    required 
                                    :tabindex="2" 
                                    v-model="form.lastname" 
                                    placeholder="Achternaam"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                                />
                                <InputError :message="form.errors.lastname" class="mt-2" />
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div>
                            <Label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email address
                            </Label>
                            <Input 
                                id="email" 
                                type="email" 
                                required 
                                :tabindex="3" 
                                autocomplete="email" 
                                v-model="form.email" 
                                placeholder="email@example.com"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                            />
                            <InputError :message="form.errors.email" class="mt-2" />
                        </div>

                        <!-- Age and Gender Fields -->
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <Label for="age" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Leeftijd
                                </Label>
                                <Input 
                                    id="age" 
                                    type="number" 
                                    min="0" 
                                    required 
                                    :tabindex="4" 
                                    v-model="form.age" 
                                    placeholder="Leeftijd"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                                />
                                <InputError :message="form.errors.age" class="mt-2" />
                            </div>

                            <div>
                                <Label for="gender" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Geslacht
                                </Label>
                                <select
                                    id="gender"
                                    v-model="form.gender"
                                    required
                                    :tabindex="5"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all bg-white"
                                >
                                    <option value="" disabled selected>Kies geslacht</option>
                                    <option value="man">Man</option>
                                    <option value="vrouw">Vrouw</option>
                                    <option value="anders">Anders</option>
                                </select>
                                <InputError :message="form.errors.gender" class="mt-2" />
                            </div>
                        </div>

                        <!-- Study Field -->
                        <div>
                            <Label for="field_of_study" class="block text-sm font-semibold text-gray-700 mb-2">
                                Studierichting
                            </Label>
                            <Input
                                id="field_of_study"
                                type="text"
                                required
                                :tabindex="6"
                                v-model="form.field_of_study"
                                placeholder="Bijv. Toegepaste informatica"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                            />
                            <InputError :message="form.errors.field_of_study" class="mt-2" />
                        </div>

                        <!-- CV Upload -->
                        <div>
                            <Label for="cv" class="block text-sm font-semibold text-gray-700 mb-2">
                                Upload je CV
                            </Label>
                            <div class="relative">
                                <input
                                    id="cv"
                                    type="file"
                                    accept=".pdf,.doc,.docx"
                                    @change="handleFileChange"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all bg-white file:bg-orange-100 file:border-none file:px-4 file:py-2 file:mr-4 file:rounded-lg file:text-orange-700 file:font-medium hover:file:bg-orange-200"
                                    :tabindex="7"
                                />
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Ondersteunde formaten: PDF, DOC, DOCX</p>
                            <InputError :message="form.errors.cv" class="mt-2" />
                        </div>

                        <!-- Company Name (for bedrijf role) -->
                        <div v-if="roleType === 'bedrijf'">
                            <Label for="company_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Bedrijfsnaam
                            </Label>
                            <Input
                                v-model="form.company_name"
                                id="company_name"
                                type="text"
                                :tabindex="8"
                                placeholder="Naam van je bedrijf"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                            />
                            <InputError :message="form.errors.company_name" class="mt-2" />
                        </div>

                        <!-- Password Fields -->
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <Label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Password
                                </Label>
                                <Input
                                    id="password"
                                    type="password"
                                    required
                                    :tabindex="9"
                                    autocomplete="new-password"
                                    v-model="form.password"
                                    placeholder="Password"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                                />
                                <InputError :message="form.errors.password" class="mt-2" />
                            </div>

                            <div>
                                <Label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Confirm password
                                </Label>
                                <Input
                                    id="password_confirmation"
                                    type="password"
                                    required
                                    :tabindex="10"
                                    autocomplete="new-password"
                                    v-model="form.password_confirmation"
                                    placeholder="Confirm password"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                                />
                                <InputError :message="form.errors.password_confirmation" class="mt-2" />
                            </div>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="text-right">
                            <TextLink 
                                :href="route('password.request')" 
                                class="text-sm text-orange-600 hover:text-orange-700 font-medium" 
                                :tabindex="11"
                            >
                                Wachtwoord vergeten?
                            </TextLink>
                        </div>

                        <!-- Submit Button -->
                        <Button
                            type="submit"
                            class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-semibold py-4 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl"
                            :tabindex="12"
                            :disabled="form.processing"
                        >
                            <LoaderCircle v-if="form.processing" class="h-5 w-5 animate-spin mr-2" />
                            <svg v-else class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Maak profiel aan
                        </Button>

                        <!-- Login Link -->
                        <div class="text-center pt-4 border-t border-gray-100">
                            <span class="text-sm text-gray-600">Heb je al een account? </span>
                            <TextLink
                                :href="route('login')"
                                class="text-orange-600 hover:text-orange-700 font-semibold"
                                :tabindex="13"
                            >
                                Log in
                            </TextLink>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Progress Steps -->
            <div class="mt-8 bg-white rounded-2xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 text-center">Na registratie</h3>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="text-center">
                        <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <span class="text-orange-600 font-bold">1</span>
                        </div>
                        <h4 class="font-medium text-gray-900 mb-1">Profiel validatie</h4>
                        <p class="text-xs text-gray-600">We controleren je gegevens</p>
                    </div>
                    <div class="text-center">
                        <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <span class="text-orange-600 font-bold">2</span>
                        </div>
                        <h4 class="font-medium text-gray-900 mb-1">Profiel live</h4>
                        <p class="text-xs text-gray-600">Bedrijven kunnen je vinden</p>
                    </div>
                    <div class="text-center">
                        <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <span class="text-orange-600 font-bold">3</span>
                        </div>
                        <h4 class="font-medium text-gray-900 mb-1">Matches ontvangen</h4>
                        <p class="text-xs text-gray-600">Begin met netwerken</p>
                    </div>
                </div>
            </div>

            <!-- Trust Indicators -->
            <div class="mt-8 grid grid-cols-3 gap-4 text-center">
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <div class="text-2xl font-bold text-orange-600 mb-1">247</div>
                    <div class="text-xs text-gray-600">Studenten deze maand</div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <div class="text-2xl font-bold text-orange-600 mb-1">150+</div>
                    <div class="text-xs text-gray-600">Partner bedrijven</div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <div class="text-2xl font-bold text-orange-600 mb-1">89%</div>
                    <div class="text-xs text-gray-600">Vindt stage binnen 2 maanden</div>
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
                  <li><Link href="/Wiezijnwe" class="hover:text-white transition-colors">Wie zijn we?</Link></li>
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