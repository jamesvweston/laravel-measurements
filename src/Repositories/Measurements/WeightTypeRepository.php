<?php
namespace app\Repositories\Measurements;


use app\Models\Measurements\WeightType;
use app\Utilities\ArrayUtil;
use LaravelDoctrine\ORM\Pagination\Paginatable;
use Doctrine\ORM\Query;

class WeightTypeRepository extends BaseMeasurementRepository
{

    use Paginatable;


    /**
     * Get a single WeightType object by its id
     * @param       int                 $id                 Id to query against
     * @return      WeightType|null
     */
    public function getOneById($id)
    {
        return $this->find($id);
    }

    /**
     * Get a single WeightType object by its name
     * @param       string              $name               Name to query against
     * @return      WeightType|null
     */
    public function getOneByName($name)
    {
        return $this->findOneBy(['name' => $name]);
    }

    /**
     * Get a single WeightType object by its symbol
     * @param       string              $symbol             Symbol to query against
     * @return      WeightType|null
     */
    public function getOneBySymbol($symbol)
    {
        return $this->findOneBy(['symbol' => $symbol]);
    }



    /**
     * Get the Ounce WeightType object
     * @return      WeightType
     */
    public function getOunce()
    {
        return $this->find(1);
    }

    /**
     * Get the Pound WeightType object
     * @return      WeightType
     */
    public function getPound()
    {
        return $this->find(2);
    }

    /**
     * Get the Kilogram WeightType object
     * @return      WeightType
     */
    public function getKilogram()
    {
        return $this->find(3);
    }

    /**
     * Get the Gram WeightType object
     * @return      WeightType
     */
    public function getGram()
    {
        return $this->find(4);
    }
}