@extends('layouts.rh')

@section('title', 'Optima | Gestion RH - Absences')

@section('content')

    <div class="flex-1 flex flex-col min-w-0">

        <header class="p-10 pb-5 flex justify-between items-end">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Validation des Absences</h2>
                <p class="text-gray-500">Gérez les demandes de congés de tous les collaborateurs</p>
            </div>

            <div class="flex gap-4">
                <div class="bg-white border border-gray-200 p-4 rounded text-center min-w-[120px] shadow-sm">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">En attente</p>
                    <p class="text-2xl font-black text-orange-500">
                        {{ $absences->where('statut', 'en_attente')->count() }}</p>
                </div>
            </div>
        </header>

        <div class="p-10 pt-0">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-600 text-xs font-bold rounded shadow-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border border-gray-200 rounded shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h3 class="font-bold text-gray-700">Toutes les demandes</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-[10px] font-bold text-gray-400 uppercase border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4">Collaborateur</th>
                                <th class="px-6 py-4">Période</th>
                                <th class="px-6 py-4">Durée</th>
                                <th class="px-6 py-4">Motif</th>
                                <th class="px-6 py-4">Statut actuel</th>
                                <th class="px-6 py-4 text-right">Actions RH</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($absences as $abs)
                                <tr class="text-xs hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-[10px]">
                                                {{ strtoupper(substr($abs->user->nom, 0, 1)) }}{{ strtoupper(substr($abs->user->prenom, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-900">{{ $abs->user->prenom }}
                                                    {{ $abs->user->nom }}</div>
                                                <div class="text-[10px] text-gray-400 uppercase">{{ $abs->user->role }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        Du <span
                                            class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($abs->date_debut)->format('d/m/Y') }}</span><br>
                                        au <span
                                            class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($abs->date_fin)->format('d/m/Y') }}</span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span
                                            class="bg-gray-100 text-gray-700 px-2 py-1 rounded font-bold border border-gray-200">
                                            {{ \Carbon\Carbon::parse($abs->date_debut)->diffInDays(\Carbon\Carbon::parse($abs->date_fin)) + 1 }}
                                            j
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 max-w-[150px]">
                                        <p class="text-gray-500 italic truncate" title="{{ $abs->motif }}">
                                            {{ $abs->motif }}</p>
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($abs->statut == 'en_attente')
                                            <span class="text-orange-500 font-black text-[9px] uppercase tracking-tighter">●
                                                En attente</span>
                                        @elseif($abs->statut == 'valide')
                                            <span class="text-green-600 font-black text-[9px] uppercase tracking-tighter">●
                                                Approuvé</span>
                                        @else
                                            <span class="text-red-500 font-black text-[9px] uppercase tracking-tighter">●
                                                Refusé</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        @if ($abs->statut == 'en_attente')
                                            <div class="flex justify-end gap-2">
                                                <form action="{{ route('rh.absences.update', $abs->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="statut" value="valide">
                                                    <button type="submit"
                                                        class="bg-green-600 text-white px-3 py-1.5 rounded text-[10px] font-bold uppercase hover:bg-green-700 transition shadow-sm">
                                                        Accepter
                                                    </button>
                                                </form>

                                                <form action="{{ route('rh.absences.update', $abs->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="statut" value="refuse">
                                                    <button type="submit"
                                                        class="bg-white border border-red-200 text-red-600 px-3 py-1.5 rounded text-[10px] font-bold uppercase hover:bg-red-50 transition">
                                                        Refuser
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-gray-300 italic text-[10px]">Traité</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-20 text-center">
                                        <div class="text-gray-200 font-black text-4xl mb-2">VIDE</div>
                                        <p class="text-gray-400 italic font-medium text-xs">Aucune demande d'absence à
                                            traiter pour le moment.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
