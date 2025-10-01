{{-- resources/views/adminGlobal/regions/show.blade.php --}}
@extends('adminGlobal.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">📍 Détails de la Région</h1>

    {{-- Carte d’infos --}}
    <div class="bg-white shadow-md rounded-lg border border-gray-200 p-6">
        <p class="mb-2"><strong>ID :</strong> {{ $region->id }}</p>
        <p><strong>Nom :</strong> {{ $region->nom }}</p>
    </div>

    {{-- Actions --}}
    <div class="flex justify-end mt-6 space-x-3">
        <a href="{{ route('admin.global.regions.index') }}" 
           class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
           ⬅ Retour
        </a>
        <a href="{{ route('admin.global.regions.edit', $region) }}" 
           class="px-4 py-2 bg-yellow-500 text-white rounded shadow hover:bg-yellow-600 transition">
           ✏ Modifier
        </a>
        <form method="POST" action="{{ route('admin.global.regions.destroy', $region) }}" 
              onsubmit="return confirm('Supprimer cette région ?');">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="px-4 py-2 bg-red-500 text-white rounded shadow hover:bg-red-600 transition">
                🗑 Supprimer
            </button>
        </form>
    </div>
</div>
@endsection
