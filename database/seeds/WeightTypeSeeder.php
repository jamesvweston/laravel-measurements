<?php

use Illuminate\Database\Seeder;

class WeightTypeSeeder extends Seeder {

    public function run () {
        $lengthUOMs = $this->getWeightTypes();
        DB::table('WeightType')->insert(
            $lengthUOMs
        );
    }

    private function getWeightTypes() {
        return [
            ['id' => 1, 'name' => 'Ounces', 'symbol' => 'OZ'],


            ['id' => 2, 'name' => 'Pounds', 'symbol' => 'LB'],


            ['id' => 3, 'name' => 'Kilograms', 'symbol' => 'KG'],


            ['id' => 4, 'name' => 'Grams', 'symbol' => 'G'],
        ];
    }

}
