<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWilayaNumberToBureausTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bureaux', function (Blueprint $table) {
			if (!Schema::hasColumn('bureaux', 'wilaya_number')) {
				$table->unsignedSmallInteger('wilaya_number')->nullable()->after('region_id');
			}
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bureaux', function (Blueprint $table) {
			if (Schema::hasColumn('bureaux', 'wilaya_number')) {
				$table->dropColumn('wilaya_number');
			}
		});
	}
}

