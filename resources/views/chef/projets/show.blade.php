<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Projet | {{ $projet->nom }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex font-sans text-gray-800">

    <aside class="w-64 bg-white border-r hidden md:block min-h-screen shrink-0 shadow-sm">
        <div class="p-6 border-b border-gray-50 text-center">
            <h1 class="text-2xl font-black text-blue-600 tracking-tighter italic">OPTIMA</h1>
            <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest mt-1">Chef Workspace</p>
        </div>
        <nav class="mt-8 px-4 space-y-2">
            <a href="{{ route('chef.dashboard') }}" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl font-bold text-sm transition">📊 Statistiques</a>
            <a href="{{ route('chef.projets.index') }}" class="flex items-center gap-3 p-3 bg-blue-50 text-blue-700 rounded-xl font-bold text-sm border-l-4 border-blue-600">📁 Mes Projets</a>
        </nav>
    </aside>

    <main class="flex-1 p-6 md:p-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <a href="{{ route('chef.projets.index') }}" class="text-blue-600 text-xs font-bold uppercase tracking-widest hover:underline">← Retour aux projets</a>
                <h2 class="text-3xl font-black text-gray-900 tracking-tight italic mt-2">{{ $projet->nom }}</h2>
                <span class="text-[10px] font-black uppercase bg-blue-100 text-blue-600 px-3 py-1 rounded-full mt-2 inline-block">
                    {{ $projet->departement->nom ?? 'Général' }}
                </span>
            </div>

            <div class="flex gap-3">
                <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm text-center min-w-[120px]">
                    <p class="text-[9px] font-black text-gray-400 uppercase">Budget</p>
                    <p class="text-sm font-black text-gray-800">{{ number_format($projet->budget, 0) }} DH</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm text-center min-w-[120px]">
                    <p class="text-[9px] font-black text-gray-400 uppercase">Deadline</p>
                    <p class="text-sm font-black text-red-500">{{ $projet->date_debut }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm sticky top-10">
                    <h3 class="text-lg font-black text-gray-800 mb-6 italic">＋ Nouvelle Tâche</h3>
                    <form action="{{ route('chef.taches.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="projet_id" value="{{ $projet->id }}">

                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase ml-2">Titre de la tâche</label>
                            <input type="text" name="titre" required class="w-full mt-1 bg-gray-50 border-none p-4 rounded-2xl text-sm focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ex: Design UI...">
                        </div>
                      <div>
    <label class="text-[10px] font-black text-gray-400 uppercase ml-2">Date Limite</label>
    <input type="date" name="date_limite" class="w-full mt-1 bg-gray-50 border-none p-4 rounded-2xl text-sm focus:ring-2 focus:ring-blue-500 outline-none">
</div>
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase ml-2">Assigner à</label>
                            <select name="user_id" required class="w-full mt-1 bg-gray-50 border-none p-4 rounded-2xl text-sm outline-none">
    <option value="">Choisir parmi l'équipe...</option>
    @foreach($projet->membres as $membre)
        <option value="{{ $membre->id }}">{{ $membre->nom }} {{ $membre->prenom }}</option>
    @endforeach
</select>
                        </div>

                        <button type="submit" class="w-full bg-gray-900 text-white p-4 rounded-2xl font-black text-xs uppercase hover:bg-blue-600 transition shadow-lg shadow-gray-200">
                            Créer la tâche
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                        <h4 class="font-black text-gray-800 uppercase text-sm italic">Liste des tâches</h4>
                        <span class="text-[10px] font-black bg-gray-100 px-3 py-1 rounded-full text-gray-500">
                            {{ count($projet->taches) }} TOTAL
                        </span>
                    </div>

                    <div class="divide-y divide-gray-50">
                        @forelse($projet->taches as $tache)
                        <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 font-black text-xs">
                                    {{ $loop->iteration }}
                                </div>
                                <div>
                                    <p class="text-sm font-black text-gray-800">{{ $tache->titre }}</p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase">
    👤 {{ $tache->user?->nom ?? 'Non assigné' }}
</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <span class="text-[9px] font-black px-3 py-1 rounded-full uppercase {{ $tache->statut == 'terminé' ? 'bg-green-100 text-green-600' : 'bg-orange-100 text-orange-600' }}">
                                    {{ $tache->statut }}
                                </span>
                                <form action="{{ route('chef.taches.destroy', $tache->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="opacity-0 group-hover:opacity-100 text-red-400 hover:text-red-600 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="p-20 text-center">
                            <p class="text-gray-300 italic font-bold">Aucune tâche pour le moment.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm mb-6">
    <h3 class="text-lg font-black text-gray-800 mb-6 italic">👥 Équipe du Projet</h3>

    <div class="flex flex-wrap gap-2 mb-6">
        @forelse($projet->membres as $m)
            <div class="flex items-center gap-2 bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full border border-blue-100">
                <span class="text-[10px] font-black uppercase">{{ $m->nom }} {{ $m->prenom }}</span>
            </div>
        @empty
            <p class="text-[10px] text-gray-400 font-bold uppercase italic">Aucun membre assigné</p>
        @endforelse
    </div>

    <form action="{{ route('chef.projets.addMembre', $projet->id) }}" method="POST" class="flex gap-2">
        @csrf
        <select name="user_id" required class="flex-1 bg-gray-50 border-none p-3 rounded-xl text-xs outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Sélectionner un collaborateur...</option>
            @foreach($all_users as $u)
                <option value="{{ $u->id }}">{{ $u->nom }} {{ $u->prenom }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 rounded-xl font-black text-[10px] uppercase hover:bg-blue-700 transition shadow-md shadow-blue-100">
            Ajouter
        </button>
    </form>
</div>
    </main>

</body>
</html>
