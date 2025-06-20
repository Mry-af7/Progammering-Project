<script setup lang="ts">
import MainNavigation from '@/components/MainNavigation.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import type { BreadcrumbItemType } from '@/types';
import NavFooter from '@/components/NavFooter.vue';
import { usePage } from '@inertiajs/vue3';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

const props = withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage();
const currentPath = page.url;

const getActivePage = () => {
    if (currentPath === '/') return 'home';
    if (currentPath === '/info') return 'info';
    if (currentPath === '/bedrijven') return 'bedrijven';
    if (currentPath === '/favorieten') return 'favorieten';
    if (currentPath === '/contact') return 'contact';
    return '';
};

// FIXED: Added /company/ paths
const shouldShowSidebar = () => {
    return currentPath.startsWith('/dashboard') || 
           currentPath.startsWith('/company') ||  // ✅ This was missing!
           currentPath.startsWith('/profile') ||
           currentPath.startsWith('/jobs') ||
           currentPath.startsWith('/applications') ||
           currentPath.startsWith('/network') ||
           currentPath.startsWith('/settings') ||
           currentPath.startsWith('/help');
};

const favoritenCount = (page.props.favoritenCount as number) || 0;
</script>

<template>
    <div class="min-h-screen">
        <template v-if="shouldShowSidebar()">
            <!-- Dashboard layout with sidebar -->
            <div class="flex h-screen bg-gray-50 dark:bg-gray-900">
                <AppSidebar />
                <main class="flex-1 overflow-y-auto">
                    <slot />
                </main>
            </div>
        </template>
        <template v-else>
            <!-- Public pages with top navigation -->
            <div class="bg-gradient-to-br from-orange-50 via-white to-orange-50">
                <MainNavigation :active-page="getActivePage()" :favoriten-count="favoritenCount" />
                <slot />
            </div>
        </template>
    </div>
</template>