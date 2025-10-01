@extends('adminBureau.layouts.layout')

@section('title', 'Détail de l’employé')

@section('content')
  <h1 class="text-3xl font-bold text-saqr-blue mb-6">Détail de l’employé</h1>
  <div class="bg-white p-6 rounded shadow max-w-lg mx-auto">
    <p><strong>Nom :</strong> {{ $user->name }}</p>
    <p><strong>Email :</strong> {{ $user->email }}</p>
    <p><strong>Bureau :</strong> {{ $user->bureau->nom ?? '-' }}</p>
    <p><strong>Région :</strong> {{ $user->region->nom ?? '-' }}</p>
    <p><strong>Rôle :</strong> {{ ucfirst($user->role) }}</p>
  </div>
  <a href="{{ route('admin.bureau.users.index') }}" class="mt-6 inline-block bg-gray-300 px-4 py-2 rounded">⬅ Retour à la liste</a>
@endsection
