@extends('adminGlobal.layouts.layout')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">📦 Détails du Colis</h1>

    <div class="bg-white shadow-md rounded-lg border border-gray-200 p-6 space-y-4">
         <p class="mb-2"><strong>ID :</strong> {{ $colis->id }}</p>
    <p class="mb-2"><strong>Code suivi :</strong> {{ $colis->code_suivi }}</p>
    <p class="mb-2"><strong>Description :</strong> {{ $colis->description }}</p>
    <p class="mb-2"><strong>Poids :</strong> {{ $colis->poids }} kg</p>
    <p class="mb-2">
        <strong>Statut :</strong>
        <span class="px-2 py-1 rounded text-white {{ [
            'en_attente' => 'bg-yellow-500',
            'en_cours' => 'bg-blue-500',
            'livré' => 'bg-green-500',
        ][$colis->statut] ?? 'bg-red-500' }}">
            {{ ucfirst($colis->statut) }}
        </span>
    </p>
    <p class="mb-2"><strong>Prix :</strong> {{ number_format($colis->prix, 2) }} DA</p>
    <p class="mb-2"><strong>Client :</strong> {{ $colis->client->nom ?? '-' }}</p>
    <p class="mb-2"><strong>Bureau :</strong> {{ $colis->bureau->nom ?? '-' }}</p>

        {{-- Relations --}}
        <p><strong>Bureau d'origine :</strong> {{ $colis->bureau->nom ?? '-' }}</p>
        <p><strong>Bureau de destination :</strong> {{ $colis->bureauDestination->nom ?? '-' }}</p>

        {{-- Transport --}}
        <p><strong>Numéro de voiture :</strong> {{ $colis->numero_voiture ?? '-' }}</p>
        <p><strong>Téléphone chauffeur :</strong> {{ $colis->telephone_chauffeur ?? '-' }}</p>
        <p><strong>Téléphone envoyeur :</strong> {{ $colis->telephone_envoyeur ?? '-' }}</p>
        <p><strong>Téléphone receveur :</strong> {{ $colis->telephone_receveur ?? '-' }}</p>

        {{-- Suivi interne --}}
        <p><strong>Saisi par :</strong> {{ $colis->saisiParUser->name ?? '-' }}</p>
        <p><strong>Date de saisie :</strong> {{ $colis->heure_saisie ? \Carbon\Carbon::parse($colis->heure_saisie)->format('d/m/Y H:i') : '-' }}</p>
    </div>

    <div class="flex justify-end mt-6 space-x-3">
        <a href="{{ route('admin.global.colis.index') }}" 
           class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
           ⬅ Retour
        </a>
        <a href="{{ route('admin.global.colis.edit', $colis) }}" 
           class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
           ✏ Modifier
        </a>
        <a href="{{ route('admin.global.colis.ticket', $colis) }}" 
           class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
           🖨 Imprimer Ticket
        </a>
        <form method="POST" action="{{ route('admin.global.colis.destroy', $colis) }}" 
              onsubmit="return confirm('Supprimer ce colis ?');">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                🗑 Supprimer
            </button>
        </form>
    </div>

    <div class="print:hidden">
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded mb-4">Imprimer le ticket</button>
    </div>
</div>
@endsection
