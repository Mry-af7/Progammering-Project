<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
</script>

<template>
    <AppLayout>
        <Head title="Info - Career Launch 2025" />
        
        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-4 py-2 bg-orange-100 rounded-full text-orange-700 text-sm font-medium mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Career Launch 2025
                </div>
                <h1 class="text-5xl lg:text-6xl font-bold bg-gradient-to-r from-gray-900 via-orange-600 to-red-600 bg-clip-text text-transparent mb-6">
                    Alles wat je moet weten
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Ontdek hoe Career Launch 2025 jouw carrière naar het volgende niveau tilt. 
                    Van registratie tot het evenement zelf - we hebben alle informatie die je nodig hebt.
                </p>
            </div>
        </section>

        <!-- Content Sections -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- What is Career Launch -->
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">Wat is Career Launch?</h2>
                            <p class="text-gray-600">Het grootste carrière-evenement van het jaar</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <p class="text-gray-700 leading-relaxed">
                            Career Launch is het jaarlijkse carrière-evenement van Erasmus Hogeschool Brussel waar studenten en bedrijven elkaar ontmoeten. 
                            Het is dé plek om jezelf te presenteren, netwerken te bouwen en je droomjob te vinden.
                        </p>
                        
                        <div class="bg-orange-50 rounded-2xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Wat kun je verwachten?</h3>
                            <ul class="space-y-2 text-gray-700">
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Speeddate sessies met bedrijven
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Workshops en presentaties
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Directe sollicitaties
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Netwerkborrel
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- How to Participate -->
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">Hoe deel te nemen?</h2>
                            <p class="text-gray-600">Stap voor stap gids</p>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">1</div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Maak je profiel</h3>
                                <p class="text-gray-700">Registreer je op het platform en bouw een compleet profiel met je skills, projecten en ambities.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">2</div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Bekijk bedrijven</h3>
                                <p class="text-gray-700">Verken de deelnemende bedrijven en voeg interessante bedrijven toe aan je favorieten.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">3</div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Plan je sessies</h3>
                                <p class="text-gray-700">Reserveer speeddate sessies met bedrijven die je interesseren.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">4</div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Bezoek het evenement</h3>
                                <p class="text-gray-700">Kom naar Career Launch en maak indruk tijdens je speeddate sessies!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="bg-gradient-to-r from-orange-500 via-red-500 to-pink-500 rounded-3xl p-8 text-white text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
                <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-white/5 rounded-full"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-center mb-6">
                        <div class="w-20 h-20 bg-white/20 rounded-3xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-4xl font-bold mb-4">Klaar om te starten?</h3>
                    <p class="text-white/90 mb-8 max-w-2xl mx-auto text-lg">
                        Maak je profiel aan en begin met het ontdekken van bedrijven die bij jou passen!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link href="/register?type=student" class="inline-flex items-center bg-white text-orange-600 px-8 py-4 rounded-2xl font-semibold text-lg hover:bg-orange-50 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Maak je profiel
                        </Link>
                        <Link href="/bedrijven" class="inline-flex items-center bg-white/10 text-white border-2 border-white/20 px-8 py-4 rounded-2xl font-semibold text-lg hover:bg-white/20 transition-all duration-300 backdrop-blur-sm">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Bekijk bedrijven
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>