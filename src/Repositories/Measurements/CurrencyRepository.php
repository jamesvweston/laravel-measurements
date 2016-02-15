<?php
namespace app\Repositories;


use app\Utilities\ArrayUtil;
use app\Utilities\StringUtil;

class CurrencyRepository extends BaseRepository {

    use Paginatable;

    /**
     * Get a Currency object by symbol
     * @param $symbol
     * @return null|Currency
     */
    public function findOneBySymbol($symbol) {
        return $this->findOneBy(['symbol' => $symbol]);
    }

    function where($query) {
        $query                      =   $this->validateQuery($query);

        $qb                         =   $this->_em->createQueryBuilder();

        if ($query['selector'] == true) {
            $qb->select(['currency.id, currency.name']);
        } else {
            $qb->select(['currency']);
        }

        $qb->from('app\Models\Currency', 'currency');

        $qb->orderBy($query['orderBy']['field'], $query['orderBy']['order']);

        if ($query['selector'] == true)
            return $qb->getQuery()->getResult();
        else
            return $this->paginate($qb->getQuery(), $query['limit']);
    }

    public function validateQuery($query) {
        $inputValidator             =   new InputValidator();
        $pagination                 =   $inputValidator->validatePagination(
                                            ArrayUtil::get($query['selector'], NULL),
                                            NULL,
                                            ArrayUtil::get($query['limit'], NULL),
                                            ArrayUtil::get($query['page'], NULL));

        return [
            'selector'              =>  $pagination['selector'],
            'limit'                 =>  $pagination['limit'],
            'page'                  =>  $pagination['page'],
            'orderBy'               =>  [
                'field'             => 'currency.id',
                'order'             =>  'ASC']
        ];
    }


    /**
     * Query against any field with an array of values
     * @param $input
     * @param $namedInput
     * @param bool $required
     * @param bool $throwsError
     * @param bool $singleton
     * @return array|null
     */
    public function inputSearch($input, $namedInput, $required = true, $throwsError = true, $singleton = false) {
        $input                  =   trim($input);
        if ((is_null($input) || empty($input)) && $required == true) {
            if ($throwsError)
                throw new ValidationFailureException($namedInput . ' is required');
            else
                return null;
        }

        $symbolArray            =   explode(',', $input);
        $sizeOfInput            =   sizeof($symbolArray);

        if ($sizeOfInput == 0 && $throwsError == true) {
            $message            =   $namedInput . ' is required';
            throw new ValidationFailureException($message);
        } else if ($sizeOfInput == 0 && $throwsError == false) {
            return null;
        } else if ($sizeOfInput > 1 && $singleton == true) {        // Always throw the error here if singleton is expected to be true
            throw new ValidationFailureException('Currency validation failed', ['Only one value expected']);
        }

        $result                 =   [];
        foreach ($symbolArray AS $symbol) {
            $result[]           =   $this->lazyQuery($symbol, $throwsError);
        }

        if ($singleton == true)
            return $result[0];
        else
            return $result;
    }

    public function lazyQuery($symbol, $throwsError = true) {

        if (is_numeric($symbol))
            return $this->queryId($symbol, $throwsError);
        else if (StringUtil::isCamelUpper($symbol))
            return $this->querySymbol($symbol, $throwsError);
        else
            return $this->queryName($symbol, $throwsError);
    }

    public function queryId($id, $throwsError = true) {
        $result                 =   $this->find($id);

        if (is_null($result) && $throwsError == true)
            throw new ValidationFailureException('Currency validation failed', ['Invalid id (' . $id. ')']);

        return $result;
    }

    public function querySymbol($symbol, $throwsError = true) {
        $result                 =   $this->findOneBy(['symbol' => $symbol]);

        if (is_null($result) && $throwsError == true)
            throw new ValidationFailureException('Currency validation failed', ['Invalid symbol (' . $symbol . ')']);

        return $result;
    }

    public function queryName($name, $throwsError = true) {
        $result                 =   $this->findOneBy(['name' => $name]);

        if (is_null($result) && $throwsError == true)
            throw new ValidationFailureException('Currency validation failed', ['Invalid name (' . $name . ')']);

        return $result;
    }

}