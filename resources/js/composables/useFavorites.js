import { ref, watch } from 'vue'

// Create a reactive reference for favorites
const favorites = ref([])

// Load favorites from localStorage on initialization
if (typeof window !== 'undefined') {
    const savedFavorites = localStorage.getItem('favorites')
    if (savedFavorites) {
        favorites.value = JSON.parse(savedFavorites)
    }
}

// Save favorites to localStorage whenever they change
watch(favorites, (newFavorites) => {
    localStorage.setItem('favorites', JSON.stringify(newFavorites))
}, { deep: true })

// Add a company to favorites
function addToFavorites(company) {
    if (!favorites.value.some(fav => fav.id === company.id)) {
        favorites.value.push(company)
    }
}

// Remove a company from favorites
function removeFromFavorites(companyId) {
    const index = favorites.value.findIndex(fav => fav.id === companyId)
    if (index > -1) {
        favorites.value.splice(index, 1)
    }
}

// Check if a company is in favorites
function isFavorite(companyId) {
    return favorites.value.some(fav => fav.id === companyId)
}

// Make the favorites state and functions available globally
if (typeof window !== 'undefined') {
    window.favoritesState = favorites
    window.addToFavorites = addToFavorites
    window.removeFromFavorites = removeFromFavorites
    window.isFavorite = isFavorite
}

export function useFavorites() {
    return {
        favorites,
        addToFavorites,
        removeFromFavorites,
        isFavorite
    }
} 