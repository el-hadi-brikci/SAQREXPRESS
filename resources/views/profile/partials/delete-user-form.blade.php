<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-saqr-blue">
            {{ __('Suppression du compte') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Une fois votre compte supprimé, toutes vos données seront définitivement effacées. Téléchargez ce que vous souhaitez conserver avant de continuer.') }}
        </p>
    </header>

    <!-- Bouton d'ouverture -->
    <button
        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg transition"
        x-data
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        {{ __('Supprimer mon compte') }}
    </button>

    <!-- Modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-saqr-blue mb-2">
                {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Une fois votre compte supprimé, toutes vos ressources et données seront définitivement effacées. Veuillez entrer votre mot de passe pour confirmer.') }}
            </p>

            <!-- Password -->
            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 border-gray-300 rounded-lg focus:border-saqr-blue focus:ring-saqr-blue"
                    placeholder="{{ __('Mot de passe') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <!-- Boutons -->
            <div class="mt-6 flex justify-end">
                <button type="button"
                    x-on:click="$dispatch('close')"
                    class="px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 transition">
                    {{ __('Annuler') }}
                </button>

                <button type="submit"
                    class="ml-3 px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold transition">
                    {{ __('Supprimer') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
