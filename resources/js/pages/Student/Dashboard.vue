<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Heart, Users, Eye, Send, Building, Mail, Calendar } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';

interface User {
  id: number;
  name: string;
  email: string;
  role: string;
  company_name?: string;
}

interface Props {
  user: User;
  favorites: User[];
  recentBedrijven: User[];
  stats: {
    total_favorites: number;
    profile_views: number;
    applications_sent: number;
  };
}

const props = defineProps<Props>();

const favoriteForm = useForm({
  favoritable_id: 0,
  favoritable_type: 'App\\Models\\User'
});

const toggleFavorite = (bedrijfId: number) => {
  favoriteForm.favoritable_id = bedrijfId;
  favoriteForm.post('/favorites/toggle', {
    preserveScroll: true,
    onSuccess: () => {
      // Refresh page data
    }
  });
};

const logout = () => {
  const form = useForm({});
  form.post('/logout');
};
</script>

<template>
  <div class="min-h-screen bg-gray-50">
    <Head title="Student Dashboard" />
    
    <!-- Header -->
    <header class="bg-white shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <div class="flex items-center space-x-4">
            <Link href="/" class="flex items-center space-x-3">
              <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold">E</span>
              </div>
              <span class="font-bold text-gray-900">Erasmus Platform</span>
            </Link>
          </div>
          
          <div class="flex items-center space-x-4">
            <span class="text-sm text-gray-600">Welkom, {{ user.name }}</span>
            <Button @click="logout" variant="outline" size="sm">Uitloggen</Button>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <!-- Welcome Section -->
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Student Dashboard</h1>
        <p class="text-gray-600">Beheer je profiel, bekijk bedrijven en bouw je netwerk op</p>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-sm">
          <div class="flex items-center">
            <div class="p-2 bg-red-100 rounded-lg">
              <Heart class="h-6 w-6 text-red-600" />
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Favorieten</p>
              <p class="text-2xl font-bold text-gray-900">{{ stats.total_favorites }}</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm">
          <div class="flex items-center">
            <div class="p-2 bg-blue-100 rounded-lg">
              <Eye class="h-6 w-6 text-blue-600" />
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Profiel Bekeken</p>
              <p class="text-2xl font-bold text-gray-900">{{ stats.profile_views }}</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm">
          <div class="flex items-center">
            <div class="p-2 bg-green-100 rounded-lg">
              <Send class="h-6 w-6 text-green-600" />
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Sollicitaties</p>
              <p class="text-2xl font-bold text-gray-900">{{ stats.applications_sent }}</p>
            </div>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Bedrijven -->
        <div class="bg-white rounded-xl shadow-sm">
          <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
              <Building class="h-5 w-5 mr-2 text-gray-600" />
              Recente Bedrijven
            </h2>
          </div>
          <div class="p-6">
            <div class="space-y-4">
              <div v-for="bedrijf in recentBedrijven" :key="bedrijf.id" class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="flex items-center space-x-3">
                  <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <Building class="h-5 w-5 text-orange-600" />
                  </div>
                  <div>
                    <h3 class="font-medium text-gray-900">{{ bedrijf.company_name || bedrijf.name }}</h3>
                    <p class="text-sm text-gray-600 flex items-center">
                      <Mail class="h-4 w-4 mr-1" />
                      {{ bedrijf.email }}
                    </p>
                  </div>
                </div>
                <Button 
                  @click="toggleFavorite(bedrijf.id)" 
                  variant="outline" 
                  size="sm"
                  :disabled="favoriteForm.processing"
                >
                  <Heart class="h-4 w-4" />
                </Button>
              </div>
            </div>
          </div>
        </div>

        <!-- Mijn Favorieten -->
        <div class="bg-white rounded-xl shadow-sm">
          <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
              <Heart class="h-5 w-5 mr-2 text-red-600" />
              Mijn Favorieten
            </h2>
          </div>
          <div class="p-6">
            <div v-if="favorites.length === 0" class="text-center py-8">
              <Heart class="h-12 w-12 text-gray-300 mx-auto mb-4" />
              <p class="text-gray-500">Nog geen favorieten toegevoegd</p>
              <p class="text-sm text-gray-400">Begin met browsen door bedrijven</p>
            </div>
            <div v-else class="space-y-4">
              <div v-for="favorite in favorites" :key="favorite.id" class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                <div class="flex items-center space-x-3">
                  <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <Building class="h-5 w-5 text-red-600" />
                  </div>
                  <div>
                    <h3 class="font-medium text-gray-900">{{ favorite.company_name || favorite.name }}</h3>
                    <p class="text-sm text-gray-600">{{ favorite.email }}</p>
                  </div>
                </div>
                <Button 
                  @click="toggleFavorite(favorite.id)" 
                  variant="outline" 
                  size="sm"
                  :disabled="favoriteForm.processing"
                >
                  <Heart class="h-4 w-4 fill-current text-red-600" />
                </Button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="mt-8 bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Snelle Acties</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <Link href="/profile/edit" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
            <Users class="h-8 w-8 text-blue-600 mr-3" />
            <div>
              <h3 class="font-medium text-gray-900">Profiel Bijwerken</h3>
              <p class="text-sm text-gray-600">Update je gegevens en CV</p>
            </div>
          </Link>
          
          <Link href="/bedrijven" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
            <Building class="h-8 w-8 text-green-600 mr-3" />
            <div>
              <h3 class="font-medium text-gray-900">Bedrijven Verkennen</h3>
              <p class="text-sm text-gray-600">Ontdek nieuwe kansen</p>
            </div>
          </Link>
          
          <Link href="/events" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
            <Calendar class="h-8 w-8 text-purple-600 mr-3" />
            <div>
              <h3 class="font-medium text-gray-900">Events & Networking</h3>
              <p class="text-sm text-gray-600">Aankomende evenementen</p>
            </div>
          </Link>
        </div>
      </div>
    </main>
  </div>
</template> 