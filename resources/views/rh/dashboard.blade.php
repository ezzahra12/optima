@extends('layouts.rh')

@section('title', 'Optima | RH - Vue d\'ensemble')

@section('content')
    <div class="flex-1 flex flex-col min-w-0">

        <header class="p-10 pb-5">
            <h2 class="text-3xl font-bold text-gray-900">Tableau de bord RH</h2>
            <p class="text-gray-500">Aperçu global des effectifs et des flux</p>
        </header>

        <div class="p-10 pt-0 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded border border-gray-200 shadow-sm">
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Total Employés</p>
                    <p class="text-3xl font-black text-gray-900 mt-1">{{ $totalEmployes ?? 0 }}</p>
                </div>

                <div class="bg-white p-6 rounded border border-gray-200 shadow-sm">
                    <p class="text-[10px] font-bold text-gray-400 uppercase italic text-orange-500">Demandes en attente</p>
                    <p class="text-3xl font-black text-orange-500 mt-1">{{ $absencesEnAttente ?? 0 }}</p>
                </div>

                <div class="bg-white p-6 rounded border border-gray-200 shadow-sm">
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Absents aujourd'hui</p>
                    <p class="text-3xl font-black text-indigo-600 mt-1">{{ $absentsAujourdhui ?? 0 }}</p>
                </div>

                <div class="bg-white p-6 rounded border border-gray-200 shadow-sm">
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Missions Actives</p>
                    <p class="text-3xl font-black text-green-600 mt-1">{{ $missionsActives ?? 0 }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 bg-white border border-gray-200 rounded shadow-sm">
                    <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-gray-700 uppercase text-xs tracking-wider">Demandes Récentes</h3>
                        <a href="{{ route('rh.absences.index') }}"
                            class="text-indigo-600 text-[10px] font-bold hover:underline">Voir tout →</a>
                    </div>
                    <div class="p-0">
                        @forelse($dernieresAbsences ?? [] as $abs)
                            <div
                                class="flex items-center justify-between p-4 hover:bg-gray-50 border-b border-gray-50 last:border-0 transition">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-8 w-8 rounded bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-500">
                                        {{ substr($abs->user->nom, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $abs->user->prenom }} {{ $abs->user->nom }}
                                        </p>
                                        <p class="text-[10px] text-gray-400">Demande de
                                            {{ \Carbon\Carbon::parse($abs->date_debut)->diffInDays($abs->date_fin) + 1 }}
                                            jours</p>
                                    </div>
                                </div>
                                <span
                                    class="text-[9px] font-black uppercase text-orange-500 bg-orange-50 px-2 py-1 rounded">En
                                    attente</span>
                            </div>
                        @empty
                            <div class="p-10 text-center text-gray-400 italic text-xs">Aucune demande récente.</div>
                        @endforelse
                    </div>
                </div>



            </div>

        </div>
    </div>
@endsection
