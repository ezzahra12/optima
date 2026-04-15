@extends('layouts.employe')

@section('title', 'Optima | Dashboard')

@section('content')
    <style>
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 50;
        }
    </style>

    <div class="flex-1 p-10">

        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-bold">Mon Espace</h2>
                <p class="text-gray-500">Bienvenue, {{ auth()->user()->prenom }}</p>
            </div>
            <div class="bg-white border p-2 px-4 rounded-full font-bold shadow-sm">
                {{ auth()->user()->nom }}
            </div>
        </div>

        <div class="grid grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded shadow-sm border border-gray-200">
                <span class="text-gray-400 text-xs font-bold uppercase">Missions</span>
                <h3 class="text-3xl font-bold">{{ $totalTaches ?? 0 }}</h3>
            </div>
            <div class="bg-white p-6 rounded shadow-sm border border-gray-200">
                <span class="text-orange-500 text-xs font-bold uppercase">En cours</span>
                <h3 class="text-3xl font-bold text-orange-600">{{ $tachesEnCours ?? 0 }}</h3>
            </div>
            <div class="bg-white p-6 rounded shadow-sm border border-gray-200">
                <span class="text-green-500 text-xs font-bold uppercase">Terminées</span>
                <div class="flex justify-between items-end">
                    <h3 class="text-3xl font-bold text-green-600">{{ $tachesTerminees ?? 0 }}</h3>
                    <button onclick="ouvrirModal()"
                        class="bg-black text-white text-xs p-2 px-3 rounded hover:bg-indigo-600">
                        + Absence
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded border border-gray-200 shadow-sm">
            <div class="p-4 border-b font-bold bg-gray-50 flex justify-between items-center">
                Missions Récentes
                <a href="{{ route('employe.taches.index') }}" class="text-xs text-indigo-600 underline">Voir tout</a>
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-400 uppercase">
                        <th class="p-4 border-b">Mission</th>
                        <th class="p-4 border-b">Projet</th>
                        <th class="p-4 border-b">Statut</th>
                        <th class="p-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTaches ?? [] as $tache)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 border-b font-semibold">{{ $tache->titre }}</td>
                            <td class="p-4 border-b text-gray-600">{{ $tache->projet->nom ?? 'Standard' }}</td>
                            <td class="p-4 border-b">
                                @if ($tache->statut == 'termine')
                                    <span class="text-green-600 font-bold text-xs uppercase">Terminé</span>
                                @else
                                    <span class="text-orange-500 font-bold text-xs uppercase">En cours</span>
                                @endif
                            </td>
                            <td class="p-4 border-b">
                                <a href="{{ route('employe.taches.show', $tache->id) }}"
                                    class="text-indigo-600 font-bold underline">Détails</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center text-gray-400">Aucune mission pour le moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="monModal" class="modal-overlay">
        <div class="bg-white p-8 rounded-lg shadow-2xl w-96">
            <h3 class="text-xl font-bold mb-4">Demande d'absence</h3>

            <form action="{{ route('employe.absences.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Date de début</label>
                    <input type="date" name="date_debut" required
                        class="w-full border p-2 rounded outline-none focus:border-indigo-500">
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Durée (jours)</label>
                    <input type="number" name="nombre_jours" min="1" required
                        class="w-full border p-2 rounded outline-none focus:border-indigo-500">
                </div>
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Motif</label>
                    <textarea name="motif" rows="3" required class="w-full border p-2 rounded outline-none focus:border-indigo-500"></textarea>
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="flex-1 bg-indigo-600 text-white p-3 rounded font-bold hover:bg-indigo-700">Envoyer</button>
                    <button type="button" onclick="fermerModal()"
                        class="flex-1 bg-gray-100 text-gray-600 p-3 rounded font-bold">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var modal = document.getElementById('monModal');

        function ouvrirModal() {
            modal.style.display = 'flex';
        }

        function fermerModal() {
            modal.style.display = 'none';
        }
    </script>
@endsection
