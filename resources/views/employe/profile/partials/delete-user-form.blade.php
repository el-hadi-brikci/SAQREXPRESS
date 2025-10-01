@extends('employe.layouts.layout')

@section('content')
    <h2>Supprimer le compte</h2>
    <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('DELETE')

        <div>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">Supprimer le compte</button>
    </form>
@endsection