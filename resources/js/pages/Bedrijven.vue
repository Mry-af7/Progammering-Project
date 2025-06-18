<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref, computed, watch, onMounted } from 'vue'

const mobileMenuOpen = ref(false)
const searchQuery = ref('')
const selectedIndustry = ref('alle')
const selectedLocation = ref('alle')
const sortBy = ref('naam')
const showFilters = ref(false)
const currentPage = ref(1)
const itemsPerPage = 12
const isLoading = ref(false)
const viewMode = ref('grid') // 'grid' or 'list'

// Add new favorite methods
const toggleFavorite = (company) => {
    if (window.addToFavorites) {
        window.addToFavorites(company)
    }
}

const isFavorite = (companyId) => {
    return window.favoritesState?.value.some(fav => fav.id === companyId) || false
}

const bedrijven = ref([
  {
    id: 1,
    name: 'Accenture',
    src: '/images/logos/accenture-logo.svg',
    favoriet: false,
    website: 'https://www.accenture.com/be-en',
    specialisatie: 'Consulting, digitale transformatie, technologie en outsourcing',
    beschrijving: 'Accenture is een wereldwijd professioneel dienstverlenend bedrijf dat bedrijven helpt met strategie, technologie, consulting en digitale oplossingen. In België richt het zich op innovatie en het verbeteren van bedrijfsprocessen via cloud, AI en andere digitale technologieën.',
    adres: 'Boulevard de Waterloo 16, 1000 Brussel',
    telefoon: '+32 2 710 71 11',
    email: 'info.belgium@accenture.com',
    industry: 'Consulting',
    location: 'Brussel',
    employees: '500+',
    founded: '1989',
    tags: ['AI', 'Cloud', 'Digital Transformation', 'Strategy']
  },
  {
    id: 2,
    name: 'Acolad',
    src: '/images/logos/acolad-LOGO.png',
    favoriet: false,
    website: 'https://www.acolad.com/nl.html',
    specialisatie: 'Vertalingen, lokalisatie, content en multimedia‑diensten',
    beschrijving: 'Acolad is een wereldleider in technologiegestuurde lokalisatieservices en contentoplossingen, waaronder vertaling, transcreatie, copywriting, proofreading, tolkdiensten en AI‑gebaseerde contentdiensten',
    adres: 'Avenue du Port 86C, 1000 Brussel',
    telefoon: '+32 2 896 94 40',
    email: 'contact@acolad.com',
    industry: 'Translation & Localization',
    location: 'Brussel',
    employees: '100-250',
    founded: '2013',
    tags: ['Translation', 'AI', 'Content', 'Multimedia']
  },
  {
    id: 3,
    name: 'Amista',
    src: '/images/logos/amista.png',
    favoriet: false,
    website: 'https://www.amista.com/nl/',
    specialisatie: 'SAP ERP, integratie & technologie, intelligente documentflows, digital learning',
    beschrijving: 'Amista is een toonaangevende IT‑consultant en softwareleverancier in de Benelux, met circa 250 medewerkers. Ze ondersteunen organisaties bij digitale transformatie via SAP‑implementaties (S/4HANA, Business One), integratieplatforms en slimme documentautomatisering, gecombineerd met opleidingen en change management',
    adres: 'Duwijckstraat 17, 2500 Lier',
    telefoon: '+32 56 76 09 00',
    email: 'sales@amista.com',
    industry: 'SAP & ERP',
    location: 'Lier',
    employees: '250',
    founded: '1998',
    tags: ['SAP', 'ERP', 'Digital Learning', 'Integration']
  },
  {
    id: 4,
    name: 'ARHS GROUP',
    src: '/images/logos/arhs-LOGO.png',
    favoriet: false,
    website: 'https://www.arhs-group.com/about-us/',
    specialisatie: 'Softwareontwikkeling, data science, infrastructure services, digital trust, cloud & mobiele apps',
    beschrijving: 'Arηs Group is een onafhankelijke Europese IT-dienstenleverancier, opgericht in 2003 in Luxemburg. Met meer dan 2.500 consultants in 16 landen, waaronder België, richten ze zich op complexe softwareprojecten, datagedreven inzichten, infrastructuur, cybersecurity, AI en mobiele oplossingen—met een sterke focus op overheid en telecomsector',
    adres: 'Ikaroslaan 53, 1930 Zaventem',
    telefoon: '+352 26 11 02 1',
    email: 'info@arhs-dev.com',
    industry: 'Software Development',
    location: 'Zaventem',
    employees: '2500+',
    founded: '2003',
    tags: ['Software Development', 'Data Science', 'Cloud', 'Cybersecurity']
  },
  {
    id: 5,
    name: 'Avelon',
    src: '/images/logos/avelon-LOGO.png',
    favoriet: false,
    website: 'https://www.avelon.nl/#intro',
    specialisatie: 'SAP‑workflows, Procure‑to‑Pay, Master‑Data Governance, SIM/VIM, SAP Fiori',
    beschrijving: 'Avelon is een Nederlandse SAP‑specialist, actief sinds 2000. Ze helpen organisaties hun bedrijfsprocessen gebruiksvriendelijker, transparanter en efficiënter te maken. Met consultancy, turnkey‑oplossingen en eigen SAP‑add‑ons (zoals voor factuurbeheer, masterdata, e‑invoicing en workflow) optimaliseren ze P2P-processen in zowel ERP als S/4HANA omgevingen',
    adres: 'Orteliuslaan 9, 3528 BA Utrecht, Nederland',
    telefoon: '+31 30 767 0561',
    email: 'info@avelon.nl',
    industry: 'SAP & ERP',
    location: 'Utrecht',
    employees: '50-100',
    founded: '2000',
    tags: ['SAP', 'Workflows', 'P2P', 'Fiori']
  },
  {
    id: 6,
    name: 'Axxes',
    src: '/images/logos/axxess.png',
    favoriet: false,
    website: 'https://www.axxes.com/',
    specialisatie: 'IT‑consulting, software engineering, data, cloud, devops, QA, projectmanagement',
    beschrijving: 'Axxes is een full‑service IT‑adviesbureau, actief sinds 1998. Ze leveren expertise in softwareontwikkeling (.NET, Java, front‑end), infrastructuur, cloud, data en IT-projectmanagement. Ze staan bekend om hun mensen‑gerichte aanpak en "IT is about people"-cultuur.',
    adres: 'Entrepotkaai 10A, 2000 Antwerpen',
    telefoon: '+32 3 234 99 58',
    email: 'contact@axxes.com',
    industry: 'IT Consulting',
    location: 'Antwerpen',
    employees: '200+',
    founded: '1998',
    tags: ['.NET', 'Java', 'Cloud', 'DevOps']
  },
  {
    id: 7,
    name: 'Bizztalent',
    src: '/images/logos/bizztalent.png',
    favoriet: false,
    website: 'https://www.bizztalent.be/',
    specialisatie: 'IT‑consultancy, tijdelijke IT‑staffing, infrastructuuroplossingen',
    beschrijving: 'Bizztalent is een dynamisch Belgisch IT‑adviesbureau opgericht in 2012. Met meer dan 130 IT‑consultants verspreid over Antwerpen, Gent en Vilvoorde, bieden ze flexibele IT‑ondersteuning op projectbasis, van implementatie en migratie tot full support binnen grootschalige infrastructuuromgevingen.',
    adres: 'Sluisweg 1/13, 9000 Gent',
    telefoon: '+32 3 689 14 91',
    email: 'info@bizztalent.be',
    industry: 'IT Consulting',
    location: 'Gent',
    employees: '130+',
    founded: '2012',
    tags: ['IT Staffing', 'Infrastructure', 'Migration', 'Support']
  },
  {
    id: 8,
    name: 'Blents',
    src: '/images/logos/blents.png',
    favoriet: false,
    website: 'https://www.blents.be/',
    specialisatie: 'IT consultancy, software development, digital solutions',
    beschrijving: 'Blents is een innovatief IT-bedrijf dat zich richt op het leveren van hoogwaardige software-oplossingen en digitale transformaties. Met expertise in moderne technologieën helpen we bedrijven hun digitale doelstellingen te realiseren.',
    adres: 'Tech Lane 45, 2000 Antwerpen',
    telefoon: '+32 3 555 0123',
    email: 'info@blents.com',
    industry: 'IT Consulting',
    location: 'Antwerpen',
    employees: '75-150',
    founded: '2015',
    tags: ['Software Development', 'Digital Solutions', 'Innovation', 'Consulting']
  },
  {
    id: 9,
    name: 'BNP Paribas',
    src: '/images/logos/bnp-paribas-fortis-logo.svg',
    favoriet: false,
    website: 'https://www.bnpparibas.be/',
    specialisatie: 'Banking, financial services, digitale banking solutions, fintech',
    beschrijving: 'BNP Paribas is een internationale bank en financiële dienstverlener die actief is in retail banking, corporate banking en institutionele diensten. In België biedt de bank innovatieve digitale oplossingen en werkt samen met fintech bedrijven om de toekomst van banking te vormgeven.',
    adres: 'Montagne du Parc 3, 1000 Brussel',
    telefoon: '+32 2 433 41 11',
    email: 'info@bnpparibas.be',
    industry: 'Financial Services',
    location: 'Brussel',
    employees: '1000+',
    founded: '1822',
    tags: ['Banking', 'Fintech', 'Digital Banking', 'Financial Technology']
  },
  {
    id: 10,
    name: 'Capgemini',
    src: '/images/logos/capgemini-logo.svg',
    favoriet: false,
    website: 'https://www.capgemini.com/be-en/',
    specialisatie: 'Digital transformation, consulting, technology services, engineering',
    beschrijving: 'Capgemini is een wereldwijde leider in consulting, digitale transformatie, technologie en engineering services. Het bedrijf helpt organisaties hun business ambities te realiseren door middel van de kracht van technologie en menselijke energie.',
    adres: 'Bessenveldstraat 19, 1831 Diegem',
    telefoon: '+32 2 708 11 11',
    email: 'info.belgium@capgemini.com',
    industry: 'Consulting',
    location: 'Diegem',
    employees: '800+',
    founded: '1967',
    tags: ['Digital Transformation', 'Cloud', 'AI', 'Engineering', 'Consulting']
  },
  {
    id: 11,
    name: 'Colibri',
    src: '/images/logos/colibri-logo.png',
    favoriet: false,
    website: 'https://colibri.consulting/',
    specialisatie: 'Software development, custom applications, web development',
    beschrijving: 'Colibri Software is een dynamisch softwareontwikkelingsbedrijf dat zich specialiseert in het creëren van op maat gemaakte software-oplossingen. Van webapplicaties tot mobiele apps, Colibri helpt bedrijven hun digitale visie tot leven te brengen.',
    adres: 'Innovation Street 12, 9000 Gent',
    telefoon: '+32 9 123 45 67',
    email: 'hello@colibri-software.com',
    industry: 'Software Development',
    location: 'Gent',
    employees: '25-50',
    founded: '2018',
    tags: ['Custom Software', 'Web Development', 'Mobile Apps', 'Innovation']
  },
  {
    id: 12,
    name: 'Colruyt Group',
    src: '/images/logos/colruyt-group-logo.svg',
    favoriet: false,
    website: 'https://www.colruytgroup.com/wps/portal/cg/nl/home',
    specialisatie: 'Retail technology, e-commerce, supply chain, digital innovation',
    beschrijving: 'Colruyt Group is een Belgische retailgroep die sterk inzet op digitale innovatie en technologie. Van e-commerce platforms tot geavanceerde supply chain systemen, Colruyt Group investeert zwaar in IT en digitale transformatie om de retailervaring te verbeteren.',
    adres: 'Edingensesteenweg 196, 1500 Halle',
    telefoon: '+32 2 360 01 11',
    email: 'info@colruytgroup.com',
    industry: 'Retail Technology',
    location: 'Halle',
    employees: '2000+',
    founded: '1925',
    tags: ['Retail Tech', 'E-commerce', 'Supply Chain', 'Digital Innovation']
  },
  {
    id: 13,
    name: 'Delaware',
    src: '/images/logos/delaware-logo.svg',
    favoriet: false,
    website: 'https://www.delaware.pro/en-be/careers',
    specialisatie: 'IT-consulting, cloud- en ERP-oplossingen, digitale transformatie, SAP & Microsoft-technologieën',
    beschrijving: 'Delaware is een internationaal IT-adviesbureau met meer dan 4.700 specialisten in 19 landen. Ze begeleiden organisaties bij hun digitale transformatie en leveren oplossingen op het vlak van ERP, cloud, AI, data-analyse, CRM en supply chain',
    adres: 'Kapel ter Bede 86, 8500 Kortrijk',
    telefoon: '+32 56 27 44 44',
    email: 'info@delaware.pro',
    industry: 'IT Consulting',
    location: 'Kortrijk',
    employees: '4700+',
    founded: '1991',
    tags: ['ERP', 'Cloud', 'AI', 'Microsoft', 'SAP']
  },
  {
    id: 14,
    name: 'Dilaco',
    src: '/images/logos/dilaco.png',
    favoriet: false,
    website: 'https://www.dilaco.eu/',
    specialisatie: 'Digital solutions, web development, e-commerce, mobile applications',
    beschrijving: 'Dilaco is een digitaal bureau dat bedrijven helpt bij hun online aanwezigheid en digitale strategieën. Ze bieden een breed scala aan diensten, van webdesign tot complexe e-commerce oplossingen en mobiele applicaties.',
    adres: 'Leuvensesteenweg 325, 1932 Zaventem',
    telefoon: '+32 2 267 65 60',
    email: 'contact@dilaco.be',
    industry: 'Digital Agency',
    location: 'Zaventem',
    employees: '15-30',
    founded: '2016',
    tags: ['Web Development', 'E-commerce', 'Mobile Apps', 'Digital Strategy']
  },
  {
    id: 15,
    name: 'Eezee',
    src: '/images/logos/eezee-IT.png',
    favoriet: false,
    website: 'https://eezee-it.com/nl_BE',
    specialisatie: 'User experience, interface design, digital products, frontend development',
    beschrijving: 'Eezee is een UX/UI design agency die zich richt op het creëren van intuïtieve en gebruiksvriendelijke digitale ervaringen. Ze combineren design thinking met technische expertise om digitale producten te ontwikkelen die gebruikers écht willen gebruiken.',
    adres: 'Design District 15, 1050 Brussel',
    telefoon: '+32 2 789 01 23',
    email: 'hello@eezee.be',
    industry: 'UX/UI Design',
    location: 'Brussel',
    employees: '20-40',
    founded: '2014',
    tags: ['UX Design', 'UI Design', 'Frontend', 'User Research']
  },
  {
    id: 16,
    name: 'Euricom',
    src: '/images/logos/euricom.png',
    favoriet: false,
    website: 'https://www.euri.com/en',
    specialisatie: 'Software development, training, consultancy, modern web technologies',
    beschrijving: 'Euricom is een Belgisch softwareontwikkelingsbedrijf dat zich specialiseert in moderne webtechnologieën en training. Ze bieden zowel consultancy diensten als uitgebreide trainingen in de nieuwste development frameworks en methodologieën.',
    adres: 'Mechelsesteenweg 102, 2018 Antwerpen',
    telefoon: '+32 3 281 59 71',
    email: 'info@euricom.com',
    industry: 'Software Development',
    location: 'Antwerpen',
    employees: '30-60',
    founded: '2010',
    tags: ['Web Development', 'Training', 'Angular', 'React', 'JavaScript']
  },
  {
    id: 17,
    name: 'Equans',
    src: '/images/logos/equans-logo.png',
    favoriet: false,
    website: 'https://www.equans.be/',
    specialisatie: 'Smart building solutions, industrial automation, digitale infrastructuur',
    beschrijving: 'Equans is een wereldleider in multi-technische installaties en onderhoudsdiensten. Ze combineren technische expertise met digitale innovatie om slimme gebouwen en industriële automatisering te realiseren, met een sterke focus op duurzaamheid en energie-efficiëntie.',
    adres: 'Avenue Herrmann-Debroux 42, 1160 Auderghem',
    telefoon: '+32 2 663 81 11',
    email: 'info@equans.be',
    industry: 'Industrial Technology',
    location: 'Auderghem',
    employees: '1500+',
    founded: '2021',
    tags: ['Smart Buildings', 'IoT', 'Industrial Automation', 'Sustainability']
  },
  {
    id: 18,
    name: 'Exclusive Networks',
    src: '/images/logos/Exclusive-LOGO.png',
    favoriet: false,
    website: 'https://www.exclusive-networks.com/',
    specialisatie: 'Cybersecurity, cloud solutions, network infrastructure, technology distribution',
    beschrijving: 'Exclusive Networks is een wereldwijde cybersecurity specialist en technology enabler. Ze helpen bedrijven bij het implementeren van geavanceerde security oplossingen en cloud infrastructuur door middel van hun uitgebreide partner ecosysteem.',
    adres: 'Pegasus Park, De Kleetlaan 5, 1831 Diegem',
    telefoon: '+32 2 711 25 80',
    email: 'info@exclusive-networks.com',
    industry: 'Cybersecurity',
    location: 'Diegem',
    employees: '300+',
    founded: '2003',
    tags: ['Cybersecurity', 'Cloud Security', 'Network Infrastructure', 'Technology Distribution']
  },
  {
    id: 19,
    name: 'Flexso',
    src: '/images/logos/flexo-logo.svg',
    favoriet: false,
    website: 'https://www.flexso.com/',
    specialisatie: 'SAP solutions, business process optimization, digital transformation',
    beschrijving: 'Flexso is een toonaangevende SAP partner die bedrijven helpt bij hun digitale transformatie. Ze bieden end-to-end SAP oplossingen, van implementatie tot ondersteuning, en specialiseren zich in het optimaliseren van bedrijfsprocessen door middel van innovatieve technologieën.',
    adres: 'Locations in Gent, Mechelen, and Kontich',
    telefoon: '+32 9 244 14 15',
    email: 'info@flexso.com',
    industry: 'SAP & ERP',
    location: 'Gent',
    employees: '400+',
    founded: '2005',
    tags: ['SAP', 'S/4HANA', 'Business Process', 'Digital Transformation']
  },
  {
    id: 20,
    name: 'Gumption',
    src: '/images/logos/gumption-logo.png',
    favoriet: false,
    website: 'https://www.gumption.eu/',
    specialisatie: 'Data & AI, cloud platforms, modern application development',
    beschrijving: 'Gumption is een data-gedreven consultancy bedrijf dat organisaties helpt waarde te creëren uit hun data. Ze specialiseren zich in AI/ML oplossingen, cloud platforms en moderne applicatie-architectuur om bedrijven te helpen concurrentievoordeel te behalen.',
    adres: 'Technology Park 25, 9052 Zwijnaarde',
    telefoon: '+32 9 329 56 78',
    email: 'info@gumption.eu',
    industry: 'Data & AI',
    location: 'Gent',
    employees: '50-100',
    founded: '2019',
    tags: ['Data Science', 'AI/ML', 'Cloud Platforms', 'Analytics']
  },
  {
    id: 21,
    name: 'Nexios IT',
    src: '/images/logos/nexios_it_ver2.png',
    favoriet: false,
    website: 'https://www.nexiosit.com/',
    specialisatie: 'IT infrastructure, cloud services, managed services, cybersecurity',
    beschrijving: 'Nexios IT is een Belgische IT-dienstverlener die bedrijven ondersteunt met moderne IT-infrastructuur en cloud services. Ze bieden managed services, cybersecurity oplossingen en helpen organisaties bij hun migratie naar de cloud.',
    adres: 'IT Boulevard 77, 2800 Mechelen',
    telefoon: '+32 15 56 78 90',
    email: 'info@nexios.be',
    industry: 'IT Infrastructure',
    location: 'Mechelen',
    employees: '80-150',
    founded: '2012',
    tags: ['Cloud Services', 'IT Infrastructure', 'Managed Services', 'Cybersecurity']
  },
  {
    id: 22,
    name: 'Nomios',
    src: '/images/logos/NOMIOS.png',
    favoriet: false,
    website: 'https://www.nomios.be/',
    specialisatie: 'Network infrastructure, cybersecurity, cloud connectivity, data center',
    beschrijving: 'Nomios is een European network integrator die bedrijven helpt bij het ontwerpen, implementeren en beheren van hun netwerk- en security infrastructuur. Ze zijn specialist in enterprise networking, cybersecurity en cloud connectivity oplossingen.',
    adres: 'Pegasus Park, De Kleetlaan 5A, 1831 Diegem',
    telefoon: '+32 2 790 11 56',
    email: 'info@nomios.be',
    industry: 'Network & Security',
    location: 'Diegem',
    employees: '200+',
    founded: '2002',
    tags: ['Network Infrastructure', 'Cybersecurity', 'Cloud Connectivity', 'Data Center']
  },
  {
    id: 23,
    name: 'Persolis',
    src: '/images/logos/persolis.png',
    favoriet: false,
    website: 'https://persolis.be/nl/',
    specialisatie: 'HR technology, payroll solutions, workforce management',
    beschrijving: 'Persolis is een HR-technologiebedrijf dat innovatieve oplossingen biedt voor personeelsbeheer, payroll en workforce management. Ze helpen organisaties hun HR-processen te digitaliseren en te optimaliseren met moderne technologieën.',
    adres: 'HR Tech Center 33, 1000 Brussel',
    telefoon: '+32 2 456 78 90',
    email: 'contact@persolis.be',
    industry: 'HR Technology',
    location: 'Brussel',
    employees: '40-80',
    founded: '2017',
    tags: ['HR Tech', 'Payroll', 'Workforce Management', 'Digital HR']
  },
  {
    id: 24,
    name: 'Safran',
    src: '/images/logos/Safran-LOGO.svg',
    favoriet: false,
    website: 'https://www.safran-group.com/',
    specialisatie: 'Aerospace technology, defense systems, high-tech engineering',
    beschrijving: 'Safran is een internationale high-tech groep die actief is in de lucht- en ruimtevaart, defensie en security markten. In België focussen ze op geavanceerde engineering, software development en innovatieve technologieën voor aerospace toepassingen.',
    adres: 'Aerospace Avenue 15, 1930 Zaventem',
    telefoon: '+32 2 717 35 00',
    email: 'info.belgium@safrangroup.com',
    industry: 'Aerospace & Defense',
    location: 'Zaventem',
    employees: '300+',
    founded: '2005',
    tags: ['Aerospace', 'High-Tech Engineering', 'Defense Systems', 'Innovation']
  },
  {
    id: 25,
    name: 'Simac',
    src: '/images/logos/simac.svg',
    favoriet: false,
    website: 'https://www.simac.com/be-nl',
    specialisatie: 'IT solutions, digital workspace, business applications, managed services',
    beschrijving: 'Simac is een ervaren IT-dienstverlener die bedrijven helpt bij hun digitale transformatie. Ze bieden een breed scala aan IT-oplossingen, van digital workplace services tot business applicaties en managed IT services.',
    adres: 'Technology Plaza 50, 2600 Antwerpen',
    telefoon: '+32 3 206 95 00',
    email: 'info@simac.be',
    industry: 'IT Services',
    location: 'Antwerpen',
    employees: '150+',
    founded: '1992',
    tags: ['Digital Workplace', 'Business Applications', 'Managed Services', 'IT Solutions']
  },
  {
    id: 26,
    name: 'Sopra Steria',
    src: '/images/logos/sopra-steria.png',
    favoriet: false,
    website: 'https://www.soprasteria.be/',
    specialisatie: 'Digital transformation, consulting, software development, systems integration',
    beschrijving: 'Sopra Steria is een Europese leider in digitale transformatie. Ze bieden end-to-end services in consulting, systems integration, software development en business process outsourcing. Hun focus ligt op het leveren van innovatieve oplossingen die echte business value creëren.',
    adres: 'Avenue Arnaud Fraiteur 15-23, 1050 Brussel',
    telefoon: '+32 2 566 66 66',
    email: 'info@soprasteria.be',
    industry: 'Digital Transformation',
    location: 'Brussel',
    employees: '600+',
    founded: '1968',
    tags: ['Digital Transformation', 'Systems Integration', 'Software Development', 'Consulting']
  }
])

