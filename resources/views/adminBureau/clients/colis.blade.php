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
                <th class="py-2 px-3 text-left">ID</th>
                <th class="py-2 px-3 text-left">Code Suivi</th>
                <th class="py-2 px-3 text-left">Prix</th>
                <th class="py-2 px-3 text-left">Statut</th>
                <th class="py-2 px-3 text-left">Client</th>
                <th class="py-2 px-3 text-left">Saisi par</th>
                <th class="py-2 px-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($colis as $coli)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-3">{{ $coli->id }}</td>
                    <td class="py-2 px-3">{{ $coli->code_suivi }}</td>
                    <td class="py-2 px-3">{{ number_format($coli->prix, 2) }} DA</td>
                    <td class="py-2 px-3">{{ ucfirst($coli->statut) }}</td>
                    <td class="py-2 px-3">{{ $coli->client->nom ?? '-' }}</td>
                    <td class="py-2 px-3">{{ $coli->saisiParUser->name ?? '-' }}</td>
                    <td class="py-2 px-3 flex space-x-3">
                        <a href="{{ route('admin.bureau.colis.show', $coli) }}" class="text-blue-600 hover:underline">Voir</a>
                        <a href="{{ route('admin.bureau.colis.edit', $coli) }}" class="text-yellow-600 hover:underline">Modifier</a>
                        <form action="{{ route('admin.bureau.colis.destroy', $coli) }}" method="POST" onsubmit="return confirm('Supprimer ce colis ?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-4 text-center text-gray-500">Aucun colis trouvé pour ce client</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $colis->links() }}
    </div>
</div>
@endsection
