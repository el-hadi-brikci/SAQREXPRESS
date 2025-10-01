@extends('adminGlobal.layouts.layout')

@section('title', 'Admin Global - Tableau de bord')

@section('content')
  <h1 class="text-4xl font-bold text-saqr-blue mb-8">Bienvenue, Administrateur</h1>

  <div class="grid md:grid-cols-3 gap-8">
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-saqr-blue">
      <h2 class="text-2xl font-semibold mb-2">📦 Gestion des colis</h2>
      <p>Consulter, modifier ou supprimer les colis en cours et passés.</p>
      <a href="{{ route('admin.global.colis.index') }}" class="text-saqr-blue underline mt-2 inline-block hover:text-orange-500 active:bg-orange px-2 py-1 rounded">Accéder</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-saqr-blue">
      <h2 class="text-2xl font-semibold mb-2">👥 Employés</h2>
      <p>Voir la liste des employés, admins, et gérer leurs statuts.</p>
      <a href="{{ route('admin.global.users.index') }}" class="text-saqr-blue underline mt-2 inline-block hover:text-orange-500 active:bg-orange px-2 py-1 rounded">Gérer</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-saqr-blue">
      <h2 class="text-2xl font-semibold mb-2">⚙️ Regions</h2>
      <p>Configurer régions du système.</p>
      <a href="{{ route('admin.global.regions.index') }}" class="text-saqr-blue underline mt-2 inline-block hover:text-orange-500 active:bg-orange px-2 py-1 rounded">Configurer</a>
    </div>
  </div>
@endsection
