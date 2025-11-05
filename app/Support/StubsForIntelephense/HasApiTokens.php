<?php

namespace App\Support\StubsForIntelephense;

// Stub pour Intelephense - ne pas utiliser en production.
trait HasApiTokens
{
    /**
     * Stub createToken method used by routes during static analysis.
     * @param string $name
     * @param array $abilities
     * @return object
     */
    public function createToken(string $name, array $abilities = [])
    {
        return (object)['plainTextToken' => 'stub-token'];
    }
}
