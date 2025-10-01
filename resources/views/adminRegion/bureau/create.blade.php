@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">➕ Ajouter un Bureau</h1>
    <form method="POST" action="{{ route('admin.region.bureau.store') }}" class="bg-white p-6 rounded shadow-md border border-gray-200">
        @csrf
        <div class="mb-4">
            <label for="nom" class="block font-medium text-gray-700">Nom du bureau</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" class="w-full border-gray-300 rounded px-3 py-2 shadow-sm focus:ring-saqr-blue focus:border-saqr-blue">
            @error('nom')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label for="adresse" class="block font-medium text-gray-700">Adresse</label>
            <input type="text" id="adresse" name="adresse" value="{{ old('adresse') }}" class="w-full border-gray-300 rounded px-3 py-2 shadow-sm focus:ring-saqr-blue focus:border-saqr-blue">
            @error('adresse')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Région</label>
            <input type="text" value="{{ \App\Models\Region::find($regionId)->nom ?? '' }}" class="w-full border-gray-300 rounded px-3 py-2 bg-gray-100" readonly>
        </div>
        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.region.bureau.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition mr-2">Annuler</a>
            <button type="submit" class="px-4 py-2 bg-saqr-blue text-white rounded shadow hover:bg-orange-500 transition">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
{{-- resources/views/adminRegion/bureaux/create.blade.php --}}
@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">➕ Ajouter un Bureau</h1>

    <form method="POST" action="{{ route('admin.region.bureau.store') }}" 
          class="bg-white p-6 rounded shadow-md border border-gray-200">
        @csrf

        {{-- Champ Nom --}}
        <div class="mb-4">
            <label for="nom" class="block font-medium text-gray-700">Nom du bureau</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}"
                class="w-full border-gray-300 rounded px-3 py-2 shadow-sm focus:ring-saqr-blue focus:border-saqr-blue">
            @error('nom')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Boutons --}}
        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.region.bureau.index') }}" 
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
