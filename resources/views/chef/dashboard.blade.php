<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optima | Dashboard Chef</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex font-sans text-gray-800">

    <aside class="w-64 bg-white border-r hidden md:block min-h-screen shrink-0 shadow-sm">
        <div class="p-6 border-b border-gray-50 text-center">
            <h1 class="text-2xl font-black text-blue-600 tracking-tighter italic">OPTIMA</h1>
            <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest mt-1">Chef Workspace</p>
        </div>
        <nav class="mt-8 px-4 space-y-2">
            <a href="{{ route('chef.dashboard') }}" class="flex items-center gap-3 p-3 bg-blue-50 text-blue-700 rounded-xl font-bold text-sm border-l-4 border-blue-600">📊 Statistiques</a>
            <a href="{{ route('chef.projets.index') }}" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl font-bold text-sm transition">📁 Mes Projets</a>
            <form method="POST" action="{{ route('logout') }}" class="pt-10">
                @csrf
                <button type="submit" class="flex items-center gap-3 p-3 text-red-400 hover:text-red-600 font-bold text-sm transition w-full text-left">🚪 Déconnexion</button>
            </form>
        </nav>
    </aside>

    <main class="flex-1 p-6 md:p-10">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-black text-gray-900 tracking-tight italic">Tableau de bord</h2>
                <p class="text-sm text-gray-400 font-bold uppercase mt-1">Aperçu de vos performances</p>
            </div>
            <div class="text-sm font-bold bg-white px-4 py-2 rounded-full border shadow-sm">
                👤 {{ auth()->user()->name }}
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                <p class="text-[10px] font-black text-gray-400 uppercase mb-2">Projets Assignés</p>
                <h3 class="text-4xl font-black text-blue-600">{{ $projets->count() }}</h3>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                <p class="text-[10px] font-black text-gray-400 uppercase mb-2">Tâches en cours</p>
                <h3 class="text-4xl font-black text-orange-500">{{ $totalTachesEnCours ?? 0 }}</h3>
            </div>
            <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                <p class="text-[10px] font-black text-gray-400 uppercase mb-2">Tâches Terminées</p>
                <h3 class="text-4xl font-black text-green-500">{{ $totalTachesTerminees ?? 0 }}</h3>
            </div>
        </div>

        <h3 class="text-xl font-black text-gray-800 mb-6 italic">Mes Projets Actuels</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($projets as $projet)
            <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm hover:shadow-xl transition-all group relative overflow-hidden">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-xl">🚀</div>
                    <span class="text-[9px] font-black uppercase italic bg-slate-100 text-slate-500 px-3 py-1 rounded-full border border-slate-200">
                        {{ $projet->statut ?? 'En cours' }}
                    </span>
                </div>

                <h3 class="text-xl font-black text-gray-800 mb-2 truncate">{{ $projet->nom }}</h3>

                @php
                    $total = $projet->taches_count ?? 0;
                    $done = $projet->taches_terminees_count ?? 0;
                    $percent = $total > 0 ? round(($done / $total) * 100) : 0;
                @endphp
                <div class="mt-6 mb-8">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Progression</span>
                        <span class="text-xs font-black text-blue-600">{{ $percent }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                        <div class="bg-blue-600 h-full transition-all duration-1000" style="width: {{ $percent }}%"></div>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-gray-50">
                    <span class="text-[10px] font-bold text-gray-400 uppercase italic italic">Tasks: {{ $done }}/{{ $total }}</span>
                    <a href="{{ route('chef.projets.show', $projet->id) }}" class="bg-gray-900 text-white px-4 py-2 rounded-xl font-black text-[9px] uppercase hover:bg-blue-600 transition">Gérer →</a>
                </div>
            </div>
            @empty
            <div class="col-span-full bg-white rounded-[3rem] border-4 border-dashed border-gray-100 p-20 text-center">
                <p class="text-gray-300 font-bold italic text-lg">Aucun projet ne vous a été assigné pour le moment.</p>
            </div>
            @endforelse
        </div>
    </main>

</body>
</html>
