<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optima | Bienvenue</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-center items-center">

    <div class="max-w-4xl w-full px-6 text-center">
        <h1 class="text-6xl font-black text-indigo-600 italic tracking-tighter mb-4">OPTIMA</h1>
        <p class="text-xl text-gray-600 font-medium mb-12 uppercase tracking-widest">Système de Gestion Centralisé</p>

        <div class="bg-white p-12 rounded-[40px] shadow-2xl shadow-indigo-100 border border-white relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Bienvenue sur votre plateforme</h2>
                <p class="text-gray-500 max-w-lg mx-auto mb-10">
                    Gérez vos projets, vos absences et vos salaires en un seul endroit.
                    Connectez-vous pour accéder à votre espace collaborateur.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 px-10 rounded-2xl shadow-lg transition-all active:scale-95 uppercase text-sm">
                                Accéder au Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 px-10 rounded-2xl shadow-lg transition-all active:scale-95 uppercase text-sm">
                                Se Connecter
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-white border-2 border-gray-100 hover:border-indigo-200 text-gray-700 font-black py-4 px-10 rounded-2xl transition-all active:scale-95 uppercase text-sm">
                                    Créer un compte
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <div class="absolute -top-24 -right-24 w-64 h-64 bg-indigo-50 rounded-full opacity-50"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-indigo-50 rounded-full opacity-50"></div>
        </div>

        <p class="mt-12 text-gray-400 text-[10px] font-bold uppercase tracking-widest">
            &copy; {{ date('Y') }} Optima ERP. Built with Laravel 11.
        </p>
    </div>

</body>
</html>
