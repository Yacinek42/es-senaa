<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Es-Senaa - Accueil</title>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
        
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <style>
            body { font-family: 'Open Sans', sans-serif; }
            .nav-link::after {
                display: block;
                content: attr(title);
                font-weight: 700;
                height: 0;
                overflow: hidden;
                visibility: hidden;
            }
            .scrollbar-hide::-webkit-scrollbar { display: none; }
            .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

            /* Animation pour le défilement infini */
            @keyframes loop-scroll {
                from { transform: translateX(0); }
                to { transform: translateX(-100%); }
            }
            .animate-loop-scroll {
                animation: loop-scroll 40s linear infinite;
            }
            .group:hover .animate-loop-scroll {
                animation-play-state: paused;
            }
        </style>
    </head>
    
    <body class="bg-white text-gray-900 antialiased overflow-x-hidden">

        <!-- ================= HEADER ================= -->
        <header class="bg-[#FCD34D] shadow-sm w-full h-[80px] flex items-center px-8 relative z-50">
            <div class="flex items-center gap-8">
                <a href="/" class="flex-shrink-0 block">
                    <img src="https://firebasestorage.googleapis.com/v0/b/consu-net.appspot.com/o/FTP%2FLogo%20couleur.png?alt=media&token=13ab4949-a55c-41fc-b8fd-469f9c502fff" 
                         alt="Logo Es-Senaa" class="w-[99px] h-[38px] object-contain ml-20">
                </a>
                <nav class="hidden md:flex items-center gap-6">
                    <a href="#" title="Spécialités et formations disponibles" class="nav-link text-[14px] text-gray-900 font-semibold hover:font-bold transition-all duration-200">Spécialités et formations disponibles</a>
                    <a href="#" title="Centres de formation" class="nav-link text-[14px] text-gray-900 font-semibold hover:font-bold transition-all duration-200">Centres de formation</a>
                    <a href="#" title="Annonces" class="nav-link text-[14px] text-gray-900 font-semibold hover:font-bold transition-all duration-200 ">Annonces</a>
                </nav>
            </div>
            <div class="hidden md:flex items-center ml-auto gap-4">
                <a href="{{ route('register') }}" class="px-4 py-2 rounded text-[14px] font-semibold text-gray-900 border-2 border-gray-900 hover:bg-white hover:text-[#F9D241] hover:border-white transition-colors duration-150 ease-in-out whitespace-nowrap">créer un compte</a>
                <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-900 rounded text-[14px] font-semibold text-white hover:bg-white hover:text-[#F9D241] transition ease-in-out duration-150 whitespace-nowrap">Se connecter</a>
                <button class="px-3 py-2 bg-gray-900 rounded text-[14px] font-semibold text-white hover:bg-white hover:text-[#F9D241] mr-20">Fr</button>
            </div>
            <div class="flex items-center md:hidden ml-auto">
                <button class="text-gray-900 focus:outline-none"><i class="fa-solid fa-bars text-2xl"></i></button>
            </div>
        </header>

        <!-- ================= HERO SECTION ================= -->
        <main class="w-full relative pt-12 pb-20 bg-[#FFFCF5]">
            <div class="max-w-[1400px] mx-auto px-0 flex flex-col md:flex-row items-center justify-between gap-2">
                <!-- Gauche -->
                <div class="flex flex-col items-center md:w-1/4 order-2 md:order-1 mt-8 md:mt-0">
                    <div class="relative w-52 h-60 rounded-full overflow-hidden border-4 border-white shadow-lg mb-6">
                        <img src="https://firebasestorage.googleapis.com/v0/b/consu-net.appspot.com/o/FTP%2FApprentis%20ecran%20d'accueil.png?alt=media&token=26d16d91-60f7-44ff-ac23-245620259b96" alt="Apprenti" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-bold text-center leading-tight">Fais ta formation dans<br>un CFPA ou INSFP</h3>
                </div>
                
                <!-- Centre -->
                <div class="flex flex-col items-center text-center md:w-2/4 order-1 md:order-2">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-[#222] mb-3">Inscrit au CFPA ou INSFP ?</h1>
                    <p class="text-xl text-[#333] mb-10">Trouvez des offres d'apprentissage en entreprise</p>
                    
                    <div class="flex flex-col md:flex-row items-center gap-3 w-full max-w-4xl">
                        
                        <!-- SELECT NIVEAU SCOLAIRE (Dynamique + Fallback) -->
                        <div class="relative w-full md:w-3/3">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fa-solid fa-graduation-cap text-gray-500"></i></div>
                            <select class="block w-full pl-10 pr-8 py-3 bg-white border-none rounded shadow-sm text-gray-700 focus:ring-2 focus:ring-yellow-400 appearance-none">
                                <option value="">Niveau scolaire</option>
                                @if(isset($niveaux) && count($niveaux) > 0)
                                    @foreach($niveaux as $niveau)
                                        <option value="{{ $niveau->id }}">{{ $niveau->Nom }}</option>
                                    @endforeach
                                @else
                                    <!-- LISTE DE SECOURS (Si pas de BDD) -->
                                    <option>Primaire</option>
                                    <option>1e Année Moyen</option>
                                    <option>2e Année Moyen</option>
                                    <option>3e Année Moyen</option>
                                    <option>4e Année Moyen</option>
                                    <option>1e Année Secondaire</option>
                                    <option>2e Année Secondaire</option>
                                    <option>3e Année Secondaire</option>
                                @endif
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                            </div>
                        </div>
                        
                        <!-- SELECT WILAYA (Dynamique + Fallback 58 Wilayas) -->
                        <div class="relative w-full md:w-2/3">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fa-solid fa-location-dot text-gray-500"></i></div>
                            <select class="block w-full pl-10 pr-8 py-3 bg-white border-none rounded shadow-sm text-gray-700 focus:ring-2 focus:ring-yellow-400 appearance-none">
                                <option value="">Wilaya</option>
                                @if(isset($wilayas) && count($wilayas) > 0)
                                    @foreach($wilayas as $wilaya)
                                        <option value="{{ $wilaya->id }}">{{ $wilaya->num }} - {{ $wilaya->wilaya }}</option>
                                    @endforeach
                                @else
                                    <!-- LISTE DE SECOURS COMPLETE (Si pas de BDD) -->
                                    @php
                                        $fallback_wilayas = [
                                            'Adrar', 'Chlef', 'Laghouat', 'Oum-El-Bouaghi', 'Batna', 'Béjaïa', 'Biskra', 'Béchar', 'Blida', 'Bouira',
                                            'Tamanrasset', 'Tébessa', 'Tlemcen', 'Tiaret', 'Tizi-Ouzou', 'Alger', 'Djelfa', 'Jijel', 'Sétif', 'Saida',
                                            'Skikda', 'Sidi-Bel-Abbès', 'Annaba', 'Guelma', 'Constantine', 'Médéa', 'Mostaganem', "M'Sila", 'Mascara', 
                                            'Ouargla', 'Oran', 'El-Bayadh', 'Illizi', 'Bordj-Bou-Arreridj', 'Boumerdès', 'El-Tarf', 'Tindouf', 'Tissemsilt',
                                            'El-Oued', 'Khenchela', 'Souk-Ahras', 'Tipaza', 'Mila', 'Aïn-Defla', 'Naâma', 'Aïn-Témouchent', 'Ghardaia', 'Relizane',
                                            'Timimoun', 'Bordj Badji Mokhtar', 'Ouled Djellal', 'Béni Abbès', 'In Salah', 'In Guezzam', 'Touggourt', 'Djanet', 'El M\'Ghair', 'El Meniaa'
                                        ];
                                    @endphp
                                    @foreach($fallback_wilayas as $index => $w_name)
                                        <option value="{{ $index + 1 }}">{{ $index + 1 }} - {{ $w_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                            </div>
                        </div>

                        <!-- Input Mots Clés -->
                        <div class="relative w-full md:w-3/3">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fa-solid fa-magnifying-glass text-gray-500"></i></div>
                            <input type="text" placeholder="Mots clés, spécialités" class="block w-full pl-10 pr-4 py-3 bg-white border-none rounded shadow-sm text-gray-700 focus:ring-2 focus:ring-yellow-400">
                        </div>
                        <button class="bg-[#222] hover:bg-[#fcd34d] text-white p-3 rounded shadow-md transition w-full md:w-auto flex justify-center items-center h-[46px] w-[46px]"><i class="fa-solid fa-magnifying-glass text-lg"></i></button>
                    </div>
                    
                    <div class="mt-8 text-sm font-semibold">vous êtes une entreprise ? <a href="#" class="underline decoration-2 hover:text-[#fcd34d]">Postez vos annonces</a></div>
                </div>
                
                <!-- Droite -->
                <div class="flex flex-col items-center md:w-1/4 order-3 mt-8 md:mt-0">
                    <div class="relative w-52 h-60 rounded-full overflow-hidden border-4 border-white shadow-lg mb-6">
                        <img src="https://firebasestorage.googleapis.com/v0/b/consu-net.appspot.com/o/FTP%2FEntreprise%20ecran%20d'accueil.png?alt=media&token=af2d417c-00f8-4bbd-a883-39302ee0b034" alt="Travailleur" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-bold text-center leading-tight">Fais ton apprentissage<br>dans une entreprise</h3>
                </div>
            </div>
        </main>

        <!-- ================= SECTION CAROUSEL ANNONCES ================= -->
        <section class="py-16 bg-white">
            <div class="max-w-[1400px] mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Explorez les annonces</h2>
                    <p class="text-lg text-gray-600">Plus de <span class="text-yellow-400 font-bold">50</span> annonces</p>
                </div>
                
                <div class="relative group px-4 md:px-12">
                    <button id="prev-btn" class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-[#222] text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-gray-800 transition shadow-lg hidden md:flex cursor-pointer"><i class="fa-solid fa-chevron-left"></i></button>
                    
                    <div id="carousel-container" class="flex gap-6 overflow-x-auto pb-8 scrollbar-hide snap-x snap-mandatory scroll-smooth">
                        
                        @php
                            $data = [
                                [
                                    'entreprise' => 'Tchin Lait',
                                    'poste' => 'Electrotechnique',
                                    'lieu' => 'Béjaïa, Akbou',
                                    'niveau' => '2e Année Secondaire',
                                    'debut' => '23/02/2025',
                                    'diplome' => 'BT',
                                    'duree' => '24 mois',
                                    'logo_text' => 'TL',
                                    'image' => 'https://placehold.co/400x300/e2e8f0/1e293b?text=Electrotechnique'
                                ],
                                [
                                    'entreprise' => 'Cevital',
                                    'poste' => 'Peinture vitrerie',
                                    'lieu' => 'Béjaïa, Akbou',
                                    'niveau' => '3e Année Secondaire',
                                    'debut' => '23/02/2025',
                                    'diplome' => 'BTS',
                                    'duree' => '30 mois',
                                    'logo_text' => 'CEV',
                                    'image' => 'https://placehold.co/400x300/f1f5f9/1e293b?text=Peinture'
                                ]
                            ];
                            // Duplication pour le carrousel (8 cartes)
                            $annonces = array_merge($data, $data, $data, $data);
                        @endphp

                        @foreach($annonces as $annonce)
                        <div class="min-w-[85vw] sm:min-w-[45vw] md:min-w-[calc(50%-12px)] lg:min-w-[calc(25%-18px)] bg-white rounded-xl shadow-lg border border-gray-100 snap-center flex-shrink-0 flex flex-col">
                            
                            <!-- Image -->
                            <div class="h-48 w-full bg-gray-200 rounded-t-xl relative overflow-hidden group-hover:opacity-90 transition">
                                <img src="{{ $annonce['image'] }}" alt="{{ $annonce['poste'] }}" class="w-full h-full object-cover">
                                <div class="absolute bottom-[-20px] left-6 bg-white p-1 rounded-lg shadow-md w-16 h-16 flex items-center justify-center border border-gray-100">
                                    <span class="font-bold text-gray-800">{{ $annonce['logo_text'] }}</span>
                                </div>
                            </div>
                            
                            <!-- Contenu -->
                            <div class="pt-10 px-6 pb-6 flex flex-col flex-grow">
                                <p class="text-sm text-gray-500 font-semibold mb-1">{{ $annonce['entreprise'] }}</p>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $annonce['poste'] }}</h3>
                                <div class="flex items-center text-gray-500 text-sm mb-4">
                                    <i class="fa-solid fa-location-dot mr-2 text-gray-400"></i> {{ $annonce['lieu'] }}
                                </div>
                                
                                <div class="space-y-2 text-sm text-gray-700 mb-6 bg-gray-50 p-4 rounded-lg">
                                    <div class="mb-2">
                                        <span class="font-bold text-gray-900 block">Niveau d'accès :</span>
                                        <span class="text-gray-600">{{ $annonce['niveau'] }}</span>
                                    </div>
                                    <div class="flex justify-between border-t border-gray-200 pt-2 mt-2">
                                        <span class="font-bold text-gray-900">Début du stage :</span>
                                        <span class="text-gray-600">{{ $annonce['debut'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-bold text-gray-900">Diplôme :</span>
                                        <span class="text-gray-600">{{ $annonce['diplome'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-bold text-gray-900">Durée :</span>
                                        <span class="text-gray-600">{{ $annonce['duree'] }}</span>
                                    </div>
                                </div>

                                <button class="mt-auto w-full bg-[#333] text-white py-3 rounded-lg font-semibold hover:bg-[#FCD34D] hover:text-gray-900 transition duration-200 shadow-md">Postuler</button>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <button id="next-btn" class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-[#222] text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-gray-800 transition shadow-lg hidden md:flex cursor-pointer"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
                
                <div class="flex justify-center gap-2 mt-4 mb-8">
                    <div class="w-8 h-2 bg-[#FCD34D] rounded-full"></div><div class="w-2 h-2 bg-gray-300 rounded-full"></div><div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                </div>
                <div class="text-center"><a href="#" class="inline-block bg-[#333] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#FCD34D] hover:text-gray-900 transition duration-200 shadow-md">Parcourir les annonces</a></div>
            </div>
        </section>

        <!-- ================= SECTION SPÉCIALITÉS (DÉFILEMENT INFINI) ================= -->
        <section class="py-16 bg-[#FFFCF5] overflow-hidden">
            <div class="max-w-[1400px] mx-auto px-4 text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#222] mb-3">Trouvez la spécialité qui vous convient</h2>
                <p class="text-xl text-[#333]">Près de <span class="border-b-2 border-[#222] font-bold">500</span> spécialités disponibles dans les CFPA et INSFP, dans tout le pays</p>
            </div>

            <div class="flex overflow-hidden w-full group relative">
                @php
                    $specialties = ['Informatique', 'Agriculture', 'Bâtiment', 'Tourisme', 'Artisanat', 'Électronique', 'Mécanique', 'Couture', 'Esthétique', 'Comptabilité', 'Restauration', 'Soudure'];
                @endphp

                <div class="flex gap-6 animate-loop-scroll flex-shrink-0 px-3">
                    @foreach($specialties as $spec)
                    <div class="w-[200px] h-[200px] flex-shrink-0 rounded-xl overflow-hidden shadow-md relative bg-gray-200">
                        <img src="https://placehold.co/400x400/e2e8f0/1e293b?text={{ $spec }}" 
                             class="w-full h-full object-cover transition transform hover:scale-105" 
                             alt="{{ $spec }}">
                    </div>
                    @endforeach
                </div>

                <!-- Duplication pour l'effet infini -->
                <div class="flex gap-6 animate-loop-scroll flex-shrink-0 px-3" aria-hidden="true">
                    @foreach($specialties as $spec)
                    <div class="w-[200px] h-[200px] flex-shrink-0 rounded-xl overflow-hidden shadow-md relative bg-gray-200">
                        <img src="https://placehold.co/400x400/e2e8f0/1e293b?text={{ $spec }}" 
                             class="w-full h-full object-cover transition transform hover:scale-105" 
                             alt="{{ $spec }}">
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="#" class="inline-block bg-[#222] text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-800 transition shadow-lg text-lg">
                    Consulter la liste des spécialités
                </a>
            </div>
        </section>

        <!-- ================= SECTION WILAYAS ================= -->
        <section class="py-16 bg-white">
            <div class="max-w-[1400px] mx-auto px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#222] mb-12">Annonces par wilaya</h2>
                
                <div class="flex flex-wrap justify-center gap-3 max-w-5xl mx-auto">
                    @php
                        // Liste statique pour les tags de bas de page (garantie d'affichage)
                        $local_wilayas = [
                            'Adrar', 'Chlef', 'Laghouat', 'Oum-El-Bouaghi', 'Batna', 'Béjaïa', 'Biskra', 'Béchar', 'Blida', 'Bouira',
                            'Tamanrasset', 'Tébessa', 'Tlemcen', 'Tiaret', 'Tizi-Ouzou', 'Alger', 'Djelfa', 'Jijel', 'Sétif', 'Saida',
                            'Skikda', 'Sidi-Bel-Abbès', 'Annaba', 'Guelma', 'Constantine', 'Médéa', 'Mostaganem', "M'Sila", 'Mascara', 
                            'Ouargla', 'Oran', 'El-Bayadh', 'Illizi', 'Bordj-Bou-Arreridj', 'Boumerdès', 'El-Tarf', 'Tindouf', 'Tissemsilt',
                            'El-Oued', 'Khenchela', 'Souk-Ahras', 'Tipaza', 'Mila', 'Aïn-Defla', 'Naâma', 'Aïn-Témouchent', 'Ghardaia', 'Relizane'
                        ];
                    @endphp

                    @foreach($local_wilayas as $w_name)
                    <a href="#" class="bg-[#FCD34D] hover:bg-[#282825] hover:text-[#FCD34D] text-gray-900 px-4 py-2 rounded-lg font-medium text-base transition shadow-sm">
                        {{ $w_name }} (1)
                    </a>
                    @endforeach
                </div>
            </div>
            
            <div class="fixed bottom-8 right-8 z-40">
                <a href="#" class="bg-[#FCD34D] w-12 h-12 flex items-center justify-center rounded-lg shadow-lg hover:bg-[#ffe182] transition">
                    <i class="fa-solid fa-arrow-up text-gray-900 text-xl"></i>
                </a>
            </div>
        </section>

        <!-- ================= FOOTER ================= -->
        <footer class="bg-[#222222] text-white pt-16 pb-8">
            <div class="max-w-[1400px] mx-auto px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                    
                    <!-- Colonne 1: Logo & À propos -->
                    <div class="col-span-1 md:col-span-1">
                        <img src="https://firebasestorage.googleapis.com/v0/b/consu-net.appspot.com/o/FTP%2FLogo%20monochrome.png?alt=media&token=c0178548-da11-4977-97f8-38c312409c1e" 
                             alt="Logo Es-Senaa Blanc" class="w-32 mb-6 opacity-90">
                        <h4 class="font-bold text-lg mb-4 uppercase text-gray-100">À PROPOS DE NOUS</h4>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            La plateforme es-senaa.com permet de recenser les besoins métiers des entreprises et proposer aux jeunes des postes en apprentissage, en fonction des spécialités disponibles.
                        </p>
                    </div>

                    <!-- Colonne 2: Pour Vous -->
                    <div>
                        <h4 class="font-bold text-lg mb-6 uppercase text-gray-100">POUR VOUS</h4>
                        <ul class="space-y-3 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-[#FCD34D] transition">Annonces par wilaya</a></li>
                            <li><a href="#" class="hover:text-[#FCD34D] transition">Centres de formation</a></li>
                            <li><a href="#" class="hover:text-[#FCD34D] transition">Spécialités disponibles</a></li>
                            <li><a href="#" class="hover:text-[#FCD34D] transition">Création de compte</a></li>
                        </ul>
                    </div>

                    <!-- Colonne 3: Contact -->
                    <div>
                        <h4 class="font-bold text-lg mb-6 uppercase text-gray-100">CONTACT INFO</h4>
                        <ul class="space-y-3 text-sm text-gray-400">
                            <li><a href="mailto:contact@es-senaa.com" class="hover:text-[#FCD34D] transition">contact@es-senaa.com</a></li>
                            <li><a href="mailto:admin@es-senaa.com" class="hover:text-[#FCD34D] transition">admin@es-senaa.com</a></li>
                        </ul>
                    </div>

                    <!-- Colonne 4: Liens Externes -->
                    <div>
                        <h4 class="font-bold text-lg mb-6 uppercase text-gray-100">LIENS UTILES</h4>
                        <ul class="space-y-3 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-[#FCD34D] transition">Ministère de la Formation professionnelle</a></li>
                            <li><a href="#" class="hover:text-[#FCD34D] transition">Nomenclature des Branches</a></li>
                            <li><a href="#" class="hover:text-[#FCD34D] transition">Takwin</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Barre de copyright -->
                <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                    <p>2024 Tous les droits sont réservés | es-senaa</p>
                    <div class="flex space-x-4 mt-4 md:mt-0">
                        <a href="#" class="bg-white text-[#222] w-8 h-8 rounded-full flex items-center justify-center hover:bg-[#FCD34D] transition"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="bg-white text-[#222] w-8 h-8 rounded-full flex items-center justify-center hover:bg-[#FCD34D] transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="bg-white text-[#222] w-8 h-8 rounded-full flex items-center justify-center hover:bg-[#FCD34D] transition"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- SCRIPT CAROUSEL -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('carousel-container');
                const prevBtn = document.getElementById('prev-btn');
                const nextBtn = document.getElementById('next-btn');

                if (container && prevBtn && nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        const cardWidth = container.firstElementChild.getBoundingClientRect().width;
                        container.scrollBy({ left: cardWidth + 24, behavior: 'smooth' });
                    });
                    prevBtn.addEventListener('click', () => {
                        const cardWidth = container.firstElementChild.getBoundingClientRect().width;
                        container.scrollBy({ left: -(cardWidth + 24), behavior: 'smooth' });
                    });
                }
            });
        </script>

    </body>
</html>