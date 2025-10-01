@extends('employe.layouts.layout')

@section('content')
    <h2>Mettre à jour le mot de passe</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <div>
            <label for="current_password">Mot de passe actuel</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>

        <div>
            <label for="password">Nouveau mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit">Mettre à jour</button>
    </form>
@endsection