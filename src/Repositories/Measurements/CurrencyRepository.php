<?php
namespace app\Repositories\Measurements;


use app\Models\Measurements\Currency;
use app\Utilities\ArrayUtil;
use LaravelDoctrine\ORM\Pagination\Paginatable;
use Doctrine\ORM\Query;

class CurrencyRepository extends BaseMeasurementRepository
{

    use Paginatable;


    /**
     * Get a single Currency object by its id
     * @param       int                 $id                 Id to query against
     * @return      Currency|null
     */
    public function getOneById($id)
    {
        return $this->find($id);
    }

    /**
     * Get a single Currency object by its name
     * @param       string              $name               Name to query against
     * @return      Currency|null
     */
    public function getOneByName($name)
    {
        return $this->findOneBy(['name' => $name]);
    }

    /**
     * Get a single Currency object by its symbol
     * @param       string              $symbol             Symbol to query against
     * @return      Currency|null
     */
    public function getOneBySymbol($symbol)
    {
        return $this->findOneBy(['symbol' => $symbol]);
    }



    /**
     * Get the CAD Currency object
     * @return      Currency
     */
    public function getCAD()
    {
        return $this->find(27);
    }

    /**
     * Get the Euro Currency object
     * @return      Currency
     */
    public function getEuro()
    {
        return $this->find(47);
    }

    /**
     * Get the USD Currency object
     * @return      Currency
     */
    public function getUSD()
    {
        return $this->find(151);
    }
}