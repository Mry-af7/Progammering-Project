import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href?: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: any;
}

export interface SharedData extends PageProps {
    auth: Auth;
    ziggy: {
        location: string;
        url: string;
        port: number | null;
        defaults: any[];
        routes: Record<string, any>;
    };
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
}

export type BreadcrumbItemType = BreadcrumbItem;
