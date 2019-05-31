<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc:
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\wxpay;

use johnxu\payment\Exception;
use johnxu\tool\Config;

/**
 * Class Pay
 *
 * @method web(array $businessParams)
 * @method transfer(array $businessParams)
 * @method face(array $businessParams)
 * @method app(array $businessParams)
 * @method mini(array $businessParams)
 * @method wap(array $businessParams)
 *
 * @package johnxu\payment\wxpay
 */
class Pay
{
    private $businessParams = array();

    private $params = array();

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        $name      = ucfirst($name);
        $namespace = "\\johnxu\\payment\\wxpay\\pay\\{$name}";
        if (!class_exists($namespace)) {
            throw new Exception("$name class not found.");
        }
        $class                = new $namespace();
        $this->businessParams = $arguments[0];

        return $class->pay($this->params());
    }

    /**
     * Get params
     *
     * @return array
     */
    private function params()
    {
        $this->params = array(
            'appid'            => Config::getInstance()->get('wxpay.app_id'),
            'mch_id'           => Config::getInstance()->get('wxpay.mch_id'),
            'nonce_str'        => Support::getRandStr(),
            'sign_type'        => Config::getInstance()->get('wxpay.sign_type', 'MD5'),
            'spbill_create_ip' => Support::getClientIp(),
            'return_url'       => Config::getInstance()->get('wxpay.return_url'),
            'notify_url'       => Config::getInstance()->get('wxpay.notify_url')
        );
        $this->params = array_merge($this->params, $this->businessParams);

        return $this->params;
    }
}
