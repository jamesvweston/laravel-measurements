<?php

use Illuminate\Database\Seeder;

class WeightConversionSeeder extends Seeder {

    public function run () {
        $lengthUOMs = $this->getWeightConversions();
        DB::table('WeightConversion')->insert($lengthUOMs);
    }

    private function getWeightConversions () {
        return [

            // Ounce conversions
            ['fromWeightTypeId' => 1, 'toWeightTypeId' => 1, 'multiplicand' => 1],
            ['fromWeightTypeId' => 1, 'toWeightTypeId' => 2, 'multiplicand' => 0.0625],
            ['fromWeightTypeId' => 1, 'toWeightTypeId' => 3, 'multiplicand' => 0.0283495],
            ['fromWeightTypeId' => 1, 'toWeightTypeId' => 4, 'multiplicand' => 28.3495],

            // Pound conversions
            ['fromWeightTypeId' => 2, 'toWeightTypeId' => 1, 'multiplicand' => 16],
            ['fromWeightTypeId' => 2, 'toWeightTypeId' => 2, 'multiplicand' => 1],
            ['fromWeightTypeId' => 2, 'toWeightTypeId' => 3, 'multiplicand' => 0.453592],
            ['fromWeightTypeId' => 2, 'toWeightTypeId' => 4, 'multiplicand' => 453.592],

            // Kilogram conversions
            ['fromWeightTypeId' => 3, 'toWeightTypeId' => 1, 'multiplicand' => 35.274],
            ['fromWeightTypeId' => 3, 'toWeightTypeId' => 2, 'multiplicand' => 2.20462],
            ['fromWeightTypeId' => 3, 'toWeightTypeId' => 3, 'multiplicand' => 1],
            ['fromWeightTypeId' => 3, 'toWeightTypeId' => 4, 'multiplicand' => 1000],

            // Gram conversions
            ['fromWeightTypeId' => 4, 'toWeightTypeId' => 1, 'multiplicand' => 0.035274],
            ['fromWeightTypeId' => 4, 'toWeightTypeId' => 2, 'multiplicand' => 0.00220462],
            ['fromWeightTypeId' => 4, 'toWeightTypeId' => 3, 'multiplicand' => 0.001],
            ['fromWeightTypeId' => 4, 'toWeightTypeId' => 4, 'multiplicand' => 1],

        ];
    }

}
