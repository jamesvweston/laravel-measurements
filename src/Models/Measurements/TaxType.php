<?php
namespace app\Models\Measurements;


use app\Utilities\ArrayUtil;
use Respect\Validation\Validator as v;

class TaxType extends BaseModel implements \JsonSerializable {

    public $id;
    public $name;
    public $symbol;
    protected $statusId;
    protected $createdAt;
    protected $expiresAt;

    //  BEGIN manyToOne relationships
    protected $routeTransaction;
    //  END manyToOne relationships

    //  BEGIN oneToMany relationships
    //  END oneToMany relationships


    public function __construct ($data = null) {
        $this->id                               =       NULL;
        $this->statusId                         =       1;
        $this->createdAt                        =       new \DateTime();
        $this->expiresAt                        =       new \DateTime('2038-01-01 01:01:01');

        if (is_array($data)) {
            $this->name                         =       ArrayUtil::get($data['name'], '');
            $this->symbol                       =       ArrayUtil::get($data['symbol'], '');
        }
    }

    protected function getValidationRules() {
        v::with('app\\Models\\Validation\\');

        return [
            v::attribute('provider',                    v::oneOf(v::instance('app\\Models\\Provider'))),
            v::attribute('carrier',                     v::oneOf(v::instance('app\\Models\\Carrier'))),
            v::attribute('name',                        v::notEmpty()->length(3, 100)->alpha()->UniqueProviderName()),
            v::attribute('symbol',                      v::notEmpty()->length(3, 100)->UniqueProviderSymbol()),
            v::attribute('routeTransaction',            v::instance('app\\Models\\RouteTransaction')),
            v::attribute('statusId',                    v::notEmpty()->int()->positive()),
            v::attribute('createdAt',                   v::notEmpty()->date()),
            v::attribute('expiresAt',                   v::notEmpty()->date()),
        ];
    }

    public function jsonSerialize() {
        $taxType                                =       call_user_func('get_object_vars', $this);
        return array_except($taxType, ['__initializer__', '__cloner__', '__isInitialized__']);
    }
}