const geselecteerdBedrijf = ref(null)
const showModal = ref(false)

// Computed properties
const industries = computed(() => {
  const allIndustries = bedrijven.value.map(b => b.industry)
  return ['alle', ...new Set(allIndustries)]
})

const locations = computed(() => {
  const allLocations = bedrijven.value.map(b => b.location)
  return ['alle', ...new Set(allLocations)]
})

const filteredBedrijven = computed(() => {
  let result = bedrijven.value

  // Filter by search query
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    result = result.filter(bedrijf => 
      bedrijf.name.toLowerCase().includes(query) ||
      bedrijf.specialisatie.toLowerCase().includes(query) ||
      bedrijf.beschrijving.toLowerCase().includes(query) ||
      bedrijf.tags.some(tag => tag.toLowerCase().includes(query))
    )
  }

  // Filter by industry
  if (selectedIndustry.value !== 'alle') {
    result = result.filter(bedrijf => bedrijf.industry === selectedIndustry.value)
  }

  // Filter by location
  if (selectedLocation.value !== 'alle') {
    result = result.filter(bedrijf => bedrijf.location === selectedLocation.value)
  }

  // Sort results
  result.sort((a, b) => {
    switch (sortBy.value) {
      case 'naam':
        return a.name.localeCompare(b.name)
      case 'industrie':
        return a.industry.localeCompare(b.industry)
      case 'locatie':
        return a.location.localeCompare(b.location)
      case 'grootte':
        return parseInt(b.employees.replace(/\D/g, '')) - parseInt(a.employees.replace(/\D/g, ''))
      default:
        return 0
    }
  })

  return result
})

