@extends('layouts.contable')

@section('title', 'Optima | Gestion des Salaires')

@section('content')

    <div class="flex-1 flex flex-col min-w-0">
        <header class="p-10 pb-5">
            <h2 class="text-3xl font-bold text-gray-900">Gestion des Salaires</h2>
            <p class="text-gray-500">Validez les paiements mensuels des collaborateurs</p>
        </header>

        <div class="p-10 pt-0">
            @if (session('success'))
                <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 font-bold rounded text-xs">
                    ✅ {{ session('success') }}</div>
            @endif

            <div class="bg-white border border-gray-200 rounded shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-[10px] font-bold text-gray-400 uppercase border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4">Collaborateur</th>
                            <th class="px-6 py-4">RIB / Info</th>
                            <th class="px-6 py-4">salaire</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($employes as $emp)
                            @php
                                $paiement = $emp->paiements->first();
                                $salaireBase = $emp->salaire;
                                $prime = $paiement ? $paiement->prime : 0;
                                $total = ($paiement ? $paiement->montant : $salaireBase) + $prime;
                            @endphp
                            <tr class="text-xs hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $emp->prenom }} {{ $emp->nom }}</div>
                                    <div class="text-[9px] text-gray-400 uppercase font-black tracking-widest">
                                        {{ $emp->role }}</div>
                                </td>

                                <td class="px-6 py-4">
                                    @if ($emp->rib)
                                        <code
                                            class="text-[10px] bg-gray-100 p-1 rounded text-gray-600 block mt-1 select-all">
                                            {{ $emp->rib }}
                                        </code>
                                    @else
                                        <span class="text-[9px] text-red-400 italic">RIB manquant</span>
                                    @endif
                                </td>
                                {{--
        <td class="px-6 py-4">
            @if ($prime > 0)
                <div class="text-emerald-600 font-bold">+ {{ number_format($prime, 2) }} DH</div>
                <p class="text-[9px] text-gray-400 italic">{{ $paiement->motif_prime }}</p>
            @else
                <span class="text-gray-300">---</span>
            @endif
        </td> --}}

                                <td class="px-6 py-4">
                                    <span class="text-sm font-black text-gray-900 bg-gray-100 px-2 py-1 rounded">
                                        {{ number_format($total, 2) }} DH
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    @if ($paiement && $paiement->statut == 'termine')
                                        <span
                                            class="inline-flex items-center gap-1 text-emerald-600 font-black text-[10px] uppercase bg-emerald-50 px-3 py-1.5 rounded-full border border-emerald-100">
                                            Virement Effectué
                                        </span>
                                    @else
                                        <form action="{{ route('comptable.salaires.payer', $emp->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded font-black text-[9px] uppercase shadow-sm transition-all active:scale-95">
                                                Valider le Paiement
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
