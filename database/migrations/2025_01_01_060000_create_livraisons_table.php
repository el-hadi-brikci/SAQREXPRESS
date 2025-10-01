<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->string('expediteur_nom');
            $table->string('expediteur_tel');
            $table->string('destinataire_nom');
            $table->string('destinataire_tel');
            $table->string('etat')->default('en_attente');

            $table->foreignId('vehicule_id')->constrained('vehicules')->onDelete('cascade');
            $table->foreignId('bureau_id')->constrained('bureaux')->onDelete('cascade');
            $table->foreignId('colis_id')->constrained('colis')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
