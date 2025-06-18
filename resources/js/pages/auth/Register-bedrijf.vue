<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
import { Search, User } from 'lucide-vue-next';
import { ref } from 'vue';

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
  form.post('/register/bedrijf', {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
    <AppLayout>
        <Head title="Register Bedrijf - Career Launch 2025" />
        
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

                        <!-- Industry Field -->
                        <div>
                            <Label for="industry" class="block text-sm font-semibold text-gray-700 mb-2">
                                Industrie
                            </Label>
                            <select
                                id="industry"
                                v-model="form.industry"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                            >
                                <option value="">Selecteer industrie</option>
                                <option value="IT">IT & Software</option>
                                <option value="Finance">Finance & Banking</option>
                                <option value="Marketing">Marketing & Communicatie</option>
                                <option value="Consulting">Consulting</option>
                                <option value="Healthcare">Healthcare</option>
                                <option value="Education">Onderwijs</option>
                                <option value="Retail">Retail & E-commerce</option>
                                <option value="Manufacturing">Manufacturing</option>
                                <option value="Other">Andere</option>
                            </select>
                            <InputError :message="form.errors.industry" class="mt-2" />
                        </div>

                        <!-- Location Field -->
                        <div>
                            <Label for="location" class="block text-sm font-semibold text-gray-700 mb-2">
                                Locatie
                            </Label>
                            <Input
                                id="location"
                                v-model="form.location"
                                type="text"
                                required
                                placeholder="Bijv. Brussel, België"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                            />
                            <InputError :message="form.errors.location" class="mt-2" />
                        </div>

                        <!-- Description Field -->
                        <div>
                            <Label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                Bedrijfsbeschrijving
                            </Label>
                            <textarea
                                id="description"
                                v-model="form.description"
                                rows="4"
                                placeholder="Vertel kort over je bedrijf en wat voor soort talent je zoekt..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all resize-none"
                            ></textarea>
                            <InputError :message="form.errors.description" class="mt-2" />
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
                            Registreer bedrijf
                        </Button>

                        <!-- Login Link -->
                        <div class="text-center pt-4 border-t border-gray-100">
                            <span>Heb je al een account? </span>
                            <TextLink href="/login" class="!text-black">Log in</TextLink>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </AppLayout>
</template>