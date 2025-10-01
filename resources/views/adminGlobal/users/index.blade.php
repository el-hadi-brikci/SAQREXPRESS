{{-- resources/views/adminGlobal/users/index.blade.php --}}
@extends('adminGlobal.layouts.layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">👥 Liste des Utilisateurs</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- 🔽 Formulaire de filtre --}}
    <div class="flex justify-between items-center mb-4">
        <form method="GET" action="{{ route('admin.global.users.index') }}" class="flex items-center space-x-2">
            <label for="role" class="font-medium text-gray-700">Filtrer par rôle :</label>
            <select name="role" id="role" 
                    onchange="this.form.submit()" 
                    class="border-gray-300 rounded px-2 py-1 focus:ring-saqr-blue focus:border-saqr-blue">
                <option value="">-- Tous --</option>
                <option value="admin_global" {{ request('role') == 'admin_global' ? 'selected' : '' }}>Admin Global</option>
                <option value="admin_region" {{ request('role') == 'admin_region' ? 'selected' : '' }}>Admin Région</option>
                <option value="admin_bureau" {{ request('role') == 'admin_bureau' ? 'selected' : '' }}>Admin Bureau</option>
                <option value="employe" {{ request('role') == 'employe' ? 'selected' : '' }}>Employé</option>
            </select>
        </form>

        {{-- Bouton Ajouter --}}
        <a href="{{ route('admin.global.users.create') }}" 
           class="bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500">
           + Nouvel Utilisateur
        </a>
    </div>

    {{-- Tableau --}}
    <table class="min-w-full bg-white border border-gray-200 shadow">
        <thead class="bg-saqr-blue text-white">
            <tr>
                <th class="py-2 px-3">ID</th>
                <th class="py-2 px-3">Nom</th>
                <th class="py-2 px-3">Email</th>
                <th class="py-2 px-3">Rôle</th>
                <th class="py-2 px-3">Région</th>
                <th class="py-2 px-3">Bureau</th>
                <th class="py-2 px-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-3">{{ $user->id }}</td>
                    <td class="py-2 px-3">{{ $user->name }}</td>
                    <td class="py-2 px-3">{{ $user->email }}</td>
                    <td class="py-2 px-3">{{ ucfirst($user->role) }}</td>
                    <td class="py-2 px-3">{{ $user->region->nom ?? '-' }}</td>
                    <td class="py-2 px-3">{{ $user->bureau->nom ?? '-' }}</td>
                    <td class="py-2 px-3 flex space-x-3">
                        <a href="{{ route('admin.global.users.show', $user) }}" class="text-blue-600 hover:underline">Voir</a>
                        <a href="{{ route('admin.global.users.edit', $user) }}" class="text-yellow-600 hover:underline">Modifier</a>
                        <form action="{{ route('admin.global.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-4 text-center text-gray-500">Aucun utilisateur trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $users->appends(request()->query())->links() }}</div>
</div>
@endsection
