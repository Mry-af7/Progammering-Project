<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import AppearanceTabs from '@/components/AppearanceTabs.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { type BreadcrumbItem } from '@/types';

import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Verschijningsinstellingen',
        href: '/settings/appearance',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Verschijningsinstellingen" />

        <SettingsLayout>
            <div class="space-y-6 h-screen">
                <HeadingSmall title="Verschijningsinstellingen" description="De weergave-instellingen van je account bijwerken" class="dark:text-orange-500 p-2 dark:bg-neutral-700 dark:rounded-xl"/>
                <AppearanceTabs />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
