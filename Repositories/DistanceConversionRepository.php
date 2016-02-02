<?php namespace postage\Repositories;

use postage\Models\DistanceType;

class DistanceConversionRepository extends BaseRepository {

    public function findOneByDistanceTypes(DistanceType $fromDistanceType, DistanceType $toDistanceType) {
        $criteria = [
            'fromDistanceType'        =>          $fromDistanceType,
            'toDistanceType'          =>          $toDistanceType
        ];
        return $this->findOneBy($criteria);
    }

    public function convertObjects(DistanceType $fromDistanceType, DistanceType $toDistanceType, $distance) {
        $criteria = [
            'fromDistanceType'        =>          $fromDistanceType,
            'toDistanceType'          =>          $toDistanceType
        ];

        $result                 =   $this->findOneBy($criteria);

        return $result->multiplicand * $distance;
    }

}