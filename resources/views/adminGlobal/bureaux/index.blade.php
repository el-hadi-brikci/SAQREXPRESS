@extends('adminGlobal.layouts.layout')

@section('title', 'Liste des bureaux')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">Liste des bureaux</h1>
    <table class="min-w-full bg-white border border-gray-200 shadow">
        <thead class="bg-saqr-blue text-white">
            <tr>
                <th class="py-2 px-3">ID</th>
                <th class="py-2 px-3">Nom</th>
                <th class="py-2 px-3">Région</th>
                <th class="py-2 px-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bureaux as $bureau)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-3">{{ $bureau->id }}</td>
                    <td class="py-2 px-3">{{ $bureau->nom }}</td>
                    <td class="py-2 px-3">{{ $bureau->region->nom ?? '-' }}</td>
                    <td class="py-2 px-3 flex space-x-3">
                        <a href="#" class="text-blue-600 hover:underline">Voir</a>
                        <a href="#" class="text-yellow-600 hover:underline">Modifier</a>
                        <form action="#" method="POST" onsubmit="return confirm('Supprimer ce bureau ?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 text-center text-gray-500">Aucun bureau trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
