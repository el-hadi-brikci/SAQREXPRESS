{{-- resources/views/adminBureau/users/index.blade.php --}}
@extends('adminBureau.layouts.layout')

@section('title', 'Liste des employés du bureau')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">Liste des employés</h1>
    <a href="{{ route('admin.bureau.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Ajouter un employé</a>
    @php
        $currentBureauId = auth()->user()->bureau_id;
    @endphp
    <table class="min-w-full bg-white border border-gray-200 shadow">
        <thead class="bg-saqr-blue text-white">
            <tr>
                <th class="py-3 px-4 text-left">Nom</th>
                <th class="py-3 px-4 text-left">Email</th>
                <th class="py-3 px-4 text-left">Rôle</th>
                <th class="py-3 px-4 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @forelse($users as $user)
                @if(($user->role === 'employe' || $user->role === 'admin_bureau') && $user->bureau_id == $currentBureauId)
                    <tr class="border-t">
                        <td class="py-3 px-4">{{ $user->name }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">{{ $user->role }}</td>
                        <td class="py-3 px-4">
                            <a href="{{ route('admin.bureau.users.show', $user) }}" class="text-blue-600 underline">Voir</a>
                            <a href="{{ route('admin.bureau.users.edit', $user) }}" class="text-green-600 underline ml-2">Modifier</a>
                            <form action="{{ route('admin.bureau.users.destroy', $user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 underline ml-2" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="4" class="py-4 text-center text-gray-500">Aucun employé trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
