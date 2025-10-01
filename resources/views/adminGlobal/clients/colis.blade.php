@extends('adminGlobal.layouts.layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">
        📦 Colis du client : {{ $client->nom }}
    </h1>

    <a href="{{ route('admin.global.clients.index') }}" 
       class="mb-4 inline-block bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
       ⬅ Retour à la liste des clients
    </a>

    <table class="min-w-full bg-white border border-gray-200 shadow">
        <thead class="bg-saqr-blue text-white">
            <tr>
                <th class="py-2 px-3">ID</th>
                <th class="py-2 px-3">Code Suivi</th>
                <th class="py-2 px-3">Statut</th>
                <th class="py-2 px-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($colis as $c)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-3">{{ $c->id }}</td>
                    <td class="py-2 px-3">{{ $c->code_suivi }}</td>
                    <td class="py-2 px-3">{{ ucfirst($c->statut) }}</td>
                    <td class="py-2 px-3 flex space-x-3">
                        <a href="{{ route('admin.global.colis.show', $c) }}" class="text-blue-600 hover:underline">Voir</a>
                        <a href="{{ route('admin.global.colis.edit', $c) }}" class="text-yellow-600 hover:underline">Modifier</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 text-center text-gray-500">Aucun colis trouvé pour ce client</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $colis->links() }}
    </div>
</div>
@endsection
