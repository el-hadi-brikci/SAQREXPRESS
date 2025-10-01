@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl font-bold text-saqr-blue mb-6">Modifier le colis</h1>
    <form method="POST" action="{{ route('admin.region.colis.update', $colis) }}" class="bg-white shadow rounded p-6">
    @csrf
    @method('PUT')
        <div class="mb-4">
            <label class="block font-semibold mb-1">Code Suivi</label>
            <input type="text" name="code_suivi" class="form-input w-full" required value="{{ old('code_suivi', $colis->code_suivi) }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Client</label>
            <select name="client_id" class="form-select w-full" required>
                <option value="">Sélectionner...</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id', $colis->client_id) == $client->id ? 'selected' : '' }}>{{ $client->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Bureau de départ</label>
            <select name="bureau_id" class="form-select w-full" required>
                <option value="">Sélectionner...</option>
                @foreach($bureaux as $bureau)
                    <option value="{{ $bureau->id }}" {{ old('bureau_id', $colis->bureau_id) == $bureau->id ? 'selected' : '' }}>{{ $bureau->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Bureau de destination</label>
            <select name="bureau_destination_id" class="form-select w-full">
                <option value="">Sélectionner...</option>
                @foreach($bureaux as $bureau)
                    <option value="{{ $bureau->id }}" {{ old('bureau_destination_id', $colis->bureau_destination_id) == $bureau->id ? 'selected' : '' }}>{{ $bureau->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Statut</label>
            <select name="statut" class="form-select w-full" required>
                <option value="en_attente" {{ old('statut', $colis->statut) == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="en_cours" {{ old('statut', $colis->statut) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="livré" {{ old('statut', $colis->statut) == 'livré' ? 'selected' : '' }}>Livré</option>
                <option value="annulé" {{ old('statut', $colis->statut) == 'annulé' ? 'selected' : '' }}>Annulé</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description" class="form-textarea w-full">{{ old('description', $colis->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Poids (kg)</label>
            <input type="number" step="0.01" name="poids" class="form-input w-full" value="{{ old('poids', $colis->poids) }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Code Barre</label>
            <input type="text" name="code_barre" class="form-input w-full" required value="{{ old('code_barre', $colis->code_barre) }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Numéro Voiture</label>
            <input type="text" name="numero_voiture" class="form-input w-full" value="{{ old('numero_voiture', $colis->numero_voiture) }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Téléphone Chauffeur</label>
            <input type="text" name="telephone_chauffeur" class="form-input w-full" value="{{ old('telephone_chauffeur', $colis->telephone_chauffeur) }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Téléphone Envoyeur</label>
            <input type="text" name="telephone_envoyeur" class="form-input w-full" value="{{ old('telephone_envoyeur', $colis->telephone_envoyeur) }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Téléphone Receveur</label>
            <input type="text" name="telephone_receveur" class="form-input w-full" value="{{ old('telephone_receveur', $colis->telephone_receveur) }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Date livraison réelle</label>
            <input type="datetime-local" name="date_livraison_reelle" class="form-input w-full" value="{{ old('date_livraison_reelle', $colis->date_livraison_reelle ? $colis->date_livraison_reelle->format('Y-m-d\TH:i') : '') }}">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-saqr-blue text-white px-6 py-2 rounded hover:bg-orange-500 transition">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
