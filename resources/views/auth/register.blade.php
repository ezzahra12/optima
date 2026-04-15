<x-guest-layout>
    <div class="min-h-[80vh] flex flex-col justify-center items-center py-10">
        <div class="w-full max-w-md px-10 py-10 bg-white shadow-xl shadow-indigo-100/50 rounded-3xl border border-gray-100">

            <div class="mb-8 text-center">
                <h1 class="text-3xl font-black text-indigo-600 italic tracking-tighter">OPTIMA</h1>
                <p class="text-gray-500 font-medium mt-1 text-sm uppercase tracking-tighter">Inscription Collaborateur</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                    <div class="flex items-center mb-1">
                        <svg class="h-4 w-4 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd text-sm" />
                        </svg>
                        <strong class="text-red-800 text-xs uppercase font-black">ياك ما نسيتي شي حاجة؟</strong>
                    </div>
                    <ul class="list-disc list-inside text-[11px] text-red-600 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="nom" class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 italic">Nom</label>
                        <x-text-input id="nom"
                            class="block mt-1 w-full bg-gray-50 border-none px-4 py-2.5 rounded-xl focus:ring-2 focus:ring-indigo-500 shadow-sm"
                            type="text" name="nom" :value="old('nom')" required autofocus />
                    </div>
                    <div>
                        <label for="prenom" class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 italic">Prénom</label>
                        <x-text-input id="prenom"
                            class="block mt-1 w-full bg-gray-50 border-none px-4 py-2.5 rounded-xl focus:ring-2 focus:ring-indigo-500 shadow-sm"
                            type="text" name="prenom" :value="old('prenom')" required />
                    </div>
                </div>

                <div>
                    <label for="email" class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 italic">Email Professionnel</label>
                    <x-text-input id="email"
                        class="block mt-1 w-full bg-gray-50 border-none px-4 py-2.5 rounded-xl focus:ring-2 focus:ring-indigo-500 shadow-sm"
                        type="email" name="email" :value="old('email')" required />
                </div>

                <div>
                    <label for="password" class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 italic">Mot de passe</label>
                    <x-text-input id="password"
                        class="block mt-1 w-full bg-gray-50 border-none px-4 py-2.5 rounded-xl focus:ring-2 focus:ring-indigo-500 shadow-sm"
                        type="password" name="password" required autocomplete="new-password" />
                </div>

                <div>
                    <label for="password_confirmation" class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 italic">Confirmation</label>
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full bg-gray-50 border-none px-4 py-2.5 rounded-xl focus:ring-2 focus:ring-indigo-500 shadow-sm"
                        type="password" name="password_confirmation" required />
                </div>

                <div class="pt-4">
                    <button class="w-full bg-gray-900 hover:bg-black text-white font-black py-4 rounded-xl shadow-lg transition-all active:scale-[0.98] uppercase text-xs tracking-widest">
                        Créer mon compte
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('login') }}" class="text-xs text-gray-400 font-medium hover:text-indigo-600 transition-colors">
                    Déjà inscrit ? <span class="font-bold underline">Se connecter</span>
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
