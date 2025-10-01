<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('colis', function (Blueprint $table) {
            $table->id();
            $table->string('code_suivi')->unique();
            $table->string('description')->nullable();
            $table->float('poids')->nullable();
            $table->enum('statut', ['en_attente', 'en_cours', 'livré', 'annulé'])->default('en_attente');
            $table->foreignId('bureau_id')->constrained('bureaux')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('colis');
    }
};
