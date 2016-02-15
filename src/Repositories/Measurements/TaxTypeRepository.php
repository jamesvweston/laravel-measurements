<?php
namespace app\Repositories\Measurements;

use app\Models\Measurements\TaxType;
use LaravelDoctrine\ORM\Pagination\Paginatable;
use Doctrine\ORM\Query;

class TaxTypeRepository extends BaseMeasurementRepository
{

    use Paginatable;

    /**
     * Query against all fields
     * @param       []                      $query              Values to query against
     * @param       bool                    $ignorePagination   If true will not return pagination
     * @param       int|null                $maxLimit           If provided limit is greater than this value, set is to this value
     * @param       int|null                $maxPage            If the provided page is greater than this value, restrict it to this value
     * @return      array|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function where($query, $ignorePagination = true, $maxLimit = 5000, $maxPage = 100)
    {
        $pagination                 =   $this->buildPagination($query, $maxLimit, $maxPage);
        $qb                         =   $this->_em->createQueryBuilder();

        $qb->select(['taxTypes']);
        $qb->from('app\Models\TaxType', 'taxType');
        $qb->orderBy('taxType.id', 'ASC');

        if ($ignorePagination)
            return $qb->getQuery()->getResult();
        else
            return $this->paginate($qb->getQuery(), $pagination['limit']);
    }


    /**
     * Get a single TaxType object by its id
     * @param       int                 $id                 Id to query against
     * @return      TaxType|null
     */
    public function getOneById($id)
    {
        return $this->find($id);
    }

    /**
     * Get a single TaxType object by its name
     * @param       string              $name               Name to query against
     * @return      TaxType|null
     */
    public function getOneByName($name)
    {
        return $this->findOneBy(['name' => $name]);
    }

    /**
     * Get a single TaxType object by its symbol
     * @param       string              $symbol             Symbol to query against
     * @return      TaxType|null
     */
    public function getOneBySymbol($symbol)
    {
        return $this->findOneBy(['symbol' => $symbol]);
    }




    /**
     * Get the GST TaxType object
     * @return      TaxType
     */
    public function getGST()
    {
        return $this->find(1);
    }

    /**
     * Get the PST TaxType object
     * @return      TaxType
     */
    public function getPST()
    {
        return $this->find(2);
    }

    /**
     * Get the HST TaxType object
     * @return      TaxType
     */
    public function getHST()
    {
        return $this->find(3);
    }

    /**
     * Get the VAT TaxType object
     * @return      TaxType
     */
    public function getVAT()
    {
        return $this->find(4);
    }
}