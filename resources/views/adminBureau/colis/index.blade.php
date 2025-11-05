@extends('adminBureau.layouts.layout')

@section('content')
<h1 class="text-3xl font-bold text-saqr-blue mb-6">📦 Liste des Colis</h1>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="flex flex-col md:flex-row md:justify-between mb-4 space-y-2 md:space-y-0 md:space-x-4">
    <form method="GET" action="{{ route('admin.bureau.colis.index') }}" class="flex space-x-2">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="🔍 Rechercher un colis..."
               class="px-3 py-2 border rounded w-64 focus:ring-saqr-blue focus:border-saqr-blue">
        <button type="submit" class="bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500">
            Rechercher
        </button>
    </form>

    <form method="GET" action="{{ route('admin.bureau.colis.index') }}" class="flex space-x-2">
        <input type="date" name="jour" value="{{ request('jour') }}"
               class="px-3 py-2 border rounded focus:ring-saqr-blue focus:border-saqr-blue">
        <button type="submit" class="bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500">
            Filtrer par journée
        </button>
        @if(request('jour'))
            <a href="{{ route('admin.bureau.colis.index') }}" class="ml-2 text-saqr-blue underline">Réinitialiser</a>
        @endif
    </form>

    <a href="{{ route('admin.bureau.colis.create') }}" class="bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500">
        + Nouveau Colis
    </a>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 shadow">
        <thead class="bg-saqr-blue text-white">
            <tr>
                <th class="py-2 px-3 text-left">N° du jour</th>
                <th class="py-2 px-3 text-left">Code Suivi</th>
                <th class="py-2 px-3 text-left">Prix</th>
                <th class="py-2 px-3 text-left">Statut</th>
                <th class="py-2 px-3 text-left">Client</th>
                <th class="py-2 px-3 text-left">Saisi par</th>
                <th class="py-2 px-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grouped = ($colis ?? collect())->groupBy(function($item) {
                    return optional($item->created_at)->format('d/m/Y');
                });
                $dates = collect($grouped->keys())->sortByDesc(function($date) {
                    return \DateTime::createFromFormat('d/m/Y', $date)->getTimestamp();
                });
            @endphp
            @forelse($dates as $dateColis)
                @php
                    $jourColis = $grouped[$dateColis];
                @endphp
                <tr class="bg-gray-100"><td colspan="7" class="font-bold text-saqr-blue py-2 px-3">Journée du {{ $dateColis }}</td></tr>
                @foreach($jourColis as $i => $coli)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-2 px-3">{{ $i + 1 }}</td>
                        <td class="py-2 px-3">{{ $coli->code_suivi }}</td>
                        <td class="py-2 px-3">{{ number_format($coli->prix, 2) }} DA</td>
                        <td class="py-2 px-3">{{ ucfirst($coli->statut) }}</td>
                        <td class="py-2 px-3">{{ $coli->client->nom ?? '-' }}</td>
                        <td class="py-2 px-3">{{ $coli->saisiParUser->name ?? '-' }}</td>
                        <td class="py-2 px-3 flex space-x-3">
                            <a href="{{ route('admin.bureau.colis.show', $coli) }}" class="text-blue-600 hover:underline">Voir</a>
                            <a href="{{ route('admin.bureau.colis.edit', $coli) }}" class="text-yellow-600 hover:underline">Modifier</a>
                            <form action="{{ route('admin.bureau.colis.destroy', $coli) }}" method="POST" onsubmit="return confirm('Supprimer ce colis ?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @php
                    $nbColis = count($jourColis);
                    $totalPrix = collect($jourColis)->sum('prix');
                @endphp
                <tr class="bg-green-100"><td colspan="7" class="font-bold text-green-700 py-2 px-3">Total colis : {{ $nbColis }} | Total prix : {{ number_format($totalPrix, 2) }} DA</td></tr>
            @empty
                <tr><td colspan="7" class="py-4 text-center text-gray-500">Aucun colis trouvé</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
