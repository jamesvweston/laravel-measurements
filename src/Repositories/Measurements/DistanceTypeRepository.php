<?php
namespace app\Repositories\Measurements;


use app\Utilities\ArrayUtil;
use LaravelDoctrine\ORM\Pagination\Paginatable;
use Doctrine\ORM\Query;

class DistanceTypeRepository extends BaseMeasurementRepository
{

    use Paginatable;

}