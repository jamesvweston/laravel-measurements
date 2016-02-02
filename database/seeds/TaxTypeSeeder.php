<?php

use Illuminate\Database\Seeder;

class TaxTypeSeeder extends Seeder {

    public function run () {
        $taxTypes = $this->getTaxTypes();
        DB::table('TaxType')->insert(
            $taxTypes
        );
    }

    private function getTaxTypes() {
        return [
            ['id' => 1, 'name' => 'Goods And Services Tax', 'symbol' => 'GST'],
            ['id' => 2, 'name' => 'Provincial Sales Tax', 'symbol' => 'PST'],
            ['id' => 3, 'name' => 'Harmonized Sales Tax', 'symbol' => 'HST'],
            ['id' => 4, 'name' => 'Value Added Tax', 'symbol' => 'VAT'],
        ];
    }

}
