<?php

use Illuminate\Database\Seeder;

class DistanceTypeSeeder extends Seeder {

    public function run () {
        $distanceTypes = $this->getDistanceTypes();
        DB::table('DistanceType')->insert(
            $distanceTypes
        );
    }

    private function getDistanceTypes() {
        return [
            ['id' => 1, 'name' => 'Inch', 'symbol' => 'IN'],

            ['id' => 2, 'name' => 'Foot', 'symbol' => 'FT'],

            ['id' => 3, 'name' => 'Millimeter', 'symbol' => 'MM'],

            ['id' => 4, 'name' => 'Meter', 'symbol' => 'M'],

            ['id' => 5, 'name' => 'Centimeter', 'symbol' => 'CM'],
        ];
    }

}
