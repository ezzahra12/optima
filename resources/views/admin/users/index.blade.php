<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Utilisateurs | Optima</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex font-sans text-gray-800">

   <aside class="w-64 bg-white border-r hidden md:block min-h-screen shrink-0 shadow-sm">
        <div class="p-6">
            <h1 class="text-2xl font-black text-blue-600 tracking-tighter italic">OPTIMA</h1>
            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Admin Panel</p>
        </div>
        <nav class="mt-6 px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block p-3 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">Tableau de bord</a>
            <a href="{{ route('admin.produits.index') }}" class="block p-3 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">Produits</a>
            <a href="{{ route('admin.projets.index') }}" class="block p-3 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">Projets</a>
            <a href="{{ route('admin.users.index') }}" class="block p-3 bg-blue-50 text-blue-700 rounded-lg font-bold text-sm">Utilisateurs</a>
            <a href="{{ route('admin.departements.index') }}" class="block p-3 text-gray-600 hover:bg-gray-50 rounded-lg text-sm transition">Départements</a>

        </nav>
    </aside>

    <main class="flex-1 p-10">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">

                <div class="p-6 bg-gray-50 border-b">
                    <h2 class="text-2xl font-bold text-gray-800">Gestion des Utilisateurs</h2>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-100 text-gray-600 uppercase text-xs font-bold">
                            <th class="p-4 border-b">Nom & Prénom</th>
                            <th class="p-4 border-b">Email</th>
                            <th class="p-4 border-b">Rôle Actuel</th>
                            <th class="p-4 border-b text-center">Changer le Rôle</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-semibold text-gray-700">
                                {{ $user->nom }} {{ $user->prenom }}
                            </td>
                            <td class="p-4 text-gray-500">
                                {{ $user->email }}
                            </td>
                            <td class="p-4">
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-[11px] font-bold uppercase rounded-md">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <form action="{{ route('users.updateRole', $user) }}" method="POST" class="flex items-center justify-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" class="text-sm border-gray-300 rounded p-1 focus:ring-blue-500">
 <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Utilisateur Simple</option>
    <option value="employe" {{ $user->role == 'employe' ? 'selected' : '' }}>Employé</option>
    <option value="chef_projet" {{ $user->role == 'chef_projet' ? 'selected' : '' }}>Chef de Projet</option>
    <option value="rh" {{ $user->role == 'rh' ? 'selected' : '' }}>Ressources Humaines</option>
    <option value="comptable" {{ $user->role == 'comptable' ? 'selected' : '' }}>Comptable</option>
    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrateur</option>
                                    </select>
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-bold shadow-sm transition">
                                        VALIDER
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
