<?php

use Illuminate\Database\Seeder;

class ImageTypeSeeder extends Seeder {

    public function run () {
        $imageTypes = $this->getImageTypes();
        DB::table('ImageType')->insert(
            $imageTypes
        );
    }

    private function getImageTypes() {
        return [
            ['id' => 1, 'name' => 'Portable Document Format', 'symbol' => 'PDF'],
            ['id' => 2, 'name' => 'Joint Photographic Experts Group', 'symbol' => 'JPG'],
            ['id' => 3, 'name' => 'Graphics Interchange Format', 'symbol' => 'GIF'],
            ['id' => 4, 'name' => 'Bit Map Picture', 'symbol' => 'BMP'],
            ['id' => 5, 'name' => 'Portable Network Graphics', 'symbol' => 'PNG'],
        ];
    }

}
