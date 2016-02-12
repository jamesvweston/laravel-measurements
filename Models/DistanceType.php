<?php
namespace app\Models;


use Respect\Validation\Validator as v;

class DistanceType implements \JsonSerializable {

    public $id;
    public $name;
    public $symbol;
    public $statusId;
    public $createdAt;
    public $expiresAt;

    //  BEGIN oneToMany relationships
    protected $conversions;
    //  END oneToMany relationships

    public function __construct ($data = null) {
        $this->id                               =       NULL;
        $this->statusId                         =       1;
        $this->createdAt                        =       new \DateTime();
        $this->expiresAt                        =       new \DateTime('2038-01-01 01:01:01');

        $this->conversions                      =       new ArrayCollection();

        if (is_array($data)) {
            $this->name                         =       ArrayUtil::get($data['name'], '');
            $this->symbol                       =       ArrayUtil::get($data['symbol'], '');
        }
    }

    protected function getValidationRules() {

        return [
            v::attribute('name',                        v::notEmpty()->alpha()->length(2, 100)),
            v::attribute('symbol',                      v::notEmpty()->alpha()->length(2, 2)),
            v::attribute('statusId',                    v::notEmpty()->int()->positive()),
            v::attribute('createdAt',                   v::notEmpty()->date()),
            v::attribute('expiresAt',                   v::notEmpty()->date()),
        ];
    }

    public function jsonSerialize() {
        $distanceType                           =       call_user_func('get_object_vars', $this);
        return array_except($distanceType, ['__initializer__', '__cloner__', '__isInitialized__']);
    }


    // BEGIN Getters
    /**
     * Get an ArrayCollection of DistanceConversion objects for this DistanceType
     * @return ArrayCollection
     */
    public function getDistanceConversions() {
        return $this->conversions;
    }

    // END Getters


    // BEGIN Setters
    /**
     * Add a DistanceConversion object to the DistanceType
     * @param DistanceConversion $distanceConversion
     */
    public function addDistanceConversion(DistanceConversion $distanceConversion) {
        $this->conversions->add($distanceConversion);
    }

    // END Setters

}