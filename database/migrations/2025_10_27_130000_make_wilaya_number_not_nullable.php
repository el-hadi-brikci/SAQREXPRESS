<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class MakeWilayaNumberNotNullable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * This migration will fill existing NULL wilaya_number with 1 and
	 * attempt to alter the column to be NOT NULL with default 1.
	 * Note: altering requires doctrine/dbal on some platforms.
	 */
	public function up()
	{
		DB::table('bureaux')->whereNull('wilaya_number')->update(['wilaya_number' => 1]);

		if (Schema::hasColumn('bureaux', 'wilaya_number')) {
			// Attempt to change column to non-nullable with default; may require doctrine/dbal
			Schema::table('bureaux', function (Blueprint $table) {
				$table->unsignedSmallInteger('wilaya_number')->default(1)->change();
			});
		}
	}

	public function down()
	{
		if (Schema::hasColumn('bureaux', 'wilaya_number')) {
			Schema::table('bureaux', function (Blueprint $table) {
				$table->unsignedSmallInteger('wilaya_number')->nullable()->default(null)->change();
			});
		}
	}
}

