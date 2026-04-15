@extends('layouts.admin')

@section('title', 'Départements | Optima')

@section('content')
    <main class="flex-1 p-6 md:p-10">
        <div class="max-w-4xl mx-auto">
            <header class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Départements</h2>
            </header>

            <div class="bg-white p-6 rounded-xl shadow-sm border mb-8">
                <form action="{{ route('admin.departements.store') }}" method="POST" class="flex gap-4">
                    @csrf
                    <div class="flex-1">
                        <input type="text" name="nom" required placeholder="Nom du département (ex: Marketing)"
                            class="w-full border-gray-200 rounded-lg text-sm p-3 outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg font-black text-xs uppercase shadow-md hover:bg-blue-700 transition">Ajouter</button>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-400 font-black uppercase text-[10px] border-b">
                        <tr>
                            <th class="px-6 py-4">Nom</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($departements as $dept)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-bold text-gray-800">{{ $dept->nom }}</td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('admin.departements.destroy', $dept) }}" method="POST"
                                        onsubmit="return confirm('Supprimer ce département ?')">
                                        @csrf @method('DELETE')
                                        <button
                                            class="text-red-500 hover:text-red-700 font-black text-[10px] uppercase">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
