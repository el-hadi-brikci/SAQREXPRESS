<?php

return [
    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', 'localhost')),
    'expiration' => null,
    'middleware' => [
        // Use string class names to avoid static analyzers complaining when extensions are not installed
        'verify_csrf_token' => 'App\\Http\\Middleware\\VerifyCsrfToken',
        'encrypt_cookies' => 'App\\Http\\Middleware\\EncryptCookies',
    ],
];
