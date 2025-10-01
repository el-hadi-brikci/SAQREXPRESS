@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">✏ Modifier Employé/Admin</h1>
    <form method="POST" action="{{ route('admin.region.users.update', $user) }}" class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block font-medium text-gray-700">Mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" id="password" name="password" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
            @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label for="role" class="block font-medium text-gray-700">Rôle</label>
            <select id="role" name="role" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
                <option value="employe" {{ old('role', $user->role) == 'employe' ? 'selected' : '' }}>Employé</option>
                <option value="admin_bureau" {{ old('role', $user->role) == 'admin_bureau' ? 'selected' : '' }}>Admin Bureau</option>
            </select>
            @error('role')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label for="bureau_id" class="block font-medium text-gray-700">Bureau</label>
            <select id="bureau_id" name="bureau_id" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-saqr-blue focus:border-saqr-blue">
                @foreach($bureaux as $bureau)
                    <option value="{{ $bureau->id }}" {{ (old('bureau_id', $user->bureau_id) == $bureau->id) ? 'selected' : '' }}>{{ $bureau->nom }}</option>
                @endforeach
            </select>
            @error('bureau_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.region.users.index') }}" class="px-4 py-2 bg-gray-300 rounded">⬅ Annuler</a>
            <button type="submit" class="px-4 py-2 bg-saqr-blue text-white rounded hover:bg-orange-500">✅ Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
