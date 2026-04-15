@extends('layouts.employe')

@section('title', 'Optima | Mes Salaires')

@section('content')

    <div class="flex-1 flex flex-col min-w-0">

        <header class="p-10 pb-5 flex justify-between items-end">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Mes Paiements</h2>
                <p class="text-gray-500">Consultez l'historique de vos virements et primes</p>
            </div>
            <div class="bg-white border border-gray-200 p-4 rounded text-center min-w-[160px] shadow-sm">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Salaire Contractuel</p>
                <p class="text-xl font-black text-indigo-600">{{ number_format(auth()->user()->salaire, 2) }} DH</p>
            </div>
        </header>

        <div class="px-10 pb-10">
            <div class="bg-white border border-gray-200 rounded shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h3 class="font-bold text-gray-700">Historique des bulletins</h3>
                    <span class="text-[10px] text-gray-400 font-medium uppercase">RIB:
                        {{ auth()->user()->rib ?? 'Non renseigné' }}</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-[10px] font-bold text-gray-400 uppercase border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4">Période</th>
                                <th class="px-6 py-4">Montant de base</th>
                                <th class="px-6 py-4">Primes</th>
                                <th class="px-6 py-4">Total Net</th>
                                <th class="px-6 py-4 text-right">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($mesSalaires as $s)
                                <tr class="text-xs hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-800 uppercase">{{ $s->mois }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ number_format($s->montant, 2) }} DH
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($s->prime > 0)
                                            <span class="text-green-600 font-bold">+{{ number_format($s->prime, 2) }}</span>
                                            <p class="text-[9px] text-gray-400 italic">{{ $s->motif_prime }}</p>
                                        @else
                                            <span class="text-gray-300">---</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-gray-900 text-sm">
                                            {{ number_format($s->montant + $s->prime, 2) }} DH
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if ($s->statut == 'termine')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase bg-green-100 text-green-600">
                                                Versé
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase bg-orange-100 text-orange-600">
                                                En cours
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center">
                                        <div class="text-gray-300 mb-2 font-bold text-lg">Aucun bulletin</div>
                                        <p class="text-gray-400 text-xs italic">Vos fiches de paie apparaîtront ici dès
                                            validation.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <p class="mt-6 text-[10px] text-gray-400 italic text-center uppercase tracking-widest font-bold">
                * Pour toute réclamation, veuillez contacter le département des Ressources Humaines.
            </p>
        </div>
    </div>

@endsection
