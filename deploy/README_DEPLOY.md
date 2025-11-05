Guide de déploiement rapide pour Octenium (Nginx) — SaqrExpress

Prérequis serveur:
- PHP 8.2+, php-fpm
- Composer
- MySQL / SQLite ou autre via config/database.php
- Certbot (pour HTTPS)

Étapes résumées:
1) Récupérer le projet sur le serveur
   git clone <repo> /var/www/saqrexpress

2) Installer dépendances
   cd /var/www/saqrexpress
   composer install --no-dev --optimize-autoloader

3) Copier `.env` (configurer DB, APP_URL, etc.) et générer clé
   cp .env.example .env
   php artisan key:generate

4) Installer Sanctum et configurer
   composer require laravel/sanctum
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   php artisan migrate

5) Configurer nginx (voir nginx_saqrexpress.conf), activer le site et recharger nginx
   sudo ln -s /etc/nginx/sites-available/nginx_saqrexpress.conf /etc/nginx/sites-enabled/
   sudo nginx -t && sudo systemctl reload nginx

6) HTTPS (certbot)
   sudo certbot --nginx -d api.votre-domaine.tld

7) Supervisor / queue workers (si nécessaire)

Notes sécurité:
- Restreindre CORS à vos domaines frontaux.
- Utiliser HTTPS et ne pas exposer phpmyadmin sans protection.
