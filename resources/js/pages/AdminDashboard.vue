<template>
    <Head title="Admin Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mb-8">
            <div class="bg-gradient-to-r from-gray-800 via-gray-600 to-gray-400 rounded-3xl p-8 text-white relative overflow-hidden mb-6">
                <div class="relative z-10 flex justify-between items-center">
                    <div>
                        <h1 class="text-5xl font-bold mb-3">Welkom, Admin!</h1>
                        <p class="text-xl text-gray-100 mb-4">Beheer het platform en gebruikers</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-semibold mb-4">Gebruikersbeheer</h2>
                <ul>
                    <li><Link href="/admin/users">Alle gebruikers</Link></li>
                    <li><Link href="/admin/companies">Bedrijven</Link></li>
                    <li><Link href="/admin/students">Studenten</Link></li>
                </ul>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-semibold mb-4">Instellingen</h2>
                <ul>
                    <li><Link href="/admin/settings">Platform instellingen</Link></li>
                    <li><Link href="/admin/logs">Logboek</Link></li>
                </ul>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                <h2 class="text-lg font-semibold mb-4">Statistieken</h2>
                <ul>
                    <li><Link href="/admin/statistics">Overzicht</Link></li>
                </ul>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

const breadcrumbs = [{ title: 'Admin Dashboard', href: '/admin/dashboard' }]
</script> 