<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateDistanceConversionTable extends Migration {

    public function up () {
        Schema::create('DistanceConversion', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('fromDistanceTypeId')->unsigned()->index();
            $table->integer('toDistanceTypeId')->unsigned()->index();
            $table->decimal('multiplicand', 14, 8)->index();


            // Boilerplate
            $table->integer('statusId')->unsigned()->index()->default(1);
            $table->datetime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'))->index();
            $table->datetime('expiresAt')->default('2038-01-01 01:01:01')->index();
        });

        DB::statement("ALTER TABLE DistanceConversion ADD CONSTRAINT unique_fromDistanceTypeId_toDistanceTypeId
                          UNIQUE (fromDistanceTypeId, toDistanceTypeId)");

        Schema::table('DistanceConversion', function (Blueprint $table) {
            $table->foreign('fromDistanceTypeId')->references('id')->on('DistanceType');
            $table->foreign('toDistanceTypeId')->references('id')->on('DistanceType');
        });

    }

    public function down () {
        Schema::drop('DistanceConversion');
    }

}
