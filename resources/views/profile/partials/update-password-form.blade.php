<section>
    <header>
        <h2 class="text-lg font-bold text-saqr-blue">
            {{ __('Mise à jour du mot de passe') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Assurez-vous d’utiliser un mot de passe long et sécurisé pour protéger votre compte.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Mot de passe actuel -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Mot de passe actuel')" />
            <x-text-input id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="mt-1 block w-full border-gray-300 rounded-lg focus:border-saqr-blue focus:ring-saqr-blue" 
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- Nouveau mot de passe -->
        <div>
            <x-input-label for="update_password_password" :value="__('Nouveau mot de passe')" />
            <x-text-input id="update_password_password" 
                name="password" 
                type="password" 
                class="mt-1 block w-full border-gray-300 rounded-lg focus:border-saqr-blue focus:ring-saqr-blue" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirmation du nouveau mot de passe -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="mt-1 block w-full border-gray-300 rounded-lg focus:border-saqr-blue focus:ring-saqr-blue" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Boutons -->
        <div class="flex items-center gap-4">
            <button type="submit" 
                class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-semibold transition">
                {{ __('Enregistrer') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-semibold"
                >
                    {{ __('Mot de passe mis à jour !') }}
                </p>
            @endif
        </div>
    </form>
</section>
