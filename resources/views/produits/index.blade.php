<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Stock | Optima</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

    <aside class="w-64 bg-slate-800 min-h-screen text-white p-6 shadow-xl">
        <h1 class="text-xl font-bold border-b border-slate-700 pb-4 mb-6">Optima ERP</h1>
        <nav class="space-y-4">
            <a href="/dashboard" class="block text-gray-400 hover:text-white">🏠 Dashboard</a>
            <a href="/users" class="block text-gray-400 hover:text-white">👥 Utilisateurs</a>
            <a href="/produits" class="block text-blue-400 font-bold underline">📦 Stock / Produits</a>
            <a href="#" class="block text-gray-400 hover:text-white">📁 Projets</a>
        </nav>
    </aside>

    <main class="flex-1 p-10">
        <div class="max-w-6xl mx-auto">

            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-800">Gestion du Stock</h2>
                <div class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold">
                    {{ $produits->count() }} Produits au total
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border mb-10">
                <h3 class="text-lg font-bold mb-4 text-blue-700">＋ Ajouter un nouveau produit</h3>
                <form action="{{ route('produits.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Désignation</label>
                        <input type="text" name="designation" required class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500" placeholder="Ex: PC Dell Latitude">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Catégorie</label>
                        <select name="categorie" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500">
                            <option value="Informatique">Informatique</option>
                            <option value="Bureautique">Bureautique</option>
                            <option value="Mobilier">Mobilier</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Quantité</label>
                        <input type="number" name="quantite" required class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500" placeholder="0">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Prix Unit. (DH)</label>
                        <input type="number" step="0.01" name="prix_unitaire" required class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500" placeholder="0.00">
                    </div>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-lg transition shadow-md">
                        Enregistrer
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-md border overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-gray-600 uppercase text-xs font-bold">
                        <tr>
                            <th class="p-4 border-b">ID</th>
                            <th class="p-4 border-b">Désignation</th>
                            <th class="p-4 border-b">Catégorie</th>
                            <th class="p-4 border-b">Quantité</th>
                            <th class="p-4 border-b">Prix Unitaire</th>
                            <th class="p-4 border-b">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($produits as $produit)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 text-gray-400 text-sm">#{{ $produit->id }}</td>
                            <td class="p-4 font-bold text-gray-800">{{ $produit->designation }}</td>
                            <td class="p-4">
                                <span class="bg-gray-100 px-2 py-1 rounded text-[10px] font-bold text-gray-600 uppercase">{{ $produit->categorie }}</span>
                            </td>
                            <td class="p-4 font-semibold {{ $produit->quantite < 5 ? 'text-red-600' : 'text-gray-700' }}">
                                {{ $produit->quantite }}
                            </td>
                            <td class="p-4 text-gray-600">{{ number_format($produit->prix_unitaire, 2) }} DH</td>
                            <td class="p-4 font-bold text-blue-600">
                                {{ number_format($produit->quantite * $produit->prix_unitaire, 2) }} DH
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($produits->isEmpty())
                    <div class="p-10 text-center text-gray-400 italic">Aucun produit en stock pour le moment.</div>
                @endif
            </div>

        </div>
        @if(session('success'))
    <div id="alert-success" class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-bold rounded shadow-sm flex justify-between items-center transition-all">
        <span>✅ {{ session('success') }}</span>
        <button onclick="document.getElementById('alert-success').remove()" class="text-green-900 hover:text-black">✕</button>
    </div>
@endif
    </main>
</body>

</html>
