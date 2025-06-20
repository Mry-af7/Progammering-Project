import type { route as routeFn } from 'ziggy-js';
import { Ref } from 'vue';

interface FavoriteCompany {
  id: number;
  name: string;
  industry: string;
  employees: string;
  location: string;
  specialisatie: string;
  logo: string;
}

declare global {
    const route: typeof routeFn;
    interface Window {
        favoritesState?: Ref<FavoriteCompany[]>;
        addToFavorites?: (company: FavoriteCompany) => boolean;
        removeFromFavorites?: (companyId: number) => void;
        showGlobalToast?: (message: string, type: string) => void;
    }
}
