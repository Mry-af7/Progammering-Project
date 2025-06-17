<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { ref } from 'vue';

interface Props {
    token: string;
    email: string;
}

const props = defineProps<Props>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};

const mobileMenuOpen = ref(false)

</script>

<template>
    <div class="min-h-screen bg-orange-50">
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
                        <button @click="mobileMenuOpen = !mobileMenuOpen"
                            class="p-2 rounded-lg text-gray-700 hover:bg-orange-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Desktop Navigation Links -->
                    <div class="hidden md:flex items-center space-x-1">
                        <Link href="/"
                            class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">
                        Home</Link>
                        <Link href="/info"
                            class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Info
                        </Link>
                        <Link href="/favorieten"
                            class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">
                        Favorieten
                        </Link>
                        <Link href="/contact"
                            class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Contact
                        </Link>

                        <div class="flex items-center ml-6">
                            <Link href="/login"
                                class="px-6 py-2 text-orange-600 hover:text-orange-700 font-medium transition-colors">
                            Inloggen</Link>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu -->
                <div v-show="mobileMenuOpen" class="md:hidden mt-4 pb-4 border-t border-orange-200">
                    <div class="flex flex-col space-y-2 pt-4">
                        <Link href="/" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Home</Link>
                        <Link href="/students" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Student
                        Profiles</Link>
                        <Link href="/bedrijven" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Voor
                        Bedrijven</Link>
                        <Link href="/events" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Speeddate
                        Events</Link>
                        <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Contact
                        </Link>
                        <Link href="/login" class="px-4 py-2 text-orange-600 hover:text-orange-700 font-medium">Inloggen
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <Head title="Wachtwoord herstellen" />

        <main class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-8 py-6 text-center">
                    <h1 class="text-2xl lg:text-3xl font-bold text-white mb-2">
                        Wachtwoord herstellen
                    </h1>
                    <p class="text-orange-100">Voer hieronder uw nieuwe wachtwoord in</p>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <form @submit.prevent="submit">
                        <div class="grid gap-6">
                            <div class="grid gap-2">
                                <Label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</Label>
                                <Input id="email" type="email" name="email" autocomplete="email" v-model="form.email"
                                    class="mt-1 block w-full" readonly />
                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="password"
                                    class="block text-sm font-semibold text-gray-700 mb-2">Wachtwoord</Label>
                                <Input id="password" type="password" name="password" autocomplete="new-password"
                                    v-model="form.password" class="mt-1 block w-full" autofocus
                                    placeholder="Wachtwoord" />
                                <InputError :message="form.errors.password" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="password_confirmation"
                                    class="block text-sm font-semibold text-gray-700 mb-2">
                                    Bevestig wachtwoord </Label>
                                <Input id="password_confirmation" type="password" name="password_confirmation"
                                    autocomplete="new-password" v-model="form.password_confirmation"
                                    class="mt-1 block w-full" placeholder="Bevestig wachtwoord" />
                                <InputError :message="form.errors.password_confirmation" />
                            </div>

                            <Button type="submit"
                                class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-semibold py-4 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl"
                                :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-5 w-5 animate-spin mr-2" />
                                Herstel wachtwoord
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</template>
