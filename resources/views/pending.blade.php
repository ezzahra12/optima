<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optima | Attente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff; /* خلفية بيضاء نقية */
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-8 text-slate-900">

    @if(auth()->user()->role == 'user')
    <div class="max-w-lg w-full text-center">

        <div class="mb-16">
            <span class="text-xl font-extrabold tracking-tighter text-[#4F46E5]">Optima.</span>
        </div>

        <main class="space-y-8">

            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">
                Compte en attente
            </h1>

            <p class="text-lg text-slate-500 leading-relaxed font-medium">
                Bonjour <span class="text-slate-900 font-semibold">{{ auth()->user()->name }}</span>,
                votre inscription a bien été reçue. Notre équipe examine vos informations pour valider votre accès.
            </p>

            <div class="py-6">
                <h3 class="text-[#4F46E5] text-[11px] font-bold uppercase tracking-[0.3em] mb-3">Prochaine étape</h3>
                <p class="text-slate-400 text-sm max-w-sm mx-auto leading-relaxed">
                    Vous recevrez un email dès que votre rôle sera assigné. Ce processus prend généralement moins de 24 heures.
                </p>
            </div>

            <div class="flex flex-col items-center gap-6 pt-6">
                <button onclick="window.location.reload()"
                    class="group relative inline-flex items-center gap-2 font-bold text-sm uppercase tracking-widest text-slate-900 hover:text-[#4F46E5] transition-colors">
                    <span>Actualiser le statut</span>
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-slate-300 font-semibold text-[10px] uppercase tracking-[0.2em] hover:text-red-400 transition-colors">
                        Se déconnecter
                    </button>
                </form>
            </div>
        </main>

        <footer class="mt-32 pt-8 border-t border-slate-50 text-[10px] text-slate-300 flex justify-between items-center uppercase tracking-widest font-medium">
            <p>© 2026 Optima Suite</p>
            <div class="flex gap-4">
                <a href="#" class="hover:text-slate-500">Privacy</a>
                <a href="#" class="hover:text-slate-500">Support</a>
            </div>
        </footer>
    </div>

    @else
        @php
            $user = auth()->user();
            $url = match($user->role) {
                'admin' => route('admin.dashboard'),
                'chef_projet' => route('chef.dashboard'),
                'employe' => route('employe.dashboard'),
                default => '/',
            };
        @endphp
        <script>window.location.href = "{{ $url }}";</script>
    @endif

</body>
</html>