const paginatedBedrijven = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return filteredBedrijven.value.slice(start, end)
})

const totalPages = computed(() => {
  return Math.ceil(filteredBedrijven.value.length / itemsPerPage)
})

const favorieten = computed(() => {
  return bedrijven.value.filter(b => b.favoriet)
})

// Methods
function openModal(bedrijf) {
  geselecteerdBedrijf.value = bedrijf
  showModal.value = true
  document.body.style.overflow = 'hidden'
}

function closeModal() {
  showModal.value = false
  geselecteerdBedrijf.value = null
  document.body.style.overflow = 'auto'
}

// Replace the existing toggleFavoriet function with the new one
function toggleFavoriet(bedrijf) {
    toggleFavorite(bedrijf)
}

function resetFilters() {
  searchQuery.value = ''
  selectedIndustry.value = 'alle'
  selectedLocation.value = 'alle'
  sortBy.value = 'naam'
  currentPage.value = 1
}

function applyFilters() {
  currentPage.value = 1
  showFilters.value = false
}

function changePage(page) {
  currentPage.value = page
  window.scrollTo({ top: 0, behavior: 'smooth' })
}

// Watch for filter changes
watch([searchQuery, selectedIndustry, selectedLocation], () => {
  currentPage.value = 1
})

// Close modal on escape key
onMounted(() => {
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && showModal.value) {
      closeModal()
    }
  })
})
</script>

