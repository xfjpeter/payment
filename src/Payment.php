<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/10
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: Payment
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment;

use johnxu\tool\Config;

/**
 * Class Payment
 *
 * @package johnxu\payment
 */
class Payment
{
    static private $instance = null;

    private function __construct( array $config = array() )
    {
        if ( $config )
        {
            Config::getInstance()->batch( $config );
            // Set Request URI
            if ( Config::getInstance()->has( 'alipay.dev', false ) )
            {
                Config::getInstance()->set( 'alipay.uri', 'https://openapi.alipaydev.com/gateway.do' );
            }
            else
            {
                Config::getInstance()->set( 'alipay.uri', 'https://openapi.alipay.com/gateway.do' );
            }
        }
    }

    /**
     * Get instance
     *
     * @param array $config
     *
     * @return Payment|null
     */
    public static function getInstance( array $config = [] )
    {
        if ( !self::$instance instanceof self )
        {
            self::$instance = new self( $config );
        }

        return self::$instance;
    }

    /**
     * @param string $method
     *
     * @return mixed|\johnxu\payment\wxpay\Pay|\johnxu\payment\alipay\Pay
     * @throws Exception
     */
    public function pay( string $method = 'alipay' )
    {
        $namespace = "\\johnxu\\payment\\{$method}\\Pay";
        if ( !class_exists( $namespace ) )
        {
            throw new Exception( 'Pay class not found.' );
        }

        $class = new $namespace;

        return $class;
    }

    /**
     * @param string $method
     *
     * @return mixed
     * @throws Exception
     */
    public function query( string $method = 'alipay' )
    {
        $namespace = "\\johnxu\\payment\\{$method}\\Query";
        if ( !class_exists( $namespace ) )
        {
            throw new Exception( 'Pay class not found.' );
        }

        $class = new $namespace;

        return $class;
    }

    /**
     * @param string $method
     *
     * @return mixed
     * @throws Exception
     */
    public function trade( string $method = 'alipay' )
    {
        $namespace = "\\johnxu\\payment\\{$method}\\Trade";
        if ( !class_exists( $namespace ) )
        {
            throw new Exception( 'Pay class not found.' );
        }

        $class = new $namespace;

        return $class;
    }
}
