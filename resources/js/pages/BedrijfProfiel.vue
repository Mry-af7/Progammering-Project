<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <button @click="$inertia.visit('/bedrijven')" class="mr-4 text-gray-500 hover:text-gray-700">
              <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
            </button>
            <h1 class="text-3xl font-bold text-gray-900">{{ company.name }}</h1>
          </div>
          <div class="flex items-center space-x-4">
            <button @click="toggleFavorite" class="text-gray-500 hover:text-yellow-500">
              <svg :class="['h-6 w-6', isFavorite ? 'text-yellow-500' : '']" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.173 3.617a1 1 0 00.95.69h3.801c.969 0 1.371 1.24.588 1.81l-3.073 2.23a1 1 0 00-.364 1.118l1.173 3.617c.3.921-.755 1.688-1.54 1.118l-3.073-2.23a1 1 0 00-1.175 0l-3.073 2.23c-.784.57-1.838-.197-1.54-1.118l1.173-3.617a1 1 0 00-.364-1.118L2.536 9.044c-.783-.57-.38-1.81.588-1.81h3.801a1 1 0 00.95-.69l1.173-3.617z" />
              </svg>
            </button>
            <button @click="scheduleMeeting" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Afspraak maken
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Company Info -->
        <div class="lg:col-span-2 space-y-6">
          <!-- Overview -->
          <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Over het bedrijf</h2>
            <div class="prose max-w-none">
              <p class="text-gray-600">{{ company.description }}</p>
            </div>
          </div>

          <!-- Details -->
          <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Bedrijfsinformatie</h2>
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
              <div>
                <dt class="text-sm font-medium text-gray-500">Industrie</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ company.industry }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Locatie</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ company.location }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Website</dt>
                <dd class="mt-1 text-sm text-gray-900">
                  <a :href="company.website" target="_blank" class="text-indigo-600 hover:text-indigo-500">{{ company.website }}</a>
                </dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Aantal werknemers</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ company.employeeCount }}</dd>
              </div>
            </dl>
          </div>

          <!-- Open Positions -->
          <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Openstaande vacatures</h2>
            <div v-if="company.openPositions && company.openPositions.length > 0" class="space-y-4">
              <div v-for="position in company.openPositions" :key="position.id" class="border rounded-lg p-4">
                <h3 class="text-lg font-medium text-gray-900">{{ position.title }}</h3>
                <p class="mt-1 text-sm text-gray-500">{{ position.description }}</p>
                <div class="mt-4 flex items-center justify-between">
                  <div class="flex items-center space-x-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                      {{ position.type }}
                    </span>
                    <span class="text-sm text-gray-500">{{ position.location }}</span>
                  </div>
                  <button @click="applyForPosition(position.id)" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Solliciteren
                  </button>
                </div>
              </div>
            </div>
            <p v-else class="text-gray-500">Geen openstaande vacatures op dit moment.</p>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
          <!-- Company Logo -->
          <div class="bg-white shadow rounded-lg p-6">
            <div class="flex flex-col items-center">
              <img :src="company.logo" :alt="company.name" class="h-32 w-32 object-contain">
              <div class="mt-4 text-center">
                <h3 class="text-lg font-medium text-gray-900">{{ company.name }}</h3>
                <p class="mt-1 text-sm text-gray-500">{{ company.industry }}</p>
              </div>
            </div>
          </div>

          <!-- Contact Info -->
          <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Contact</h3>
            <dl class="space-y-4">
              <div>
                <dt class="text-sm font-medium text-gray-500">Email</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ company.email }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Telefoon</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ company.phone }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Adres</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ company.address }}</dd>
              </div>
            </dl>
          </div>

          <!-- Social Media -->
          <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Social Media</h3>
            <div class="flex space-x-4">
              <a v-if="company.linkedin" :href="company.linkedin" target="_blank" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">LinkedIn</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                </svg>
              </a>
              <a v-if="company.twitter" :href="company.twitter" target="_blank" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Twitter</span>
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BedrijfProfiel',
  data() {
    return {
      company: {
        id: null,
        name: '',
        description: '',
        industry: '',
        location: '',
        website: '',
        employeeCount: '',
        logo: '',
        email: '',
        phone: '',
        address: '',
        linkedin: '',
        twitter: '',
        openPositions: []
      },
      isFavorite: false
    }
  },
  methods: {
    async fetchCompanyData() {
      try {
        // Implement API call to fetch company data
        // const response = await axios.get(`/api/companies/${this.$route.params.id}`)
        // this.company = response.data
        
        // Mock data for testing
        this.company = {
          id: 1,
          name: 'TechCorp',
          description: 'TechCorp is een toonaangevend softwarebedrijf dat innovatieve oplossingen ontwikkelt voor bedrijven wereldwijd. Met meer dan 10 jaar ervaring in de industrie, zijn we gespecialiseerd in het creëren van op maat gemaakte softwareoplossingen die bedrijven helpen groeien en efficiënter te werken.',
          industry: 'IT & Software',
          location: 'Brussel',
          website: 'https://techcorp.example.com',
          employeeCount: '50-100',
          logo: 'https://via.placeholder.com/150',
          email: 'info@techcorp.example.com',
          phone: '+32 2 123 45 67',
          address: 'Nieuwstraat 123, 1000 Brussel',
          linkedin: 'https://linkedin.com/company/techcorp',
          twitter: 'https://twitter.com/techcorp',
          openPositions: [
            {
              id: 1,
              title: 'Frontend Developer',
              description: 'We zijn op zoek naar een ervaren Frontend Developer om ons team te versterken.',
              type: 'Vast',
              location: 'Brussel'
            },
            {
              id: 2,
              title: 'Backend Developer',
              description: 'Join ons team als Backend Developer en help ons met het bouwen van schaalbare applicaties.',
              type: 'Stage',
              location: 'Brussel'
            }
          ]
        }
      } catch (error) {
        console.error('Error fetching company data:', error)
      }
    },
    async toggleFavorite() {
      try {
        // Implement API call to toggle favorite status
        // await axios.post(`/api/companies/${this.company.id}/favorite`)
        this.isFavorite = !this.isFavorite
      } catch (error) {
        console.error('Error toggling favorite:', error)
      }
    },
    scheduleMeeting() {
      this.$inertia.visit(`/afspraak?company=${this.company.id}`)
    },
    applyForPosition(positionId) {
      this.$inertia.visit(`/sollicitatie/${positionId}`)
    }
  },
  mounted() {
    this.fetchCompanyData()
  }
}
</script>

<style scoped>
/* Add any custom styles here */
</style> 