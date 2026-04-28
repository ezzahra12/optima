<aside class="w-64 bg-white border-r hidden md:block shrink-0 shadow-sm">
    <div class="p-6">
        <h1 class="text-2xl font-black text-blue-600 tracking-tighter italic">OPTIMA</h1>
        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Admin Panel</p>
    </div>
    <nav class="mt-6 px-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}"
            class="{{ isActive('admin.dashboard') }}">Tableau de bord</a>
        <a href="{{ route('admin.produits.index') }}" class="{{ isActive('admin.produits.index') }}">
            Produits</a>
        <a href="{{ route('admin.projets.index') }}"
            class="{{ isActive('admin.projets.index') }}">Projets</a>
        <a href="{{ route('admin.users.index') }}"
            class="{{ isActive('admin.users.index') }}">Utilisateurs</a>
        <a href="{{ route('admin.departements.index') }}"
            class="{{ isActive('admin.departements.index') }}">Départements</a>
        <div class="mt-auto pb-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left p-3 text-red-500 hover:bg-red-50 rounded-lg text-sm font-bold transition flex items-center gap-2">
                    Déconnexion
                </button>
            </form>
        </div>
    </nav>
</aside>
