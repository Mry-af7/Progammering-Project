<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref } from 'vue'

const mobileMenuOpen = ref(false)

const bedrijven = ref([
  {
    name: 'Accenture',
    src: '/images/logos/accenture-logo.svg',
    favoriet: false,
    website: 'https://www.accenture.com/be-en',
    specialisatie: 'Consulting, digitale transformatie, technologie en outsourcing',
    beschrijving: 'Accenture is een wereldwijd professioneel dienstverlenend bedrijf dat bedrijven helpt met strategie, technologie, consulting en digitale oplossingen. In België richt het zich op innovatie en het verbeteren van bedrijfsprocessen via cloud, AI en andere digitale technologieën.',
    adres: 'Boulevard de Waterloo 16, 1000 Brussel',
    telefoon: '+32 2 710 71 11',
    email: 'info.belgium@accenture.com'
  },
  {
    name: 'Acolad',
    src: '/images/logos/acolad-LOGO.png',
    favoriet: false,
    website: 'https://www.acolad.com/nl.html',
    specialisatie: 'Vertalingen, lokalisatie, content en multimedia‑diensten',
    beschrijving: 'Acolad is een wereldleider in technologiegestuurde lokalisatieservices en contentoplossingen, waaronder vertaling, transcreatie, copywriting, proofreading, tolkdiensten en AI‑gebaseerde contentdiensten',
    adres: 'Avenue du Port 86C, 1000 Brussel',
    telefoon: '+32 2 896 94 40',
    email: 'contact@acolad.com'
  },
  {
    name: 'Amista',
    src: '/images/logos/amista.png',
    favoriet: false,
    website: 'https://www.amista.com/nl/',
    specialisatie: 'SAP ERP, integratie & technologie, intelligente documentflows, digital learning',
    beschrijving: 'Amista is een toonaangevende IT‑consultant en softwareleverancier in de Benelux, met circa 250 medewerkers. Ze ondersteunen organisaties bij digitale transformatie via SAP‑implementaties (S/4HANA, Business One), integratieplatforms en slimme documentautomatisering, gecombineerd met opleidingen en change management',
    adres: 'Duwijckstraat 17, 2500 Lier',
    telefoon: '+32 56 76 09 00',
    email: 'sales@amista.com'
  },
  {
    name: 'ARHS GROUP',
    src: '/images/logos/arhs-LOGO.png',
    favoriet: false,
    website: 'https://www.arhs-group.com/about-us/',
    specialisatie: 'Softwareontwikkeling, data science, infrastructure services, digital trust, cloud & mobiele apps',
    beschrijving: 'Arηs Group is een onafhankelijke Europese IT-dienstenleverancier, opgericht in 2003 in Luxemburg. Met meer dan 2.500 consultants in 16 landen, waaronder België, richten ze zich op complexe softwareprojecten, datagedreven inzichten, infrastructuur, cybersecurity, AI en mobiele oplossingen—met een sterke focus op overheid en telecomsector',
    adres: 'Ikaroslaan 53, 1930 Zaventem',
    telefoon: '+352 26 11 02 1',
    email: 'info@arhs-dev.com'
  },
  {
    name: 'Avalon', 
    src: '/images/logos/avelon-LOGO.png', 
    favoriet: false,
    website: 'https://www.avelon.nl/#intro',
    specialisatie: 'SAP‑workflows, Procure‑to‑Pay, Master‑Data Governance, SIM/VIM, SAP Fiori',
    beschrijving: 'Avelon is een Nederlandse SAP‑specialist, actief sinds 2000. Ze helpen organisaties hun bedrijfsprocessen gebruiksvriendelijker, transparanter en efficiënter te maken. Met consultancy, turnkey‑oplossingen en eigen SAP‑add‑ons (zoals voor factuurbeheer, masterdata, e‑invoicing en workflow) optimaliseren ze P2P-processen in zowel ERP als S/4HANA omgevingen',
    adres: 'Orteliuslaan 9, 3528 BA Utrecht, Nederland',
    telefoon: '+31 30 767 0561',
    email: 'info@avelon.nl'
  },
  {
    name: 'Axxess', 
    src: '/images/logos/axxess.png', 
    favoriet: false,
    website: 'https://www.axxes.com/',
    specialisatie: 'IT‑consulting, software engineering, data, cloud, devops, QA, projectmanagement',
    beschrijving: 'Axxes is een full‑service IT‑adviesbureau, actief sinds 1998. Ze leveren expertise in softwareontwikkeling (.NET, Java, front‑end), infrastructuur, cloud, data en IT-projectmanagement. Ze staan bekend om hun mensen‑gerichte aanpak en “IT is about people”-cultuur.',
    adres: 'Entrepotkaai 10A, 2000 Antwerpen',
    telefoon: '+32 3 234 99 58',
    email: '///'
  }, 
  {
    name: 'Bizztalent',
    src: '/images/logos/bizztalent.png',
    favoriet: false,
    website: 'https://www.bizztalent.be/',
    specialisatie: 'IT‑consultancy, tijdelijke IT‑staffing, infrastructuuroplossingen',
    beschrijving: 'Bizztalent is een dynamisch Belgisch IT‑adviesbureau opgericht in 2012. Met meer dan 130 IT‑consultants verspreid over Antwerpen, Gent en Vilvoorde, bieden ze flexibele IT‑ondersteuning op projectbasis, van implementatie en migratie tot full support binnen grootschalige infrastructuuromgevingen. Ze zetten sterk in op welzijn, een go‑getter mentaliteit en klantgerichte dienstverlening',
    adres: 'Sluisweg 1/13, 9000 Gent',
    telefoon: '+32 3 689 14 91',
    email: 'info@bizztalent.be'
  },
  {
    name: 'Blents',
    src: '/images/logos/blents.png',
    favoriet: false,
    website: 'https://www.blents.be/careers/',
    specialisatie: 'Integratieconsulting, API Management, Boomi iPaaS, Master Data Management, B2B/EDI, event streams',
    beschrijving: 'Blents is sinds 2013 actief in integratie-oplossingen. Ze zijn gespecialiseerd in het helpen van organisaties bij het conecteren, integreren en automatiseren van hun IT-ecosystemen met platforms zoals Boomi. Ze combineren diepgaande technische kennis met businessinzicht om digitale transformaties te versnellen',
    adres: 'Duwijckstraat 17, 2500 Lier',
    telefoon: '+32 473 73 51 11',
    email: 'info@blents.be'
  },
  { 
    name: 'BNP Paribas', 
    src: '/images/logos/bnp-paribas-fortis-logo.svg', 
    favoriet: false,
    website: 'https://www.bnpparibasfortis.com/nl',
    specialisatie: 'Retail- & corporate banking, private banking, investerings- en verzekeringsdiensten',
    beschrijving: 'BNP Paribas Fortis is de grootste bank voor particulieren, bedrijven en privébanking in België. Ze bieden een breed scala aan financiële diensten aan, waaronder leningen, betalingen, vermogensbeheer, verzekeringen en kapitaalmarktoplossingen. Sinds 2009 is het een dochteronderneming van BNP Paribas en in 2024 nam het bpost bank volledig over, waardoor die klanten geïntegreerd zijn in hun netwerk',
    adres: 'Montagne du Parc 3 (Warandeberg 3), 1000 Brussel',
    telefoon: '+32 2 762 90 00',
    email: '///'
  },
  { 
    name: 'Capgemini', 
    src: '/images/logos/capgemini-logo.svg', 
    favoriet: false,
    website: 'https://www.capgemini.com/',
    specialisatie: 'IT-consulting, cloudoplossingen, digitale transformatie, engineering',
    beschrijving: 'Capgemini is een wereldwijd consultancybedrijf dat organisaties helpt bij hun digitale transformatie. Ze bieden IT-diensten aan zoals softwareontwikkeling, cloudoplossingen, kunstmatige intelligentie en bedrijfsstrategie. In België werken ze met klanten in zowel de publieke als private sector.',
    adres: 'Culliganlaan 3B, 1831 Diegem',
    telefoon: '+32 2 708 11 11',
    email: 'info.be@capgemini.com'
  },
  {
    name: 'Colibri Consulting',
    src: '/images/logos/colibri-LOGO-edit2.png', 
    favoriet: false,
    website: 'https://colibri.consulting/',
    specialisatie: 'ICT-netwerken & cybersecurity, projectconsultancy, managed services',
    beschrijving: 'Opgericht in 2007, is Colibri Consulting een kleine maar ervaren speler in Kessel‑Lo (Leuven). Ze bieden maatwerkadvies in netwerk- en securitydiensten, ondersteunen bij infrastructurele ICT-projecten en verzorgen doorlopende it‑ondersteuning via managed services. Hun focus: flexibel, persoonlijk en afgestemd op elke bedrijfscontext',
    adres: 'Martelarenlaan 50/601, 3010 Kessel‑Lo',
    telefoon: '///',
    email: 'info@colibri.consulting'
  },
  { 
    name: 'Colruyt Group', 
    src: '/images/logos/colruyt-group-logo.svg', 
    favoriet: false,
    website: 'https://www.colruytgroup.com/nl',
    specialisatie: 'Retail, supermarktketens, groothandel, energie, duurzame oplossingen',
    beschrijving: 'olruyt Group is een Belgisch familiebedrijf, opgericht in 1950, uitgegroeid tot een toonaangevende retailgroep met meer dan 33 000 medewerkers in België, Frankrijk en Luxemburg. Het omvat supermarktformules (Colruyt, OKay, Bio‑Planet), groothandel, energie‑diensten (DATS 24, Eoly), en activiteiten in printing, online apotheek, fitness en vastgoed',
    adres: 'Edingensesteenweg 196, 1500 Halle',
    telefoon: '+32 2 363 55 45',
    email: 'info@colruytgroup.com'
  },
  { 
    name: 'Delaware', 
    src: '/images/logos/delaware-logo.svg', 
    favoriet: false,
    website: 'https://www.delaware.pro/en-be/careers',
    specialisatie: 'IT-consulting, cloud- en ERP-oplossingen, digitale transformatie, SAP & Microsoft-technologieën',
    beschrijving: 'Delaware is een internationaal IT-adviesbureau met meer dan 4.700 specialisten in 19 landen. Ze begeleiden organisaties bij hun digitale transformatie en leveren oplossingen op het vlak van ERP, cloud, AI, data-analyse, CRM en supply chain',
    adres: 'Kapel ter Bede 86, 8500 Kortrijk',
    telefoon: '+32 56 27 44 44',
    email: 'info@delaware.pro'
  },
  {
    name: 'Dilaco',
    src: '/images/logos/dilaco.png',
    favoriet: false,
    website: 'https://www.dilaco.eu/nl/',
    specialisatie: 'IT‑consultancy, applicatiebeheer, netwerk & security, managed services',
    beschrijving: 'Dilaco is een ervaren Benelux IT-dienstverlener, actief sinds 1996, met ca. 200–500 medewerkers. Ze bieden IT‑consultancy, end‑user support, application management, (cyber)security en infrastructuuroplossingen. Dankzij hun focus op menselijke expertise en technologie zorgen ze voor stabiele, schaalbare en veilige IT-omgevingen bij klanten',
    adres: 'Leuvensesteenweg 325, 1932 Zaventem',
    telefoon: '+32 2 267 65 60',
    email: '///'
  },
  {
    name: 'Eezee IT',
    src: '/images/logos/eezee-IT.png',
    favoriet: false,
    website: 'https://eezee-it.com/nl_BE',
    specialisatie: 'https://eezee-it.com/nl_BE',
    beschrijving: 'Eezee‑IT is een Gold‑partner van Odoo sinds 2010 en één van België’s toonaangevende Odoo‑consultancybureaus. Ze bedienen retailers, distributie en merken met op maat gemaakte ERP‑oplossingen, omnichannelstrategieën en integraties. Ze combineerden meer dan 250 succesvolle projecten met snelle reactietijd (<4 u) en een klanttevredenheid van 4,8/5',
    adres: 'Avenue Edison 20, 1300 Wavre, Wallonië',
    telefoon: '+32 10 87 00 24',
    email: 'info@eezee‑it.com'
  },
  {
    name: 'Euricom',
    src: '/images/logos/euricom.png',
    favoriet: false,
    website: 'https://www.euri.com/?r=0',
    specialisatie: 'Software development (.NET, JavaScript), IT‑consulting, architectuur & cloudmigratie',
    beschrijving: 'Euricom is een Belgisch software-adviesbureau, actief sinds 1999 met meer dan 100 ‘Euricommers’. Ze bouwen maatwerk applicaties, adviseren in softwarearchitectuur, cloudmigratie, UX/UI, security en AI‑tooling. Bekend om hun hoogwaardige code, pragmatische aanpak en teamwork, ze dragen het Great Place to Work®‑label',
    adres: 'Blarenberglaan 3A, 2800 Mechelen',
    telefoon: '+32 15 26 24 40',
    email: 'info@euri.com'
  },
  {
    name: 'Equans', 
    src: '/images/logos/Equans-LOGO.png', 
    favoriet: false,
    website: 'https://jobs.equans.be/nl/',
    specialisatie: 'Multi‑technische services, energie‑ & industriële transities, facility management, digitale & ICT‑oplossingen',
    beschrijving: 'Equans is een Belgische dochteronderneming van het Bouygues‑conglomeraat, actief in multi‑technische installaties, energie‑transformatie, industriële oplossingen en digitale dienstverlening. Ze ondersteunen organisaties in sectoren zoals gebouwen, transport, netwerken en industrie met engineering, onderhoud, HVAC, automatisatie, elektriciteit, digitalisering en cybersecurity',
    adres: 'Koning Albert II‑laan 19, 1210 Brussel',
    telefoon: '+32 2 370 31 11',
    email: 'contact.belux@equans.com'
  },
  {
    name: 'Exclusive Networs', 
    src: 'images/logos/Exclusive-LOGO.png', 
    favoriet: false,
    website: 'https://www.exclusive-networks.com/be/',
    specialisatie: 'Cybersecurity-distributie, managed security services, cloud & beveiligingsprofessional services',
    beschrijving: 'Exclusive Networks is een wereldwijde distributeur gespecialiseerd in cybersecurity en cloud-oplossingen. Met ruim 43 vestigingen en aanwezig in meer dan 170 landen, biedt het bedrijf waardegedreven levering van beveiligingsproducten, managed services, consulting en flexibele financiering via zijn “as-a-service”-model',
    adres: 'A. Stocletlaan 202, 2570 Duffel',
    telefoon: '+32 15 30 55 10',
    email: 'info@exclusive-networks.be',
  },
  { 
    name: 'Flexso', 
    src: '/images/logos/flexo-logo.svg', 
    favoriet: false,
    website: 'https://www.flexso.com',
    specialisatie: 'SAP-advies & implementatie, cloud­beheer, AI-integratie, managed services',
    beschrijving: 'Flexso is een SAP Gold-partner sinds 2004 met meer dan 600 consultants. Ze leveren end‑to‑end oplossingen rond ERP, HR, supply chain, CRM, analytics en infrastructuur in België en naburige landen. Hun focus ligt op innovatie, lange termijn relaties en digitale transformatie.',
    adres: 'Prins Boudewijnlaan 24A, 2550 Kontich',
    telefoon: '+32 3 451 23 80',
    email: 'info@flexso.com'
  },
  {
    name: 'Gumption', 
    src: '/images/logos/Gumption-LOGO.png', 
    favoriet: false,
    website: 'https://www.gumption.eu/',
    specialisatie: 'Digitale transformatie, procesautomatisering, ICT‑infrastructuur, data‑gedreven strategie',
    beschrijving: 'Gumption is een innovatief ecosysteem van circa 18 start‑ups/scale‑ups en ruim 800 medewerkers in de Benelux. Ze werken via co‑creatie samen met klanten aan volledige digitale transformaties, van branding & customer experience tot infrastructuur en procesoptimalisatie',
    adres: 'Satenrozen 10, 2550 Kontich',
    telefoon: '+32 3 84 32 900',
    email: 'info@gumption.be'
  },
  { 
    name: 'Inetum', 
    src: '/images/logos/inetum-realdolmen-logo.svg', 
    favoriet: false, 
    website: 'https://www.inetum.com/en/belgium',
    specialisatie: 'IT‑consulting, digital services, cloud‑ & cybersecurity, ERP‑implementatie',
    beschrijving: 'Inetum is een Europese leider in digitale diensten, actief in 19 landen met 28 000 medewerkers en ongeveer 1 500 in België. Ze ondersteunen organisaties bij strategie, applicaties, infrastructuur, cloud, cybersecurity en AI, met focus op digitale transformatie en innovatie',
    adres: 'Bedrijvenlaan 4, 2800 Mechelen',
    telefoon: '+32 2 801 55 55',
    email: 'info.belgium@inetum.com'
  },
  {
    name: 'Nexios IT', 
    src: '/images/logos/nexios_it_ver2.png', 
    favoriet: false,
    website: 'https://www.nexiosit.com/',
    specialisatie: 'IT‑consulting, project sourcing, softwareontwikkeling (Java, .NET, front‑end), managed services',
    beschrijving: 'Nexios IT is een Belgische IT-consultingorganisatie (onderdeel van Nexios Consulting Group), actief sinds 2002. Ze leveren specialistische projectenourcing, kwaliteitsgerichte softwareontwikkeling en managed services, ondersteund door hun eigen IKM-testframework voor consultantkwalificatie',
    adres: 'Telecom Gardens, Medialaan 36, 1800 Vilvoorde',
    telefoon: '+32 2 270 47 33',
    email: 'info@nexiosIT.com'
  },
  {
    name: 'Nomios', 
    src: '/images/logos/NOMIOS.png', 
    favoriet: false,
    website: 'https://www.nomios.be/',
    specialisatie: 'Cybersecurity, netwerkoplossingen, managed & professional services',
    beschrijving: 'Nomios is een toonaangevende Europese specialist in cybersecurity en netwerkinfrastructuur. Ze ontwerpen, beveiligen en beheren digitale omgevingen met diensten zoals Managed Detection & Response, Zero‑Trust Architectuur, enterprise‑netwerkbeheer en technische consulting. Bij hen werken ruim 600 engineers wereldwijd, met ongeveer 20 vestigingen en 24/7 ondersteuning.',
    adres: 'Excelsiorlaan 89, 1930 Zaventem',
    telefoon: '+32 3 808 8888',
    email: 'info@nomios.be',
  },
  {
    name: 'Persolis',
    src: '/images/logos/persolis.png',
    favoriet: false,
    website: 'https://persolis.be/nl/over-ons/',
    specialisatie: 'SAP HCM & SuccessFactors consultancy, HR payroll ondersteuning',
    beschrijving: 'Persolis is een dynamische Belgische niche-speler met circa 40 specialisten in SAP HCM en SuccessFactors. Ze ondersteunen HR- en IT-teams bij het optimaliseren van payrollprocessen, onboarding en SAP HCM-implementaties. Hun klantenportfolio omvat grote organisaties zoals Belfius, Carrefour en ULB. Cultureel hechten ze veel belang aan teamgevoel (“work hard, play hard”) en professionele groei',
    adres: 'Rue du Panier Vert 70, 1400 Nivelles',
    telefoon: '///',
    email: '///'
  },
  { 
    name: 'Safran', 
    src: '/images/logos/Safran-LOGO.svg', 
    favoriet: false,
    website: 'https://www.safran-group.com/companies/safran-aircraft-engines',
    specialisatie: 'Luchtvaart- & ruimtevaarttechnologie, vliegtuigmotorenonderhoud, testfaciliteiten',
    beschrijving: 'Safran is een Frans technologiebedrijf dat wereldwijd toonaangevend is in onderdelen en systemen voor lucht- en ruimtevaart, defensie en beveiliging. In België werken ruim 1.500 medewerkers verspreid over sites in Luik, Brussel en Liers. Ze ontwikkelen onder andere testfaciliteiten en compressoronderdelen voor vliegtuigmotoren, en verzorgen onderhoud van CFM- en LEAP-1A/–1B‑motoren nabij Brussels Airport',
    adres: 'Brussels Airport – Building 24B, 1930 Zaventem',
    telefoon: '+32 2 790 45 00',
    email: 'cfm.csc@safrangroup.com'
  },
  {
    name: 'Simac', 
    src: '/images/logos/simac.svg', 
    favoriet: false,
    website: 'https://www.simac.be/nl/',
    specialisatie: 'Business management solutions, datacenter & connectivity, ICT‑integratie, IT staffing, IoT & Industrie 4.0, project‑based services',
    beschrijving: 'Simac ICT Belgium (onderdeel van Simac Techniek, sinds 1972 actief in de Benelux) is een strategische ICT‑integrator. Ze zorgen ervoor dat de ICT‑infrastructuur van bedrijven optimaal werkt en ondersteunen bij digitale transformatie met expertise in datacenters, netwerk, beveiliging, IoT, staffing en professionele services',
    adres: 'Industrieweg 8, B‑3001 Heverlee (Leuven/Heverlee)',
    telefoon: '+32 2 755 15 11',
    email: 'info@simac.be'
  },
  {
    name: 'Sopra Steria',
    src: '/images/logos/sopra-steria.png',
    favoriet: false,
    website: 'https://www.soprasteria.be/',
    specialisatie: 'Consulting & digitale transformatie, cybersecurity, data & cloud oplossingen, softwareontwikkeling, infrastructuurservices',
    beschrijving: 'Sopra Steria is een toonaangevend Europees IT-consultancy- en digitale dienstenbedrijf met circa 50 000 medewerkers wereldwijd. In België ondersteunen ze organisaties bij managementconsulting, cyberveiligheid, data-inzichten, cloudmigratie en softwareontwikkeling via 13 kantoren verspreid over Machelen, Brussel, Gent, Lummen en Louvain-la-Neuve',
    adres: 'Culliganlaan 3B, 1831 Machelen',
    telefoon: '+32 2 208 72 72',
    email: 'marketing.bnl@soprasteria.com; voor algemene vragen: contact-benelux@soprasteria.com'
  },
  {
    name: 'UZ-Brussel',
    src: '/images/logos/UZ-Brussel-logo.png',
    favoriet: false,
    website: 'https://www.uzbrussel.be/',
    specialisatie: 'Universitair ziekenhuis, spoedeisende hulp, materniteit & neonatologie, IVF & reproductieve geneeskunde, academisch onderzoek',
    beschrijving: 'UZ Brussel is het Nederlandstalige universitair ziekenhuis verbonden aan de Vrije Universiteit Brussel, gelegen op de Brussels Health Campus in Jette. Met bijna 5.000 medewerkers en 721 bedden biedt het uitgebreide zorg: acute spoed, gespecialiseerde kindzorg via het KidZ Health Castle, materniteit, vruchtbaarheidscentrum (Brussels IVF), en toonaangevend wetenschappelijk onderzoek',
    adres: 'Laarbeeklaan 101, 1090 Jette',
    telefoon: '+32 2 477 41 11',
    email: 'info@uzbrussel.be'
  },

  
])
const geselecteerdBedrijf = ref(null)
const showModal = ref(false)

