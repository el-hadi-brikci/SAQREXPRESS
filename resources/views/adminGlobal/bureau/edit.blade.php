@extends('adminGlobal.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">✏ Modifier le Bureau</h1>

    <form method="POST" action="{{ route('admin.global.bureau.update', $bureau) }}" 
          class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <div class="mb-4">
            <label for="nom" class="block font-medium text-gray-700">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom', $bureau->nom) }}"
                   class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('nom') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Adresse --}}
        <div class="mb-4">
            <label for="adresse" class="block font-medium text-gray-700">Adresse</label>
            <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $bureau->adresse) }}"
                   class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('adresse') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Région --}}
        <div class="mb-4">
            <label for="region_id" class="block font-medium text-gray-700">Région</label>
            <select id="region_id" name="region_id" 
                    class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
                @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ (old('region_id', $bureau->region_id) == $region->id) ? 'selected' : '' }}>
                        {{ $region->nom }}
                    </option>
                @endforeach
            </select>
            @error('region_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.global.bureau.index') }}" class="px-4 py-2 bg-gray-300 rounded">⬅ Annuler</a>
            <button type="submit" class="px-4 py-2 bg-saqr-blue text-white rounded hover:bg-orange-500">✅ Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
