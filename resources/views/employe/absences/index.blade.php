<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optima | Mes Absences</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen text-sm">

   <div class="w-60 bg-white min-h-screen border-r border-gray-200 shrink-0">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-indigo-600">Optima</h1>
        </div>

        <div class="px-4">
            <p class="text-gray-400 text-xs font-bold mb-4 uppercase">Menu</p>

            <a href="{{ route('employe.dashboard') }}"
               class="block p-3 {{ request()->routeIs('employe.dashboard') ? 'bg-indigo-100 text-indigo-700 font-bold' : 'text-gray-600 hover:bg-gray-50' }} rounded mb-2">
                Tableau de bord
            </a>

            <a href="{{ route('employe.taches.index') }}"
               class="block p-3 {{ request()->routeIs('employe.taches.index') ? 'bg-indigo-100 text-indigo-700 font-bold' : 'text-gray-600 hover:bg-gray-50' }} rounded mb-2">
                Mes Missions
            </a>

            <a href="{{ route('employe.absences.index') }}"
               class="block p-3 {{ request()->routeIs('employe.absences.index') ? 'bg-indigo-100 text-indigo-700 font-bold' : 'text-gray-600 hover:bg-gray-50' }} rounded mb-2">
                Mes Absences
            </a>

            <hr class="my-4 border-gray-100">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left p-3 text-red-500 hover:bg-red-50 rounded">
                    Déconnexion
                </button>
            </form>
        </div>
    </div>

    <div class="flex-1 flex flex-col">

        <header class="p-10 pb-5 flex justify-between items-end">
            <div>
                <h2 class="text-3xl font-bold">Mes Absences</h2>
                <p class="text-gray-500">Demandes de congés et suivi</p>
            </div>
            <div class="bg-white border border-gray-200 p-4 rounded text-center min-w-[120px]">
                <p class="text-[10px] font-bold text-gray-400 uppercase">Solde Restant</p>
                <p class="text-2xl font-black text-indigo-600">{{ $solde ?? 18 }} Jours</p>
            </div>
        </header>

        <div class="p-10 pt-0 grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1">
                <div class="bg-white border border-gray-200 rounded">
                    <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-bold text-gray-700">Nouvelle Demande</h3>
                    </div>
                    <form action="{{ route('employe.absences.store') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Date de début</label>
                            <input type="date" name="date_debut" required class="w-full border border-gray-200 p-2 rounded focus:border-indigo-500 outline-none">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Nombre de jours</label>
                            <input type="number" name="nombre_jours" min="1" placeholder="Ex: 3" required class="w-full border border-gray-200 p-2 rounded focus:border-indigo-500 outline-none">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Motif</label>
                            <textarea name="motif" rows="3" required class="w-full border border-gray-200 p-2 rounded focus:border-indigo-500 outline-none resize-none"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-black text-white py-3 rounded font-bold text-xs uppercase hover:bg-indigo-600 transition">
                            Envoyer la demande
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-200 rounded">
                    <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-bold text-gray-700">Historique</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 text-[10px] font-bold text-gray-400 uppercase border-b border-gray-100">
                                <tr>
                                    <th class="px-6 py-3">Début</th>
                                    <th class="px-6 py-3">Durée</th>
                                    <th class="px-6 py-3">Statut</th>
                                    <th class="px-6 py-3">Motif</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($absences as $abs)
                                <tr class="text-xs">
                                    <td class="px-6 py-4 font-bold">{{ \Carbon\Carbon::parse($abs->date_debut)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4"><span class="bg-gray-100 px-2 py-1 rounded">{{ $abs->nombre_jours }} j</span></td>
                                    <td class="px-6 py-4 uppercase font-black text-[9px]">
                                        @if($abs->statut == 'en_attente')
                                            <span class="text-orange-500">● En attente</span>
                                        @elseif($abs->statut == 'valide')
                                            <span class="text-green-600">● Approuvé</span>
                                        @else
                                            <span class="text-red-500">● Refusé</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 italic">{{ Str::limit($abs->motif, 30) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="p-10 text-center text-gray-400 italic">Aucune demande</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
