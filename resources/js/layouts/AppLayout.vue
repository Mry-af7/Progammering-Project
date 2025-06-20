<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import NavFooter from '@/components/NavFooter.vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <div class="min-h-screen bg-gray-100">
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
    </div>
</template>
