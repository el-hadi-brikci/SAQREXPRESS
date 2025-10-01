@extends('adminBureau.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">➕ Ajouter un Client</h1>

    <form method="POST" action="{{ route('admin.global.clients.store') }}" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label for="nom" class="block font-medium text-gray-700">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}"
                   class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('nom') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                   class="w-full border-gray-300 rounded px-3 py-2">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="telephone" class="block font-medium text-gray-700">Téléphone</label>
            <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}"
                   class="w-full border-gray-300 rounded px-3 py-2">
            @error('telephone') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="adresse" class="block font-medium text-gray-700">Adresse</label>
            <input type="text" name="adresse" id="adresse" value="{{ old('adresse') }}"
                   class="w-full border-gray-300 rounded px-3 py-2">
            @error('adresse') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block font-medium text-gray-700">Mot de passe</label>
            <input type="password" name="password" id="password"
                   class="w-full border-gray-300 rounded px-3 py-2">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.global.clients.index') }}" class="px-4 py-2 bg-gray-300 rounded mr-2">Annuler</a>
            <button type="submit" class="px-4 py-2 bg-saqr-blue text-white rounded hover:bg-orange-500">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
