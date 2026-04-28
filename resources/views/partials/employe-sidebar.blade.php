<div class="w-60 bg-white min-h-screen border-r border-gray-200">
    <div class="p-6">
        <h1 class="text-2xl font-bold text-indigo-600">Optima</h1>
    </div>

    <div class="px-4">

        @if (auth()->user()->role === 'rh')
            <p class="text-gray-400 text-xs font-bold mb-4 uppercase">Administration</p>

            <a href="{{ route('rh.dashboard') }}" class="{{ isActive('rh.dashboard') }}">
                Vue d'ensemble
            </a>

            <a href="{{ route('rh.absences.index') }}" class="{{ isActive('rh.absences.index') }}">
                Valider Absences
            </a>

            <a href="{{ route('rh.employes.index') }}"
                class="{{ isActive('rh.employes.index') }}">
                Liste des Employés
            </a>
        @elseif(auth()->user()->role === 'comptable')
            <p class="text-gray-400 text-xs font-bold mb-4 uppercase">Finance</p>
            <a href="{{ route('comptable.dashboard') }}" class="{{ isActive('comptable.dashboard') }}">Vue
                d'ensemble</a>
            <a href="{{ route('comptable.salaires.index') }}" class="{{ isActive('comptable.salaires.index') }}">Gestion
                Salaires</a>
        @elseif(auth()->user()->role === 'chef_projet')
            <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest">Espace Chef</p>

            <a href="{{ route('chef.dashboard') }}"
                class="block p-3 bg-indigo-100 text-indigo-700 font-bold rounded mb-2">
                Tableau de bord
            </a>
        @elseif(auth()->user()->role === 'employe')
            <p class="text-gray-400 text-xs font-bold mb-4 uppercase">Menu</p>

            <a href="{{ route('employe.dashboard') }}" class="{{ isActive('employe.dashboard') }}">
                Tableau de bord
            </a>
        @endif

        <a href="{{ route('employe.taches.index') }}" class="{{ isActive('employe.taches.index') }}">
            Mes Missions
        </a>
        <a href="{{ route('employe.absences.index') }}" class="{{ isActive('employe.absences.index') }}">
            Mes Absences
        </a>
        <a href="{{ route('employe.salaires.index') }}" class="{{ isActive('employe.salaires.index') }}">
            Mes Salaires
        </a>

        <hr class="my-4 border-gray-100">

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left p-3 text-red-500 hover:bg-red-50 rounded">
                Déconnexion
            </button>
        </form>
    </div>
</div>
