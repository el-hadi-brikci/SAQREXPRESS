@extends('employe.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">📍 Détails du Client</h1>

    <div class="bg-white shadow rounded p-6 border border-gray-200">
        <p><strong>ID :</strong> {{ $client->id }}</p>
        <p><strong>Nom :</strong> {{ $client->nom }}</p>
        <p><strong>Email :</strong> {{ $client->user->email ?? '-' }}</p>
        <p><strong>Téléphone :</strong> {{ $client->telephone }}</p>
        <p><strong>Adresse :</strong> {{ $client->adresse }}</p>
        <p><strong>Prix total des colis :</strong> {{ number_format($client->colis->sum('prix'), 2) }} DA</p>
    </div>

    <div class="flex justify-end mt-6 space-x-3">
        <a href="{{ route('employe.clients.index') }}" 
           class="px-4 py-2 bg-gray-300 rounded">⬅ Retour</a>
        <a href="{{ route('employe.clients.colis', $client->id) }}" 
           class="px-4 py-2 bg-blue-500 text-white rounded">📦 Voir les Colis</a>
    </div>
</div>
@endsection