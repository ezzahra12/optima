@extends('layouts.employe')

@section('title', 'Optima | Mes Absences')

@section('content')

    <div class="flex-1 flex flex-col min-w-0">

        <header class="p-10 pb-5 flex justify-between items-end">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Mes Absences</h2>
                <p class="text-gray-500">Demandes de congés et suivi en temps réel</p>
            </div>
            <div class="bg-white border border-gray-200 p-4 rounded text-center min-w-[140px] shadow-sm">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Solde Restant</p>
                <p class="text-2xl font-black text-indigo-600">{{ $solde }} Jours</p>
            </div>
        </header>

        <div class="p-10 pt-0 grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1">
                <div class="bg-white border border-gray-200 rounded shadow-sm">
                    <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-bold text-gray-700">Nouvelle Demande</h3>
                    </div>

                    @if (session('success'))
                        <div class="m-4 p-3 bg-green-50 border border-green-100 text-green-600 text-xs font-bold rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="m-4 p-3 bg-red-50 border border-red-100 text-red-600 text-xs font-bold rounded">
                            <ul class="list-disc pl-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('employe.absences.store') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Date de
                                début</label>
                            <input type="date" name="date_debut" value="{{ old('date_debut') }}" required
                                class="w-full border border-gray-200 p-2 rounded focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Nombre de
                                jours</label>
                            <input type="number" name="nombre_jours" value="{{ old('nombre_jours') }}" min="1"
                                placeholder="Ex: 3" required
                                class="w-full border border-gray-200 p-2 rounded focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Motif /
                                Justification</label>
                            <textarea name="motif" rows="3" required placeholder="Expliquez brièvement le motif..."
                                class="w-full border border-gray-200 p-2 rounded focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none resize-none transition-all">{{ old('motif') }}</textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-gray-900 text-white py-3 rounded font-bold text-xs uppercase hover:bg-indigo-600 transition shadow-md active:scale-95">
                            Envoyer la demande
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-200 rounded shadow-sm">
                    <div class="p-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-700">Historique des demandes</h3>
                        <span class="text-[10px] text-gray-400 font-medium">Total: {{ $absences->count() }}</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead
                                class="bg-gray-50 text-[10px] font-bold text-gray-400 uppercase border-b border-gray-100">
                                <tr>
                                    <th class="px-6 py-4">Période (Début - Fin)</th>
                                    <th class="px-6 py-4">Durée</th>
                                    <th class="px-6 py-4">Statut</th>
                                    <th class="px-6 py-4">Motif</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($absences as $abs)
                                    <tr class="text-xs hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-gray-800">
                                                {{ \Carbon\Carbon::parse($abs->date_debut)->format('d/m/Y') }}</div>
                                            <div class="text-[10px] text-gray-400">au
                                                {{ \Carbon\Carbon::parse($abs->date_fin)->format('d/m/Y') }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="bg-indigo-50 text-indigo-700 px-2 py-1 rounded font-bold border border-indigo-100">
                                                {{ \Carbon\Carbon::parse($abs->date_debut)->diffInDays(\Carbon\Carbon::parse($abs->date_fin)) + 1 }}
                                                j
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($abs->statut == 'en_attente')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase bg-orange-100 text-orange-600">
                                                    En attente
                                                </span>
                                            @elseif($abs->statut == 'valide')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase bg-green-100 text-green-600">
                                                    Approuvé
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase bg-red-100 text-red-600">
                                                    Refusé
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 italic max-w-[200px] truncate"
                                            title="{{ $abs->motif }}">
                                            {{ $abs->motif }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-12 text-center">
                                            <div class="text-gray-300 mb-2 font-bold text-lg">Aucune demande</div>
                                            <p class="text-gray-400 text-xs italic">Vos futures demandes de congés
                                                apparaîtront ici.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

        </div>
    </div>

@endsection