<template>
    <AppLayout>
        <Head title="Bedrijven - Career Launch 2025" />
        
        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-4 py-2 bg-orange-100 rounded-full text-orange-700 text-sm font-medium mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Deelnemende Bedrijven
                </div>
                <h1 class="text-5xl lg:text-6xl font-bold bg-gradient-to-r from-gray-900 via-orange-600 to-red-600 bg-clip-text text-transparent mb-6">
                    Ontdek topbedrijven
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Verken de deelnemende bedrijven van Career Launch 2025. 
                    Van startups tot multinationals - vind het bedrijf dat bij jou past!
                </p>
            </div>
        </section>

        <!-- Content Sections -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Company List -->
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">Deelnemende Bedrijven</h2>
                            <p class="text-gray-600">Ontdek de bedrijven die deelnemen aan Career Launch 2025</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <p class="text-gray-700 leading-relaxed">
                            Career Launch 2025 brengt toonaangevende bedrijven uit verschillende sectoren samen. 
                            Van technologie en design tot marketing en consultancy - er is voor iedereen wat wils.
                        </p>
                        
                        <div class="bg-orange-50 rounded-2xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Wat kun je verwachten?</h3>
                            <ul class="space-y-2 text-gray-700">
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Direct contact met recruiters
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Speeddate sessies
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Job en stage mogelijkheden
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Netwerk mogelijkheden
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- How to Connect -->
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">Hoe contact maken?</h2>
                            <p class="text-gray-600">Stap voor stap gids</p>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">1</div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Bekijk bedrijven</h3>
                                <p class="text-gray-700">Verken de bedrijfsprofielen en lees meer over hun cultuur en vacatures.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">2</div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Voeg toe aan favorieten</h3>
                                <p class="text-gray-700">Sla interessante bedrijven op in je favorieten voor later.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">3</div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Plan speeddate sessies</h3>
                                <p class="text-gray-700">Reserveer tijd met bedrijven die je interesseren.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0">4</div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Maak indruk</h3>
                                <p class="text-gray-700">Bereid je voor en maak een goede indruk tijdens het evenement!</p>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-4xl font-bold mb-4">Klaar om te ontdekken?</h3>
                    <p class="text-white/90 mb-8 max-w-2xl mx-auto text-lg">
                        Bekijk alle deelnemende bedrijven en vind het bedrijf dat bij jou past!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link href="/favorieten" class="inline-flex items-center bg-white text-orange-600 px-8 py-4 rounded-2xl font-semibold text-lg hover:bg-orange-50 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            Bekijk favorieten
                        </Link>
                        <Link href="/register?type=student" class="inline-flex items-center bg-white/10 text-white border-2 border-white/20 px-8 py-4 rounded-2xl font-semibold text-lg hover:bg-white/20 transition-all duration-300 backdrop-blur-sm">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Maak je profiel
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
/* Line clamp utilities */
.line-clamp-1 {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
  line-clamp: 1;
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  line-clamp: 2;
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  line-clamp: 3;
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.group:hover .group-hover\:scale-105 {
  transform: scale(1.05);
}
</style>