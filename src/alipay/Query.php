<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: Alipay
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\alipay;

use johnxu\tool\Config;
use johnxu\payment\Exception;

/**
 * Class Pay
 *
 * @method web(array $businessParams)
 *
 * @package johnxu\payment\alipay
 */
class Query
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
    public function __call( $name, $arguments )
    {
        $name      = ucfirst( $name );
        $namespace = "\\johnxu\\payment\\alipay\\query\\{$name}";
        if ( !class_exists( $namespace ) )
        {
            throw new Exception( "$name class not found." );
        }
        $class                = new $namespace();
        $this->businessParams = $arguments[0];

        return $class->run( $this->params() );
    }

    /**
     * Get params
     *
     * @return array
     */
    private function params()
    {
        $this->params = array(
            'app_id'      => Config::getInstance()->get( 'alipay.app_id' ),
            'format'      => Config::getInstance()->get( 'alipay.format', 'json' ),
            'charset'     => Config::getInstance()->get( 'alipay.charset', 'utf-8' ),
            'sign_type'   => Config::getInstance()->get( 'alipay.sign_type', 'RSA2' ),
            'timestamp'   => Support::getTimestamp(),
            'version'     => Config::getInstance()->get( 'alipay.version', '1.0' ),
            'return_url'  => Config::getInstance()->get( 'alipay.return_url' ),
            'notify_url'  => Config::getInstance()->get( 'alipay.notify_url' ),
            'biz_content' => json_encode( $this->businessParams, JSON_UNESCAPED_UNICODE )
        );

        return $this->params;
    }
}
