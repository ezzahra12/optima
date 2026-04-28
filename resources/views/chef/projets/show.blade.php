<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optima | {{ $projet->nom }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

@php
    function isActive($route) {
        return request()->routeIs($route) ? 'block p-3 bg-blue-50 text-blue-700 rounded-lg font-bold text-sm' : 'block p-3 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition';
    }
@endphp

<body class="bg-gray-100 flex min-h-screen text-sm">

    @include("partials.employe-sidebar")

    <div class="flex-1 flex flex-col min-w-0">

        <header class="p-10 pb-5">
            <a href="{{ route('chef.dashboard') }}"
                class="text-indigo-600 text-[10px] font-bold uppercase tracking-widest hover:underline">
                ← Retour aux projets
            </a>
            <div class="flex justify-between items-end mt-2">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">{{ $projet->nom }}</h2>
                    <span
                        class="text-[10px] font-bold uppercase bg-indigo-50 text-indigo-600 px-3 py-1 rounded border border-indigo-100 mt-2 inline-block">
                        {{ $projet->departement->nom ?? 'Général' }}
                    </span>
                </div>
                <div class="flex gap-4">
                    <div class="bg-white border border-gray-200 p-3 rounded text-center min-w-[120px]">
                        <p class="text-[9px] font-bold text-gray-400 uppercase">Budget</p>
                        <p class="text-sm font-bold text-gray-800">{{ number_format($projet->budget, 0) }} DH</p>
                    </div>
                    <div class="bg-white border border-gray-200 p-3 rounded text-center min-w-[120px]">
                        <p class="text-[9px] font-bold text-gray-400 uppercase">Deadline</p>
                        <p class="text-sm font-bold text-red-500">{{ $projet->date_debut }}</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-10 pt-0 grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1 space-y-6">

                <div class="bg-white border border-gray-200 rounded">
                    <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-bold text-gray-700 uppercase text-[11px]">＋ Nouvelle Tâche</h3>
                    </div>
                    <form action="{{ route('chef.taches.store') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        <input type="hidden" name="projet_id" value="{{ $projet->id }}">
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Titre</label>
                            <input type="text" name="titre" required
                                class="w-full border border-gray-200 p-2.5 rounded focus:border-indigo-500 outline-none"
                                placeholder="Ex: Design UI...">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Date Limite</label>
                            <input type="date" name="date_limite"
                                class="w-full border border-gray-200 p-2.5 rounded focus:border-indigo-500 outline-none">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Assigner à</label>
                            <select name="user_id" required
                                class="w-full border border-gray-200 p-2.5 rounded focus:border-indigo-500 outline-none">
                                <option value="">Choisir...</option>
                                @foreach ($projet->membres as $membre)
                                    <option value="{{ $membre->id }}">{{ $membre->nom }} {{ $membre->prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="w-full bg-black text-white py-3 rounded font-bold text-[10px] uppercase hover:bg-indigo-600 transition">
                            Créer la tâche
                        </button>
                    </form>
                </div>

                <div class="bg-white border border-gray-200 rounded">
                    <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-bold text-gray-700 uppercase text-[11px]"> Équipe</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2 mb-4">
                            @forelse($projet->membres as $m)
                                <span
                                    class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-[10px] font-bold border border-gray-200">
                                    {{ $m->nom }} {{ $m->prenom }}
                                </span>
                            @empty
                                <p class="text-[10px] text-gray-400 italic uppercase font-bold">Aucun membre</p>
                            @endforelse
                        </div>
                        <form action="{{ route('chef.projets.addMembre', $projet->id) }}" method="POST"
                            class="flex gap-2">
                            @csrf
                            <select name="user_id" required
                                class="flex-1 border border-gray-200 p-2 rounded text-[10px] outline-none">
                                <option value="">Ajouter...</option>
                                @foreach ($all_users as $u)
                                    <option value="{{ $u->id }}">{{ $u->nom }} {{ $u->prenom }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit"
                                class="bg-indigo-600 text-white px-3 rounded font-bold text-[10px] uppercase">
                                OK
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-200 rounded">
                    <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h4 class="font-bold text-gray-700 uppercase text-[11px]">Liste des tâches</h4>
                        <span class="text-[10px] font-bold bg-white border px-2 py-0.5 rounded text-gray-400">
                            {{ count($projet->taches) }} TOTAL
                        </span>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @forelse($projet->taches as $tache)
                            <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition group">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-8 h-8 rounded bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-[10px]">
                                        {{ $loop->iteration }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800">{{ $tache->titre }}</p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase">👤
                                            {{ $tache->user?->nom ?? 'Non assigné' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <span
                                        class="text-[9px] font-bold px-2 py-1 rounded uppercase border {{ $tache->statut == 'terminé' ? 'bg-green-50 text-green-600 border-green-100' : 'bg-orange-50 text-orange-500 border-orange-100' }}">
                                        {{ $tache->statut }}
                                    </span>
                                    <form action="{{ route('chef.taches.destroy', $tache->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="text-gray-300 hover:text-red-500 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-20 text-center text-gray-400 italic">
                                Aucune tâche pour le moment.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
