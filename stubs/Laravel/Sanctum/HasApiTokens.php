<?php

namespace Laravel\Sanctum;

// Stub pour Intelephense / analyse statique.
// Ne pas charger en production — le vrai trait viendra de laravel/sanctum via Composer.
if (!\trait_exists('Laravel\\Sanctum\\HasApiTokens')) {
    trait HasApiTokens
    {
        /**
         * Simulate createToken for static analysis.
         * @param string $name
         * @param array $abilities
         * @return object
         */
        public function createToken(string $name, array $abilities = [])
        {
            return new class {
                public $plainTextToken = 'stub-token';
            };
        }
    }
}
