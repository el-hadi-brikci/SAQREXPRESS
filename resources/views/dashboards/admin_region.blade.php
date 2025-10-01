@extends('adminRegion.layouts.layout')

@section('title', 'Admin Région - Tableau de bord')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">Bienvenue sur le dashboard de l'administrateur de région</h1>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
            <div class="text-5xl mb-2 text-saqr-blue"><i class="fas fa-building"></i></div>
            <div class="text-lg font-semibold">Bureaux</div>
            <a href="{{ route('admin.region.bureau.index') }}" class="mt-4 bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500">Voir la liste</a>
        </div>
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
            <div class="text-5xl mb-2 text-saqr-blue"><i class="fas fa-users"></i></div>
            <div class="text-lg font-semibold">Employés</div>
            <a href="{{ route('admin.region.users.index') }}" class="mt-4 bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500">Voir la liste</a>
        </div>
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
            <div class="text-5xl mb-2 text-saqr-blue"><i class="fas fa-user-friends"></i></div>
            <div class="text-lg font-semibold">Clients</div>
            <a href="{{ route('admin.region.clients.index') }}" class="mt-4 bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500">Voir la liste</a>
        </div>
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
            <div class="text-5xl mb-2 text-saqr-blue"><i class="fas fa-box"></i></div>
            <div class="text-lg font-semibold">Colis</div>
            <a href="{{ route('admin.region.colis.index') }}" class="mt-4 bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500">Voir la liste</a>
        </div>
    </div>
</div>
@endsection
