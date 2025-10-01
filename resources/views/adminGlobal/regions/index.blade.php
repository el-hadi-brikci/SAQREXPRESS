{{-- resources/views/adminGlobal/regions/index.blade.php --}}
@extends('adminGlobal.layouts.layout')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">📍 Liste des Régions</h1>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Bouton ajout --}}
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.global.regions.create') }}" 
           class="bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500 transition">
           + Nouvelle Région
        </a>
    </div>

    {{-- Tableau des régions --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow rounded">
            <thead class="bg-saqr-blue text-white">
                <tr>
                    <th class="py-3 px-4 text-left">#</th>
                    <th class="py-3 px-4 text-left">Nom</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($regions as $region)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4 font-semibold">{{ $region->id }}</td>
                        <td class="py-3 px-4">{{ $region->nom }}</td>
                        <td class="py-3 px-4 flex space-x-4">
                            <a href="{{ route('admin.global.regions.show', $region) }}" 
                               class="text-blue-600 hover:underline">Voir</a>
                            <a href="{{ route('admin.global.regions.edit', $region) }}" 
                               class="text-yellow-600 hover:underline">Modifier</a>

                            <form method="POST" action="{{ route('admin.global.regions.destroy', $region) }}" 
                                  onsubmit="return confirm('Supprimer cette région ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-gray-500">
                            Aucune région trouvée
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
