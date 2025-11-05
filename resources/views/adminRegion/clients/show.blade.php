@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">👤 Détail Client</h1>
    <div class="bg-white p-6 rounded shadow-md border border-gray-200">
        <div class="mb-4">
            <span class="font-medium text-gray-700">Nom :</span>
            <span>{{ $client->nom }}</span>
        </div>
        <div class="mb-4">
            <span class="font-medium text-gray-700">Téléphone :</span>
            <span>{{ $client->telephone }}</span>
        </div>
        <div class="mb-4">
            <span class="font-medium text-gray-700">Adresse :</span>
            <span>{{ $client->adresse }}</span>
        </div>
        <div class="mb-4">
            <span class="font-medium text-gray-700">Email :</span>
            <span>{{ $client->user->email ?? '—' }}</span>
        </div>
        <div class="mb-4">
            <span class="font-medium text-gray-700">Prix total des colis :</span>
            <span>{{ number_format($client->colis->sum('prix'), 2) }} DA</span>
        </div>
        <div class="flex justify-end mt-6 space-x-3">
            <a href="{{ route('admin.region.clients.colis', $client) }}" class="px-4 py-2 bg-orange-400 text-white rounded hover:bg-orange-500">📦 Voir les colis</a>
            <a href="{{ route('admin.region.clients.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Retour</a>
        </div>
    </div>
</div>
@endsection
