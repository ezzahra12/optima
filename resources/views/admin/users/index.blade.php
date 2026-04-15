@extends('layouts.admin')

@section('title', 'Gestion Utilisateurs | Optima')

@section('content')
    <main class="flex-1 p-10">
        <div class="max-w-6xl mx-auto">

            @if (session('success'))
                <div id="alert-success"
                    class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 font-bold rounded shadow-sm flex justify-between items-center transition-all">
                    <span>✅ {{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-emerald-900">✕</button>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                <div class="p-6 bg-gray-50 border-b">
                    <h2 class="text-2xl font-bold text-gray-800">Gestion des Utilisateurs</h2>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-100 text-gray-600 uppercase text-[10px] font-black tracking-wider">
                            <th class="p-4 border-b">Nom & Prénom</th>
                            <th class="p-4 border-b">Email</th>
                            <th class="p-4 border-b">Rôle</th>
                            <th class="p-4 border-b">Salaire (DH)</th>
                            <th class="p-4 border-b text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-semibold text-gray-700">
                                    {{ $user->nom }} {{ $user->prenom }}
                                </td>
                                <td class="p-4 text-gray-500 text-xs italic">
                                    {{ $user->email }}
                                </td>

                                <form action="{{ route('admin.users.updateFull', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <td class="p-4">
                                        <select name="role"
                                            class="text-xs border-gray-300 rounded p-1 focus:ring-blue-500 bg-white font-bold uppercase text-blue-600">
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User
                                            </option>
                                            <option value="employe" {{ $user->role == 'employe' ? 'selected' : '' }}>Employé
                                            </option>
                                            <option value="chef_projet"
                                                {{ $user->role == 'chef_projet' ? 'selected' : '' }}>Chef Projet</option>
                                            <option value="rh" {{ $user->role == 'rh' ? 'selected' : '' }}>RH</option>
                                            <option value="comptable" {{ $user->role == 'comptable' ? 'selected' : '' }}>
                                                Comptable</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                        </select>
                                    </td>

                                    <td class="p-4">
                                        <div class="flex items-center gap-1 border border-gray-300 rounded px-2 bg-gray-50">
                                            <input type="number" name="salaire" value="{{ $user->salaire }}"
                                                class="w-20 bg-transparent border-none p-1 text-sm font-black text-emerald-600 focus:ring-0"
                                                step="0.01">
                                            <span class="text-[10px] font-bold text-gray-400">DH</span>
                                        </div>
                                    </td>

                                    <td class="p-4 text-center">
                                        <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded text-[10px] font-black shadow-sm transition uppercase">
                                            Enregistrer
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection

