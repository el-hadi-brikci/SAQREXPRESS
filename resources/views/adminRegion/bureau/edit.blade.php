@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">✏ Modifier le Bureau</h1>
    <form method="POST" action="{{ route('admin.region.bureau.update', $bureau) }}" class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nom" class="block font-medium text-gray-700">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom', $bureau->nom) }}" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('nom')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label for="adresse" class="block font-medium text-gray-700">Adresse</label>
            <input type="text" id="adresse" name="adresse" value="{{ old('adresse', $bureau->adresse) }}" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('adresse')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label for="wilaya_number" class="block font-medium text-gray-700">Numéro de wilaya</label>
            <input type="number" id="wilaya_number" name="wilaya_number" value="{{ old('wilaya_number', $bureau->wilaya_number) }}" min="1" max="99" step="1" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('wilaya_number')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Région</label>
            <input type="text" value="{{ \App\Models\Region::find($regionId)->nom ?? '' }}" class="w-full border-gray-300 rounded px-3 py-2 bg-gray-100" readonly>
        </div>
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.region.bureau.index') }}" class="px-4 py-2 bg-gray-300 rounded">⬅ Annuler</a>
            <button type="submit" class="px-4 py-2 bg-saqr-blue text-white rounded hover:bg-orange-500">✅ Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">✏ Modifier le Bureau</h1>

    <form method="POST" action="{{ route('admin.region.bureau.update', $bureau) }}" 
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

        {{-- Numéro de wilaya --}}
        <div class="mb-4">
            <label for="wilaya_number" class="block font-medium text-gray-700">Numéro de wilaya</label>
            <input type="number" id="wilaya_number" name="wilaya_number" value="{{ old('wilaya_number', $bureau->wilaya_number) }}" min="1" max="99" step="1" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('wilaya_number') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>


        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.region.bureau.index') }}" class="px-4 py-2 bg-gray-300 rounded">⬅ Annuler</a>
            <button type="submit" class="px-4 py-2 bg-saqr-blue text-white rounded hover:bg-orange-500">✅ Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
