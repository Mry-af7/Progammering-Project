<script setup lang="ts">
import AppContent from '@/components/layouts/AppContent.vue';
import AppSidebar from '@/components/layouts/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import AppShell from '@/components/AppShell.vue';
import type { BreadcrumbItemType } from '@/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppShell class="flex-col">
        <AppSidebarHeader />
        <AppSidebar />
        <AppContent>
            <slot />
        </AppContent>
    </AppShell>
</template>
