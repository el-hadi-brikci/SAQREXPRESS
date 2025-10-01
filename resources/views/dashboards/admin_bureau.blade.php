@extends('adminBureau.layouts.layout')

@section('title', 'Dashboard Bureau')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">Bienvenue sur le dashboard de l'administrateur de bureau</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
            <div class="text-5xl mb-2 text-saqr-blue"><i class="fas fa-users"></i></div>
            <div class="text-lg font-semibold">Employés</div>
            <a href="{{ route('admin.bureau.users.index') }}" class="mt-4 bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500">Voir la liste</a>
        </div>
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
            <div class="text-5xl mb-2 text-saqr-blue"><i class="fas fa-user-friends"></i></div>
            <div class="text-lg font-semibold">Clients</div>
            <a href="{{ route('admin.bureau.clients.index') }}" class="mt-4 bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500">Voir la liste</a>
        </div>
        <div class="bg-white rounded shadow p-6 flex flex-col items-center">
            <div class="text-5xl mb-2 text-saqr-blue"><i class="fas fa-box"></i></div>
            <div class="text-lg font-semibold">Colis</div>
            <a href="{{ route('admin.bureau.colis.index') }}" class="mt-4 bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500">Voir la liste</a>
        </div>
    </div>
</div>
@endsection
