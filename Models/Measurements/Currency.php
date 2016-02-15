<?php
namespace app\Models\Measurements;


use Respect\Validation\Validator as v;

class Currency implements \JsonSerializable {

    public $id;
    public $name;
    public $symbol;
    public $statusId;
    public $createdAt;
    public $expiresAt;


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

        return [
            v::attribute('name',                        v::notEmpty()->length(3, 100)),
            v::attribute('symbol',                      v::notEmpty()->length(3, 3)),
            v::attribute('statusId',                    v::notEmpty()->int()->positive()),
            v::attribute('createdAt',                   v::notEmpty()->date()),
            v::attribute('expiresAt',                   v::notEmpty()->date()),
        ];
    }

    public function jsonSerialize() {
        $currency                               =       call_user_func('get_object_vars', $this);
        return array_except($currency, ['__initializer__', '__cloner__', '__isInitialized__']);
    }
}