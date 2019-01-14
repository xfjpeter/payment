<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/13
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: H5
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\wxpay\pay;

use johnxu\payment\Exception;
use johnxu\payment\wxpay\Fire;

class Wap extends Fire
{

    /**
     * @param array $params
     *
     * @return mixed
     * @throws Exception
     */
    public function pay( array $params )
    {
        if ( !isset( $params['wap_url'] ) )
        {
            throw new Exception( '[wap_url] parameters cannot be null' );
        }
        if ( !isset( $params['wap_name'] ) )
        {
            throw new Exception( '[wap_name] parameters cannot be null' );
        }
        $params['scene_info'] = json_encode( array(
            'h5_info' => array(
                'type'     => 'Wap',
                'wap_url'  => $params['wap_url'],
                'wap_name' => $params['wap_name']
            )
        ), JSON_UNESCAPED_UNICODE );
        unset( $params['wap_url'], $params['wap_name'] );

        try
        {
            return parent::pay( $params );
        }
        catch ( \Exception $e )
        {
            throw new Exception( $e->getMessage() );
        }
    }

    protected function getTradeType()
    {
        return 'MWEB';
    }

    protected function getUri()
    {
        return 'pay/unifiedorder';
    }
}
