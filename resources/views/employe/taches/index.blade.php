@extends('layouts.employe')

@section('title', 'Optima | Kanban')

@section('content')

    <div class="flex-1 flex flex-col">

        <header class="p-10 pb-5">
            <h2 class="text-3xl font-bold">Tableau Kanban</h2>
            <p class="text-gray-500">Gestion de vos missions</p>
        </header>

        <div class="flex-1 p-10 pt-0 flex gap-6 overflow-x-auto">

            @php
                $colonnes = [
                    'a_faire' => ['nom' => 'À Faire', 'color' => 'bg-gray-300'],
                    'en_cours' => ['nom' => 'En Cours', 'color' => 'bg-orange-500'],
                    'termine' => ['nom' => 'Terminé', 'color' => 'bg-green-500'],
                ];
            @endphp

            @foreach ($colonnes as $slug => $info)
                <div class="w-80 shrink-0">
                    <div class="flex items-center gap-2 mb-4 px-1">
                        <div class="w-2 h-2 rounded-full {{ $info['color'] }}"></div>
                        <h3 class="font-bold text-gray-700 uppercase text-xs tracking-wider">{{ $info['nom'] }}</h3>
                        <span class="ml-auto bg-white border text-gray-400 text-[10px] px-2 py-0.5 rounded-full font-bold">
                            {{ $taches->where('statut', $slug)->count() }}
                        </span>
                    </div>

                    <div class="space-y-4">
                        @forelse($taches->where('statut', $slug) as $tache)
                            <div class="bg-white p-5 rounded border border-gray-200 shadow-sm">
                                <span class="text-[10px] font-bold text-indigo-600 mb-2 block uppercase">
                                    {{ $tache->projet->nom ?? 'Projet' }}
                                </span>

                                <h4 class="font-bold text-gray-800 mb-1">{{ $tache->titre }}</h4>
                                <p class="text-xs text-gray-500 mb-4">{{ Str::limit($tache->description, 70) }}</p>

                                <div class="text-[10px] text-gray-400 mb-4 font-medium">
                                    📅 {{ \Carbon\Carbon::parse($tache->date_limite)->format('d/m/Y') }}
                                </div>

                                <div class="flex gap-2 border-t pt-3">
                                    <a href="{{ route('employe.taches.show', $tache->id) }}"
                                        class="flex-1 text-center py-2 bg-gray-50 text-gray-600 text-[10px] font-bold rounded border uppercase hover:bg-gray-100 transition">
                                        Détails
                                    </a>

                                    @if ($slug !== 'termine')
                                        <form action="{{ route('employe.taches.updateStatus', $tache->id) }}" method="POST"
                                            class="flex-1">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="statut"
                                                value="{{ $slug == 'a_faire' ? 'en_cours' : 'termine' }}">
                                            <button type="submit"
                                                class="w-full bg-black text-white py-2 rounded text-[10px] font-bold uppercase hover:bg-indigo-600 transition">
                                                {{ $slug == 'a_faire' ? 'Démarrer' : 'Terminer' }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div
                                class="py-10 border-2 border-dashed border-gray-200 rounded text-center text-gray-400 text-xs">
                                Aucune tâche
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection
