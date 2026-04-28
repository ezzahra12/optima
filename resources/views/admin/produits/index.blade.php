@extends('layouts.admin')

@section('title', 'Gestion du Stock | Optima')

@section('content')
    <main class="flex-1 p-4 md:p-10 w-full">
        <div class="max-w-6xl mx-auto">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800 tracking-tight">Gestion du Stock</h2>
                <div class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-[11px] md:text-xs font-black uppercase tracking-widest shadow-sm">
                    {{ $produits->count() }} Produits
                </div>
            </div>

            <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm border mb-8 md:mb-10 transition-all">
                <h3 class="text-sm md:text-base font-bold mb-5 text-blue-700 flex items-center">
                    <span class="bg-blue-100 text-blue-600 w-6 h-6 rounded-full flex items-center justify-center mr-2 text-xs">＋</span>
                    Ajouter un nouveau produit
                </h3>
                <form action="{{ route('admin.produits.store') }}" method="POST"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 md:gap-5 items-end">
                    @csrf
                    <div class="sm:col-span-2 lg:col-span-1">
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1.5 ml-1">Désignation</label>
                        <input type="text" name="designation" required
                            class="w-full border-gray-200 rounded-lg text-sm p-2.5 focus:ring-2 focus:ring-blue-500 bg-gray-50/50"
                            placeholder="Ex: PC Dell Latitude">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1.5 ml-1">Catégorie</label>
                        <select name="categorie" class="w-full border-gray-200 rounded-lg text-sm p-2.5 focus:ring-2 focus:ring-blue-500 bg-gray-50/50">
                            <option value="Informatique">Informatique</option>
                            <option value="Bureautique">Bureautique</option>
                            <option value="Mobilier">Mobilier</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1.5 ml-1">Quantité</label>
                        <input type="number" name="quantite" required
                            class="w-full border-gray-200 rounded-lg text-sm p-2.5 focus:ring-2 focus:ring-blue-500 bg-gray-50/50" placeholder="0">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1.5 ml-1">Prix Unit. (DH)</label>
                        <input type="number" step="0.01" name="prix_unitaire" required
                            class="w-full border-gray-200 rounded-lg text-sm p-2.5 focus:ring-2 focus:ring-blue-500 bg-gray-50/50" placeholder="0.00">
                    </div>
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-black text-[11px] uppercase py-3 rounded-lg transition shadow-md active:scale-95">
                        Enregistrer
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse min-w-[700px]">
                        <thead class="bg-gray-50 text-gray-400 uppercase text-[10px] font-black tracking-widest border-b">
                            <tr>
                                <th class="p-4">ID</th>
                                <th class="p-4">Désignation</th>
                                <th class="p-4">Catégorie</th>
                                <th class="p-4">Stock</th>
                                <th class="p-4">Prix Unit.</th>
                                <th class="p-4 text-right">Valeur Totale</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($produits as $produit)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="p-4 text-gray-400 text-xs">#{{ $produit->id }}</td>
                                    <td class="p-4 font-bold text-gray-800">{{ $produit->designation }}</td>
                                    <td class="p-4">
                                        <span class="bg-gray-100 px-2 py-1 rounded text-[9px] font-black text-gray-500 uppercase border border-gray-200">
                                            {{ $produit->categorie }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center">
                                            <span class="font-black {{ $produit->quantite < 5 ? 'text-red-600' : 'text-gray-700' }}">
                                                {{ $produit->quantite }}
                                            </span>
                                            @if($produit->quantite < 5)
                                                <span class="ml-2 w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-4 text-gray-600 font-medium text-xs">{{ number_format($produit->prix_unitaire, 0) }} DH</td>
                                    <td class="p-4 font-black text-blue-600 text-right">
                                        {{ number_format($produit->quantite * $produit->prix_unitaire, 0) }} <span class="text-[9px] text-blue-300">DH</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($produits->isEmpty())
                    <div class="p-10 text-center text-gray-400 italic text-sm">Aucun produit en stock pour le moment.</div>
                @endif
            </div>

        </div>

        @if (session('success'))
            <div id="alert-success"
                class="fixed bottom-6 right-6 left-6 sm:left-auto sm:w-[350px] p-4 bg-green-600 text-white font-bold rounded-xl shadow-2xl flex justify-between items-center transition-all z-50 animate-bounce-in">
                <span class="text-xs">✅ {{ session('success') }}</span>
                <button onclick="document.getElementById('alert-success').remove()"
                    class="text-green-100 hover:text-white ml-4 text-lg leading-none">✕</button>
            </div>
        @endif
    </main>
@endsection
