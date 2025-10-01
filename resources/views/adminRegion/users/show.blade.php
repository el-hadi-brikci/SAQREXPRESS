@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">👤 Détail Employé/Admin</h1>
    <div class="bg-white p-6 rounded shadow-md border border-gray-200">
        <div class="mb-4">
            <span class="font-medium text-gray-700">Nom :</span>
            <span>{{ $user->name }}</span>
        </div>
        <div class="mb-4">
            <span class="font-medium text-gray-700">Email :</span>
            <span>{{ $user->email }}</span>
        </div>
        <div class="mb-4">
            <span class="font-medium text-gray-700">Rôle :</span>
            <span>{{ $user->role }}</span>
        </div>
        <div class="mb-4">
            <span class="font-medium text-gray-700">Bureau :</span>
            <span>{{ $user->bureau->nom ?? '—' }}</span>
        </div>
        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.region.users.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Retour</a>
        </div>
    </div>
</div>
@endsection
