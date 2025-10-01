{{-- resources/views/adminBureau/users/edit.blade.php --}}
@extends('adminBureau.layouts.layout')

@section('title', 'Modifier un employé')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">Modifier un employé</h1>

    <form method="POST" action="{{ route('admin.bureau.users.update', $user) }}" class="bg-white p-6 rounded shadow-md border border-gray-200">
        @csrf
        @method('PATCH')

        {{-- Nom --}}
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                class="w-full border-gray-300 rounded px-3 py-2" required>
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full border-gray-300 rounded px-3 py-2" required>
        </div>

        {{-- Mot de passe (optionnel) --}}
        <div class="mb-4">
            <label for="password" class="block font-semibold mb-1">Mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" id="password" name="password"
                class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        {{-- Bureau --}}
        <div class="mb-4">
            <label for="bureau_id" class="block font-semibold mb-1">Bureau</label>
            <select id="bureau_id" name="bureau_id" class="w-full border-gray-300 rounded px-3 py-2" required>
                @foreach($bureaux as $bureau)
                    <option value="{{ $bureau->id }}" {{ old('bureau_id', $user->bureau_id) == $bureau->id ? 'selected' : '' }}>
                        {{ $bureau->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Actions --}}
        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.bureau.users.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 mr-2">Annuler</a>
            <button type="submit" class="px-4 py-2 bg-saqr-blue text-white rounded hover:bg-orange-500">Mettre à jour</button>
        </div>
    </form>
    <a href="{{ route('admin.bureau.users.index') }}" class="mt-6 inline-block bg-gray-300 px-4 py-2 rounded">⬅ Retour à la liste</a>
</div>
@endsection
