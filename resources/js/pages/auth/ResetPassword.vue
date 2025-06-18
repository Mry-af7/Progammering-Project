<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
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
    form.post('/reset-password', {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <AppLayout>
        <Head title="Wachtwoord herstellen - Career Launch 2025" />

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
    </AppLayout>
</template>
