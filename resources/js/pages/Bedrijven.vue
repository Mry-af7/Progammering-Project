<script setup>
import { Head, Link } from '@inertiajs/vue3'
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
  <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-orange-50">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-lg shadow-lg sticky top-0 z-40 border-b border-orange-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <!-- Logo -->
          <Link href="/" class="flex items-center space-x-3 group">
            <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-700 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
              <span class="text-white font-bold text-lg">E</span>
            </div>
            <div>
              <div class="text-gray-900 font-bold text-xl">erasmus</div>
              <div class="text-xs text-gray-600 -mt-1">HOGESCHOOL BRUSSEL</div>
            </div>
          </Link>

          <!-- Mobile menu button -->
          <div class="md:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-gray-700 hover:bg-orange-100 transition-colors">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
          </div>

          <!-- Desktop Navigation -->
          <div class="hidden md:flex items-center space-x-1">
            <Link href="/" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors rounded-lg hover:bg-orange-50">Home</Link>
            <Link href="/info" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors rounded-lg hover:bg-orange-50">Info</Link>
            <Link href="/bedrijven" class="px-4 py-2 text-orange-600 bg-orange-100 rounded-lg font-medium">Bedrijven</Link>
            <Link href="/favorieten" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors rounded-lg hover:bg-orange-50 relative">
              Favorieten
              <span v-if="favorieten.length > 0" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                {{ favorieten.length }}
              </span>
            </Link>
            <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors rounded-lg hover:bg-orange-50">Contact</Link>
            <div class="flex items-center ml-6">
              <Link href="/login" class="px-6 py-2 text-orange-600 hover:text-orange-700 font-medium transition-colors">Inloggen</Link>
            </div>
          </div>
        </div>

        <!-- Mobile menu -->
        <div v-show="mobileMenuOpen" class="md:hidden mt-4 pb-4 border-t border-orange-200">
          <div class="flex flex-col space-y-2 pt-4">
            <Link href="/" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium rounded-lg">Home</Link>
            <Link href="/info" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium rounded-lg">Info</Link>
            <Link href="/bedrijven" class="px-4 py-2 text-orange-600 bg-orange-100 font-medium rounded-lg">Bedrijven</Link>
            <Link href="/favorieten" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium rounded-lg">Favorieten</Link>
            <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium rounded-lg">Contact</Link>
            <Link href="/login" class="px-4 py-2 text-orange-600 hover:text-orange-700 font-medium rounded-lg">Inloggen</Link>
          </div>
        </div>
      </div>
    </nav>

    <Head title="Alle Bedrijven - Pro" />

    <!-- Header Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="text-center mb-12">
        <h1 class="text-5xl lg:text-6xl font-bold bg-gradient-to-r from-gray-900 via-orange-600 to-red-600 bg-clip-text text-transparent mb-6">
          Ontdek jouw toekomstige werkgever
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
          Verken {{ bedrijven.length }} toonaangevende bedrijven die op zoek zijn naar talent zoals jij. 
          Filter op industrie, locatie en meer om jouw perfecte match te vinden.
        </p>
      </div>

      <!-- Search and Filter Bar -->
      <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 border border-orange-100">
        <div class="flex flex-col lg:flex-row gap-4 items-center">
          <!-- Search Input -->
          <div class="relative flex-1 w-full lg:w-auto">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Zoek bedrijven, specialisaties, technologieën..."
              class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200"
            />
          </div>

          <!-- Quick Filters -->
          <div class="flex flex-wrap gap-2 lg:gap-4">
            <select
              v-model="selectedIndustry"
              class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white"
            >
              <option v-for="industry in industries" :key="industry" :value="industry">
                {{ industry }}
              </option>
            </select>

            <select
              v-model="selectedLocation"
              class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white"
            >
              <option v-for="location in locations" :key="location" :value="location">
                {{ location }}
              </option>
            </select>

            <select
              v-model="sortBy"
              class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white"
            >
              <option value="naam">Sorteer op naam</option>
              <option value="industrie">Sorteer op industrie</option>
              <option value="locatie">Sorteer op locatie</option>
              <option value="grootte">Sorteer op grootte</option>
            </select>
          </div>

          <!-- View Toggle and Reset -->
          <div class="flex items-center gap-2">
            <div class="flex bg-gray-100 rounded-lg p-1">
              <button
                @click="viewMode = 'grid'"
                :class="['px-3 py-2 rounded-md transition-all', viewMode === 'grid' ? 'bg-white shadow-sm text-orange-600' : 'text-gray-600 hover:text-gray-900']"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
              </button>
              <button
                @click="viewMode = 'list'"
                :class="['px-3 py-2 rounded-md transition-all', viewMode === 'list' ? 'bg-white shadow-sm text-orange-600' : 'text-gray-600 hover:text-gray-900']"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
              </button>
            </div>

            <button
              @click="resetFilters"
              class="px-4 py-2 text-gray-600 hover:text-gray-900 transition-colors"
              title="Reset filters"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Results Summary -->
        <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
          <p class="text-gray-600">
            <span class="font-semibold text-gray-900">{{ filteredBedrijven.length }}</span> 
            {{ filteredBedrijven.length === 1 ? 'bedrijf gevonden' : 'bedrijven gevonden' }}
          </p>
          <p class="text-sm text-gray-500">
            Pagina {{ currentPage }} van {{ totalPages }}
          </p>
        </div>
      </div>
    </section>

    <!-- Companies Grid/List -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
      <!-- Loading State -->
      <div v-if="isLoading" class="flex justify-center items-center py-20">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-orange-600"></div>
      </div>

      <!-- Grid View -->
      <div v-else-if="viewMode === 'grid'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <div
          v-for="bedrijf in paginatedBedrijven"
          :key="bedrijf.id"
          class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 overflow-hidden"
        >
          <!-- Company Card Header -->
          <div class="relative p-6 bg-gradient-to-br from-gray-50 to-white">
            <!-- Favorite Button -->
            <button
              @click="toggleFavoriet(bedrijf)"
              :class="[
                'absolute top-4 right-4 w-12 h-12 rounded-xl flex items-center justify-center transition-all duration-300',
                isFavorite(bedrijf.id) 
                  ? 'bg-red-100 text-red-600 hover:bg-red-200' 
                  : 'bg-gray-100 text-gray-600 hover:bg-orange-100 hover:text-orange-600'
              ]"
            >
              <svg class="w-5 h-5" :fill="isFavorite(bedrijf.id) ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
              </svg>
            </button>

            <!-- Company Logo -->
            <div class="flex justify-center mb-4">
              <div class="w-20 h-20 bg-white rounded-2xl shadow-md flex items-center justify-center hover:shadow-lg transition-shadow cursor-pointer" @click="openModal(bedrijf)">
                <img
                  :src="bedrijf.src"
                  :alt="bedrijf.name"
                  class="max-w-16 max-h-16 object-contain"
                />
              </div>
            </div>

            <!-- Company Name -->
            <h3 class="text-xl font-bold text-gray-900 text-center mb-2 group-hover:text-orange-600 transition-colors cursor-pointer" @click="openModal(bedrijf)">
              {{ bedrijf.name }}
            </h3>

            <!-- Industry Tag -->
            <div class="flex justify-center mb-3">
              <span class="px-3 py-1 bg-orange-100 text-orange-600 text-sm font-medium rounded-full">
                {{ bedrijf.industry }}
              </span>
            </div>
          </div>

          <!-- Company Info -->
          <div class="p-6 pt-0">
            <!-- Specialization -->
            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
              {{ bedrijf.specialisatie }}
            </p>

            <!-- Company Details -->
            <div class="space-y-2 mb-4">
              <div class="flex items-center text-sm text-gray-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ bedrijf.location }}
              </div>
              <div class="flex items-center text-sm text-gray-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
                {{ bedrijf.employees }} medewerkers
              </div>
            </div>

            <!-- Tags -->
            <div class="flex flex-wrap gap-1 mb-4">
              <span
                v-for="tag in bedrijf.tags.slice(0, 3)"
                :key="tag"
                class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md"
              >
                {{ tag }}
              </span>
              <span v-if="bedrijf.tags.length > 3" class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md">
                +{{ bedrijf.tags.length - 3 }}
              </span>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-2">
              <button
                @click="openModal(bedrijf)"
                class="flex-1 bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition-colors font-medium"
              >
                Meer info
              </button>
              <a
                :href="bedrijf.website"
                target="_blank"
                class="px-4 py-2 border border-orange-600 text-orange-600 rounded-lg hover:bg-orange-50 transition-colors"
                title="Bezoek website"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- List View -->
      <div v-else class="space-y-4">
        <div
          v-for="bedrijf in paginatedBedrijven"
          :key="bedrijf.id"
          class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 p-6"
        >
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-6 flex-1">
              <!-- Company Logo -->
              <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center cursor-pointer" @click="openModal(bedrijf)">
                <img
                  :src="bedrijf.src"
                  :alt="bedrijf.name"
                  class="max-w-12 max-h-12 object-contain"
                />
              </div>

              <!-- Company Info -->
              <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                  <h3 class="text-xl font-bold text-gray-900 hover:text-orange-600 transition-colors cursor-pointer" @click="openModal(bedrijf)">
                    {{ bedrijf.name }}
                  </h3>
                  <span class="px-3 py-1 bg-orange-100 text-orange-600 text-sm font-medium rounded-full">
                    {{ bedrijf.industry }}
                  </span>
                </div>
                <p class="text-gray-600 mb-2 line-clamp-1">{{ bedrijf.specialisatie }}</p>
                <div class="flex items-center gap-4 text-sm text-gray-500">
                  <span>📍 {{ bedrijf.location }}</span>
                  <span>👥 {{ bedrijf.employees }} medewerkers</span>
                  <span>📅 Opgericht {{ bedrijf.founded }}</span>
                </div>
              </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3">
              <button
                @click="toggleFavoriet(bedrijf)"
                :class="[
                  'w-12 h-12 rounded-xl flex items-center justify-center transition-all duration-300',
                  isFavorite(bedrijf.id) 
                    ? 'bg-red-100 text-red-600 hover:bg-red-200' 
                    : 'bg-gray-100 text-gray-600 hover:bg-orange-100 hover:text-orange-600'
                ]"
              >
                <svg class="w-5 h-5" :fill="isFavorite(bedrijf.id) ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
              </button>
              <button
                @click="openModal(bedrijf)"
                class="px-6 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors font-medium"
              >
                Meer info
              </button>
              <a
                :href="bedrijf.website"
                target="_blank"
                class="p-2 border border-orange-600 text-orange-600 rounded-lg hover:bg-orange-50 transition-colors"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- No Results -->
      <div v-if="filteredBedrijven.length === 0" class="text-center py-20">
        <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47.881-6.086 2.291M12 15v2.25m0 0V19.5m0-2.25L9.75 19.5m2.25-2.25L14.25 19.5" />
        </svg>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Geen bedrijven gevonden</h3>
        <p class="text-gray-600 mb-4">Probeer je zoektermen te wijzigen of filters aan te passen</p>
        <button
          @click="resetFilters"
          class="px-6 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors font-medium"
        >
          Reset filters
        </button>
      </div>
    </section>

    <!-- Pagination -->
    <section v-if="totalPages > 1" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
      <div class="flex justify-center">
        <nav class="flex items-center space-x-1">
          <button
            @click="changePage(currentPage - 1)"
            :disabled="currentPage === 1"
            class="px-3 py-2 rounded-lg text-gray-500 hover:text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </button>

          <template v-for="page in totalPages" :key="page">
            <button
              v-if="page === 1 || page === totalPages || Math.abs(page - currentPage) <= 2"
              @click="changePage(page)"
              :class="[
                'px-4 py-2 rounded-lg font-medium transition-colors',
                page === currentPage
                  ? 'bg-orange-600 text-white'
                  : 'text-gray-700 hover:text-orange-600 hover:bg-orange-50'
              ]"
            >
              {{ page }}
            </button>
            <span v-else-if="Math.abs(page - currentPage) === 3" class="px-2 text-gray-400">...</span>
          </template>

          <button
            @click="changePage(currentPage + 1)"
            :disabled="currentPage === totalPages"
            class="px-3 py-2 rounded-lg text-gray-500 hover:text-gray-700 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </nav>
      </div>
    </section>

    <!-- Enhanced Modal -->
    <div
      v-if="showModal && geselecteerdBedrijf"
      class="fixed inset-0 z-50 overflow-y-auto"
      @click.self="closeModal"
    >
      <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" @click="closeModal"></div>

        <div class="relative bg-white rounded-3xl shadow-2xl max-w-4xl w-full transform transition-all">
          <!-- Modal Header -->
          <div class="relative bg-gradient-to-br from-orange-100 to-orange-200 px-8 py-6 rounded-t-3xl">
            <button
              @click="closeModal"
              class="absolute top-6 right-6 p-2 rounded-full bg-white/80 hover:bg-white text-gray-600 hover:text-gray-900 transition-all"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>

            <div class="flex items-center space-x-6">
              <div class="w-20 h-20 bg-white rounded-3xl shadow-lg flex items-center justify-center">
                <img
                  :src="geselecteerdBedrijf.src"
                  :alt="geselecteerdBedrijf.name"
                  class="max-w-16 max-h-16 object-contain"
                />
              </div>
              <div class="text-left">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ geselecteerdBedrijf.name }}</h2>
                <div class="flex items-center gap-3">
                  <span class="px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-full">
                    {{ geselecteerdBedrijf.industry }}
                  </span>
                  <span class="text-gray-600">{{ geselecteerdBedrijf.location }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Content -->
          <div class="px-8 py-6">
            <div class="grid md:grid-cols-2 gap-8">
              <!-- Left Column -->
              <div class="space-y-6">
                <div>
                  <h3 class="text-lg font-semibold text-gray-900 mb-3">Specialisatie</h3>
                  <p class="text-gray-600">{{ geselecteerdBedrijf.specialisatie }}</p>
                </div>

                <div>
                  <h3 class="text-lg font-semibold text-gray-900 mb-3">Over het bedrijf</h3>
                  <p class="text-gray-600 leading-relaxed">{{ geselecteerdBedrijf.beschrijving }}</p>
                </div>

                <div>
                  <h3 class="text-lg font-semibold text-gray-900 mb-3">Technologieën & Skills</h3>
                  <div class="flex flex-wrap gap-2">
                    <span
                      v-for="tag in geselecteerdBedrijf.tags"
                      :key="tag"
                      class="px-3 py-1 bg-blue-100 text-blue-600 text-sm rounded-full"
                    >
                      {{ tag }}
                    </span>
                  </div>
                </div>
              </div>

              <!-- Right Column -->
              <div class="space-y-6">
                <div>
                  <h3 class="text-lg font-semibold text-gray-900 mb-3">Bedrijfsinfo</h3>
                  <div class="space-y-3">
                    <div class="flex items-start">
                      <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                      <span class="text-gray-600">{{ geselecteerdBedrijf.adres }}</span>
                    </div>
                    <div class="flex items-center">
                      <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                      </svg>
                      <span class="text-gray-600">{{ geselecteerdBedrijf.telefoon || 'Niet beschikbaar' }}</span>
                    </div>
                    <div class="flex items-center">
                      <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                      </svg>
                      <span class="text-gray-600">{{ geselecteerdBedrijf.email || 'Niet beschikbaar' }}</span>
                    </div>
                    <div class="flex items-center">
                      <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                      </svg>
                      <span class="text-gray-600">{{ geselecteerdBedrijf.employees }} medewerkers</span>
                    </div>
                    <div class="flex items-center">
                      <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h3z" />
                      </svg>
                      <span class="text-gray-600">Opgericht in {{ geselecteerdBedrijf.founded }}</span>
                    </div>
                  </div>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6">
                  <h3 class="text-lg font-semibold text-gray-900 mb-4">Interesse?</h3>
                  <p class="text-gray-600 text-sm mb-4">
                    Voeg {{ geselecteerdBedrijf.name }} toe aan je favorieten en plan een gesprek tijdens de Career Launch!
                  </p>
                  <div class="flex gap-3">
                    <button
                      @click="toggleFavoriet(geselecteerdBedrijf)"
                      :class="[
                        'flex-1 px-4 py-2 rounded-lg font-medium transition-all',
                        geselecteerdBedrijf.favoriet
                          ? 'bg-yellow-100 text-yellow-700 border border-yellow-200'
                          : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                      ]"
                    >
                      <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.173 3.617a1 1 0 00.95.69h3.801c.969 0 1.371 1.24.588 1.81l-3.073 2.23a1 1 0 00-.364 1.118l1.173 3.617c.3.921-.755 1.688-1.54 1.118l-3.073-2.23a1 1 0 00-1.175 0l-3.073 2.23c-.784.57-1.838-.197-1.54-1.118l1.173-3.617a1 1 0 00-.364-1.118L2.536 9.044c-.783-.57-.38-1.81.588-1.81h3.801a1 1 0 00.95-.69l1.173-3.617z" />
                      </svg>
                      {{ geselecteerdBedrijf.favoriet ? 'Favoriet ✓' : 'Voeg toe aan favorieten' }}
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
              <button
                @click="closeModal"
                class="px-6 py-2 text-gray-600 hover:text-gray-900 transition-colors"
              >
                Sluiten
              </button>
              <a
                :href="geselecteerdBedrijf.website"
                target="_blank"
                class="px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors font-medium flex items-center"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                Bezoek website
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-orange-500 to-red-600 text-white py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8">
          <div>
            <div class="flex items-center space-x-3 mb-4">
              <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                <span class="text-white font-bold text-lg">E</span>
              </div>
              <div class="text-white font-bold text-xl">erasmus</div>
            </div>
            <p class="text-orange-100 text-sm mb-4">
              Hogeschool Brussel<br />
              Connecting talent with opportunity
            </p>
          </div>

          <div>
            <h4 class="font-semibold mb-4">Voor studenten</h4>
            <ul class="space-y-2 text-orange-100 text-sm">
              <li><Link href="/register?type=student" class="hover:text-white transition-colors">Maak je profiel</Link></li>
              <li><Link href="/info" class="hover:text-white transition-colors">Career Launch Info</Link></li>
              <li><Link href="/afspraak" class="hover:text-white transition-colors">Speeddate plannen</Link></li>
            </ul>
          </div>

          <div>
            <h4 class="font-semibold mb-4">Voor bedrijven</h4>
            <ul class="space-y-2 text-orange-100 text-sm">
              <li><Link href="/companies" class="hover:text-white transition-colors">Browse studenten</Link></li>
              <li><Link href="/contact" class="hover:text-white transition-colors">Partnership</Link></li>
            </ul>
          </div>

          <div>
            <h4 class="font-semibold mb-4">Support</h4>
            <ul class="space-y-2 text-orange-100 text-sm">
              <li><Link href="/contact" class="hover:text-white transition-colors">Contact</Link></li>
              <li><Link href="/privacy" class="hover:text-white transition-colors">Privacy beleid</Link></li>
            </ul>
          </div>
        </div>

        <div class="border-t border-orange-400 mt-12 pt-8 text-center text-orange-100 text-sm">
          <p>&copy; 2025 Erasmus Hogeschool Brussel. Alle rechten voorbehouden.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<style scoped>
.line-clamp-1 {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
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