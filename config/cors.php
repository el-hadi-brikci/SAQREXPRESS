<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'logout', 'sanctum/*'],

    'allowed_methods' => ['*'],

    // Autoriser l'application Electron locale (http://localhost:8000) et l'API du VPS
    'allowed_origins' => [env('APP_URL', 'http://localhost'), 'http://localhost:8000', 'http://127.0.0.1:8000'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,
];
