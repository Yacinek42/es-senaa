<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Es-Senaa - Connexion</title>

    <!-- Chargement des styles (Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Police Open Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { font-family: 'Open Sans', sans-serif; }
    </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center">

    <div class="w-full h-screen flex overflow-hidden">
        
        <!-- PARTIE GAUCHE : FORMULAIRE -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center p-8 md:p-12 bg-white relative z-10">
            
            <!-- Logo -->
            <div class="mb-8">
                <a href="/">
                    <img src="https://firebasestorage.googleapis.com/v0/b/consu-net.appspot.com/o/FTP%2FLogo%20couleur.png?alt=media&token=13ab4949-a55c-41fc-b8fd-469f9c502fff" 
                         alt="Es-Senaa Logo" class="h-16 w-auto">
                </a>
            </div>

            <!-- Titres -->
            <h1 class="text-3xl font-extrabold text-gray-900 mb-1">Bienvenue !</h1>
            <p class="text-[#FCD34D] font-semibold text-lg mb-8">connectez vous a votre compte</p>

            <!-- Formulaire -->
            <form method="POST" action="{{ route('login') }}" class="w-full max-w-sm space-y-5">
                @csrf

                <!-- Email -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-envelope text-gray-900"></i>
                    </div>
                    <input type="email" name="email" required autofocus placeholder="Email"
                           class="block w-full pl-10 pr-3 py-3 border border-yellow-300 rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Mot de passe -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-lock text-gray-900"></i>
                    </div>
                    <input type="password" name="password" required placeholder="Mot de passe"
                           class="block w-full pl-10 pr-10 py-3 border border-yellow-300 rounded-lg bg-[#FFFCF5] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                        <i class="fa-solid fa-eye text-gray-400 hover:text-gray-600"></i>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Bouton Se connecter -->
                <button type="submit" class="w-full bg-[#222] text-white font-bold py-3 rounded-lg hover:bg-black transition duration-200 shadow-lg">
                    Se connecter
                </button>

                <!-- Mot de passe oublié -->
                <div class="text-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <!-- Séparateur OU -->
                <div class="relative flex py-2 items-center">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="flex-shrink-0 mx-4 text-gray-500 text-sm font-semibold">OU</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <!-- Boutons Sociaux -->
                <div class="space-y-3">
                    <button type="button" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#1877F2] hover:bg-[#166fe5]">
                        <i class="fa-brands fa-facebook-f mr-3"></i> Continue with Facebook
                    </button>
                    
                    <button type="button" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5 mr-3" alt="Google">
                        Continue with Google
                    </button>

                    <button type="button" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-900">
                        <i class="fa-brands fa-tiktok mr-3"></i> Continue with TikTok
                    </button>
                </div>

                <!-- Inscription -->
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Pas encore inscrit ? 
                        <a href="{{ route('register') }}" class="font-bold text-gray-900 hover:underline">
                            Créer un compte
                        </a>
                    </p>
                </div>

            </form>
        </div>

        <!-- PARTIE DROITE : IMAGE (Cachée sur mobile) -->
        <div class="hidden md:flex md:w-1/2 bg-[#FFFCF5] items-center justify-center relative">
            <!-- Cercle Jaune décoratif -->
            <div class="absolute w-[500px] h-[500px] bg-[#FCD34D] rounded-full opacity-20 blur-3xl"></div>
            
            <!-- Image Principale -->
            <img src="https://firebasestorage.googleapis.com/v0/b/consu-net.appspot.com/o/FTP%2FEcran%20de%20connexion.png?alt=media&token=4b979817-9064-4b96-8517-2d07d37b7e04" 
                 alt="Illustration Connexion" 
                 class="relative z-10 w-3/4 max-w-lg object-contain drop-shadow-xl transform hover:scale-105 transition duration-500">
        </div>

    </div>

</body>
</html>