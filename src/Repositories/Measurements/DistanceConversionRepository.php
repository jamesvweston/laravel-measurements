<?php
namespace app\Repositories\Measurements;


use app\Models\DistanceType;

class DistanceConversionRepository extends BaseMeasurementRepository
{

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