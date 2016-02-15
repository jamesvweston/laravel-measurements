<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateWeightConversionTable extends Migration
{

    public function up ()
    {
        Schema::create('WeightConversion', function (Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('fromWeightTypeId')->unsigned()->index();
            $table->integer('toWeightTypeId')->unsigned()->index();
            $table->decimal('multiplicand', 14, 8)->index();


            // Boilerplate
            $table->integer('statusId')->unsigned()->index()->default(1);
            $table->datetime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'))->index();
            $table->datetime('expiresAt')->default('2038-01-01 01:01:01')->index();
        });

        DB::statement("ALTER TABLE WeightConversion ADD CONSTRAINT unique_fromWeightTypeId_toWeightTypeId
                          UNIQUE (fromWeightTypeId, toWeightTypeId)");

        Schema::table('WeightConversion', function (Blueprint $table)
        {
            $table->foreign('fromWeightTypeId')->references('id')->on('WeightType');
            $table->foreign('toWeightTypeId')->references('id')->on('WeightType');
        });

    }

    public function down ()
    {
        Schema::drop('WeightConversion');
    }

}
