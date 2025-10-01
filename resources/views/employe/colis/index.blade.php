@extends('employe.layouts.layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">
        📦 Liste des Colis (Employé)
    </h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <form method="GET" action="{{ route('employe.colis.index') }}" class="flex space-x-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="🔍 Rechercher un colis..."
                   class="px-3 py-2 border rounded w-64 focus:ring-saqr-blue focus:border-saqr-blue">
            <button type="submit" class="bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500">
                Rechercher
            </button>
        </form>

        <a href="{{ route('employe.colis.create') }}" 
           class="bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500">
           + Nouveau Colis
        </a>
    </div>

    

    <table class="min-w-full bg-white border border-gray-200 shadow">
        <thead class="bg-saqr-blue text-white">
            <tr>
                <th class="py-2 px-3">ID</th>
                <th class="py-2 px-3">Code Suivi</th>
                <th class="py-2 px-3">Statut</th>
                <th class="py-2 px-3">Client</th>
                <th class="py-2 px-3">Saisi par</th>
                <th class="py-2 px-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($colis as $coli)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-3">{{ $coli->id }}</td>
                    <td class="py-2 px-3">{{ $coli->code_suivi }}</td>
                    <td class="py-2 px-3">{{ ucfirst($coli->statut) }}</td>
                    <td class="py-2 px-3">{{ $coli->client->nom ?? '-' }}</td>
                    <td class="py-2 px-3">{{ $coli->saisiParUser->name ?? '-' }}</td>
                    <td class="py-2 px-3 flex space-x-3">
                        <a href="{{ route('employe.colis.show', $coli) }}" class="text-blue-600 hover:underline">Voir</a>
                        <a href="{{ route('employe.colis.edit', $coli) }}" class="text-yellow-600 hover:underline">Modifier</a>
                        <form action="{{ route('employe.colis.destroy', $coli) }}" method="POST" onsubmit="return confirm('Supprimer ce colis ?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="py-4 text-center text-gray-500">Aucun colis trouvé</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection