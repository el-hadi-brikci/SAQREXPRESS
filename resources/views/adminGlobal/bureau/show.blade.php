@extends('adminGlobal.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">🏢 Détails du Bureau</h1>

    <div class="bg-white shadow-md rounded-lg border border-gray-200 p-6">
        <p class="mb-2"><strong>ID :</strong> {{ $bureau->id }}</p>
        <p class="mb-2"><strong>Nom :</strong> {{ $bureau->nom }}</p>
        <p class="mb-2"><strong>Adresse :</strong> {{ $bureau->adresse }}</p>
            <p class="mb-2"><strong>Wilaya :</strong> {{ $bureau->wilaya_number ?? '—' }}</p>
        <p><strong>Région :</strong> {{ $bureau->region->nom ?? '—' }}</p>
    </div>

    <div class="flex justify-end mt-6 space-x-3">
        <a href="{{ route('admin.global.bureau.index') }}" class="px-4 py-2 bg-gray-300 rounded">⬅ Retour</a>
        <a href="{{ route('admin.global.bureau.edit', $bureau) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">✏ Modifier</a>
        <form method="POST" action="{{ route('admin.global.bureau.destroy', $bureau) }}" 
              onsubmit="return confirm('Supprimer ce bureau ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">🗑 Supprimer</button>
        </form>
    </div>
</div>
@endsection
