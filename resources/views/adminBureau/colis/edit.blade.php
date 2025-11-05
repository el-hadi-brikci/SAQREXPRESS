{{-- resources/views/adminGlobal/colis/edit.blade.php --}}
@extends('adminGlobal.layouts.layout')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">✏ Modifier le Colis</h1>

    <form method="POST" action="{{ route('admin.global.colis.update', $colis) }}" 
          class="bg-white p-6 rounded shadow-md border border-gray-200">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block">Code Suivi</label>
                <input type="text" name="code_suivi" value="{{ old('code_suivi', $colis->code_suivi) }}" class="w-full border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block">Code Barre</label>
                <input type="text" name="code_barre" value="{{ old('code_barre', $colis->code_barre) }}" class="w-full border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block">Poids</label>
                <input type="number" step="0.01" name="poids" value="{{ old('poids', $colis->poids) }}" class="w-full border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block">Prix (DA)</label>
                <input type="number" step="0.01" name="prix" value="{{ old('prix', $colis->prix) }}" class="w-full border-gray-300 rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block">Statut</label>
                <select name="statut" class="w-full border-gray-300 rounded px-3 py-2">
                    <option value="en_attente" {{ $colis->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="en_cours" {{ $colis->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                    <option value="livré" {{ $colis->statut == 'livré' ? 'selected' : '' }}>Livré</option>
                    <option value="annulé" {{ $colis->statut == 'annulé' ? 'selected' : '' }}>Annulé</option>
                </select>
            </div>
            <div>
                <label class="block">Client</label>
                <select name="client_id" class="w-full border-gray-300 rounded px-3 py-2">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $colis->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block">Bureau Source</label>
                <select name="bureau_id" class="w-full border-gray-300 rounded px-3 py-2">
                    @foreach($bureaux as $bureau)
                        <option value="{{ $bureau->id }}" {{ $colis->bureau_id == $bureau->id ? 'selected' : '' }}>
                            {{ $bureau->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block">Bureau Destination</label>
                <select name="bureau_destination_id" class="w-full border-gray-300 rounded px-3 py-2">
                    <option value="">-- Facultatif --</option>
                    @foreach($bureaux as $bureau)
                        <option value="{{ $bureau->id }}" {{ $colis->bureau_destination_id == $bureau->id ? 'selected' : '' }}>
                            {{ $bureau->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Champs supplémentaires --}}
        <div class="mt-4">
            <label class="block">Description</label>
            <textarea name="description" class="w-full border-gray-300 rounded px-3 py-2">{{ old('description', $colis->description) }}</textarea>
        </div>
        <div class="mt-4 grid grid-cols-2 gap-4">
            <div>
                <label class="block">Téléphone Envoyeur</label>
                <input type="text" name="telephone_envoyeur" value="{{ old('telephone_envoyeur', $colis->telephone_envoyeur) }}" class="w-full border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block">Téléphone Receveur</label>
                <input type="text" name="telephone_receveur" value="{{ old('telephone_receveur', $colis->telephone_receveur) }}" class="w-full border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block">Numéro Voiture</label>
                <input type="text" name="numero_voiture" value="{{ old('numero_voiture', $colis->numero_voiture) }}" class="w-full border-gray-300 rounded px-3 py-2">
            </div>
            <div>
                <label class="block">Téléphone Chauffeur</label>
                <input type="text" name="telephone_chauffeur" value="{{ old('telephone_chauffeur', $colis->telephone_chauffeur) }}" class="w-full border-gray-300 rounded px-3 py-2">
            </div>
        </div>

        <div class="mt-4">
            <label class="block">Date Livraison Réelle</label>
            <input type="date" name="date_livraison_reelle" value="{{ old('date_livraison_reelle', $colis->date_livraison_reelle) }}" class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.global.colis.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Annuler</a>
            <button type="submit" class="ml-2 px-4 py-2 bg-saqr-blue text-white rounded hover:bg-orange-500">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
