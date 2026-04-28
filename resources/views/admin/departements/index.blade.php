@extends('layouts.admin')

@section('title', 'Départements | Optima')

@section('content')
    <main class="flex-1 p-4 md:p-10">
        <div class="max-w-4xl mx-auto">
            <header class="mb-8 text-center sm:text-left">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800 tracking-tight">Départements</h2>
            </header>

            <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm border mb-8 transition-all">
                <form action="{{ route('admin.departements.store') }}" method="POST" class="flex flex-col sm:flex-row gap-3 md:gap-4">
                    @csrf
                    <div class="flex-1">
                        <input type="text" name="nom" required placeholder="Nom du département (ex: Marketing)"
                            class="w-full border-gray-200 rounded-lg text-sm p-3 outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50/50">
                    </div>
                    <button type="submit"
                        class="w-full sm:w-auto bg-blue-600 text-white px-8 py-3 rounded-lg font-black text-[11px] uppercase shadow-md hover:bg-blue-700 active:scale-95 transition-all">
                        Ajouter
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm min-w-[400px]">
                        <thead class="bg-gray-50 text-gray-400 font-black uppercase text-[10px] border-b tracking-widest">
                            <tr>
                                <th class="px-6 py-4">Nom du département</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($departements as $dept)
                                <tr class="hover:bg-gray-50/50 transition group">
                                    <td class="px-6 py-4 font-bold text-gray-800">
                                        <div class="flex items-center">
                                            <span class="w-2 h-2 bg-blue-400 rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                            {{ $dept->nom }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('admin.departements.destroy', $dept) }}" method="POST"
                                            onsubmit="return confirm('Supprimer ce département ?')">
                                            @csrf @method('DELETE')
                                            <button
                                                class="text-red-400 hover:text-red-600 font-black text-[10px] uppercase tracking-tighter hover:underline underline-offset-4 transition">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-10 text-center text-gray-400 italic font-medium">
                                        Aucun département trouvé.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
