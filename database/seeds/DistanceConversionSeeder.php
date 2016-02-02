<?php

use Illuminate\Database\Seeder;

class DistanceConversionSeeder extends Seeder {

    public function run () {
        $distanceConversions = $this->getDistanceConversions();
        DB::table('DistanceConversion')->insert($distanceConversions);
    }

    private function getDistanceConversions () {
        return [

            // Inch conversions
            ['fromDistanceTypeId' => 1, 'toDistanceTypeId' => 1, 'multiplicand' => 1],
            ['fromDistanceTypeId' => 1, 'toDistanceTypeId' => 2, 'multiplicand' => 0.0833333],
            ['fromDistanceTypeId' => 1, 'toDistanceTypeId' => 3, 'multiplicand' => 25.4],
            ['fromDistanceTypeId' => 1, 'toDistanceTypeId' => 4, 'multiplicand' => 0.0254],
            ['fromDistanceTypeId' => 1, 'toDistanceTypeId' => 5, 'multiplicand' => 2.54],

            // Foot conversions
            ['fromDistanceTypeId' => 2, 'toDistanceTypeId' => 1, 'multiplicand' => 12],
            ['fromDistanceTypeId' => 2, 'toDistanceTypeId' => 2, 'multiplicand' => 1],
            ['fromDistanceTypeId' => 2, 'toDistanceTypeId' => 3, 'multiplicand' => 304.8],
            ['fromDistanceTypeId' => 2, 'toDistanceTypeId' => 4, 'multiplicand' => 0.3048],
            ['fromDistanceTypeId' => 2, 'toDistanceTypeId' => 5, 'multiplicand' => 30.48],

            // Millimeter conversions
            ['fromDistanceTypeId' => 3, 'toDistanceTypeId' => 1, 'multiplicand' => 0.0393701],
            ['fromDistanceTypeId' => 3, 'toDistanceTypeId' => 2, 'multiplicand' => 0.00328084],
            ['fromDistanceTypeId' => 3, 'toDistanceTypeId' => 3, 'multiplicand' => 1],
            ['fromDistanceTypeId' => 3, 'toDistanceTypeId' => 4, 'multiplicand' => 0.001],
            ['fromDistanceTypeId' => 3, 'toDistanceTypeId' => 5, 'multiplicand' => 0.1],

            // Meter conversions
            ['fromDistanceTypeId' => 4, 'toDistanceTypeId' => 1, 'multiplicand' => 39.3701],
            ['fromDistanceTypeId' => 4, 'toDistanceTypeId' => 2, 'multiplicand' => 3.28084],
            ['fromDistanceTypeId' => 4, 'toDistanceTypeId' => 3, 'multiplicand' => 1000],
            ['fromDistanceTypeId' => 4, 'toDistanceTypeId' => 4, 'multiplicand' => 1],
            ['fromDistanceTypeId' => 4, 'toDistanceTypeId' => 5, 'multiplicand' => 100],

            // Centimeter conversions
            ['fromDistanceTypeId' => 5, 'toDistanceTypeId' => 1, 'multiplicand' => 0.393701],
            ['fromDistanceTypeId' => 5, 'toDistanceTypeId' => 2, 'multiplicand' => 0.03280841666667],
            ['fromDistanceTypeId' => 5, 'toDistanceTypeId' => 3, 'multiplicand' => 10.000005400001015232],
            ['fromDistanceTypeId' => 5, 'toDistanceTypeId' => 4, 'multiplicand' => 0.010000005400001015995],
            ['fromDistanceTypeId' => 5, 'toDistanceTypeId' => 5, 'multiplicand' => 1],];
    }

}
