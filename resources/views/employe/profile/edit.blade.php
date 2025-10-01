@extends('employe.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">⚙️ Mon Profil</h1>

    @if (session('status'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="bg-white p-6 rounded-lg shadow border border-gray-200">
        @csrf
        @method('PUT')

        <!-- Nom -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Nom</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('email')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Mot de passe -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Nouveau mot de passe</label>
            <input type="password" name="password"
                   class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('password')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmation mot de passe -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation"
                   class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
        </div>

        <!-- Boutons -->
        <div class="flex justify-end">
            <button type="submit" 
                    class="px-5 py-2 bg-saqr-blue text-white rounded shadow hover:bg-orange-500 transition">
                ✅ Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection