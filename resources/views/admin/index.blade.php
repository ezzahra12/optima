<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard | Optima</title>
</head>
<body class="bg-gray-100 font-sans text-gray-800">

  <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r hidden md:block shrink-0 shadow-sm">
            <div class="p-6">
                <h1 class="text-2xl font-black text-blue-600 tracking-tighter italic">OPTIMA</h1>
                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Admin Panel</p>
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block p-3 bg-blue-50 text-blue-700 rounded-lg font-bold text-sm">Tableau de bord</a>
                <a href="/produits" class="block p-3 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition"> Produits</a>
                <a href="{{ route('admin.projets.index') }}" class="block p-3 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">Projets</a>
                <a href="{{ route('admin.users.index') }}" class="block p-3 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">Utilisateurs</a>
            <a href="{{ route('admin.departements.index') }}" class="block p-3 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">Départements</a>
            <div class="mt-auto pb-6">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left p-3 text-red-500 hover:bg-red-50 rounded-lg text-sm font-bold transition flex items-center gap-2">
                <span>🚪</span> Déconnexion
            </button>
        </form>
    </div>
            </nav>
        </aside>

        <main class="flex-1 p-6 md:p-10">

            <header class="flex justify-between items-center mb-10">
                <h2 class="text-xl font-bold">Vue d'ensemble</h2>
                <div class="text-sm font-medium bg-white px-4 py-2 rounded-full border shadow-sm">
                    👤 {{ auth()->user()->name }} <span class="text-gray-300 mx-2">|</span> <span class="text-blue-600 uppercase text-[10px] font-black">{{ auth()->user()->role }}</span>
                </div>
            </header>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <p class="text-xs font-bold text-gray-400 uppercase mb-1">Total Projets</p>
                    <h3 class="text-3xl font-black text-gray-900">{{ $totalProjets }}</h3>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <p class="text-xs font-bold text-gray-400 uppercase mb-1">Budget Total</p>
                    <h3 class="text-2xl font-black text-green-600">{{ number_format($totalBudget, 0) }} DH</h3>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <p class="text-xs font-bold text-gray-400 uppercase mb-1">Membres</p>
                    <h3 class="text-3xl font-black text-gray-900">{{ $totalUsers }}</h3>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <p class="text-xs font-bold text-gray-400 uppercase mb-1">En Cours</p>
                    <h3 class="text-3xl font-black text-blue-600">{{ $projetsEnCours }}</h3>
                </div>

            </div>


            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h4 class="font-bold text-gray-800 uppercase text-sm">Derniers Projets Ajoutés</h4>
                    <a href="/projets" class="text-blue-600 text-xs font-bold hover:underline">Voir tout →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
    <thead class="bg-gray-50 text-gray-500 font-medium border-b">
        <tr>
            <th class="px-6 py-3">Nom du Projet</th>
            <th class="px-6 py-3">Département</th> <th class="px-6 py-3">Budget</th>
            <th class="px-6 py-3">Statut</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
        @forelse($derniersProjets as $projet)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-medium italic text-gray-900">{{ $projet->nom }}</td>

                <td class="px-6 py-4">
                    <span class="bg-purple-50 text-purple-700 px-2 py-1 rounded-md text-[10px] font-bold uppercase border border-purple-100">
                        {{ $projet->departement->nom ?? 'Non assigné' }}
                    </span>
                </td>

                <td class="px-6 py-4 font-bold text-gray-700">
                    {{ number_format($projet->budget, 2) }} DH
                </td>

                <td class="px-6 py-4">
                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-[10px] font-bold uppercase">
                        {{ $projet->statut }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">
                    Aucun projet récent trouvé.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
                </div>
            </div>

        </main>
    </div>

</body>
</html>
