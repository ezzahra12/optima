@extends('layouts.employe')

@section('title', 'Optima | Détails Mission')

@section('content')

    <div class="flex-1 flex flex-col min-w-0">

        <header class="p-10 pb-5">
            <a href="{{ route('employe.taches.index') }}"
                class="text-indigo-600 text-[10px] font-bold uppercase tracking-widest hover:underline">
                ← Retour au Kanban
            </a>
            <div class="flex justify-between items-end mt-2">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">{{ $tache->titre }}</h2>
                    <p class="text-gray-500 uppercase text-[10px] font-bold mt-1">Détails de la mission #{{ $tache->id }}
                    </p>
                </div>
                <div class="flex items-center gap-3 bg-white px-4 py-2 rounded border border-gray-200 shadow-sm">
                    <span
                        class="h-2 w-2 rounded-full @if ($tache->statut == 'a_faire') bg-gray-400 @elseif($tache->statut == 'en_cours') bg-orange-400 @else bg-green-400 @endif"></span>
                    <span class="text-[10px] font-bold uppercase text-gray-600">
                        {{ str_replace('_', ' ', $tache->statut) }}
                    </span>
                </div>
            </div>
        </header>

        <div class="p-10 pt-0 grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white border border-gray-200 rounded p-8">
                    <h3 class="text-gray-400 text-[10px] font-bold uppercase tracking-wider mb-4">Description</h3>
                    <p class="text-gray-700 text-base leading-relaxed">
                        {{ $tache->description ?? 'Aucune description détaillée fournie pour cette mission.' }}
                    </p>
                </div>

                <div class="bg-gray-900 rounded p-6 text-white flex justify-between items-center">
                    <div>
                        <p class="text-indigo-400 text-[9px] font-bold uppercase tracking-widest">Mise à jour</p>
                        <h3 class="text-lg font-bold">Changer l'état de la mission</h3>
                    </div>

                    @if ($tache->statut !== 'termine')
                        <form action="{{ route('employe.taches.updateStatus', $tache->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="statut"
                                value="{{ $tache->statut == 'a_faire' ? 'en_cours' : 'termine' }}">
                            <button type="submit"
                                class="bg-white text-gray-900 px-6 py-2 rounded font-bold text-[10px] uppercase hover:bg-indigo-500 hover:text-white transition-all">
                                {{ $tache->statut == 'a_faire' ? 'Démarrer' : 'Terminer' }}
                            </button>
                        </form>
                    @else
                        <div
                            class="px-6 py-2 bg-green-500/20 text-green-400 rounded border border-green-500/30 font-bold text-[10px] uppercase">
                            Terminée
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white border border-gray-200 rounded p-6">
                    <h3 class="text-gray-400 text-[10px] font-bold uppercase tracking-wider mb-6">Informations Clés</h3>

                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 bg-gray-100 rounded flex items-center justify-center font-bold text-gray-400">
                                P</div>
                            <div>
                                <p class="text-[9px] font-bold text-gray-400 uppercase">Projet</p>
                                <p class="font-bold text-gray-800">{{ $tache->projet->nom ?? 'Indépendant' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-red-50 rounded flex items-center justify-center font-bold text-red-400">D
                            </div>
                            <div>
                                <p class="text-[9px] font-bold text-gray-400 uppercase">Deadline</p>
                                <p class="font-bold text-red-600">
                                    {{ \Carbon\Carbon::parse($tache->date_limite)->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 bg-orange-50 rounded flex items-center justify-center font-bold text-orange-400">
                                D</div>
                            <div>
                                <p class="text-[9px] font-bold text-gray-400 uppercase">Département</p>
                                <p class="font-bold text-gray-800">{{ $tache->projet->departement->nom ?? 'Général' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-indigo-600 rounded text-white">
                    <h4 class="text-xl font-bold">OPTIMA</h4>
                    <p class="text-[8px] font-bold uppercase opacity-60 tracking-widest mt-1">Gestion de production</p>
                </div>
            </div>

        </div>
    </div>

@endsection
