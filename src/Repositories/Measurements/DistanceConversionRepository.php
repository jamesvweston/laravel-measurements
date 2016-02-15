<?php
namespace app\Repositories\Measurements;


use app\Utilities\ArrayUtil;
use app\Models\Measurements\DistanceConversion;
use app\Models\Measurements\DistanceType;
use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Pagination\Paginatable;

class DistanceConversionRepository extends BaseMeasurementRepository
{

    use Paginatable;

    /**
     * Query against all fields
     * @param       []                      $query              Values to query against
     * @param       bool                    $ignorePagination   If true will not return pagination
     * @param       int|null                $maxLimit           If provided limit is greater than this value, set is to this value
     * @param       int|null                $maxPage            If the provided page is greater than this value, restrict it to this value
     * @return      DistanceConversion[]|\Illuminate\Pagination\LengthAwarePaginator
     */
    function where($query, $ignorePagination = true, $maxLimit = 5000, $maxPage = 100)
    {
        $pagination                 =   $this->buildPagination($query, $maxLimit, $maxPage);

        $qb                         =   $this->_em->createQueryBuilder();
        $qb->select(['distanceConversion']);

        $qb->from('postage\Models\DistanceConversion', 'distanceConversion')
            ->innerJoin('distanceConversion.fromDistanceType', 'fromDistanceType', Query\Expr\Join::ON)
            ->innerJoin('distanceConversion.toDistanceType', 'toDistanceType', Query\Expr\Join::ON);

        if (!is_null(ArrayUtil::get($query['fromDistanceTypeIds'])))
            $qb->andWhere($qb->expr()->in('fromDistanceType.id', $query['fromDistanceTypeIds']));

        if (!is_null(ArrayUtil::get($query['toDistanceTypeIds'])))
            $qb->andWhere($qb->expr()->in('toDistanceType.id', $query['toDistanceTypeIds']));

        $qb->orderBy('distanceConversion.id', 'ASC');

        if ($ignorePagination)
            return $qb->getQuery()->getResult();
        else
            return $this->paginate($qb->getQuery(), $pagination['limit']);
    }

    /**
     * Convert a DistanceType object with its respective distance to inches
     * @param       DistanceType            $distanceType       Current working DistanceType object
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertDistanceTypeToInches(DistanceType $distanceType, $distance)
    {
        return $this->conversionHelper($distanceType->id, 1, $distance);
    }

    /**
     * Convert a DistanceType object with its respective distance to feet
     * @param       DistanceType            $distanceType       Current working DistanceType object
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertDistanceTypeToFeet(DistanceType $distanceType, $distance)
    {
        return $this->conversionHelper($distanceType->id, 2, $distance);
    }

    /**
     * Convert a DistanceType object with its respective distance to millimeters
     * @param       DistanceType            $distanceType       Current working DistanceType object
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertDistanceTypeToMillimeters(DistanceType $distanceType, $distance)
    {
        return $this->conversionHelper($distanceType->id, 3, $distance);
    }

    /**
     * Convert a DistanceType object with its respective distance to meters
     * @param       DistanceType            $distanceType       Current working DistanceType object
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertDistanceTypeToMeters(DistanceType $distanceType, $distance)
    {
        return $this->conversionHelper($distanceType->id, 4, $distance);
    }

    /**
     * Convert a DistanceType object with its respective distance to centimeters
     * @param       DistanceType            $distanceType       Current working DistanceType object
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertDistanceTypeToCentimeters(DistanceType $distanceType, $distance)
    {
        return $this->conversionHelper($distanceType->id, 5, $distance);
    }

    /**
     * Convert inches to feet
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertInchesToFeet($distance)
    {
        return $this->conversionHelper(1, 2, $distance);
    }

    /**
     * Convert inches to millimeters
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertInchesToMillimeters($distance)
    {
        return $this->conversionHelper(1, 3, $distance);
    }

    /**
     * Convert inches to meters
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertInchesToMeters($distance)
    {
        return $this->conversionHelper(1, 4, $distance);
    }

    /**
     * Convert inches to centimeters
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertInchesToCentimeters($distance)
    {
        return $this->conversionHelper(1, 5, $distance);
    }

    /**
     * Convert feet to inches
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertFeetToInches($distance)
    {
        return $this->conversionHelper(2, 1, $distance);
    }

    /**
     * Convert feet to millimeters
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertFeetToMillimeters($distance)
    {
        return $this->conversionHelper(2, 3, $distance);
    }

    /**
     * Convert feet to meters
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertFeetToMeters($distance)
    {
        return $this->conversionHelper(2, 4, $distance);
    }

    /**
     * Convert feet to centimeters
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertFeetToCentimeters($distance)
    {
        return $this->conversionHelper(2, 5, $distance);
    }

    /**
     * Convert millimeters to inches
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertMillimetersToInches($distance)
    {
        return $this->conversionHelper(3, 1, $distance);
    }

    /**
     * Convert millimeters to feet
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertMillimetersToFeet($distance)
    {
        return $this->conversionHelper(3, 2, $distance);
    }

    /**
     * Convert millimeters to meters
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertMillimetersToMeters($distance)
    {
        return $this->conversionHelper(3, 4, $distance);
    }

    /**
     * Convert millimeters to centimeters
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertMillimetersToCentimeters($distance)
    {
        return $this->conversionHelper(3, 5, $distance);
    }

    /**
     * Convert meters to inches
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertMetersToInches($distance)
    {
        return $this->conversionHelper(4, 1, $distance);
    }

    /**
     * Convert meters to feet
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertMetersToFeet($distance)
    {
        return $this->conversionHelper(4, 2, $distance);
    }

    /**
     * Convert meters to millimeters
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertMetersToMillimeters($distance)
    {
        return $this->conversionHelper(4, 3, $distance);
    }

    /**
     * Convert meters to centimeters
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertMetersToCentimeters($distance)
    {
        return $this->conversionHelper(4, 5, $distance);
    }

    /**
     * Convert centimeters to inches
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertCentimetersToInches($distance)
    {
        return $this->conversionHelper(5, 1, $distance);
    }

    /**
     * Convert centimeters to feet
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertCentimetersToFeet($distance)
    {
        return $this->conversionHelper(5, 2, $distance);
    }

    /**
     * Convert centimeters to millimeters
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertCentimetersToMillimeters($distance)
    {
        return $this->conversionHelper(5, 3, $distance);
    }

    /**
     * Convert centimeters to meters
     * @param       float                   $distance           Distance value to convert
     * @return      float
     */
    public function convertCentimetersToMeters($distance)
    {
        return $this->conversionHelper(5, 4, $distance);
    }

    private function conversionHelper($fromId, $toId, $distance)
    {
        $query  =   [
            'fromDistanceTypeIds'   =>  $fromId,
            'toDistanceTypeIds'     =>  $toId
        ];
        $results                    =   $this->where($query);

        if (sizeof($results) == 1)
            return $results[0]->multiplicand * $distance;

        return null;
    }

}