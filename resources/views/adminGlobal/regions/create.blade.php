{{-- resources/views/adminGlobal/regions/create.blade.php --}}
@extends('adminGlobal.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">➕ Ajouter une Région</h1>

    <form method="POST" action="{{ route('admin.global.regions.store') }}" 
          class="bg-white p-6 rounded shadow-md border border-gray-200">
        @csrf

        {{-- Champ Nom --}}
        <div class="mb-4">
            <label for="nom" class="block font-medium text-gray-700">Nom de la région</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}"
                class="w-full border-gray-300 rounded px-3 py-2 shadow-sm focus:ring-saqr-blue focus:border-saqr-blue">
            @error('nom')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Boutons --}}
        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.global.regions.index') }}" 
               class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition mr-2">
                Annuler
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-saqr-blue text-white rounded shadow hover:bg-orange-500 transition">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
