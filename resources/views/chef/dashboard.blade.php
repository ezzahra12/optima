<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optima | Dashboard Chef</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen text-sm">

    <div class="w-60 bg-white border-r border-gray-200 shrink-0">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-indigo-600">Optima</h1>
            <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest">Espace Chef</p>
        </div>

        <nav class="px-4">
            <p class="text-gray-400 text-[10px] font-bold mb-4 uppercase">Menu</p>

            <a href="{{ route('chef.dashboard') }}"
               class="block p-3 bg-indigo-100 text-indigo-700 font-bold rounded mb-2">
                Tableau de bord
            </a>

            <hr class="my-4 border-gray-100">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left p-3 text-red-500 hover:bg-red-50 rounded">
                    Déconnexion
                </button>
            </form>
        </nav>
    </div>

    <div class="flex-1 flex flex-col min-w-0">

        <header class="p-10 pb-5 flex justify-between items-end">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Tableau de bord</h2>
                <p class="text-gray-500 uppercase text-[10px] font-bold tracking-wider mt-1">Aperçu des performances de l'équipe</p>
            </div>
            <div class="text-[11px] font-bold bg-white px-4 py-2 rounded border border-gray-200">
                 {{ auth()->user()->nom }}
            </div>
        </header>

        <div class="p-10 pt-0">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded border border-gray-200 shadow-sm">
                    <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Projets Assignés</p>
                    <h3 class="text-3xl font-black text-indigo-600">{{ $projets->count() }}</h3>
                </div>
                <div class="bg-white p-6 rounded border border-gray-200 shadow-sm">
                    <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Tâches en cours</p>
                    <h3 class="text-3xl font-black text-orange-500">{{ $totalTachesEnCours ?? 0 }}</h3>
                </div>
                <div class="bg-white p-6 rounded border border-gray-200 shadow-sm">
                    <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Tâches Terminées</p>
                    <h3 class="text-3xl font-black text-green-600">{{ $totalTachesTerminees ?? 0 }}</h3>
                </div>
            </div>

            <h3 class="font-bold text-gray-700 mb-6 uppercase text-xs tracking-widest">Mes Projets Actuels</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($projets as $projet)
                <div class="bg-white rounded border border-gray-200 p-6 hover:border-indigo-300 transition-colors">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-xl"></div>
                        <span class="text-[9px] font-bold uppercase bg-gray-100 text-gray-500 px-2 py-1 rounded border">
                            {{ $projet->statut ?? 'En cours' }}
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 mb-1 truncate">{{ $projet->nom }}</h3>

                    @php
                        $total = $projet->taches_count ?? 0;
                        $done = $projet->taches_terminees_count ?? 0;
                        $percent = $total > 0 ? round(($done / $total) * 100) : 0;
                    @endphp

                    <div class="mt-4 mb-6">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-[9px] font-bold text-gray-400 uppercase">Progression</span>
                            <span class="text-[10px] font-bold text-indigo-600">{{ $percent }}%</span>
                        </div>
                        <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-indigo-600 h-full transition-all" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                        <span class="text-[9px] font-bold text-gray-400 uppercase">Tâches: {{ $done }}/{{ $total }}</span>
                        <a href="{{ route('chef.projets.show', $projet->id) }}"
                           class="bg-black text-white px-3 py-1.5 rounded text-[9px] font-bold uppercase hover:bg-indigo-600 transition">
                            Gérer →
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 border-2 border-dashed border-gray-200 rounded text-center">
                    <p class="text-gray-400 font-medium">Aucun projet assigné pour le moment.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

</body>
</html>
