@extends('layouts.admin')

@section('title', 'Projets - Optima')

@section('content')
    <main class="flex-1 p-8">

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded mb-6 text-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Gestion des Projets</h2>

        <div class="bg-white border p-6 rounded mb-10">
            <h3 class="text-xs font-bold uppercase text-gray-400 mb-4 tracking-widest">＋ Nouveau Projet</h3>
            @error('titre')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
            <form action="{{ route('projets.store') }}" method="POST" class="flex flex-wrap gap-4 items-end">
                @csrf
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-gray-500 mb-1 uppercase tracking-tight">Nom du
                        projet</label>
                    <input type="text" name="titre" required
                        class="border p-2 text-sm rounded w-52 focus:border-blue-500 outline-none"
                        placeholder="Ex: Projet X">
                </div>

                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-gray-500 mb-1 uppercase tracking-tight">Responsable
                        (Chef)</label>
                    <select name="user_id" required class="border p-2 text-sm rounded w-52 bg-white">
                        <option value="">-- Sélectionner --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-gray-500 mb-1 uppercase tracking-tight">Département</label>
                    <select name="departement_id" required
                        class="border p-2 text-sm rounded w-52 bg-white focus:border-blue-500 outline-none">
                        <option value="">-- Sélectionner --</option>
                        @foreach ($departements as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-gray-500 mb-1 uppercase tracking-tight">Date début</label>
                    <input type="date" name="date_debut" required class="border p-2 text-sm rounded">
                </div>
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-gray-500 mb-1 uppercase tracking-tight">Budget (DH)</label>
                    <input type="number" name="budget" step="0.01"
                        class="border p-2 text-sm rounded w-32 focus:border-blue-500 outline-none" placeholder="0.00">
                </div>
                <button type="submit"
                    class="bg-blue-600 text-white px-8 py-2 rounded text-xs font-black hover:bg-blue-700 transition-colors uppercase">
                    Enregistrer
                </button>
            </form>
        </div>

        <div class="bg-white border rounded overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-tighter">Nom du Projet</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-tighter">Chef de Projet</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-tighter">Date de Début</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-tighter text-center">Statut
                        </th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-tighter">Budget</th>
                        <th class="p-4 text-xs font-bold text-gray-500 uppercase tracking-tighter text-right">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($projets as $projet)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-sm font-bold text-gray-800 tracking-tight">{{ $projet->nom }}</td>
                            <td class="p-4 text-sm text-gray-600 font-medium italic">
                                {{ $projet->user->nom }} {{ $projet->user->prenom }}
                            </td>
                            <td class="p-4 text-sm font-mono text-blue-600 font-bold">
                                {{ number_format($projet->budget, 2, ',', ' ') }} DH
                            </td>
                            <td class="p-4 text-sm text-gray-400 font-mono">{{ $projet->date_debut }}</td>
                            <td class="p-4 text-sm text-gray-600 font-bold uppercase text-[10px]">
                                {{ $projet->departement->nom ?? 'N/A' }}
                            </td>
                            <td class="p-4 text-center">
                                <span
                                    class="px-2 py-0.5 border border-blue-400 text-blue-600 text-[10px] font-black uppercase rounded shadow-sm">
                                    {{ $projet->statut }}
                                </span>
                            </td>

                            <td class="p-4 text-right">
                                <form action="{{ route('projets.destroy', $projet->id) }}" method="POST"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 text-[10px] font-black uppercase border border-red-200 px-2 py-1 rounded hover:bg-red-50 transition">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                            <td>
                                <button type="button"
                                    onclick="openEditModal({{ $projet->id }}, '{{ $projet->nom }}', {{ $projet->budget }}, '{{ $projet->date_debut }}', {{ $projet->departement_id }})"
                                    class="text-blue-500 hover:text-blue-700 text-[10px] font-black uppercase border border-blue-200 px-2 py-1 rounded hover:bg-blue-50">
                                    Modifier
                                </button>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center text-gray-400 italic text-sm">
                                Aucun projet n'est enregistré pour le moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>
    <div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-sm font-bold border-b pb-2 uppercase text-gray-400 mb-4">Modifier Projet</h3>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col gap-3">
                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase">Nom</label>
                            <input type="text" id="edit_nom" name="nom"
                                class="w-full border p-2 text-sm rounded outline-none focus:border-blue-500">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase">Budget</label>
                            <input type="number" id="edit_budget" name="budget"
                                class="w-full border p-2 text-sm rounded outline-none">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase">Département</label>
                            <select id="edit_departement_id" name="departement_id"
                                class="w-full border p-2 text-sm rounded outline-none focus:border-blue-500">
                                @foreach ($departements as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-gray-500 uppercase">Date Début</label>
                            <input type="date" id="edit_date_debut" name="date_debut"
                                class="w-full border p-2 text-sm rounded outline-none">
                        </div>
                        <div class="flex gap-2 mt-4">
                            <button type="submit"
                                class="flex-1 bg-blue-600 text-white py-2 rounded text-xs font-bold uppercase">Sauvegarder</button>
                            <button type="button" onclick="closeModal()"
                                class="flex-1 bg-gray-100 text-gray-600 py-2 rounded text-xs font-bold uppercase">Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const alert = document.querySelector('.bg-green-50');
            if (alert) alert.remove();
        }, 3000);

        function openEditModal(id, nom, budget, date, departement_id) {
            const form = document.getElementById('editForm');
            form.action = `/projets/${id}`;

            document.getElementById('edit_nom').value = nom;
            document.getElementById('edit_budget').value = budget;
            document.getElementById('edit_date_debut').value = date;
            document.getElementById('edit_departement_id').value = departement_id;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
@endsection
