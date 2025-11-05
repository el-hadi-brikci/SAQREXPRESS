# API SaqrExpress

Ce fichier contient des exemples d'appels pour tester l'API (auth token + endpoints colis).

1) Login (obtenir un token)

```bash
curl -X POST https://api.votre-domaine.tld/api/login \
  -d "email=utilisateur@example.com&password=motdepasse"
```

Réponse attendue:

```json
{ "token": "eyJhbGci..." }
```

2) Appeler un endpoint protégé (liste des colis)

```bash
curl -H "Authorization: Bearer <TOKEN>" https://api.votre-domaine.tld/api/colis
```

3) Appeler le tracking public

```bash
curl https://api.votre-domaine.tld/api/tracking/ABC123
```

Notes:
- Avant d'utiliser les endpoints protégés, exécutez `composer update` puis `php artisan vendor:publish --provider="Laravel\\Sanctum\\SanctumServiceProvider"` et `php artisan migrate` sur le serveur API.
- Pour une application Electron, stockez le token de façon sécurisée (p.ex. keytar) et ajoutez l'entête Authorization sur chaque requête.
