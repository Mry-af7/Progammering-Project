<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { 
    LayoutGrid, 
    User, 
    Briefcase, 
    FileText, 
    Users, 
    Award, 
    MessageSquare,
    Search,
    BookmarkPlus,
    TrendingUp,
    BookOpen,
    Folder,
    Home,
    Building2,
    Heart,
    Settings
} from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { router } from '@inertiajs/vue3';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: Home
    },
    {
        title: 'My Profile',
        href: '/profile/edit',
        icon: User
    },
    {
        title: 'Browse Jobs',
        href: '/jobs',
        icon: Search
    },
    {
        title: 'Companies',
        href: '/companies',
        icon: Building2
    },
    {
        title: 'Applications',
        href: '/applications',
        icon: FileText
    },
    {
        title: 'Favorites',
        href: '/favorieten',
        icon: Heart
    },
    {
        title: 'Network',
        href: '/network',
        icon: Users
    }
];

const footerNavItems: NavItem[] = [
    {
        title: 'Settings',
        href: '/settings',
        icon: Settings
    },
    {
        title: 'Help',
        href: '/help',
        icon: BookOpen
    }
];

const handleNavigation = (item: NavItem) => {
    if (item.href) {
        router.visit(item.href);
    }
};
</script>

<template>
    <Sidebar collapsible="icon" variant="inset" 
             class="bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700">
        


        <!-- Simple Logo -->
        <SidebarHeader class="p-6">
            <div class="flex justify-center">
                <AppLogo class="w-8 h-8 text-gray-900 dark:text-white" />
            </div>
        </SidebarHeader>

        <!-- Simple Content -->
        <SidebarContent class="p-4">
            <!-- Main Navigation -->
            <div class="mb-8">
                <SidebarMenu class="space-y-1">
                    <SidebarMenuItem v-for="item in mainNavItems" :key="item.title">
                        <SidebarMenuButton 
                            @click="handleNavigation(item)"
                            class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200 group cursor-pointer">
                            
                            <component :is="item.icon" 
                                      class="w-5 h-5 text-gray-600 dark:text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-200" />
                            
                            <span class="font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition-colors duration-200">
                                {{ item.title }}
                            </span>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </div>

            <!-- Footer Navigation -->
            <div>
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-4 px-2">
                    SUPPORT
                </p>
                <SidebarMenu class="space-y-1">
                    <SidebarMenuItem v-for="item in footerNavItems" :key="item.title">
                        <SidebarMenuButton 
                            @click="handleNavigation(item)"
                            class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200 group cursor-pointer">
                            
                            <component :is="item.icon" 
                                      class="w-5 h-5 text-gray-600 dark:text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors duration-200" />
                            
                            <span class="font-medium text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition-colors duration-200">
                                {{ item.title }}
                            </span>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </div>
        </SidebarContent>

        <!-- Simple Footer -->
        <SidebarFooter class="p-4 border-t border-gray-100 dark:border-gray-800">
            <NavUser />
            <div class="text-center mt-3">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    © 2024 IT Student Hub
                </p>
            </div>
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>