@extends('layouts.contable')

@section('title', 'Optima | Comptabilité - Dashboard')

@section('content')
    <div class="flex-1 flex flex-col min-w-0">


        <div class="p-10">
            <h2 class="text-2xl font-black text-gray-800 mb-6 italic">Dashboard Comptabilité</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Masse Salariale
                        ({{ now()->format('F') }})</p>
                    <p class="text-2xl font-black text-emerald-600 italic">
                        {{ number_format($stats['total_masse_salariale'], 2) }} DH</p>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Paiements en attente</p>
                    <p class="text-2xl font-black text-orange-500 italic">{{ $stats['paiements_en_attente'] }}</p>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Effectif Total</p>
                    <p class="text-2xl font-black text-indigo-600 italic">{{ $stats['total_employes'] }} Salariés</p>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50">
                    <h3 class="font-bold text-gray-800">Derniers Virements Effectués</h3>
                </div>
                <table class="w-full text-left text-xs">
                    <thead class="bg-gray-50 text-gray-400 uppercase text-[9px] font-bold">
                        <tr>
                            <th class="px-6 py-3">Employé</th>
                            <th class="px-6 py-3">Mois</th>
                            <th class="px-6 py-3">Montant Versé</th>
                            <th class="px-6 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($stats['dernieres_transactions'] as $trans)
                            <tr>
                                <td class="px-6 py-4 font-bold">{{ $trans->user->prenom }} {{ $trans->user->nom }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $trans->mois }}</td>
                                <td class="px-6 py-4 font-black text-emerald-600">
                                    {{ number_format($trans->montant + $trans->prime, 2) }} DH</td>
                                <td class="px-6 py-4 text-gray-400 italic">
                                    {{ $trans->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">Aucune
                                    transaction récente.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
