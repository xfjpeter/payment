<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/13
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: Web scan
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\wxpay\pay;

use johnxu\payment\Exception;
use johnxu\payment\wxpay\Fire;
use johnxu\payment\wxpay\Support;
use johnxu\tool\Config;

class App extends Fire
{
    /**
     * @param string $params
     *
     * @return array|mixed
     * @throws Exception
     */
    protected function request( string $params )
    {
        $result = parent::request( $params );

        if ( $result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS' )
        {
            if ( Support::verifySignature( (array) $result, $result->sign ) )
            {
                $return = array(
                    'appid'     => Config::getInstance()->get( 'wxpay.app_id' ),
                    'partnerid' => Config::getInstance()->get( 'wxpay_mch_id' ),
                    'prepay_id' => $result->prepay_id,
                    'package'   => 'Sign=WXPay',
                    'noncestr'  => Support::getRandStr(),
                    'timestamp' => time(),
                );
                $return = Support::signature( $return );

                return $return;
            }
            else
            {
                throw new Exception( 'Verify signature fail.' );
            }
        }
        else
        {
            throw new Exception( 'return_code:' . $result->return_code . ',return_msg:' . $result->return_msg );
        }
    }

    protected function getTradeType()
    {
        return 'APP';
    }

    protected function getUri()
    {
        return 'pay/unifiedorder';
    }
}
