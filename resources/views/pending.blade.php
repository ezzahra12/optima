<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optima | Attente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    @if(auth()->user()->role == 'user')
        <div class="py-12 min-h-screen flex items-center justify-center">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-[2.5rem] p-12 border border-gray-100 text-center">

                    <div class="inline-flex items-center justify-center w-24 h-24 bg-amber-50 text-amber-500 rounded-3xl mb-8 rotate-3 shadow-sm border border-amber-100">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <h1 class="text-4xl font-black text-gray-900 mb-4 italic tracking-tight">Compte en attente</h1>
                  <p class="text-gray-500 text-lg mb-10 font-medium">
    Bienvenue
    <span class="text-blue-600 font-bold uppercase">
        {{ auth()->user()->name }}
    </span>.
    <br>
    Votre compte est en cours de révision par l'administrateur.
</p>
                    <div class="p-8 bg-blue-50/50 rounded-3xl border border-blue-100 inline-block text-left max-w-sm">
                        <h3 class="text-blue-800 font-black text-xs uppercase tracking-widest mb-3">Prochaine étape :</h3>
                        <p class="text-blue-700 text-sm leading-relaxed">L'admin va vous assigner un rôle (RH, Chef de projet, etc.) pour débloquer les menus.</p>
                    </div>

                    <div class="mt-12 flex flex-col items-center gap-4">
                        <button onclick="window.location.reload()" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-blue-200 hover:bg-blue-700 transition active:scale-95">
                            Actualiser le statut
                        </button>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-400 font-bold text-[10px] uppercase hover:text-red-500 transition tracking-widest">
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @else
       <script>window.location.href = "/dashboard";</script>
    @endif

</body>
</html>
