<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Saqr-Express - Solutions d'expédition et de logistique</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    /* Couleurs principales */
    .bg-saqr-blue { background-color: #0000FF; }
    .bg-saqr-blue-dark { background-color: #000080; }
    .text-saqr-blue { color: #0000FF; }

    /* Hover / Active */
    .hover\:bg-saqr-blue-dark:hover { background-color: #000080; }
    .hover\:text-saqr-blue:hover { color: #0000FF; }
    .active\:bg-orange:active { background-color: #FFA500 !important; }

    /* Dégradé */
    .bg-gradient-saqr { background: linear-gradient(135deg, #0000FF 0%, #000080 100%); }
  </style>
</head>
<body class="min-h-screen bg-white">

<!-- Navbar -->
<nav class="bg-gradient-saqr text-white py-4 px-6 flex justify-between items-center">
  <!-- Logo -->
  <div class="text-xl font-bold text-orange-500">
    <i class="fas fa-dove mr-2"></i> SAQR-EXPRESS
  </div>

  <!-- Menu -->
  <ul class="flex space-x-6 items-center">
    <li><a href="#services" class="hover:text-orange-500 active:bg-orange px-2 py-1 rounded">Services</a></li>
    <li><a href="#about" class="hover:text-orange-500 active:bg-orange px-2 py-1 rounded">À propos</a></li>
    <li><a href="#contact" class="hover:text-orange-500 active:bg-orange px-2 py-1 rounded">Contact</a></li>
    <!-- Bouton Se connecter -->
    <li>
      <a href="{{ route('login') }}" 
         class="ml-4 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-semibold transition">
         Se connecter
      </a>
    </li>
  </ul>
</nav>

<!-- Header -->
<header class="text-center py-20 bg-saqr-blue text-white">
  <h1 class="text-5xl font-bold mb-4">Solutions d'expédition rapides et fiables</h1>
  <p class="text-xl">Simplifiez vos livraisons avec SAQR-EXPRESS</p>
</header>

<!-- Suivi colis -->
<section id="tracking" class="py-20 px-6 bg-white">
  <div class="max-w-xl mx-auto text-center">
    <h2 class="text-3xl font-bold text-saqr-blue mb-6">Suivre mon colis</h2>
    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
      <input id="parcelId" type="text" placeholder="Entrez l'ID de votre colis" 
             class="w-full sm:w-2/3 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-saqr-blue">
      <button onclick="checkTracking()" 
              class="bg-saqr-blue text-white px-6 py-3 rounded-lg hover:bg-saqr-blue-dark active:bg-orange transition">
        Rechercher
      </button>
    </div>
    <div id="trackingResult" class="mt-6 text-lg text-gray-700"></div>
  </div>
</section>

<!-- Services -->
<section id="services" class="py-16 px-6 bg-gray-100">
  <h2 class="text-3xl font-bold text-center text-saqr-blue mb-12">Nos Services</h2>
  <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <i class="fas fa-shipping-fast text-4xl text-saqr-blue mb-4"></i>
      <h3 class="text-xl font-semibold mb-2">Livraison Express</h3>
      <p>Recevez vos colis en un temps record grâce à notre réseau logistique optimisé.</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <i class="fas fa-map-marked-alt text-4xl text-saqr-blue mb-4"></i>
      <h3 class="text-xl font-semibold mb-2">Suivi en Temps Réel</h3>
      <p>Suivez chaque étape de votre colis en toute transparence.</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <i class="fas fa-box-open text-4xl text-saqr-blue mb-4"></i>
      <h3 class="text-xl font-semibold mb-2">Collecte et Emballage</h3>
      <p>Un service complet de collecte et d'emballage pour faciliter vos envois.</p>
    </div>
  </div>
</section>

<!-- À propos -->
<section id="about" class="py-16 px-6 bg-white">
  <div class="max-w-4xl mx-auto text-center">
    <h2 class="text-3xl font-bold text-saqr-blue mb-6">À propos de SAQR-EXPRESS</h2>
    <p class="text-lg text-gray-700 leading-relaxed">
      SAQR-EXPRESS est une entreprise innovante spécialisée dans les solutions de logistique et de livraison en Algérie. 
      Nous connectons les commerçants, les clients et les transporteurs à travers une plateforme simple et efficace.
    </p>
  </div>
</section>

<!-- Contact -->
<section id="contact" class="py-16 px-6 bg-gray-100">
  <div class="max-w-3xl mx-auto text-center">
    <h2 class="text-3xl font-bold text-saqr-blue mb-6">Contactez-nous</h2>
    <p class="mb-6">Vous avez des questions ? Écrivez-nous à 
      <a href="mailto:contact@saqr-express.com" class="text-saqr-blue underline hover:text-orange-500">
        contact@saqr-express.com
      </a>
    </p>
    <a href="#"
       class="inline-block bg-saqr-blue hover:bg-saqr-blue-dark active:bg-orange text-white px-6 py-3 rounded-lg text-lg font-semibold transition duration-300">
      Rejoignez-nous
    </a>
  </div>
</section>

<!-- Footer -->
<footer class="bg-saqr-blue-dark text-white text-center py-4">
  <p>&copy; {{ date('Y') }} SAQR-EXPRESS. Tous droits réservés.</p>
</footer>

<!-- Script JS pour suivi colis -->
<script>
function checkTracking() {
    const codeSuivi = document.getElementById('parcelId').value.trim();
    const resultDiv = document.getElementById('trackingResult');
    if (!codeSuivi) {
        resultDiv.innerHTML = '<span class="text-red-500">Veuillez entrer un ID de colis.</span>';
        return;
    }
    resultDiv.innerHTML = 'Recherche en cours...';
    fetch(`/tracking/${codeSuivi}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                resultDiv.innerHTML = `<span class='text-red-500'>${data.error}</span>`;
            } else {
                resultDiv.innerHTML = `
                    <div class='bg-gray-100 p-4 rounded shadow text-left'>
                        <div><strong>Code suivi :</strong> ${data.code_suivi}</div>
                        <div><strong>Description :</strong> ${data.description ?? '-'}</div>
                        <div><strong>Statut :</strong> ${data.statut}</div>
                        <div><strong>Bureau de départ :</strong> ${data.bureau_depart}</div>
                        <div><strong>Bureau de destination :</strong> ${data.bureau_destination}</div>
                        <div><strong>Client :</strong> ${data.client}</div>
                    </div>
                `;
            }
        })
        .catch(() => {
            resultDiv.innerHTML = '<span class="text-red-500">Erreur lors de la recherche du colis.</span>';
        });
}
</script>

</body>
</html>
