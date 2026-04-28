@extends('layouts.admin')

@section('title', 'Projets - Optima')

@section('content')
    <main class="flex-1 p-4 md:p-8 w-full overflow-hidden">

        @if (session('success'))
            <div id="success-alert" class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm flex justify-between items-center animate-pulse">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <h2 class="text-xl md:text-2xl font-black mb-6 text-gray-800 border-b pb-3 tracking-tight">Gestion des Projets</h2>

        <div class="bg-white border border-gray-100 p-5 md:p-6 rounded-xl shadow-sm mb-10">
            <h3 class="text-[10px] font-black uppercase text-gray-400 mb-5 tracking-[0.2em]">＋ Nouveau Projet</h3>

            <form action="{{ route('admin.projets.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 items-end">
                @csrf
                <div class="flex flex-col">
                    <label class="text-[10px] font-black text-gray-500 mb-1.5 uppercase tracking-wide">Nom du projet</label>
                    <input type="text" name="titre" required class="border border-gray-200 p-2.5 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-gray-50/50" placeholder="Ex: Projet X">
                </div>

                <div class="flex flex-col">
                    <label class="text-[10px] font-black text-gray-500 mb-1.5 uppercase tracking-wide">Responsable</label>
                    <select name="user_id" required class="border border-gray-200 p-2.5 text-sm rounded-lg bg-gray-50/50 focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Sélectionner</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col">
                    <label class="text-[10px] font-black text-gray-500 mb-1.5 uppercase tracking-wide">Département</label>
                    <select name="departement_id" required class="border border-gray-200 p-2.5 text-sm rounded-lg bg-gray-50/50 focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Sélectionner</option>
                        @foreach ($departements as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col">
                    <label class="text-[10px] font-black text-gray-500 mb-1.5 uppercase tracking-wide">Date début</label>
                    <input type="date" name="date_debut" required class="border border-gray-200 p-2.5 text-sm rounded-lg bg-gray-50/50 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div class="flex flex-col">
                    <label class="text-[10px] font-black text-gray-500 mb-1.5 uppercase tracking-wide">Budget (DH)</label>
                    <input type="number" name="budget" step="0.01" class="border border-gray-200 p-2.5 text-sm rounded-lg bg-gray-50/50 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="0.00">
                </div>

                <button type="submit" class="bg-blue-600 text-white py-3 rounded-lg text-[10px] font-black hover:bg-blue-700 transition-all uppercase tracking-widest shadow-lg shadow-blue-100 active:scale-95">
                    Enregistrer
                </button>
            </form>
        </div>

        <div class="bg-white border border-gray-100 rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left min-w-[1000px]">
                    <thead class="bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th class="p-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Projet</th>
                            <th class="p-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Responsable</th>
                            <th class="p-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Budget</th>
                            <th class="p-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Début</th>
                            <th class="p-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Statut</th>
                            <th class="p-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($projets as $projet)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="p-4">
                                    <div class="text-sm font-bold text-gray-800">{{ $projet->nom }}</div>
                                    <div class="text-[9px] text-blue-500 font-bold uppercase tracking-tighter">{{ $projet->departement->nom ?? 'N/A' }}</div>
                                </td>
                                <td class="p-4 text-xs text-gray-600 font-medium italic">
                                    {{ $projet->user->nom }} {{ $projet->user->prenom }}
                                </td>
                                <td class="p-4 text-xs font-black text-gray-700">
                                    {{ number_format($projet->budget, 0, ',', ' ') }} <span class="text-[9px] text-gray-400 font-normal">DH</span>
                                </td>
                                <td class="p-4 text-xs text-gray-400 font-mono">{{ $projet->date_debut }}</td>
                                <td class="p-4 text-center">
                                    <span class="px-2.5 py-1 bg-blue-50 text-blue-600 text-[9px] font-black uppercase rounded-full border border-blue-100">
                                        {{ $projet->statut }}
                                    </span>
                                </td>
                                <td class="p-4 text-right flex justify-end gap-2">
                                    <button onclick="openEditModal({{ $projet->id }}, '{{ $projet->nom }}', {{ $projet->budget }}, '{{ $projet->date_debut }}', {{ $projet->departement_id }})"
                                        class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors border border-transparent hover:border-blue-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.projets.destroy', $projet->id) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-red-400 hover:bg-red-50 rounded-lg transition-colors border border-transparent hover:border-red-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-10 text-center text-gray-400 italic text-xs">Aucun projet enregistré.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="editModal" class="hidden fixed inset-0 bg-gray-900/60 backdrop-blur-sm overflow-y-auto h-full w-full z-50 p-4 flex items-center justify-center">
        <div class="relative bg-white w-full max-w-md shadow-2xl rounded-2xl p-6 md:p-8 transform transition-all">
            <h3 class="text-xs font-black border-b border-gray-100 pb-4 uppercase text-gray-400 mb-6 tracking-widest text-center">Modifier Projet</h3>

            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Nom du projet</label>
                        <input type="text" id="edit_nom" name="nom" class="w-full border border-gray-200 p-3 text-sm rounded-xl outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50/50">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Budget (DH)</label>
                        <input type="number" id="edit_budget" name="budget" class="w-full border border-gray-200 p-3 text-sm rounded-xl outline-none bg-gray-50/50">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Département</label>
                        <select id="edit_departement_id" name="departement_id" class="w-full border border-gray-200 p-3 text-sm rounded-xl outline-none bg-gray-50/50">
                            @foreach ($departements as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Date Début</label>
                        <input type="date" id="edit_date_debut" name="date_debut" class="w-full border border-gray-200 p-3 text-sm rounded-xl outline-none bg-gray-50/50">
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 mt-6">
                        <button type="submit" class="flex-1 bg-blue-600 text-white py-3 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-100">Sauvegarder</button>
                        <button type="button" onclick="closeModal()" class="flex-1 bg-gray-100 text-gray-500 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest">Annuler</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Auto-remove alert
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) alert.style.display = 'none';
        }, 3000);

        function openEditModal(id, nom, budget, date, departement_id) {
            const form = document.getElementById('editForm');
            form.action = `/projets/${id}`;
            document.getElementById('edit_nom').value = nom;
            document.getElementById('edit_budget').value = budget;
            document.getElementById('edit_date_debut').value = date;
            document.getElementById('edit_departement_id').value = departement_id;

            const modal = document.getElementById('editModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
@endsection
