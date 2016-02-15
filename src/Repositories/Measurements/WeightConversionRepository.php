<?php
namespace app\Repositories\Measurements;


use app\Utilities\ArrayUtil;
use LaravelDoctrine\ORM\Pagination\Paginatable;
use Doctrine\ORM\Query;

class WeightConversionRepository extends BaseMeasurementRepository
{

    use Paginatable;


}