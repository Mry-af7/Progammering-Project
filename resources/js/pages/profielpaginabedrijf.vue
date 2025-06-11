<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const form = useForm<{
  name: string;
  surname: string;
  email: string;
  company_name: string;
  sector: string;
  description: string;
  location: string;
  website: string;
  logo: File | null;
}>({
  name: '',
  surname: '',
  email: '',
  company_name: '',
  sector: '',
  description: '',
  location: '',
  website: '',
  logo: null,
});


const submit = () => {
  form.post(route('company.profile.update'), {
    forceFormData: true, // nodig voor file upload
    onFinish: () => console.log('Profiel bijgewerkt'),
  });
};

</script>

<template>
  <div class="max-w-4xl mx-auto p-6 space-y-8">
    <h1 class="text-2xl font-bold">Profiel</h1>

    <!-- Gegevens -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <Label for="company_name">Bedrijfsnaam</Label>
        <Input id="company_name" v-model="form.company_name" />
        <InputError :message="form.errors.company_name" />
      </div>

      <div>
        <Label for="sector">Sector</Label>
        <Input id="sector" v-model="form.sector" />
        <InputError :message="form.errors.sector" />
      </div>

      <div>
        <Label for="location">Locatie</Label>
        <Input id="location" v-model="form.location" />
        <InputError :message="form.errors.location" />
      </div>

      <div>
        <Label for="website">Website</Label>
        <Input id="website" v-model="form.website" />
        <InputError :message="form.errors.website" />
      </div>

      <div class="md:col-span-2">
        <Label for="description">Beschrijving</Label>
        <textarea id="description" v-model="form.description" class="w-full p-2 border rounded-md" rows="4" />
        <InputError :message="form.errors.description" />
      </div>

      <div class="md:col-span-2">
        <Label for="logo">Bedrijfslogo</Label>
        <input
            type="file"
            id="logo"
            @change="(e: Event) => form.logo = (e.target as HTMLInputElement).files?.[0]|| null"/>
        <InputError :message="form.errors.logo" />
      </div>
    </div>

    <Button @click="submit">Opslaan</Button>
  </div>
</template>
