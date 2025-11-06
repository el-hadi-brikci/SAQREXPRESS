<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Interface Employé - Saqr-Express')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    .bg-saqr-blue { background-color: #0000FF; }
    .bg-saqr-blue-dark { background-color: #000080; }
    .text-saqr-blue { color: #0000FF; }
    .hover\:bg-saqr-blue-dark:hover { background-color: #000080; }
    .hover\:text-saqr-blue:hover { color: #0000FF; }
    .active\:bg-orange:active { background-color: #FFA500 !important; }
    .bg-gradient-saqr { background: linear-gradient(135deg, #0000FF 0%, #000080 100%); }
  </style>
</head>
<body class="min-h-screen bg-white">

  <!-- Header -->
  <nav class="bg-gradient-saqr text-white py-4 px-6 flex justify-between items-center">
    <div class="text-xl font-bold text-orange-500">
  <img src="{{ asset('logo.png') }}" alt="Saqr-Express" class="inline-block h-6 mr-2 align-middle">
      <span class="align-middle">Saqr-Express</span>
    </div>
    <ul class="flex space-x-6">
      <li><a href="{{ route('employe.dashboard') }}" class="hover:text-orange-500 active:bg-orange px-2 py-1 rounded">🏠 Dashboard</a></li>
      <li><a href="{{ route('employe.colis.index') }}" class="hover:text-orange-500 active:bg-orange px-2 py-1 rounded">Colis</a></li>
      <li><a href="{{ route('employe.clients.index') }}" class="hover:text-orange-500 active:bg-orange px-2 py-1 rounded">Clients</a></li>
      <li>
        <!-- Menu Profil -->
    <div class="relative group">
      <button class="flex items-center space-x-2 focus:outline-none">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0000FF&color=fff" 
             class="w-8 h-8 rounded-full border border-white" alt="Avatar">
        <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
        <i class="fas fa-caret-down"></i>
      </button>
      <!-- Dropdown -->
      <div class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded shadow-lg hidden group-hover:block">
        <a href="{{ route('employe.profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">⚙️ Profil</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">🚪 Déconnexion</button>
        </form>
      </div>
    </div>
      </li>
    </ul>
  </nav>
  

  <!-- Contenu principal -->
  <main class="py-12 px-6">
    <div class="max-w-6xl mx-auto">
      @yield('content')
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-saqr-blue-dark text-white text-center py-4 mt-16">
    <p>&copy; 2025 Saqr-Express. Tous droits réservés.</p>
  </footer>

</body>
</html>
