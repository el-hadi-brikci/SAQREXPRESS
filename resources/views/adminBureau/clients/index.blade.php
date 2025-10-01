@extends('adminBureau.layouts.layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">👤 Liste des Clients</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.bureau.clients.create') }}" 
           class="bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500">
           + Nouveau Client
        </a>
    </div>

    <table class="min-w-full bg-white border border-gray-200 shadow">
        <thead class="bg-saqr-blue text-white">
            <tr>
                <th class="py-2 px-3">ID</th>
                <th class="py-2 px-3">Nom</th>
                <th class="py-2 px-3">Email</th>
                <th class="py-2 px-3">Téléphone</th>
                <th class="py-2 px-3">Adresse</th>
                <th class="py-2 px-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-3">{{ $client->id }}</td>
                    <td class="py-2 px-3">{{ $client->nom }}</td>
                    <td class="py-2 px-3">{{ $client->user->email ?? '-' }}</td>
                    <td class="py-2 px-3">{{ $client->telephone }}</td>
                    <td class="py-2 px-3">{{ $client->adresse }}</td>
                    <td class="py-2 px-3 flex space-x-3">
                        <a href="{{ route('admin.bureau.clients.show', $client) }}" class="text-blue-600 hover:underline">Voir</a>
                        <a href="{{ route('admin.bureau.clients.edit', $client) }}" class="text-yellow-600 hover:underline">Modifier</a>
                        <form action="{{ route('admin.bureau.clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Supprimer ce client ?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-4 text-center text-gray-500">Aucun client trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $clients->links() }}</div>
</div>
@endsection
