<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/13
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: Mini
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\wxpay\pay;

use johnxu\payment\Exception;
use johnxu\payment\wxpay\Fire;
use johnxu\payment\wxpay\Support;
use johnxu\tool\Config;

class Mini extends Fire
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
                $return            = array(
                    'appId'     => Config::getInstance()->get( 'wxpay.app_id' ),
                    'timeStamp' => time(),
                    'nonceStr'  => Support::getRandStr(),
                    'package'   => "prepay_id={$result->prepay_id}",
                    'signType'  => Config::getInstance()->get( 'sign_type', 'MD5' )
                );
                $return            = Support::signature( $return );
                $return['paySign'] = $return['sign'];
                unset( $return['sign'] );

                return json_encode( $return, JSON_UNESCAPED_UNICODE );
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
        return 'JSAPI';
    }

    protected function getUri()
    {
        return 'pay/unifiedorder';
    }
}
