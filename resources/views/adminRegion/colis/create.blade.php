@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl font-bold text-saqr-blue mb-6">Ajouter un colis</h1>
    <form method="POST" action="{{ route('admin.region.colis.store') }}" class="bg-white shadow rounded p-6">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold mb-1">Code Suivi</label>
            <input type="text" name="code_suivi" class="form-input w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-600 cursor-not-allowed" value="{{ old('code_suivi') }}" placeholder="Généré automatiquement" readonly>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Client</label>
            <input list="client-list" name="client_name" value="{{ old('client_name') }}" class="form-input w-full border border-gray-300 rounded px-3 py-2" placeholder="Tapez un nom ou choisissez..." autocomplete="off" />
            <datalist id="client-list">
                @foreach($clients as $client)
                    <option value="{{ $client->nom }}"></option>
                @endforeach
            </datalist>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Bureau de départ</label>
            <select name="bureau_id" class="form-select w-full" required>
                <option value="">Sélectionner...</option>
                @foreach($bureaux as $bureau)
                    <option value="{{ $bureau->id }}" {{ old('bureau_id') == $bureau->id ? 'selected' : '' }}>{{ $bureau->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Bureau de destination</label>
            <select name="bureau_destination_id" class="form-select w-full">
                <option value="">Sélectionner...</option>
                @foreach($bureaux as $bureau)
                    <option value="{{ $bureau->id }}" {{ old('bureau_destination_id') == $bureau->id ? 'selected' : '' }}>{{ $bureau->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Statut</label>
            <select name="statut" class="form-select w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="en_attente">En attente</option>
                <option value="en_cours">En cours</option>
                <option value="livré">Livré</option>
                <option value="annulé">Annulé</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description" class="form-textarea w-full">{{ old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Poids (kg)</label>
            <input type="number" step="0.01" name="poids" class="form-input w-full border border-gray-300 rounded px-3 py-2" value="{{ old('poids') }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Prix (DA)</label>
            <input type="number" step="0.01" name="prix" class="form-input w-full" value="{{ old('prix') }}" required>
        </div>
        <div class="mb-4">
            {{-- Code barre masqué / facultatif (généré automatiquement si nécessaire) --}}
            <input type="hidden" name="code_barre" value="{{ old('code_barre') }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Numéro Voiture</label>
            <input type="text" name="numero_voiture" class="form-input w-full" value="{{ old('numero_voiture') }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Téléphone Chauffeur</label>
            <input type="text" name="telephone_chauffeur" class="form-input w-full" value="{{ old('telephone_chauffeur') }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Téléphone Envoyeur</label>
            <input type="text" name="telephone_envoyeur" class="form-input w-full" value="{{ old('telephone_envoyeur') }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Téléphone Receveur</label>
            <input type="text" name="telephone_receveur" class="form-input w-full" value="{{ old('telephone_receveur') }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Date livraison réelle</label>
            <input type="datetime-local" name="date_livraison_reelle" class="form-input w-full border border-gray-300 rounded px-3 py-2" value="{{ old('date_livraison_reelle') }}">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-saqr-blue text-white px-6 py-2 rounded hover:bg-orange-500 transition">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
