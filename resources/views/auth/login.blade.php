<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Saqr-Express</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .text-saqr-blue { color: #0000FF; }
        .focus\:ring-saqr-blue:focus { --tw-ring-color: #0000FF; }
        .focus\:border-saqr-blue:focus { border-color: #0000FF; }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-center items-center bg-[#0000FF]">

    <!-- Logo -->
    <div class="mb-8 text-3xl font-bold text-orange-500 flex items-center">
        <i class="fas fa-dove mr-2"></i> Saqr-Express
    </div>

    <!-- Card -->
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold text-center text-saqr-blue mb-6">Connexion</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="block mt-1 w-full rounded-lg border-gray-300 bg-white text-gray-800 shadow-sm focus:ring-saqr-blue focus:border-saqr-blue" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Mot de passe')" />
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="block mt-1 w-full rounded-lg border-gray-300 bg-white text-gray-800 shadow-sm focus:ring-saqr-blue focus:border-saqr-blue" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Role -->
            <div class="mt-4">
                <x-input-label for="role" :value="__('Rôle')" />
                <select id="role" name="role" required
                    class="block mt-1 w-full rounded-lg border-gray-300 bg-white text-gray-800 shadow-sm focus:ring-saqr-blue focus:border-saqr-blue">
                    <option value="" disabled selected>-- Sélectionnez un rôle --</option>
                    @foreach($roles as $role)
                        @if(!empty($role))
                            <option value="{{ $role }}">{{ ucfirst(str_replace('_', ' ', $role)) }}</option>
                        @endif
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- Région -->
            <div id="region-field" class="mt-4 hidden">
                <x-input-label for="region_id" :value="__('Région')" />
                <select id="region_id" name="region_id"
                    class="block mt-1 w-full rounded-lg border-gray-300 bg-white text-gray-800 shadow-sm focus:ring-saqr-blue focus:border-saqr-blue">
                    <option value="" disabled selected>-- Sélectionnez une région --</option>
                    @foreach(\App\Models\Region::all() as $region)
                        <option value="{{ $region->id }}">{{ $region->nom }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
            </div>

            <!-- Bureau -->
            <div id="bureau-field" class="mt-4 hidden">
                <x-input-label for="bureau_id" :value="__('Bureau')" />
                <select id="bureau_id" name="bureau_id"
                    class="block mt-1 w-full rounded-lg border-gray-300 bg-white text-gray-800 shadow-sm focus:ring-saqr-blue focus:border-saqr-blue">
                    <option value="" disabled selected>-- Sélectionnez un bureau --</option>
                    @foreach(\App\Models\Bureau::all() as $bureau)
                        <option value="{{ $bureau->id }}">{{ $bureau->nom }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('bureau_id')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-saqr-blue shadow-sm focus:ring-saqr-blue"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between mt-6">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-saqr-blue hover:text-orange-500"
                       href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif

                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-semibold transition">
                    Se connecter
                </button>
            </div>
        </form>
    </div>

    <!-- Script pour affichage dynamique -->
    <script>
        document.getElementById('role').addEventListener('change', function () {
            let role = this.value;
            let regionField = document.getElementById('region-field');
            let bureauField = document.getElementById('bureau-field');

            // Masquer par défaut
            regionField.classList.add('hidden');
            bureauField.classList.add('hidden');

            if (role === 'admin_region') {
                regionField.classList.remove('hidden');
            } else if (role === 'admin_bureau' || role === 'employe') {
                regionField.classList.remove('hidden');
                bureauField.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
