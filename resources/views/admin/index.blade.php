@extends('layouts.admin')

@section('title', 'Dashboard | Optima')

@section('content')
    <main class="flex-1 p-6 md:p-10">

        <header class="flex justify-between items-center mb-10">
            <h2 class="text-xl font-bold">Vue d'ensemble</h2>
            <div class="text-sm font-medium bg-white px-4 py-2 rounded-full border shadow-sm">
                {{ auth()->user()->name }} <span class="text-gray-300 mx-2">|</span> <span
                    class="text-blue-600 uppercase text-[10px] font-black">{{ auth()->user()->role }}</span>
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
                            <th class="px-6 py-3">Département</th>
                            <th class="px-6 py-3">Budget</th>
                            <th class="px-6 py-3">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($derniersProjets as $projet)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium italic text-gray-900">{{ $projet->nom }}</td>

                                <td class="px-6 py-4">
                                    <span
                                        class="bg-purple-50 text-purple-700 px-2 py-1 rounded-md text-[10px] font-bold uppercase border border-purple-100">
                                        {{ $projet->departement->nom ?? 'Non assigné' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 font-bold text-gray-700">
                                    {{ number_format($projet->budget, 2) }} DH
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-[10px] font-bold uppercase">
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
@endsection
