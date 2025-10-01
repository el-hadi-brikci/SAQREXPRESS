<x-app-layout>
    <h1 class="text-2xl font-bold">Espace Client</h1>
    <p>Bienvenue {{ Auth::user()->name }} ({{ Auth::user()->role }})</p>
</x-app-layout>