function openModal(bedrijf) {
  geselecteerdBedrijf.value = bedrijf
  showModal.value = true
}

function closeModal() {
  showModal.value = false
  geselecteerdBedrijf.value = null
}
</script>

<template>
  <div class="min-h-screen bg-orange-50">
    <!-- Navigation -->
    <nav class="bg-orange-50/90 backdrop-blur-sm shadow-sm sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <!-- Logo -->
          <Link href="/" class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center shadow-lg">
              <span class="text-white font-bold text-lg">E</span>
            </div>
            <div>
              <div class="text-gray-900 font-bold text-xl">erasmus</div>
              <div class="text-xs text-gray-600 -mt-1">HOGESCHOOL BRUSSEL</div>
            </div>
          </Link>

          <!-- Mobile menu button -->
          <div class="md:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-gray-700 hover:bg-orange-100">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
          </div>

          <!-- Desktop Navigation Links -->
          <div class="hidden md:flex items-center space-x-1">
            <Link href="/" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Home</Link>
            <Link href="/info" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Info</Link>
            <Link href="/bedrijven" class="px-4 py-2 text-orange-600 bg-orange-100 rounded-lg font-medium transition-colors">Bedrijven</Link>
            <Link href="/favorieten" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Favorieten</Link>
            <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium transition-colors">Contact</Link>

            <div class="flex items-center ml-6">
              <Link href="/login" class="px-6 py-2 text-orange-600 hover:text-orange-700 font-medium transition-colors">Inloggen</Link>
            </div>
          </div>
        </div>

        <!-- Mobile menu -->
        <div v-show="mobileMenuOpen" class="md:hidden mt-4 pb-4 border-t border-orange-200">
          <div class="flex flex-col space-y-2 pt-4">
            <Link href="/" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Home</Link>
            <Link href="/info" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Info</Link>
            <Link href="/afspraak" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Afspraak</Link>
            <Link href="/favorieten" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Favorieten</Link>
            <Link href="/contact" class="px-4 py-2 text-gray-700 hover:text-orange-600 font-medium">Contact</Link>
            <Link href="/login" class="px-4 py-2 text-orange-600 hover:text-orange-700 font-medium">Inloggen</Link>
          </div>
        </div>
      </div>
    </nav>

    <Head title="Alle Bedrijven" />

    <!-- Pagina header -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
      <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Alle bedrijven</h1>
      <p class="text-gray-600 text-lg">Ontdek welke bedrijven op zoek zijn naar talent zoals jij</p>
    </section>

    <!-- Bedrijven grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
      <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-6 justify-items-center">
      <div
         v-for="bedrijf in bedrijven"
         :key="bedrijf.name"
         class="relative bg-white rounded-xl p-4 shadow-sm w-full h-24 flex items-center justify-center">
    
    <!-- ⭐ Sterretje rechtsboven -->
      <button
        @click="bedrijf.favoriet = !bedrijf.favoriet"
        class="absolute top-2 right-2">
        <svg
          :class="['w-5 h-5 transition-colors', bedrijf.favoriet ? 'text-yellow-400' : 'text-gray-300']"
          fill="currentColor"
          viewBox="0 0 20 20">

              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.173 3.617a1 1 0 00.95.69h3.801c.969 0 1.371 1.24.588 1.81l-3.073 2.23a1 1 0 00-.364 1.118l1.173 3.617c.3.921-.755 1.688-1.54 1.118l-3.073-2.23a1 1 0 00-1.175 0l-3.073 2.23c-.784.57-1.838-.197-1.54-1.118l1.173-3.617a1 1 0 00-.364-1.118L2.536 9.044c-.783-.57-.38-1.81.588-1.81h3.801a1 1 0 00.95-.69l1.173-3.617z" />
            </svg>
          </button>


      <!-- Bedrijfslogo (klikbaar om modal te openen) -->
      <img
          :src="bedrijf.src"
          :alt="bedrijf.name"
          :class="[
             'h-10 object-contain cursor-pointer',
             bedrijf.name === 'Avalon' ? 'scale-120' : '',
             bedrijf.name === 'Bizztalent' ? 'scale-150' : '',
             bedrijf.name === 'Dilaco' ? 'scale-70' : '',
             bedrijf.name === 'Eezee IT' ? 'scale-150' : '',
             bedrijf.name === 'Euricom' ? 'scale-230' : '',
             bedrijf.name === 'Gumption' ? 'scale-150' : '',
             bedrijf.name === 'Nomios' ? 'scale-70' : '',
             bedrijf.name === 'Simac' ? 'scale-150' : '',
             bedrijf.name === 'Sopra Steria' ? 'scale-150' : '',
             bedrijf.name === 'UZ-Brussel' ? 'scale-150' : '',
          ]"
          @click="openModal(bedrijf)"/>
    </div>
  </div>
