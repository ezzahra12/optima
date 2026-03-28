<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Utilisateurs | Optima</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

    <aside class="w-64 bg-slate-800 min-h-screen text-white p-6 shadow-xl">
        <h1 class="text-xl font-bold border-b border-slate-700 pb-4 mb-6">Optima ERP</h1>
        <nav class="space-y-4">
            <a href="/dashboard" class="block text-gray-300 hover:text-white">🏠 Dashboard</a>
            <a href="/users" class="block text-blue-400 font-bold underline">👥 Utilisateurs</a>
            <a href="#" class="block text-gray-300 hover:text-white">📁 Projets</a>
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
    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Utilisateur (Standard)</option>
    <option value="employe" {{ $user->role == 'employe' ? 'selected' : '' }}>Employé</option>
    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrateur</option>
    <option value="rh" {{ $user->role == 'rh' ? 'selected' : '' }}>Ressources Humaines</option>
    <option value="chef de projet" {{ $user->role == 'chef de projet' ? 'selected' : '' }}>Chef de Projet</option>
    <option value="comptable" {{ $user->role == 'comptable' ? 'selected' : '' }}>Comptable</option>
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
