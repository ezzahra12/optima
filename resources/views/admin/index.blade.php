@extends('layouts.admin')

@section('title', 'Dashboard | Optima')

@section('content')
    <main class="flex-1 p-4 md:p-10 w-full overflow-hidden">

        <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 md:mb-10">
            <h2 class="text-xl font-bold text-gray-800 tracking-tight">Vue d'ensemble</h2>

            <div class="text-sm font-medium bg-white px-4 py-2 rounded-full border shadow-sm flex items-center self-end sm:self-auto">
                <span class="truncate max-w-[150px]">{{ auth()->user()->name }}</span>
                <span class="text-gray-300 mx-2">|</span>
                <span class="text-blue-600 uppercase text-[10px] font-black whitespace-nowrap">
                    {{ auth()->user()->role }}
                </span>
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-10">
            <div class="bg-white p-5 md:p-6 rounded-xl border border-gray-200 shadow-sm transition-transform hover:scale-[1.02]">
                <p class="text-[10px] md:text-xs font-bold text-gray-400 uppercase mb-1 tracking-wider">Total Projets</p>
                <h3 class="text-2xl md:text-3xl font-black text-gray-900">{{ $totalProjets }}</h3>
            </div>

            <div class="bg-white p-5 md:p-6 rounded-xl border border-gray-200 shadow-sm transition-transform hover:scale-[1.02]">
                <p class="text-[10px] md:text-xs font-bold text-gray-400 uppercase mb-1 tracking-wider">Budget Total</p>
                <h3 class="text-xl md:text-2xl font-black text-green-600">{{ number_format($totalBudget, 0) }} DH</h3>
            </div>

            <div class="bg-white p-5 md:p-6 rounded-xl border border-gray-200 shadow-sm transition-transform hover:scale-[1.02]">
                <p class="text-[10px] md:text-xs font-bold text-gray-400 uppercase mb-1 tracking-wider">Membres</p>
                <h3 class="text-2xl md:text-3xl font-black text-gray-900">{{ $totalUsers }}</h3>
            </div>

            <div class="bg-white p-5 md:p-6 rounded-xl border border-gray-200 shadow-sm transition-transform hover:scale-[1.02]">
                <p class="text-[10px] md:text-xs font-bold text-gray-400 uppercase mb-1 tracking-wider">En Cours</p>
                <h3 class="text-2xl md:text-3xl font-black text-blue-600">{{ $projetsEnCours }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-5 md:p-6 border-b border-gray-100 flex flex-row justify-between items-center">
                <h4 class="font-bold text-gray-800 uppercase text-xs md:text-sm tracking-wide">Derniers Projets</h4>
                <a href="/projets" class="text-blue-600 text-[11px] md:text-xs font-bold hover:underline bg-blue-50 px-3 py-1.5 rounded-lg transition">
                    Voir tout <span class="hidden sm:inline">→</span>
                </a>
            </div>

            <div class="w-full overflow-x-auto custom-scrollbar">
                <table class="w-full text-left text-xs md:text-sm min-w-[600px]">
                    <thead class="bg-gray-50 text-gray-500 font-bold border-b uppercase text-[10px] tracking-widest">
                        <tr>
                            <th class="px-6 py-4">Nom du Projet</th>
                            <th class="px-6 py-3">Département</th>
                            <th class="px-6 py-3">Budget</th>
                            <th class="px-6 py-3 text-right">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($derniersProjets as $projet)
                            <tr class="hover:bg-gray-50/50 transition duration-150">
                                <td class="px-6 py-4 font-bold italic text-gray-900">{{ $projet->nom }}</td>

                                <td class="px-6 py-4">
                                    <span class="bg-purple-50 text-purple-700 px-2.5 py-1 rounded-md text-[9px] md:text-[10px] font-black uppercase border border-purple-100">
                                        {{ $projet->departement->nom ?? 'N/A' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 font-black text-gray-700">
                                    {{ number_format($projet->budget, 0) }} <span class="text-[10px] text-gray-400 font-medium italic">DH</span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <span class="bg-blue-100/50 text-blue-700 px-2.5 py-1 rounded-full text-[9px] md:text-[10px] font-black uppercase border border-blue-200">
                                        {{ $projet->statut }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic font-medium">
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
