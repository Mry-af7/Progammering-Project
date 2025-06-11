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
            <div class="bg-orange-50 space-y-6">
                <HeadingSmall title="Verschijningsinstellingen" description="De weergave-instellingen van je account bijwerken" />
                <AppearanceTabs />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
