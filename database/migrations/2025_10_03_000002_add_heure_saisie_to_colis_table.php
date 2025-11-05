<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up() {
        Schema::table('colis', function (Blueprint $table) {
            $table->timestamp('heure_saisie')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }
    public function down() {
        Schema::table('colis', function (Blueprint $table) {
            $table->dropColumn('heure_saisie');
        });
    }
};
