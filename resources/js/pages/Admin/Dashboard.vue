<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Users, Building, Heart, Activity, Eye, UserCheck, UserX, Search } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';

interface User {
  id: number;
  name: string;
  email: string;
  role: string;
  is_active: boolean;
  created_at: string;
  company_name?: string;
  field_of_study?: string;
}

interface Favorite {
  id: number;
  user: User;
  favoritable: User;
  created_at: string;
}

interface Props {
  stats: {
    total_users: number;
    total_students: number;
    total_bedrijven: number;
    total_favorites: number;
  };
  recent_users: User[];
  recent_favorites: Favorite[];
}

const props = defineProps<Props>();

const logout = () => {
  const form = useForm({});
  form.post('/logout');
};

const toggleUserStatus = (userId: number) => {
  const form = useForm({});
  form.patch(`/admin/users/${userId}/toggle-status`, {}, {
    preserveScroll: true,
  });
};
</script>

<template>
  <div class="min-h-screen bg-gray-50">
    <Head title="Admin Dashboard" />
    
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
            <span class="text-sm text-gray-600 bg-purple-100 px-3 py-1 rounded-full font-medium">Admin</span>
            <Button @click="logout" variant="outline" size="sm">Uitloggen</Button>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <!-- Welcome Section -->
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Admin Dashboard</h1>
        <p class="text-gray-600">Platform overzicht en gebruikersbeheer</p>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-sm">
          <div class="flex items-center">
            <div class="p-2 bg-blue-100 rounded-lg">
              <Users class="h-6 w-6 text-blue-600" />
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Totaal Gebruikers</p>
              <p class="text-2xl font-bold text-gray-900">{{ stats.total_users }}</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm">
          <div class="flex items-center">
            <div class="p-2 bg-green-100 rounded-lg">
              <UserCheck class="h-6 w-6 text-green-600" />
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Studenten</p>
              <p class="text-2xl font-bold text-gray-900">{{ stats.total_students }}</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm">
          <div class="flex items-center">
            <div class="p-2 bg-orange-100 rounded-lg">
              <Building class="h-6 w-6 text-orange-600" />
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Bedrijven</p>
              <p class="text-2xl font-bold text-gray-900">{{ stats.total_bedrijven }}</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm">
          <div class="flex items-center">
            <div class="p-2 bg-red-100 rounded-lg">
              <Heart class="h-6 w-6 text-red-600" />
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Totaal Favorieten</p>
              <p class="text-2xl font-bold text-gray-900">{{ stats.total_favorites }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="mb-8 bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Snelle Acties</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <Link href="/admin/users" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
            <Users class="h-8 w-8 text-blue-600 mr-3" />
            <div>
              <h3 class="font-medium text-gray-900">Gebruikers Beheren</h3>
              <p class="text-sm text-gray-600">Bekijk en beheer alle gebruikers</p>
            </div>
          </Link>
          
          <Link href="/admin/reports" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
            <Activity class="h-8 w-8 text-green-600 mr-3" />
            <div>
              <h3 class="font-medium text-gray-900">Rapporten</h3>
              <p class="text-sm text-gray-600">Platform statistieken</p>
            </div>
          </Link>
          
          <Link href="/admin/settings" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
            <Eye class="h-8 w-8 text-purple-600 mr-3" />
            <div>
              <h3 class="font-medium text-gray-900">Instellingen</h3>
              <p class="text-sm text-gray-600">Platform configuratie</p>
            </div>
          </Link>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Users -->
        <div class="bg-white rounded-xl shadow-sm">
          <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
              <Users class="h-5 w-5 mr-2 text-gray-600" />
              Recente Gebruikers
            </h2>
          </div>
          <div class="p-6">
            <div class="space-y-4">
              <div v-for="user in recent_users" :key="user.id" class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                <div class="flex items-center space-x-3">
                  <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <Users v-if="user.role === 'student'" class="h-5 w-5 text-blue-600" />
                    <Building v-else-if="user.role === 'bedrijf'" class="h-5 w-5 text-orange-600" />
                    <UserCheck v-else class="h-5 w-5 text-purple-600" />
                  </div>
                  <div>
                    <h3 class="font-medium text-gray-900">{{ user.name }}</h3>
                    <p class="text-sm text-gray-600">
                      {{ user.role === 'student' ? user.field_of_study : user.company_name || user.email }}
                    </p>
                    <p class="text-xs text-gray-500">{{ user.created_at }}</p>
                  </div>
                </div>
                <div class="flex items-center space-x-2">
                  <span 
                    :class="[
                      'px-2 py-1 rounded-full text-xs font-medium',
                      user.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                    ]"
                  >
                    {{ user.is_active ? 'Actief' : 'Inactief' }}
                  </span>
                  <Button
                    @click="toggleUserStatus(user.id)"
                    :variant="user.is_active ? 'destructive' : 'default'"
                    size="sm"
                  >
                    <UserX v-if="user.is_active" class="h-4 w-4" />
                    <UserCheck v-else class="h-4 w-4" />
                  </Button>
                </div>
              </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
              <Link href="/admin/users" class="text-sm text-orange-600 hover:text-orange-700 font-medium">
                Alle gebruikers bekijken →
              </Link>
            </div>
          </div>
        </div>

        <!-- Recent Favorites -->
        <div class="bg-white rounded-xl shadow-sm">
          <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
              <Heart class="h-5 w-5 mr-2 text-red-600" />
              Recente Favorieten
            </h2>
          </div>
          <div class="p-6">
            <div v-if="recent_favorites.length === 0" class="text-center py-8">
              <Heart class="h-12 w-12 text-gray-300 mx-auto mb-4" />
              <p class="text-gray-500">Nog geen favorieten</p>
            </div>
            <div v-else class="space-y-4">
              <div v-for="favorite in recent_favorites" :key="favorite.id" class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                <div class="flex items-center space-x-3">
                  <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <Heart class="h-5 w-5 text-red-600" />
                  </div>
                  <div>
                    <h3 class="font-medium text-gray-900">{{ favorite.user.name }}</h3>
                    <p class="text-sm text-gray-600">
                      favoriete {{ favorite.favoritable.name }}
                    </p>
                    <p class="text-xs text-gray-500">{{ favorite.created_at }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template> 