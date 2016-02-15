<?php
namespace app\Models\Measurements;


use app\Utilities\ArrayUtil;
use Respect\Validation\Validator as v;

class WeightType implements \JsonSerializable
{

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

    public function __construct ($data = null)
    {
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

    protected function getValidationRules()
    {
        // TODO: Implement getValidationRules() method
    }

    public function jsonSerialize()
    {
        $weightType                             =       call_user_func('get_object_vars', $this);
        return array_except($weightType, ['__initializer__', '__cloner__', '__isInitialized__']);
    }
}