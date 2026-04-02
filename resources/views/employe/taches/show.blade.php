<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optima | Détails de la Mission</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f3f4f6] antialiased">

    <div class="flex min-h-screen">

        <main class="flex-1 flex flex-col">

            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-40 px-8 flex items-center justify-between">
                <div>
                    <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-1 italic">Espace Employé</h3>
                    <p class="text-sm font-black text-gray-800">Mission <span class="text-purple-600">#{{ $tache->id }}</span></p>
                </div>

                <div class="flex items-center gap-6">
                    <div class="hidden sm:flex flex-col text-right">
                        <p class="text-[10px] font-black text-gray-900 uppercase italic leading-none mb-1">{{ auth()->user()->name }}</p>
                        <p class="text-[9px] font-bold text-green-500 leading-none">En ligne</p>
                    </div>
                    <div class="w-10 h-10 bg-gray-900 text-white rounded-xl flex items-center justify-center font-black italic shadow-lg shadow-gray-200">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="p-6 md:p-12 max-w-6xl mx-auto w-full">

                <div class="flex justify-between items-center mb-10">
                    <a href="{{ route('employe.taches.index') }}" class="group flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-purple-600 transition-all">
                        <span class="bg-white p-2 rounded-xl shadow-sm border border-gray-100 group-hover:-translate-x-1 transition-transform">←</span>
                        Retour au Kanban
                    </a>

                    <div class="flex items-center gap-3 bg-white px-5 py-2 rounded-2xl shadow-sm border border-gray-50">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 @if($tache->statut == 'a_faire') bg-gray-400 @elseif($tache->statut == 'en_cours') bg-orange-400 @else bg-green-400 @endif"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 @if($tache->statut == 'a_faire') bg-gray-500 @elseif($tache->statut == 'en_cours') bg-orange-500 @else bg-green-500 @endif"></span>
                        </span>
                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-600">
                            {{ str_replace('_', ' ', $tache->statut) }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2 space-y-8">
                        <div class="bg-white rounded-[3rem] p-8 md:p-14 shadow-xl shadow-purple-900/5 border border-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-40 h-40 bg-purple-50 rounded-bl-[5rem] -mr-20 -mt-20 opacity-40"></div>

                            <div class="relative">
                                <p class="text-[10px] font-black text-purple-600 uppercase tracking-[0.4em] mb-4 italic">Description de la mission</p>
                                <h1 class="text-4xl md:text-6xl font-black text-gray-900 tracking-tighter italic leading-[0.85] mb-10">
                                    {{ $tache->titre }}
                                </h1>
                                <p class="text-gray-500 font-medium text-lg leading-relaxed">
                                    {{ $tache->description ?? 'Aucune description détaillée fournie.' }}
                                </p>
                            </div>
                        </div>

                        <div class="bg-gray-900 rounded-[2.5rem] p-8 text-white flex flex-col md:flex-row justify-between items-center gap-6 shadow-2xl shadow-gray-400/30">
                            <div>
                                <p class="text-[9px] font-black text-purple-400 uppercase tracking-widest mb-1 italic">Action Rapide</p>
                                <h3 class="text-xl font-black italic tracking-tight text-white">Mettre à jour le statut</h3>
                            </div>

                            @if($tache->statut !== 'termine')
                                <form action="{{ route('employe.taches.updateStatus', $tache->id) }}" method="POST" class="w-full md:w-auto">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="{{ $tache->statut == 'a_faire' ? 'en_cours' : 'termine' }}">
                                    <button type="submit" class="w-full bg-white text-gray-900 px-10 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-purple-500 hover:text-white transition-all shadow-lg active:scale-95">
                                        {{ $tache->statut == 'a_faire' ? '🚀 Démarrer' : '✅ Terminer' }}
                                    </button>
                                </form>
                            @else
                                <div class="px-10 py-4 bg-green-500/10 text-green-400 rounded-2xl font-black text-[10px] uppercase tracking-widest border border-green-500/20">
                                    ✨ Mission Terminée
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white rounded-[2.5rem] p-8 shadow-lg shadow-purple-900/5 border border-white">
                            <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-300 mb-8 italic">Informations</h3>

                            <div class="space-y-8">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center font-black italic border border-blue-100">P</div>
                                    <div>
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Projet</p>
                                        <p class="text-sm font-black text-gray-800 italic tracking-tight">{{ $tache->projet->nom ?? 'Indépendant' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center font-black italic border border-red-100">D</div>
                                    <div>
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Deadline</p>
                                        <p class="text-sm font-black text-red-600 tracking-tight">{{ \Carbon\Carbon::parse($tache->date_limite)->format('d/m/Y') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center font-black italic border border-orange-100">D</div>
                                    <div>
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Département</p>
                                        <p class="text-sm font-black text-gray-800 tracking-tight">{{ $tache->projet->departement->nom ?? 'Général' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-8 text-center bg-gradient-to-br from-purple-600 to-indigo-700 rounded-[2.5rem] text-white shadow-xl shadow-purple-200">
                            <h1 class="text-3xl font-black italic tracking-tighter mb-2">OPTIMA</h1>
                            <p class="text-[8px] font-black uppercase tracking-[0.4em] opacity-60 italic">Système de gestion v1.0</p>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

</body>
</html>
