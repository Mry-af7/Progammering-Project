import type { route as routeFn } from 'ziggy-js';

declare global {
    const route: typeof routeFn;

    interface Window {
        addToFavorites?: (company: any) => void;
        favoritesState?: {
            value: any[];
        };
    }
}
