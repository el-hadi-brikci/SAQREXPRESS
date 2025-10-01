<section>
    <header>
        <h2 class="text-lg font-bold text-saqr-blue">
            {{ __('Informations du profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Mettez à jour vos informations de compte et votre adresse email.") }}
        </p>
    </header>

    <!-- Formulaire pour renvoyer le mail de vérification -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Formulaire principal -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Nom -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" 
                name="name" 
                type="text" 
                class="mt-1 block w-full border-gray-300 rounded-lg focus:border-saqr-blue focus:ring-saqr-blue" 
                :value="old('name', $user->name)" 
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" 
                name="email" 
                type="email" 
                class="mt-1 block w-full border-gray-300 rounded-lg focus:border-saqr-blue focus:ring-saqr-blue" 
                :value="old('email', $user->email)" 
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-600">
                        {{ __('Votre adresse email n’est pas vérifiée.') }}

                        <button form="send-verification" 
                            class="underline text-sm text-saqr-blue hover:text-orange-500 rounded-md focus:outline-none">
                            {{ __('Cliquez ici pour renvoyer l’email de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse email.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Boutons -->
        <div class="flex items-center gap-4">
            <button type="submit" 
                class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-semibold transition">
                {{ __('Enregistrer') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-semibold"
                >
                    {{ __('Informations mises à jour !') }}
                </p>
            @endif
        </div>
    </form>
</section>
