import { route } from 'ziggy-js';
import { App } from 'vue';

declare global {
    interface Window {
        Ziggy: any;
        route: typeof route;
    }
}

// Extend Vue's global properties
declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        $route: typeof route;
        route: typeof route;
    }
}

export function setupZiggy(app: App) {
    // Make route available on global properties
    app.config.globalProperties.$route = route;
    app.config.globalProperties.route = route;
    
    // Make route available globally via window
    window.route = route;
    
    // Also make it available as a global property for templates
    app.config.globalProperties.route = route;
}

export { route };