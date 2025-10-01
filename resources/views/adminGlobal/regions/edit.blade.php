{{-- resources/views/adminGlobal/regions/edit.blade.php --}}
@extends('adminGlobal.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">✏ Modifier la Région</h1>

    <form method="POST" action="{{ route('admin.global.regions.update', $region) }}" 
          class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
        @csrf
        @method('PUT')

        {{-- Champ Nom --}}
        <div class="mb-4">
            <label for="nom" class="block font-medium text-gray-700">Nom de la région</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom', $region->nom) }}"
                   class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('nom')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Actions --}}
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.global.regions.index') }}" 
               class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
               ⬅ Annuler
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-saqr-blue text-white rounded shadow hover:bg-orange-500 transition">
                ✅ Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
