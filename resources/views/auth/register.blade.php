<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Es-Senaa - Inscription</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { font-family: 'Open Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white min-h-screen flex flex-col items-center justify-center p-4">

    <!-- 1. CHARGEMENT DES DONNÉES INITIALES (PHP) -->
    @php
        $niveaux = [];
        $wilayas = [];
        try {
            if(class_exists('App\Models\NiveauScolaire')) {
                $niveaux = \App\Models\NiveauScolaire::all();
            }
            if(class_exists('App\Models\Wilaya')) {
                // On récupère les wilayas triées par leur numéro (1-58)
                $wilayas = \App\Models\Wilaya::orderBy('num')->get();
            }
        } catch(\Exception $e) {
            // Silence en cas d'erreur de base de données
        }
        
        // Liste de secours pour les Wilayas (identique à l'accueil)
        $fallback_wilayas = [
            'Adrar', 'Chlef', 'Laghouat', 'Oum-El-Bouaghi', 'Batna', 'Béjaïa', 'Biskra', 'Béchar', 'Blida', 'Bouira',
            'Tamanrasset', 'Tébessa', 'Tlemcen', 'Tiaret', 'Tizi-Ouzou', 'Alger', 'Djelfa', 'Jijel', 'Sétif', 'Saida',
            'Skikda', 'Sidi-Bel-Abbès', 'Annaba', 'Guelma', 'Constantine', 'Médéa', 'Mostaganem', "M'Sila", 'Mascara', 
            'Ouargla', 'Oran', 'El-Bayadh', 'Illizi', 'Bordj-Bou-Arreridj', 'Boumerdès', 'El-Tarf', 'Tindouf', 'Tissemsilt',
            'El-Oued', 'Khenchela', 'Souk-Ahras', 'Tipaza', 'Mila', 'Aïn-Defla', 'Naâma', 'Aïn-Témouchent', 'Ghardaia', 'Relizane',
            'Timimoun', 'Bordj Badji Mokhtar', 'Ouled Djellal', 'Béni Abbès', 'In Salah', 'In Guezzam', 'Touggourt', 'Djanet', 'El M\'Ghair', 'El Meniaa'
        ];
    @endphp

    <!-- En-tête avec Logo -->
    <div class="mb-8 text-center">
        <a href="/">
            <img src="https://firebasestorage.googleapis.com/v0/b/consu-net.appspot.com/o/FTP%2FLogo%20couleur.png?alt=media&token=13ab4949-a55c-41fc-b8fd-469f9c502fff" 
                 alt="Es-Senaa" class="h-16 mx-auto">
        </a>
    </div>

    <!-- 
        APPLICATION ALPINE.JS
    -->
    <div x-data="{ 
            step: 1, 
            role: '', 
            birthYear: '',
            password: '', 
            showTutor: false,
            
            // Listes dynamiques pour l'utilisateur principal
            dairas: [], 
            communes: [],

            // Listes dynamiques pour le tuteur
            tuteurDairas: [], 
            tuteurCommunes: [],
            
            // Navigation
            nextStep() { this.step++ },
            prevStep() { this.step-- },

            // --- API: Charger Dairas/Communes Utilisateur ---
            fetchDairas(event) {
                let wilayaId = event.target.value;
                this.dairas = []; this.communes = []; // Reset
                if(wilayaId) {
                    fetch(`/api/dairas/${wilayaId}`)
                        .then(r => r.json())
                        .then(data => this.dairas = data)
                        .catch(e => console.error(e));
                }
            },
            fetchCommunes(event) {
                let dairaId = event.target.value;
                this.communes = []; // Reset
                if(dairaId) {
                    fetch(`/api/communes/${dairaId}`)
                        .then(r => r.json())
                        .then(data => this.communes = data)
                        .catch(e => console.error(e));
                }
            },

            // --- API: Charger Dairas/Communes Tuteur ---
            fetchTuteurDairas(event) {
                let wilayaId = event.target.value;
                this.tuteurDairas = []; this.tuteurCommunes = [];
                if(wilayaId) {
                    fetch(`/api/dairas/${wilayaId}`)
                        .then(r => r.json())
                        .then(data => this.tuteurDairas = data);
                }
            },
            fetchTuteurCommunes(event) {
                let dairaId = event.target.value;
                this.tuteurCommunes = [];
                if(dairaId) {
                    fetch(`/api/communes/${dairaId}`)
                        .then(r => r.json())
                        .then(data => this.tuteurCommunes = data);
                }
            }
         }" 
         class="w-full max-w-4xl bg-white rounded-2xl p-4 md:p-8" x-cloak>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="role" x-model="role">

            <!-- ================= ÉTAPE 1 : CHOIX DU PROFIL ================= -->
            <div x-show="step === 1" x-transition.opacity>
                <h1 class="text-3xl font-extrabold text-center text-gray-900 mb-16">Vous êtes</h1>

                <div class="flex flex-col md:flex-row justify-center items-center gap-16 md:gap-32">
                    <!-- Apprenti -->
                    <div class="group cursor-pointer flex flex-col items-center" @click="role = 'apprenti'; nextStep()">
                        <div class="relative w-48 h-48 rounded-full overflow-hidden border-4 border-white shadow-xl group-hover:border-[#FCD34D] transition duration-300 transform group-hover:scale-105">
                            <img src="https://firebasestorage.googleapis.com/v0/b/consu-net.appspot.com/o/FTP%2FApprentis%20ecran%20d'accueil.png?alt=media&token=26d16d91-60f7-44ff-ac23-245620259b96" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-[#FCD34D] opacity-0 group-hover:opacity-20 transition duration-300"></div>
                        </div>
                        <h3 class="mt-8 text-2xl font-bold text-gray-800 group-hover:text-[#FCD34D] transition">Un apprenti</h3>
                    </div>

                    <!-- Entreprise -->
                    <div class="group cursor-pointer flex flex-col items-center" @click="role = 'entreprise'; nextStep()">
                        <div class="relative w-48 h-48 rounded-full overflow-hidden border-4 border-white shadow-xl group-hover:border-[#FCD34D] transition duration-300 transform group-hover:scale-105">
                            <img src="https://firebasestorage.googleapis.com/v0/b/consu-net.appspot.com/o/FTP%2FEntreprise%20Ecran%20dinscription.png?alt=media&token=daab813d-ca0d-46f1-bdc9-3e4df1f54c3a" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-[#FCD34D] opacity-0 group-hover:opacity-20 transition duration-300"></div>
                        </div>
                        <h3 class="mt-8 text-2xl font-bold text-gray-800 group-hover:text-[#FCD34D] transition">Une entreprise</h3>
                    </div>
                </div>
            </div>

            <!-- ================= ÉTAPE 2 : CRÉATION DE COMPTE ================= -->
            <div x-show="step === 2" class="max-w-md mx-auto">
                <button type="button" @click="prevStep()" class="mb-4 text-gray-900 hover:text-[#FCD34D] transition"><i class="fa-solid fa-arrow-left text-xl"></i></button>
                
                <h2 class="text-3xl font-extrabold text-center text-gray-900 mb-8">Création de compte</h2>

                <div class="space-y-4">
                    <!-- Email -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-900"><i class="fa-solid fa-envelope"></i></div>
                        <input type="email" name="email" required placeholder="Email" class="block w-full pl-10 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]">
                    </div>

                    <!-- Téléphone -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-900"><i class="fa-solid fa-phone"></i></div>
                        <input type="tel" name="phone" placeholder="Téléphone" class="block w-full pl-10 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]">
                    </div>

                    <!-- Mot de passe -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-900"><i class="fa-solid fa-lock"></i></div>
                        <input type="password" name="password" x-model="password" required placeholder="Mot de passe" class="block w-full pl-10 pr-10 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"><i class="fa-solid fa-eye text-gray-400"></i></div>
                    </div>

                    <!-- Confirmation automatique -->
                    <input type="hidden" name="password_confirmation" x-bind:value="password">

                    <!-- Bouton SUIVANT -->
                    <button type="button" @click="nextStep()" class="w-full bg-[#222] text-white font-bold py-3 rounded-lg hover:bg-black transition duration-200 shadow-lg cursor-pointer flex justify-center items-center mt-6">
                        S'inscrire
                    </button>

                    <!-- CGU -->
                    <div class="flex items-start mt-4">
                        <input id="cgu" type="checkbox" class="mt-1 w-4 h-4 border-gray-300 rounded text-yellow-400 focus:ring-yellow-400">
                        <label for="cgu" class="ml-2 text-xs text-gray-600">J'ai lu et j'accepte les CGU et la politique de protection des données.</label>
                    </div>

                    <div class="relative flex py-2 items-center"><div class="flex-grow border-t border-gray-300"></div><span class="flex-shrink-0 mx-4 text-gray-500 text-sm">OU</span><div class="flex-grow border-t border-gray-300"></div></div>

                    <!-- Socials -->
                    <div class="space-y-3">
                        <button type="button" class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#1877F2] hover:bg-blue-700">
                            <i class="fa-brands fa-facebook-f mr-3"></i> Continue with Facebook
                        </button>
                        <button type="button" class="w-full flex justify-center items-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5 mr-3"> Continue with Google
                        </button>
                        <button type="button" class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-900">
                            <i class="fa-brands fa-tiktok mr-3"></i> Continue with TikTok
                        </button>
                    </div>
                </div>
            </div>

            <!-- ================= ÉTAPE 3 : INFORMATIONS PERSONNELLES ================= -->
            <div x-show="step === 3" class="max-w-2xl mx-auto pb-10">
                <button type="button" @click="prevStep()" class="mb-6 text-gray-900 hover:text-[#FCD34D] transition"><i class="fa-solid fa-arrow-left text-2xl"></i></button>
                
                <h2 class="text-3xl font-extrabold text-center text-gray-900 mb-8">informations personnelles</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <input type="text" name="name" placeholder="Nom et Prénom" class="block w-full pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]">
                    <input type="text" name="name_ar" placeholder="الإسم واللقب بالعربية" class="block w-full pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D] text-right" dir="rtl">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <input type="text" name="birth_place" placeholder="Lieu de naissance" class="block w-full pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]">
                    <div class="flex gap-2">
                        <select class="block w-1/3 px-1 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]"><option>Jours</option>@for($i=1;$i<=31;$i++)<option>{{$i}}</option>@endfor</select>
                        <select class="block w-1/3 px-1 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]"><option>Mois</option>@foreach(['Jan','Fév','Mar','Avr','Mai','Juin','Juil','Août','Sep','Oct','Nov','Déc'] as $m)<option>{{$m}}</option>@endforeach</select>
                        <select class="block w-1/3 px-1 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]" x-model="birthYear"><option value="">Années</option>@for($i=2024;$i>=1950;$i--)<option>{{$i}}</option>@endfor</select>
                    </div>
                </div>

                <div class="mb-4">
                    <span class="font-bold text-gray-900 mr-4">Sexe* :</span>
                    <label class="inline-flex items-center mr-6 cursor-pointer"><input type="radio" name="sexe" value="homme" class="w-5 h-5 text-black border-gray-300 focus:ring-black"><span class="ml-2 text-gray-700">Homme</span></label>
                    <label class="inline-flex items-center cursor-pointer"><input type="radio" name="sexe" value="femme" class="w-5 h-5 text-black border-gray-300 focus:ring-black"><span class="ml-2 text-gray-700">Femme</span></label>
                </div>

                <div class="mb-6">
                    <input type="text" name="address" placeholder="Adresse de résidence" class="block w-full pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]">
                </div>

                <!-- TRIGGER TUTEUR LEGAL -->
                <div class="mb-8">
                    <h3 class="font-bold text-gray-900 mb-1">Tuteur Légal</h3>
                    <p @click="showTutor = !showTutor" class="text-sm text-red-500 font-medium cursor-pointer hover:underline select-none">
                        Si vous avez moins de 18 ans , vous devez renseigner les coordonnées de votre Tuteur légal. 
                        <span class="text-xs ml-2 text-gray-400" x-text="showTutor ? '(Cliquez pour masquer)' : '(Cliquez pour dérouler)'"></span>
                    </p>
                </div>

                <!-- ACCORDEON TUTEUR (DYNAMIQUE + FALLBACK) -->
                <div x-show="showTutor" x-transition class="border-t-2 border-[#FCD34D] pt-6 mt-4 mb-8">
                    <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">informations personnelles du tuteur légal</h2>
                    <div class="space-y-4">
                        <input type="text" name="tuteur_nom" placeholder="Nom et Prénom" class="block w-full pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]">
                        <input type="text" name="tuteur_adresse" placeholder="Adresse de résidence" class="block w-full pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]">
                        
                        <div class="flex flex-wrap gap-2">
                            <!-- Wilaya Tuteur -->
                            <select name="tuteur_wilaya" @change="fetchTuteurDairas($event)" class="block flex-1 pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]">
                                <option value="">Wilaya</option>
                                @if(isset($wilayas) && count($wilayas) > 0)
                                    @foreach($wilayas as $wilaya)
                                        <option value="{{ $wilaya->id }}">{{ $wilaya->num }} - {{ $wilaya->wilaya }}</option>
                                    @endforeach
                                @else
                                    @foreach($fallback_wilayas as $index => $w_name)
                                        <option value="{{ $index + 1 }}">{{ $index + 1 }} - {{ $w_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            
                            <!-- Daira Tuteur -->
                            <select name="tuteur_daira" @change="fetchTuteurCommunes($event)" class="block flex-1 pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]">
                                <option value="">Daira</option>
                                <template x-for="d in tuteurDairas" :key="d.id"><option :value="d.id" x-text="d.daira"></option></template>
                            </select>
                            
                            <!-- Commune Tuteur -->
                            <select name="tuteur_commune" class="block flex-1 pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]">
                                <option value="">Commune</option>
                                <template x-for="c in tuteurCommunes" :key="c.id"><option :value="c.id" x-text="c.commune"></option></template>
                            </select>
                            
                            <select name="tuteur_codepostal" class="block flex-1 pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]"><option>Code postal</option></select>
                        </div>
                        
                        <div class="flex gap-4">
                            <input type="email" name="tuteur_email" placeholder="Adresse mail" class="block flex-1 pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]">
                            <input type="tel" name="tuteur_phone" placeholder="Téléphone" class="block flex-1 pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D]">
                        </div>
                    </div>
                </div>

                <div class="flex justify-center">
                    <button type="button" @click="nextStep()" class="bg-[#222] text-white font-bold py-3 px-12 rounded-lg hover:bg-black transition duration-200 shadow-lg cursor-pointer">
                        Suivant
                    </button>
                </div>
            </div>

            <!-- ================= ÉTAPE 4 : NIVEAU SCOLAIRE ================= -->
            <div x-show="step === 4" class="max-w-lg mx-auto text-center">
                <button type="button" @click="prevStep()" class="absolute left-8 top-8 text-gray-900 hover:text-[#FCD34D] transition"><i class="fa-solid fa-arrow-left text-2xl"></i></button>
                
                <h2 class="text-3xl font-extrabold text-gray-900 mb-12 mt-8">Votre niveau scolaire</h2>

                <div class="mb-8">
                    <!-- CONNEXION BDD NIVEAUX + FALLBACK -->
                    <select name="niveau_scolaire" class="block w-full pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D] focus:border-transparent text-center">
                        <option value="">Votre niveau scolaire</option>
                        @if(isset($niveaux) && count($niveaux) > 0)
                            @foreach($niveaux as $niveau)
                                <option value="{{ $niveau->id }}">{{ $niveau->Nom }}</option>
                            @endforeach
                        @else
                            <option>4e Année Moyen</option>
                            <option>1e Année Secondaire</option>
                            <option>2e Année Secondaire</option>
                            <option>3e Année Secondaire</option>
                        @endif
                    </select>
                </div>

                <button type="button" @click="nextStep()" class="bg-[#222] text-white font-bold py-3 px-16 rounded-lg hover:bg-black transition duration-200 shadow-lg cursor-pointer">
                    Suivant
                </button>
            </div>

            <!-- ================= ÉTAPE 5 : WILAYA (FIN) ================= -->
            <div x-show="step === 5" class="max-w-lg mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-12 mt-8">Choisissez Votre wilaya</h2>

                <div class="space-y-4 mb-8">
                    <!-- WILAYA (CONNEXION BDD + AJAX + FALLBACK) -->
                    <select name="wilaya" @change="fetchDairas($event)" class="block w-full pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D] focus:border-transparent">
                        <option value="">Wilaya</option>
                        @if(isset($wilayas) && count($wilayas) > 0)
                            @foreach($wilayas as $wilaya)
                                <option value="{{ $wilaya->id }}">{{ $wilaya->num }} - {{ $wilaya->wilaya }}</option>
                            @endforeach
                        @else
                            @foreach($fallback_wilayas as $index => $w_name)
                                <option value="{{ $index + 1 }}">{{ $index + 1 }} - {{ $w_name }}</option>
                            @endforeach
                        @endif
                    </select>

                    <!-- DAIRA (AJAX) -->
                    <select name="daira" @change="fetchCommunes($event)" class="block w-full pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D] focus:border-transparent">
                        <option value="">Daira</option>
                        <template x-for="d in dairas" :key="d.id">
                            <option :value="d.id" x-text="d.daira"></option>
                        </template>
                    </select>

                    <!-- COMMUNE (AJAX) -->
                    <select name="commune" class="block w-full pl-4 pr-3 py-3 border border-[#FCD34D] rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#FCD34D] focus:border-transparent">
                        <option value="">Commune</option>
                        <template x-for="c in communes" :key="c.id">
                            <option :value="c.id" x-text="c.commune"></option>
                        </template>
                    </select>
                </div>

                <!-- BOUTON TERMINER -->
                <button type="submit" class="bg-[#222] text-white font-bold py-3 px-16 rounded-lg hover:bg-black transition duration-200 shadow-lg cursor-pointer">
                    Terminer
                </button>
            </div>

        </form>
    </div>

</body>
</html>