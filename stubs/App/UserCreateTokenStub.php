<?php

namespace App;

// Stub pour Intelephense: ajoute la signature createToken sur User pour l'analyse statique.
// Ne pas inclure ce fichier en runtime; c'est uniquement pour l'analyse locale.
class User
{
    /**
     * @param string $name
     * @param array $abilities
     * @return object
     */
    public function createToken(string $name, array $abilities = [])
    {
        return (object)['plainTextToken' => 'stub-token'];
    }
}
