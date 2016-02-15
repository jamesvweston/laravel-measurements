<?php
namespace app\Models\Measurements;


use app\Utilities\ArrayUtil;
use Respect\Validation\Validator as v;

class DistanceConversion implements \JsonSerializable
{

    public $id;
    public $multiplicand;
    public $statusId;
    public $createdAt;
    public $expiresAt;

    // BEGIN oneToMany relationships
    protected $fromDistanceType;
    protected $toDistanceType;
    // END oneToMany relationships


    public function __construct ($data = null)
    {
        $this->id                               =       NULL;
        $this->statusId                         =       1;
        $this->createdAt                        =       new \DateTime();
        $this->expiresAt                        =       new \DateTime('2038-01-01 01:01:01');

        if (is_array($data)) {
            $this->fromDistanceType             =       ArrayUtil::get($data['fromDistanceType'], '');
            $this->toDistanceType               =       ArrayUtil::get($data['toDistanceType'], '');
        }
    }

    protected function getValidationRules()
    {

        v::with('app\\Models\\Validation\\');

        return [
            v::attribute('name',                        v::notEmpty()->alpha()->length(2, 100)),
            v::attribute('symbol',                      v::notEmpty()->alpha()->length(2, 2)),
            v::attribute('statusId',                    v::notEmpty()->int()->positive()),
            v::attribute('createdAt',                   v::notEmpty()->date()),
            v::attribute('expiresAt',                   v::notEmpty()->date()),
        ];
    }

    public function jsonSerialize()
    {
        $distanceConversion                     =       call_user_func('get_object_vars', $this);
        return array_except($distanceConversion, ['__initializer__', '__cloner__', '__isInitialized__']);
    }

    // BEGIN Getters
    /**
     * Get the from DistanceType object for the DistanceConversion
     * @return DistanceType
     */
    public function getFromDistanceType()
    {
        return $this->fromDistanceType;
    }

    /**
     * Get the to DistanceType object for the DistanceConversion
     * @return DistanceType
     */
    public function getToDistanceType()
    {
        return $this->toDistanceType;
    }

    // END Getters


    // BEGIN Setters
    /**
     * Set the from DistanceType object for the DistanceConversion
     * @param DistanceType $fromDistanceType
     */
    public function setFromDistanceType(DistanceType $fromDistanceType)
    {
        $this->fromDistanceType = $fromDistanceType;
    }

    /**
     * Set the to DistanceType object for the DistanceConversion
     * @param DistanceType $toDistanceType
     */
    public function setToDistanceType(DistanceType $toDistanceType)
    {
        $this->toDistanceType = $toDistanceType;
    }
    // END Setters


}