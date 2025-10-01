@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">✏ Modifier Client</h1>
    <form method="POST" action="{{ route('admin.region.clients.update', $client) }}" class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nom" class="block font-medium text-gray-700">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom', $client->nom) }}" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('nom')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $client->user->email ?? '') }}" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label for="telephone" class="block font-medium text-gray-700">Téléphone</label>
            <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $client->telephone) }}" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('telephone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label for="adresse" class="block font-medium text-gray-700">Adresse</label>
            <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $client->adresse) }}" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('adresse')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block font-medium text-gray-700">Mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" id="password" name="password" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.region.clients.index') }}" class="px-4 py-2 bg-gray-300 rounded">⬅ Annuler</a>
            <button type="submit" class="px-4 py-2 bg-saqr-blue text-white rounded hover:bg-orange-500">✅ Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
