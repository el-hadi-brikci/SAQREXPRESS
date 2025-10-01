@extends('employe.layouts.layout')

@section('content')
    <h2>Mettre à jour les informations du profil</h2>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <button type="submit">Mettre à jour</button>
    </form>
@endsection