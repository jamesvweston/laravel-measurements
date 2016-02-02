<?php namespace postage\Repositories;

use postage\Models\WeightType;

class WeightConversionRepository extends BaseRepository {

    public function findOneByWeightTypes(WeightType $fromWeightType, WeightType $toWeightType) {
        $criteria = [
            'fromWeightType'        =>          $fromWeightType,
            'toWeightType'          =>          $toWeightType
        ];
        return $this->findOneBy($criteria);
    }


    public function convertObjects(WeightType $fromWeightType, WeightType $toWeightType, $weight) {
        $criteria = [
            'fromWeightType'        =>          $fromWeightType,
            'toWeightType'          =>          $toWeightType
        ];

        $result                 =   $this->findOneBy($criteria);

        return $result->multiplicand * $weight;
    }
}