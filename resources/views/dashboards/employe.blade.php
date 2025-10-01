@extends('employe.layouts.layout')

@section('title', 'Dashboard Employé - Saqr-Express')

@section('content')
  <h1 class="text-3xl font-bold text-saqr-blue mb-8">
    Tableau de bord - Bureau d'Alger
  </h1>

  <!-- Colis -->
  <section class="mb-12">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Liste des Colis</h2>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200 shadow">
        <thead class="bg-saqr-blue text-white">
          <tr>
            <th class="py-3 px-4 text-left">ID Colis</th>
            <th class="py-3 px-4 text-left">Client</th>
            <th class="py-3 px-4 text-left">Statut</th>
            <th class="py-3 px-4 text-left">Date</th>
            <th class="py-3 px-4 text-left">Action</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          @forelse($colisList ?? [] as $colis)
            <tr class="border-t">
              <td class="py-3 px-4">{{ $colis->numero }}</td>
              <td class="py-3 px-4">{{ $colis->client->nom ?? '—' }}</td>
              <td class="py-3 px-4">{{ $colis->statut }}</td>
              <td class="py-3 px-4">{{ $colis->created_at->format('Y-m-d') }}</td>
              <td class="py-3 px-4">
                <a href="{{ route('colis.show', $colis->id) }}" class="text-saqr-blue underline hover:text-orange-500">Détails</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="py-4 text-center text-gray-500">Aucun colis trouvé</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>

  <!-- Clients -->
  <section>
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Liste des Clients</h2>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200 shadow">
        <thead class="bg-saqr-blue text-white">
          <tr>
            <th class="py-3 px-4 text-left">Nom</th>
            <th class="py-3 px-4 text-left">Téléphone</th>
            <th class="py-3 px-4 text-left">Adresse</th>
            <th class="py-3 px-4 text-left">Action</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          @forelse($clients ?? [] as $client)
            <tr class="border-t">
              <td class="py-3 px-4">{{ $client->nom }}</td>
              <td class="py-3 px-4">{{ $client->telephone }}</td>
              <td class="py-3 px-4">{{ $client->adresse }}</td>
              <td class="py-3 px-4">
                <a href="#" class="text-saqr-blue underline hover:text-orange-500">Contacter</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="py-4 text-center text-gray-500">Aucun client trouvé</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>

  <!-- Menu Profil dans la Navbar -->
  
@endsection
