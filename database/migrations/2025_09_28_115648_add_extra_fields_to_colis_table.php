<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('colis', function (Blueprint $table) {
            $table->string('code_barre')->nullable()->after('code_suivi');
            $table->string('numero_voiture')->nullable()->after('description');
            $table->string('telephone_chauffeur')->nullable();
            $table->string('telephone_envoyeur')->nullable();
            $table->string('telephone_receveur')->nullable();
            $table->unsignedBigInteger('bureau_destination_id')->nullable();
            $table->unsignedBigInteger('saisi_par')->nullable();
            $table->date('date_livraison_reelle')->nullable();

            // 🔗 Clés étrangères
            $table->foreign('bureau_destination_id')
                  ->references('id')->on('bureaux')
                  ->onDelete('set null');
            
            $table->foreign('saisi_par')
                  ->references('id')->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('colis', function (Blueprint $table) {
            $table->dropForeign(['bureau_destination_id']);
            $table->dropForeign(['saisi_par']);
            $table->dropColumn([
                'code_barre',
                'numero_voiture',
                'telephone_chauffeur',
                'telephone_envoyeur',
                'telephone_receveur',
                'bureau_destination_id',
                'saisi_par',
                'date_livraison_reelle',
            ]);
        });
    }
};

