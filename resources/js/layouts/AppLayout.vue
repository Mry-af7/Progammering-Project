<script setup lang="ts">
import MainNavigation from '@/components/MainNavigation.vue';
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

// Bepaal de actieve pagina op basis van het pad
const getActivePage = () => {
    if (currentPath === '/') return 'home';
    if (currentPath === '/info') return 'info';
    if (currentPath === '/bedrijven') return 'bedrijven';
    if (currentPath === '/favorieten') return 'favorieten';
    if (currentPath === '/contact') return 'contact';
    return '';
};

// Haal het aantal favorieten op uit de pagina props
const favoritenCount = (page.props.favoritenCount as number) || 0;
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-orange-50">
        <MainNavigation :active-page="getActivePage()" :favoriten-count="favoritenCount" />
        <slot />
        <NavFooter />
    </div>
</template>
