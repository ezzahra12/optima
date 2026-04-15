@extends('layouts.rh')

@section('title', 'Optima | RH - Liste des Employés')

@section('content')
    <div class="flex-1 flex flex-col min-w-0">

        <header class="p-10 pb-5">
            <h2 class="text-3xl font-bold text-gray-900">Annuaire Collaborateurs</h2>
            <p class="text-gray-500">Consultez la liste et les informations de contact de l'équipe</p>
        </header>

        <div class="p-10 pt-0">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead
                        class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase border-b border-gray-100 tracking-widest">
                        <tr>
                            <th class="px-6 py-4">Employé / Matricule</th>
                            <th class="px-6 py-4">Salaire Fixe</th>
                            <th class="px-6 py-4">Absences (Ce mois)</th>
                            <th class="px-6 py-4">Ajouter Prime (Ajustement)</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 italic">
                        @foreach ($employes as $emp)
                            @php
                                // On récupère le paiement préparé s'il existe
                                $prep = $emp->paiements->first();
                                $salaireAffiche = $prep ? $prep->montant : $emp->salaire;
                            @endphp
                            <tr class="text-xs hover:bg-gray-50 transition-all">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3 font-bold text-gray-900 not-italic">
                                        <div
                                            class="h-8 w-8 rounded-full bg-indigo-600 text-white flex items-center justify-center text-[10px]">
                                            {{ substr($emp->nom, 0, 1) }}{{ substr($emp->prenom, 0, 1) }}
                                        </div>
                                        <div>
                                            <span>{{ $emp->prenom }} {{ $emp->nom }}</span>
                                            <p class="text-[9px] text-gray-400">#OPT-{{ $emp->id }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td colspan="3" class="px-6 py-4">
                                    <form action="{{ route('rh.salaires.store-complet') }}" method="POST"
                                        class="flex items-center gap-4">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $emp->id }}">

                                        <div class="flex flex-col">
                                            <label class="text-[8px] font-black uppercase text-gray-400">Salaire du
                                                mois</label>
                                            <input type="number" name="montant" value="{{ $salaireAffiche }}"
                                                class="w-24 border-gray-200 rounded p-1.5 font-black text-indigo-700 focus:ring-indigo-500 bg-indigo-50/30">
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-[8px] font-black uppercase text-gray-400">Prime
                                                (+)
                                            </label>
                                            <input type="number" name="prime" value="{{ $prep->prime ?? '' }}"
                                                placeholder="0.00"
                                                class="w-20 border-gray-200 rounded p-1.5 font-bold text-emerald-600 focus:ring-emerald-500">
                                        </div>

                                        <div class="flex flex-col flex-1">
                                            <label class="text-[8px] font-black uppercase text-gray-400">Motif /
                                                Note</label>
                                            <input type="text" name="motif" value="{{ $prep->motif_prime ?? '' }}"
                                                placeholder="Ex: Prime rendement ou déduction absence"
                                                class="border-gray-200 rounded p-1.5 text-[10px] focus:ring-indigo-500">
                                        </div>

                                        <button type="submit"
                                            class="self-end bg-gray-900 text-white px-4 py-2 rounded font-black text-[9px] uppercase hover:bg-black transition shadow-sm">
                                            Enregistrer
                                        </button>
                                    </form>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    @if ($emp->absences_count > 0)
                                        <span class="text-red-500 font-black text-[9px]">{{ $emp->absences_count }}
                                            ABS.</span>
                                    @else
                                        <span class="text-gray-300 italic text-[9px]">SANS ABSENCE</span>
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
