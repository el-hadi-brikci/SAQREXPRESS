@extends('adminBureau.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">📍 Détails du Client</h1>

    <div class="bg-white shadow rounded p-6 border border-gray-200">
        <p><strong>ID :</strong> {{ $client->id }}</p>
        <p><strong>Nom :</strong> {{ $client->nom }}</p>
        <p><strong>Email :</strong> {{ $client->user->email ?? '-' }}</p>
        <p><strong>Téléphone :</strong> {{ $client->telephone }}</p>
        <p><strong>Adresse :</strong> {{ $client->adresse }}</p>
    </div>

    <div class="flex justify-end mt-6 space-x-3">
        <a href="{{ route('admin.global.clients.index') }}" 
           class="px-4 py-2 bg-gray-300 rounded">⬅ Retour</a>

        <a href="{{ route('admin.global.clients.edit', $client) }}" 
           class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">✏ Modifier</a>

        <a href="{{ route('admin.global.clients.colis', $client->id) }}" 
           class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600">📦 Voir ses Colis</a>

        <form method="POST" action="{{ route('admin.global.clients.destroy', $client) }}" 
              onsubmit="return confirm('Supprimer ce client ?');">
            @csrf @method('DELETE')
            <button type="submit" 
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                🗑 Supprimer
            </button>
        </form>
    </div>
</div>
@endsection
