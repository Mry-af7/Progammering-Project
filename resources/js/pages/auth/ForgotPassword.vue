<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { ref } from 'vue'

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post('/forgot-password');
};
</script>

<template>
    <AppLayout>
        <Head title="Wachtwoord vergeten - Career Launch 2025" />
        
        <main class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Login Card -->
            <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-8 py-6 text-center">
                    <h1 class="text-2xl lg:text-3xl font-bold text-white mb-2">
                        Wachtwoord vergeten?
                    </h1>
                    <p class="text-orange-100">Vul je e-mailadres in om een verificatiecode te ontvangen</p>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <!-- Login Form -->
                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Email Field -->
                        <div>
                            <Label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                E-mailadres
                            </Label>
                            <Input id="email" type="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                                required autofocus :tabindex="1" autocomplete="email" v-model="form.email"
                                placeholder="email@example.com" />
                            <InputError :message="form.errors.email" class="mt-2" />
                        </div>

                        <div v-if="status" class="mb-4 text-center text-sm font-medium text-orange-600">
                            {{ status }}
                        </div>

                        <!-- Submit Button -->
                        <Button type="submit"
                            class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-semibold py-4 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl"
                            :tabindex="4" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-5 w-5 animate-spin mr-2" />
                            <svg v-else class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Stuur resetlink
                        </Button>

                        <!-- Sign Up Link -->
                        <div class="text-center pt-4 border-t border-gray-100">
                            <span>Of, ga terug naar </span>
                            <TextLink href="/login" class="!text-black">log in</TextLink>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </AppLayout>
</template>
