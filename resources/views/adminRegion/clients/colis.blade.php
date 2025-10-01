@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">📦 Colis du client : {{ $client->nom }}</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow rounded">
            <thead class="bg-saqr-blue text-white">
                <tr>
                    <th class="py-3 px-4 text-left">#</th>
                    <th class="py-3 px-4 text-left">Code suivi</th>
                    <th class="py-3 px-4 text-left">Description</th>
                    <th class="py-3 px-4 text-left">Statut</th>
                    <th class="py-3 px-4 text-left">Bureau</th>
                    <th class="py-3 px-4 text-left">Date livraison</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($colis as $colisItem)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4 font-semibold">{{ $colisItem->id }}</td>
                        <td class="py-3 px-4">{{ $colisItem->code_suivi }}</td>
                        <td class="py-3 px-4">{{ $colisItem->description }}</td>
                        <td class="py-3 px-4">{{ $colisItem->statut }}</td>
                        <td class="py-3 px-4">{{ $colisItem->bureau->nom ?? '—' }}</td>
                        <td class="py-3 px-4">{{ $colisItem->date_livraison_reelle ? $colisItem->date_livraison_reelle->format('d/m/Y') : '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-gray-500">Aucun colis trouvé pour ce client</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="flex justify-end mt-6">
        <a href="{{ route('admin.region.clients.show', $client) }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Retour au client</a>
    </div>
</div>
@endsection
