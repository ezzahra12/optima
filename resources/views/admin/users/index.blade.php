@extends('layouts.admin')

@section('title', 'Gestion Utilisateurs | Optima')

@section('content')
    <main class="flex-1 p-6 md:p-16 w-full bg-white text-[#1a1a1a]">
        <div class="max-w-5xl mx-auto">

            @if (session('success'))
                <div id="alert-success" class="mb-12 pb-4 border-b border-emerald-500 text-emerald-600 text-xs font-bold tracking-widest uppercase animate-pulse">
                    {{ session('success') }}
                </div>
            @endif

            <header class="mb-16">
                <h2 class="text-4xl md:text-5xl font-black tracking-tighter mb-2 italic uppercase">Team</h2>
                <p class="text-gray-400 text-xs font-medium tracking-[0.3em] uppercase">Administration des effectifs Optima</p>
            </header>

            <div class="hidden md:block">
                <div class="grid grid-cols-12 gap-4 mb-6 pb-4 border-b border-gray-100 text-[10px] font-black text-gray-300 uppercase tracking-widest">
                    <div class="col-span-5 italic">Collaborateur</div>
                    <div class="col-span-2">Rôle</div>
                    <div class="col-span-2">Salaire</div>
                    <div class="col-span-3 text-right">Action</div>
                </div>

                <div class="divide-y divide-gray-50">
                    @foreach ($users as $user)
                        <div class="grid grid-cols-12 gap-4 py-8 items-center group hover:bg-gray-50/30 transition-all duration-500">
                            <div class="col-span-5">
                                <h3 class="text-xl font-bold tracking-tight group-hover:pl-2 transition-all duration-300">{{ $user->nom }} {{ $user->prenom }}</h3>
                                <p class="text-xs text-gray-400 font-medium italic mt-1">{{ $user->email }}</p>
                            </div>

                            <form action="{{ route('admin.users.updateFull', $user->id) }}" method="POST" class="col-span-7 grid grid-cols-7 gap-4 items-center">
                                @csrf @method('PATCH')

                                <div class="col-span-2">
                                    <select name="role" class="w-full bg-transparent border-none p-0 text-[11px] font-black uppercase tracking-tighter text-blue-600 focus:ring-0 cursor-pointer">
                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="employe" {{ $user->role == 'employe' ? 'selected' : '' }}>Employé</option>
                                        <option value="chef_projet" {{ $user->role == 'chef_projet' ? 'selected' : '' }}>Chef Projet</option>
                                        <option value="rh" {{ $user->role == 'rh' ? 'selected' : '' }}>RH</option>
                                        <option value="comptable" {{ $user->role == 'comptable' ? 'selected' : '' }}>Comptable</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>

                                <div class="col-span-2">
                                    <div class="flex items-baseline gap-1">
                                        <input type="number" name="salaire" value="{{ $user->salaire }}" class="w-full bg-transparent border-none p-0 text-lg font-black text-gray-900 focus:ring-0 outline-none" step="0.01">
                                        <span class="text-[9px] font-bold text-gray-300">DH</span>
                                    </div>
                                </div>

                                <div class="col-span-3 text-right">
                                    <button type="submit" class="text-[10px] font-black uppercase tracking-widest border-b-2 border-black pb-1 hover:border-blue-600 hover:text-blue-600 transition-all active:scale-95">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="md:hidden space-y-12">
                @foreach ($users as $user)
                    <div class="flex flex-col border-l-2 border-gray-100 pl-4 py-2">
                        <div class="mb-4">
                            <span class="text-[9px] font-black text-blue-600 uppercase tracking-widest">{{ $user->role }}</span>
                            <h3 class="text-2xl font-bold tracking-tighter">{{ $user->nom }} {{ $user->prenom }}</h3>
                            <p class="text-[10px] text-gray-400 font-medium italic mt-0.5">{{ $user->email }}</p>
                        </div>

                        <form action="{{ route('admin.users.updateFull', $user->id) }}" method="POST" class="space-y-4">
                            @csrf @method('PATCH')
                            <div class="flex justify-between items-end border-b border-gray-50 pb-2">
                                <div class="w-1/2">
                                    <label class="text-[8px] font-black text-gray-300 uppercase block mb-1">Modify Role</label>
                                    <select name="role" class="w-full bg-transparent border-none p-0 text-[11px] font-black uppercase tracking-tighter text-blue-600 focus:ring-0">
                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="employe" {{ $user->role == 'employe' ? 'selected' : '' }}>Employé</option>
                                        <option value="chef_projet" {{ $user->role == 'chef_projet' ? 'selected' : '' }}>Chef Projet</option>
                                        <option value="rh" {{ $user->role == 'rh' ? 'selected' : '' }}>RH</option>
                                        <option value="comptable" {{ $user->role == 'comptable' ? 'selected' : '' }}>Comptable</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                                <div class="w-1/3 text-right">
                                    <label class="text-[8px] font-black text-gray-300 uppercase block mb-1">Salary</label>
                                    <input type="number" name="salaire" value="{{ $user->salaire }}" class="w-full bg-transparent border-none p-0 text-right text-sm font-black text-gray-900 focus:ring-0" step="0.01">
                                </div>
                            </div>
                            <button type="submit" class="w-full py-4 border border-black text-[10px] font-black uppercase tracking-widest hover:bg-black hover:text-white transition-all">
                                Confirm Changes
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
