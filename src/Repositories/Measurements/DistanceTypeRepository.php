<?php
namespace app\Repositories\Measurements;


use app\Models\Measurements\DistanceType;
use LaravelDoctrine\ORM\Pagination\Paginatable;
use Doctrine\ORM\Query;

class DistanceTypeRepository extends BaseMeasurementRepository
{

    use Paginatable;

    /**
     * Query against all fields
     * @param       []                      $query              Values to query against
     * @param       bool                    $ignorePagination   If true will not return pagination
     * @param       int|null                $maxLimit           If provided limit is greater than this value, set is to this value
     * @param       int|null                $maxPage            If the provided page is greater than this value, restrict it to this value
     * @return      DistanceType[]|array|\Illuminate\Pagination\LengthAwarePaginator
     */
    function where($query, $ignorePagination = true, $maxLimit = 5000, $maxPage = 100) {
        $pagination                 =   $this->buildPagination($query, $maxLimit, $maxPage);
        $qb                         =   $this->_em->createQueryBuilder();

        $qb->select(['distanceType']);
        $qb->from('postage\Models\DistanceType', 'distanceType');
        $qb->orderBy('distanceType.id', 'ASC');

        if ($ignorePagination)
            return $qb->getQuery()->getResult();
        else
            return $this->paginate($qb->getQuery(), $pagination['limit']);
    }


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