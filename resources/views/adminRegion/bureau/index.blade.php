
@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">🏢 Liste des Bureaux</h1>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Bouton ajout --}}
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.region.bureau.create') }}" class="bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500 transition">
            + Nouveau Bureau
        </a>
    </div>

    {{-- Tableau --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow rounded">
            <thead class="bg-saqr-blue text-white">
                <tr>
                    <th class="py-3 px-4 text-left">#</th>
                    <th class="py-3 px-4 text-left">Nom</th>
                    <th class="py-3 px-4 text-left">Adresse</th>
                    <th class="py-3 px-4 text-left">Région</th>
                    <th class="py-3 px-4 text-left">Wilaya</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($bureaux as $bureau)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4 font-semibold">{{ $bureau->id }}</td>
                        <td class="py-3 px-4">{{ $bureau->nom }}</td>
                        <td class="py-3 px-4">{{ $bureau->adresse }}</td>
                        <td class="py-3 px-4">{{ $bureau->region->nom ?? '—' }}</td>
                        <td class="py-3 px-4">{{ $bureau->wilaya_number ?? '—' }}</td>
                        <td class="py-3 px-4 flex space-x-4">
                            <a href="{{ route('admin.region.bureau.show', $bureau) }}" class="text-blue-600 hover:underline">Voir</a>
                            <a href="{{ route('admin.region.bureau.edit', $bureau) }}" class="text-yellow-600 hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.region.bureau.destroy', $bureau) }}" onsubmit="return confirm('Supprimer ce bureau ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-gray-500">Aucun bureau trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
