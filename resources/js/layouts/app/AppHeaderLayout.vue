<script setup lang="ts">
import AppHeader from '@/components/layouts/AppHeader.vue';
import type { BreadcrumbItem } from '@/types';

interface Props {
    breadcrumbs?: BreadcrumbItem[];
}

const props = withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <div class="min-h-screen bg-background">
        <AppHeader :breadcrumbs="breadcrumbs" />
        <main>
            <slot />
        </main>
    </div>
</template>
