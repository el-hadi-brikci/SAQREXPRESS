@extends('adminGlobal.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">👤 Détails Utilisateur</h1>

    <div class="bg-white p-6 rounded shadow">
        <p><strong>ID :</strong> {{ $user->id }}</p>
        <p><strong>Nom :</strong> {{ $user->name }}</p>
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <p><strong>Rôle :</strong> {{ $user->role }}</p>
        <p><strong>Région :</strong> {{ $user->region->nom ?? '-' }}</p>
        <p><strong>Bureau :</strong> {{ $user->bureau->nom ?? '-' }}</p>
    </div>

    <div class="flex space-x-3 mt-6">
        <a href="{{ route('admin.global.users.index') }}" class="px-4 py-2 bg-gray-300 rounded">⬅ Retour</a>
        <a href="{{ route('admin.global.users.edit', $user) }}" class="px-4 py-2 bg-yellow-500 text-white rounded">✏ Modifier</a>
        <form method="POST" action="{{ route('admin.global.users.destroy', $user) }}" onsubmit="return confirm('Supprimer ?');">
            @csrf @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">🗑 Supprimer</button>
        </form>
    </div>
</div>
@endsection
