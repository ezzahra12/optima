<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Départements | Optima</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex font-sans text-gray-800">

    <aside class="w-64 bg-white border-r hidden md:block min-h-screen shrink-0 shadow-sm">
        <div class="p-6">
            <h1 class="text-2xl font-black text-blue-600 tracking-tighter italic">OPTIMA</h1>
            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Admin Panel</p>
        </div>
             <nav class="mt-6 px-4 space-y-2">
                <a href="/dashboard" class="block p-3 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">Tableau de bord</a>
                <a href="/produits" class="block p-3 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">Produits</a>

                <a href="/projets" class="block p-3 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">Projets</a>
                <a href="/users" class="block p-3 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">Utilisateurs</a>

            <a href="{{ route('admin.departements.index') }}" class="block p-3 bg-blue-50 text-blue-700 rounded-lg font-bold text-sm">Départements</a>

        </nav>
    </aside>

    <main class="flex-1 p-6 md:p-10">
        <div class="max-w-4xl mx-auto">
            <header class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Départements</h2>
            </header>

            <div class="bg-white p-6 rounded-xl shadow-sm border mb-8">
                <form action="{{ route('admin.departements.store') }}" method="POST" class="flex gap-4">
                    @csrf
                    <div class="flex-1">
                        <input type="text" name="nom" required placeholder="Nom du département (ex: Marketing)" class="w-full border-gray-200 rounded-lg text-sm p-3 outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-black text-xs uppercase shadow-md hover:bg-blue-700 transition">Ajouter</button>
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
                        @foreach($departements as $dept)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-bold text-gray-800">{{ $dept->nom }}</td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.departements.destroy', $dept) }}" method="POST" onsubmit="return confirm('Supprimer ce département ?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700 font-black text-[10px] uppercase">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
