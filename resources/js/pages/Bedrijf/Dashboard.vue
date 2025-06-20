<script setup lang="ts">
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { Heart, Users, Eye, Search, Filter, Building, Mail, Calendar, User } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { ref } from 'vue';

interface Student {
  id: number;
  name: string;
  email: string;
  age: number;
  gender: string;
  field_of_study: string;
  is_favorited: boolean;
  created_at: string;
}

interface Props {
  user: {
    id: number;
    name: string;
    email: string;
    role: string;
    company_name: string;
  };
  studenten: {
    data: Student[];
    links: any[];
    meta: any;
  };
  stats: {
    total_students: number;
    my_favorites: number;
    profile_views: number;
  };
}

const props = defineProps<Props>();

const searchForm = useForm({
  search: '',
  field_of_study: '',
  gender: ''
});

const favoriteForm = useForm({
  favoritable_id: 0,
  favoritable_type: 'App\\Models\\User'
});

const showFilters = ref(false);

const toggleFavorite = (studentId: number) => {
  favoriteForm.favoritable_id = studentId;
  favoriteForm.post('/favorites/toggle', {
    preserveScroll: true,
    onSuccess: () => {
      router.reload({ only: ['studenten'] });
    }
  });
};

const searchStudents = () => {
  searchForm.get('/bedrijf/studenten/search', {
    preserveState: true,
    preserveScroll: true,
  });
};

const logout = () => {
  const form = useForm({});
  form.post('/logout');
};
</script>

<template>
  <div class="min-h-screen bg-gray-50">
    <Head title="Bedrijf Dashboard" />
    
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
            <span class="text-sm text-gray-600">{{ user.company_name }}</span>
            <Button @click="logout" variant="outline" size="sm">Uitloggen</Button>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <!-- Welcome Section -->
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Bedrijf Dashboard</h1>
        <p class="text-gray-600">Ontdek getalenteerde studenten en bouw je team op</p>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-sm">
          <div class="flex items-center">
            <div class="p-2 bg-blue-100 rounded-lg">
              <Users class="h-6 w-6 text-blue-600" />
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Totaal Studenten</p>
              <p class="text-2xl font-bold text-gray-900">{{ stats.total_students }}</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm">
          <div class="flex items-center">
            <div class="p-2 bg-red-100 rounded-lg">
              <Heart class="h-6 w-6 text-red-600" />
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Mijn Favorieten</p>
              <p class="text-2xl font-bold text-gray-900">{{ stats.my_favorites }}</p>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm">
          <div class="flex items-center">
            <div class="p-2 bg-green-100 rounded-lg">
              <Eye class="h-6 w-6 text-green-600" />
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600">Profiel Bekeken</p>
              <p class="text-2xl font-bold text-gray-900">{{ stats.profile_views }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Search and Filters -->
      <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="flex-1">
            <div class="relative">
              <Search class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-5 w-5" />
              <Input
                v-model="searchForm.search"
                placeholder="Zoek studenten op naam, email of studierichting..."
                class="pl-10"
                @keyup.enter="searchStudents"
              />
            </div>
          </div>
          <Button @click="showFilters = !showFilters" variant="outline">
            <Filter class="h-4 w-4 mr-2" />
            Filters
          </Button>
          <Button @click="searchStudents" :disabled="searchForm.processing">
            Zoeken
          </Button>
        </div>

        <!-- Advanced Filters -->
        <div v-show="showFilters" class="mt-4 pt-4 border-t border-gray-200">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Studierichting</label>
              <Input
                v-model="searchForm.field_of_study"
                placeholder="Bijv. Toegepaste Informatica"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Geslacht</label>
              <select
                v-model="searchForm.gender"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
              >
                <option value="">Alle geslachten</option>
                <option value="man">Man</option>
                <option value="vrouw">Vrouw</option>
                <option value="anders">Anders</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <!-- Students Grid -->
      <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200">
          <h2 class="text-xl font-semibold text-gray-900">Studenten Overzicht</h2>
          <p class="text-sm text-gray-600 mt-1">{{ studenten.meta.total }} studenten gevonden</p>
        </div>
        
        <div class="p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div
              v-for="student in studenten.data"
              :key="student.id"
              class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow"
            >
              <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-3">
                  <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <User class="h-6 w-6 text-blue-600" />
                  </div>
                  <div>
                    <h3 class="font-semibold text-gray-900">{{ student.name }}</h3>
                    <p class="text-sm text-gray-600">{{ student.field_of_study }}</p>
                  </div>
                </div>
                <Button
                  @click="toggleFavorite(student.id)"
                  variant="ghost"
                  size="sm"
                  :disabled="favoriteForm.processing"
                >
                  <Heart 
                    class="h-5 w-5" 
                    :class="student.is_favorited ? 'fill-current text-red-600' : 'text-gray-400'"
                  />
                </Button>
              </div>
              
              <div class="space-y-2 text-sm text-gray-600">
                <div class="flex items-center">
                  <Mail class="h-4 w-4 mr-2" />
                  {{ student.email }}
                </div>
                <div class="flex items-center">
                  <Calendar class="h-4 w-4 mr-2" />
                  {{ student.age }} jaar • {{ student.gender }}
                </div>
                <div class="flex items-center">
                  <Users class="h-4 w-4 mr-2" />
                  Lid sinds {{ student.created_at }}
                </div>
              </div>
              
              <div class="mt-4 pt-4 border-t border-gray-200">
                <Button variant="outline" size="sm" class="w-full">
                  Bekijk Profiel
                </Button>
              </div>
            </div>
          </div>

          <!-- Pagination -->
          <div v-if="studenten.links.length > 3" class="mt-8 flex justify-center">
            <nav class="flex space-x-2">
              <Link
                v-for="link in studenten.links"
                :key="link.label"
                :href="link.url"
                :class="[
                  'px-3 py-2 text-sm rounded-lg',
                  link.active 
                    ? 'bg-orange-500 text-white' 
                    : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-300'
                ]"
                v-html="link.label"
              />
            </nav>
          </div>
        </div>
      </div>
    </main>
  </div>
</template> 