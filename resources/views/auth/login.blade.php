<x-guest-layout>
    

   <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-white shadow-xl shadow-indigo-100/50 overflow-hidden sm:rounded-3xl border border-gray-100">

        <div class="mb-10 text-center">
            <h1 class="text-4xl font-black text-indigo-600 italic tracking-tighter">OPTIMA</h1>
            <p class="text-gray-500 font-medium mt-2">Connectez-vous à votre espace</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Adresse Email</label>
                <input type="email" name="email" :value="old('email')" required autofocus
                    class="block mt-1 w-full bg-gray-50 border-none px-4 py-3 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Mot de passe</label>
                <input type="password" name="password" required
                    class="block mt-1 w-full bg-gray-50 border-none px-4 py-3 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
                <label class="inline-flex items-center">
                    <input type="checkbox" class="rounded-md border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-xs text-gray-500 font-medium italic">Se souvenir</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-indigo-600 font-bold hover:underline" href="{{ route('password.request') }}">Oublié ?</a>
                @endif
            </div>

            <div>
                <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-xl shadow-lg shadow-indigo-200 transition-all active:scale-[0.98] uppercase text-xs tracking-widest">
                    Se Connecter
                </button>
            </div>
        </form>

        <p class="mt-8 text-center text-xs text-gray-400">
            Nouveau chez Optima ? <a href="{{ route('register') }}" class="text-indigo-600 font-bold">Créer un compte</a>
        </p>
    </div>
</div>
</x-guest-layout>
