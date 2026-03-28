<x-app-layout>
    @if(auth()->user()->role == 'user')

        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-10 border border-gray-200 text-center">

                    <div class="inline-flex items-center justify-center w-20 h-20 bg-amber-100 text-amber-600 rounded-full mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>

                    <h1 class="text-3xl font-extrabold text-gray-900 mb-4">Compte en attente</h1>
                    <p class="text-gray-600 text-lg mb-8">
                        Bienvenue **{{ auth()->user()->prenom }}**. Votre compte est en cours de révision par l'administrateur.
                    </p>

                    <div class="p-6 bg-blue-50 rounded-xl border border-blue-100 inline-block text-left">
                        <h3 class="text-blue-800 font-bold mb-2">Prochaine étape :</h3>
                        <p class="text-blue-700 text-sm">L'admin va vous assigner un rôle (RH, Chef de projet, etc.) pour débloquer les menus.</p>
                    </div>

                    <div class="mt-10">
                        <button onclick="window.location.reload()" class="bg-gray-800 text-white px-8 py-3 rounded-lg font-bold hover:bg-black transition">
                            Actualiser le statut
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h1 class="text-2xl font-bold">Bienvenue dans l'espace professionnel</h1>
                    <p class="mt-4 text-gray-600">Ici vous pouvez gérer les projets et les produits.</p>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