</section>

    <!-- Modal overlay -->
    <div
      v-if="geselecteerdBedrijf"
      class="fixed inset-0 z-50 bg-black/10 flex items-center justify-center px-4"
    >
      <!-- Modal venster -->
      <div class="bg-gradient-to-br from-orange-100 to-orange-200 rounded-2xl shadow-xl max-w-xl w-full p-8 relative border border-orange-300">
        <!-- Sluitknop -->
        <button @click="closeModal" class="absolute top-4 right-4 text-orange-500 hover:text-orange-600 text-2xl font-bold">
          &times;
        </button>


        <!-- Header met logo en naam -->
        <div class="flex items-center space-x-4 mb-6">
        <!-- Logo met aparte achtergrondkleur -->
        <div class="w-14 h-14 bg-white rounded-xl shadow-md flex items-center justify-center">
          <img :src="geselecteerdBedrijf.src" :alt="geselecteerdBedrijf.name" class="w-10 h-10 object-contain" />
        </div>
        <h2 class="text-2xl font-bold text-orange-800">{{ geselecteerdBedrijf.name }}</h2>
      </div>


        <!-- Bedrijfsinformatie -->
        <ul class="space-y-2 text-sm text-orange-900">
          <li><strong>Specialisatie:</strong> {{ geselecteerdBedrijf.specialisatie || '—' }}</li>
          <li><strong>Beschrijving:</strong> {{ geselecteerdBedrijf.beschrijving || '—' }}</li>
          <li><strong>Adres:</strong> {{ geselecteerdBedrijf.adres || '—' }}</li>
          <li><strong>Telefoonnummer:</strong> {{ geselecteerdBedrijf.telefoon || '—' }}</li>
          <li><strong>Email-adres:</strong> {{ geselecteerdBedrijf.email || '—' }}</li>
        </ul>

    <!-- Website-link rechts onderaan -->
    <div class="flex justify-end mt-8">
    <a
         v-if="geselecteerdBedrijf.website"
         :href="geselecteerdBedrijf.website"
         class="text-orange-600 hover:text-orange-700 font-semibold underline text-sm"
         target="_blank">
    🌐 Ga naar website
    </a>
    </div>
  </div>
</div>



    <!-- Footer -->
    <footer class="bg-orange-500 text-white py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8">
          <div>
            <div class="flex items-center space-x-3 mb-4">
              <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center">
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
/* Add any custom styles here */
</style>
