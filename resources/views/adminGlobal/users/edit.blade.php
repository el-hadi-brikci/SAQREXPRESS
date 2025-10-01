{{-- resources/views/adminGlobal/users/edit.blade.php --}}
@extends('adminGlobal.layouts.layout')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">✏ Modifier l’Utilisateur</h1>

    <form method="POST" action="{{ route('admin.global.users.update', $user) }}" class="bg-white p-6 rounded shadow-md border border-gray-200">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        {{-- Mot de passe (optionnel) --}}
        <div class="mb-4">
            <label for="password" class="block font-medium text-gray-700">Mot de passe (laisser vide si inchangé)</label>
            <input type="password" id="password" name="password"
                class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        {{-- Rôle --}}
        <div class="mb-4">
            <label for="role" class="block font-medium text-gray-700">Rôle</label>
            <select id="role" name="role" class="w-full border-gray-300 rounded px-3 py-2">
                <option value="admin_global" {{ old('role', $user->role) === 'admin_global' ? 'selected' : '' }}>Admin Global</option>
                <option value="admin_region" {{ old('role', $user->role) === 'admin_region' ? 'selected' : '' }}>Admin Région</option>
                <option value="admin_bureau" {{ old('role', $user->role) === 'admin_bureau' ? 'selected' : '' }}>Admin Bureau</option>
                <option value="employe" {{ old('role', $user->role) === 'employe' ? 'selected' : '' }}>Employé</option>
                <option value="client" {{ old('role', $user->role) === 'client' ? 'selected' : '' }}>Client</option>
            </select>
        </div>

        {{-- Région --}}
        <div class="mb-4">
            <label for="region_id" class="block font-medium text-gray-700">Région</label>
            <select id="region_id" name="region_id" class="w-full border-gray-300 rounded px-3 py-2">
                <option value="">-- Choisir une région --</option>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ old('region_id', $user->region_id) == $region->id ? 'selected' : '' }}>
                        {{ $region->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Bureau --}}
        <div class="mb-4">
            <label for="bureau_id" class="block font-medium text-gray-700">Bureau</label>
            <select id="bureau_id" name="bureau_id" class="w-full border-gray-300 rounded px-3 py-2">
                <option value="">-- Choisir un bureau --</option>
                @foreach($bureaux as $bureau)
                    <option value="{{ $bureau->id }}" {{ old('bureau_id', $user->bureau_id) == $bureau->id ? 'selected' : '' }}>
                        {{ $bureau->nom }} ({{ $bureau->region->nom }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Actions --}}
        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.global.users.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 mr-2">Annuler</a>
            <button type="submit" class="px-4 py-2 bg-saqr-blue text-white rounded hover:bg-orange-500">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
