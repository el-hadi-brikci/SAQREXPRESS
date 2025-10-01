@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">👥 Employés et Admins du Bureau</h1>
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.region.users.create') }}" class="bg-saqr-blue text-white px-4 py-2 rounded hover:bg-orange-500 transition">+ Nouvel Employé</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow rounded">
            <thead class="bg-saqr-blue text-white">
                <tr>
                    <th class="py-3 px-4 text-left">#</th>
                    <th class="py-3 px-4 text-left">Nom</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Rôle</th>
                    <th class="py-3 px-4 text-left">Bureau</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($users as $user)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4 font-semibold">{{ $user->id }}</td>
                        <td class="py-3 px-4">{{ $user->name }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">{{ $user->role }}</td>
                        <td class="py-3 px-4">{{ $user->bureau->nom ?? '—' }}</td>
                        <td class="py-3 px-4 flex space-x-4">
                            <a href="{{ route('admin.region.users.show', $user) }}" class="text-blue-600 hover:underline">Voir</a>
                            <a href="{{ route('admin.region.users.edit', $user) }}" class="text-yellow-600 hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.region.users.destroy', $user) }}" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-gray-500">Aucun employé ou admin trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
