@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">📦 Colis de la région</h1>
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.region.colis.create') }}" class="bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500 transition">+ Nouveau Colis</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow rounded">
            <thead class="bg-saqr-blue text-white">
                <tr>
                    <th class="py-3 px-4 text-left">#</th>
                    <th class="py-3 px-4 text-left">Code Suivi</th>
                    <th class="py-3 px-4 text-left">Client</th>
                    <th class="py-3 px-4 text-left">Départ</th>
                    <th class="py-3 px-4 text-left">Destination</th>
                    <th class="py-3 px-4 text-left">Statut</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($colis as $colis)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4 font-semibold">{{ $colis->id }}</td>
                        <td class="py-3 px-4">{{ $colis->code_suivi }}</td>
                        <td class="py-3 px-4">{{ $colis->client->nom ?? '—' }}</td>
                        <td class="py-3 px-4">{{ $colis->bureau->nom ?? '—' }}</td>
                        <td class="py-3 px-4">{{ $colis->bureauDestination->nom ?? '—' }}</td>
                        <td class="py-3 px-4">{{ ucfirst($colis->statut) }}</td>
                        <td class="py-3 px-4 flex space-x-4">
                            <a href="{{ route('admin.region.colis.show', $colis) }}" class="text-blue-600 hover:underline">Voir</a>
                            <a href="{{ route('admin.region.colis.edit', $colis) }}" class="text-yellow-600 hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.region.colis.destroy', $colis) }}" onsubmit="return confirm('Supprimer ce colis ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 text-center text-gray-500">Aucun colis trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
