{{-- resources/views/adminBureau/users/create.blade.php --}}
@extends('adminBureau.layouts.layout')

@section('title', 'Ajouter un employé')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">➕ Ajouter un Utilisateur</h1>

    <form method="POST" action="{{ route('admin.bureau.users.store') }}" class="bg-white p-6 rounded shadow-md border border-gray-200">
        @csrf

        {{-- Nom --}}
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                class="w-full border rounded px-3 py-2" required>
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                class="w-full border rounded px-3 py-2" required>
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Mot de passe --}}
        <div class="mb-4">
            <label for="password" class="block font-semibold mb-1">Mot de passe</label>
            <input type="password" id="password" name="password"
                class="w-full border rounded px-3 py-2" required>
            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <input type="hidden" name="role" value="employe">

        {{-- Bureau --}}
        <div class="mb-4">
            <label for="bureau_id" class="block font-semibold mb-1">Bureau</label>
            <select id="bureau_id" name="bureau_id" class="w-full border rounded px-3 py-2" required>
                @foreach($bureaux as $bureau)
                    <option value="{{ $bureau->id }}">{{ $bureau->nom }}</option>
                @endforeach
            </select>
        </div>

        {{-- Boutons --}}
        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.global.users.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 mr-2">Annuler</a>
            <button type="submit" class="px-4 py-2 bg-saqr-blue text-white rounded hover:bg-orange-500">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
