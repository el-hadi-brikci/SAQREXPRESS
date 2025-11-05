@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">👤 Clients de la région</h1>
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.region.clients.create') }}" class="bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500 transition">+ Nouveau Client</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow rounded">
            <thead class="bg-saqr-blue text-white">
                <tr>
                    <th class="py-3 px-4 text-left">#</th>
                    <th class="py-3 px-4 text-left">Nom</th>
                    <th class="py-3 px-4 text-left">Téléphone</th>
                    <th class="py-3 px-4 text-left">Adresse</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Prix</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($clients as $client)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4 font-semibold">{{ $client->id }}</td>
                        <td class="py-3 px-4">{{ $client->nom }}</td>
                        <td class="py-3 px-4">{{ $client->telephone }}</td>
                        <td class="py-3 px-4">{{ $client->adresse }}</td>
                        <td class="py-3 px-4">{{ $client->user->email ?? '—' }}</td>
                        <td class="py-3 px-4">{{ number_format($client->colis->sum('prix'), 2) }} DA</td>
                        <td class="py-3 px-4 flex space-x-4">
                            <a href="{{ route('admin.region.clients.show', $client) }}" class="text-blue-600 hover:underline">Voir</a>
                            <a href="{{ route('admin.region.clients.edit', $client) }}" class="text-yellow-600 hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.region.clients.destroy', $client) }}" onsubmit="return confirm('Supprimer ce client ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 text-center text-gray-500">Aucun client trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
