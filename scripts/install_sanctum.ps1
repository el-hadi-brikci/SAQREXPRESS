<#
Script PowerShell pour installer Laravel Sanctum, publier la config et exécuter les migrations.
A exécuter depuis la racine du projet (c:\laragon\www\SaqrExpress) sur le serveur ou en local.
#>

Write-Host "== Installer laravel/sanctum (si nécessaire) =="
if (-not (Test-Path vendor)) {
    Write-Host "Le dossier vendor n'existe pas ; exécutez 'composer install' d'abord si nécessaire." -ForegroundColor Yellow
}

Write-Host "Installation / mise à jour via composer..."
composer require laravel/sanctum

Write-Host "Publication du provider Sanctum..."
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

Write-Host "Exécution des migrations..."
php artisan migrate

Write-Host "Nettoyage du cache config/routes..."
php artisan config:clear
php artisan route:clear
php artisan cache:clear

Write-Host "Opération terminée. Testez le login via POST /api/login"
