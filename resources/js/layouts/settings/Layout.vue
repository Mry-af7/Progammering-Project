<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

const sidebarNavItems: NavItem[] = [
    {
        title: 'Profiel',
        href: '/settings/profile',
    },
    {
        title: 'Wachtwoord',
        href: '/settings/password',
    },
    {
        title: 'Verschijning',
        href: '/settings/appearance',
    },
];

const page = usePage();

const currentPath = page.props.ziggy?.location ? new URL(page.props.ziggy.location).pathname : '';
</script>

<template>
    <div class="bg-orange-50 px-4 py-6 dark:bg-neutral-800 rounded-b-xl">
        <Heading title="Instellingen" description="Beheer uw profiel en accountinstellingen" />

        <div class="flex flex-col space-y-8 md:space-y-0 lg:flex-row lg:space-x-12 lg:space-y-0">
            <aside class="w-full max-w-xl lg:w-48">
                <nav class="flex flex-col space-x-0 space-y-1">
                    <Button v-for="item in sidebarNavItems" :key="item.href" variant="ghost" 
                    :class="[
                        'w-full justify-start text-left px-4 py-2 rounded-md transition-colors',
                        currentPath === item.href
                            ? 'bg-orange-500 text-white hover:bg-transparent dark:bg-[color:#b25400]'    //Kleur van geselecteerde knop
                            : 'bg-orange-200 text-orange-900 hover:bg-transparent dark:bg-[color:#db6a00]'  //Kleur van niet geselecteerde knop
                    ]">
                        <Link :href="item.href">
                        {{ item.title }}
                        </Link>
                    </Button>
                </nav>
            </aside>

            <Separator class="my-6 md:hidden" />

            <div class="flex-1 md:max-w-2xl">
                <section class="max-w-xl space-y-12">
                    <slot />
                </section>
            </div>
        </div>
    </div>
</template>
