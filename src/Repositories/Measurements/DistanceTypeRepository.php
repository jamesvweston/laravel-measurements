<?php
namespace app\Repositories\Measurements;


use app\Models\Measurements\DistanceType;
use app\Utilities\ArrayUtil;
use LaravelDoctrine\ORM\Pagination\Paginatable;
use Doctrine\ORM\Query;

class DistanceTypeRepository extends BaseMeasurementRepository
{

    use Paginatable;


    /**
     * Get a single DistanceType object by its id
     * @param       int                 $id                 Id to query against
     * @return      DistanceType|null
     */
    public function getOneById($id)
    {
        return $this->find($id);
    }

    /**
     * Get a single DistanceType object by its name
     * @param       string              $name               Name to query against
     * @return      DistanceType|null
     */
    public function getOneByName($name)
    {
        return $this->findOneBy(['name' => $name]);
    }

    /**
     * Get a single DistanceType object by its symbol
     * @param       string              $symbol             Symbol to query against
     * @return      DistanceType|null
     */
    public function getOneBySymbol($symbol)
    {
        return $this->findOneBy(['symbol' => $symbol]);
    }





    /**
     * Get the Inch DistanceType object
     * @return      DistanceType
     */
    public function getInch()
    {
        return $this->find(1);
    }

    /**
     * Get the Foot DistanceType object
     * @return      DistanceType
     */
    public function getFoot()
    {
        return $this->find(2);
    }

    /**
     * Get the Millimeter DistanceType object
     * @return      DistanceType
     */
    public function getMillimeter()
    {
        return $this->find(3);
    }

    /**
     * Get the Meter DistanceType object
     * @return      DistanceType
     */
    public function getMeter()
    {
        return $this->find(4);
    }

    /**
     * Get the Centimeter DistanceType object
     * @return      DistanceType
     */
    public function getCentimeter()
    {
        return $this->find(5);
    }
}