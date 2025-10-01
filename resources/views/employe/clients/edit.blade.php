@extends('employe.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">✏ Modifier le Client</h1>

    <form method="POST" action="{{ route('employe.clients.update', $client) }}" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nom" class="block font-medium text-gray-700">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $client->nom) }}"
                   class="w-full border-gray-300 rounded px-3 py-2">
            @error('nom') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $client->user->email) }}"
                   class="w-full border-gray-300 rounded px-3 py-2">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="telephone" class="block font-medium text-gray-700">Téléphone</label>
            <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $client->telephone) }}"
                   class="w-full border-gray-300 rounded px-3 py-2">
            @error('telephone') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="adresse" class="block font-medium text-gray-700">Adresse</label>
            <input type="text" name="adresse" id="adresse" value="{{ old('adresse', $client->adresse) }}"
                   class="w-full border-gray-300 rounded px-3 py-2">
            @error('adresse') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block font-medium text-gray-700">Mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" name="password" id="password"
                   class="w-full border-gray-300 rounded px-3 py-2">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('employe.clients.index') }}" class="px-4 py-2 bg-gray-300 rounded mr-2">Annuler</a>
            <button type="submit" class="px-4 py-2 bg-saqr-blue text-white rounded hover:bg-orange-500">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection