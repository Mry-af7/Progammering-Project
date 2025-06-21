<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { 
    Home,
    User, 
    Search,
    Building2,
    FileText, 
    Heart,
    Users,
    Settings,
    BookOpen,
    LogOut,
    ChevronDown,
    UserCircle
} from 'lucide-vue-next';
import { router } from '@inertiajs/vue3';

const page = usePage();
// Try different common auth prop locations
const user = page.props.auth?.user || page.props.user || page.props.auth;

const showUserMenu = ref(false);

const mainNavItems = [
    {
        title: 'Dashboard',
        href: '/company/dashboard',
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

const footerNavItems = [
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

const handleNavigation = (item: any) => {
    if (item.href) {
        router.visit(item.href);
    }
};

const logout = () => {
    router.post('/logout');
};

const toggleUserMenu = () => {
    showUserMenu.value = !showUserMenu.value;
};

const getUserInitials = (name: string) => {
    if (!name) return 'U';
    const words = name.split(' ');
    if (words.length >= 2) {
        return (words[0].charAt(0) + words[1].charAt(0)).toUpperCase();
    }
    return name.charAt(0).toUpperCase();
};

// Debug user data
console.log('User data:', user);
console.log('All page props:', page.props);
</script>

<template>
    <aside class="w-64 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 flex flex-col h-full">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-center">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">
                    IH
                </div>
                <span class="ml-3 text-lg font-semibold text-gray-900 dark:text-white">
                    IT Student Hub
                </span>
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex-1 px-4 py-6 overflow-y-auto">
            <!-- Main Navigation -->
            <nav class="space-y-1">
                <div v-for="item in mainNavItems" :key="item.title">
                    <button 
                        @click="handleNavigation(item)"
                        class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 group">
                        
                        <component :is="item.icon" 
                                  class="w-5 h-5 mr-3 text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300" />
                        
                        {{ item.title }}
                    </button>
                </div>
            </nav>

            <!-- Divider -->
            <div class="border-t border-gray-200 dark:border-gray-700 my-6"></div>

            <!-- Support Navigation -->
            <div>
                <p class="px-3 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-3">
                    Support
                </p>
                <nav class="space-y-1">
                    <div v-for="item in footerNavItems" :key="item.title">
                        <button 
                            @click="handleNavigation(item)"
                            class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 group">
                            
                            <component :is="item.icon" 
                                      class="w-5 h-5 mr-3 text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300" />
                            
                            {{ item.title }}
                        </button>
                    </div>
                </nav>
            </div>
        </div>

        <!-- User Footer with Dropdown -->
        <div class="border-t border-gray-200 dark:border-gray-700">
            <div class="relative">
                <!-- User Menu Button -->
                <button 
                    @click="toggleUserMenu"
                    class="w-full p-4 flex items-center hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors duration-200">
                    
                    <!-- User Avatar -->
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-medium text-sm">
                        {{ user?.name ? getUserInitials(user.name) : 'U' }}
                    </div>
                    
                    <!-- User Info -->
                    <div class="ml-3 flex-1 text-left">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ user?.name || 'User' }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                            {{ user?.email || 'user@example.com' }}
                        </p>
                    </div>
                    
                    <!-- Dropdown Arrow -->
                    <ChevronDown 
                        class="w-4 h-4 text-gray-500 dark:text-gray-400 transition-transform duration-200"
                        :class="{ 'rotate-180': showUserMenu }" />
                </button>

                <!-- Dropdown Menu -->
                <div 
                    v-show="showUserMenu"
                    class="absolute bottom-full left-0 right-0 mb-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg py-1">
                    
                    <!-- Profile Link -->
                    <Link 
                        href="/profile" 
                        class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <UserCircle class="w-4 h-4 mr-3" />
                        Profile
                    </Link>
                    
                    <!-- Settings Link -->
                    <Link 
                        href="/settings" 
                        class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <Settings class="w-4 h-4 mr-3" />
                        Settings
                    </Link>
                    
                    <!-- Divider -->
                    <div class="border-t border-gray-200 dark:border-gray-600 my-1"></div>
                    
                    <!-- Logout Button -->
                    <button 
                        @click="logout"
                        class="w-full flex items-center px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200">
                        <LogOut class="w-4 h-4 mr-3" />
                        Sign out
                    </button>
                </div>
            </div>

            <!-- Copyright -->
            <div class="px-4 pb-4">
                <p class="text-xs text-gray-500 dark:text-gray-400 text-center">
                    © 2024 IT Student Hub
                </p>
            </div>
        </div>
    </aside>
</template>