<?php
namespace app\Models\Measurements;


use app\Utilities\ArrayUtil;
use Respect\Validation\Validator as v;
use Auth;

class WeightConversion extends BaseModel implements \JsonSerializable {

    public $id;
    public $multiplicand;
    protected $statusId;
    protected $createdAt;
    protected $expiresAt;

    //  BEGIN manyToOne relationships
    protected $fromWeightType;
    protected $toWeightType;
    protected $routeTransaction;
    //  END manyToOne relationships

    //  BEGIN oneToMany relationships
    //  END oneToMany relationships


    public function __construct ($data = null) {
        $this->id                               =       NULL;
        $this->statusId                         =       1;
        $this->createdAt                        =       new \DateTime();
        $this->expiresAt                        =       new \DateTime('2038-01-01 01:01:01');
        $this->routeTransaction                 =       Auth::getSession()->get('routeTransaction');

        if (is_array($data)) {
            $this->name                         =       ArrayUtil::get($data['name'], '');
            $this->symbol                       =       ArrayUtil::get($data['symbol'], '');
        }
    }

    protected function getValidationRules() {

        v::with('app\\Models\\Validation\\');

        return [
            v::attribute('name',                        v::notEmpty()->alpha()->length(2, 100)->UniqueDimensionUOMName()),
            v::attribute('symbol',                      v::notEmpty()->alpha()->length(2, 2)->UniqueDimensionUOMSymbol()),
            v::attribute('routeTransaction',            v::instance('app\\Models\\RouteTransaction')),
            v::attribute('statusId',                    v::notEmpty()->int()->positive()),
            v::attribute('createdAt',                   v::notEmpty()->date()),
            v::attribute('expiresAt',                   v::notEmpty()->date()),
        ];
    }

    public function jsonSerialize() {
        $weightConversion                       =       call_user_func('get_object_vars', $this);
        return array_except($weightConversion, ['__initializer__', '__cloner__', '__isInitialized__']);
    }


    // BEGIN Getters
    /**
     * Get the from WeightType for the WeightConversion
     * @return WeightType
     */
    public function getFromWeightType() {
        return $this->fromWeightType;
    }

    /**
     * Get the to WeightType for the WeightConversion
     * @return WeightType
     */
    public function getToWeightType() {
        return $this->toWeightType;
    }
    // END Getters


    // BEGIN Setters
    /**
     * Set the from WeightType for the WeightConversion
     * @param WeightType $fromWeightType
     */
    public function setFromWeightType(WeightType $fromWeightType) {
        $this->fromWeightType = $fromWeightType;
    }

    /**
     * Set the to WeightType for the WeightConversion
     * @param WeightType $toWeightType
     */
    public function setToWeightType(WeightType $toWeightType) {
        $this->toWeightType = $toWeightType;
    }
    // END Setters

}