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

class Web extends Fire
{

    /**
     * @param string $params
     *
     * @return mixed
     * @throws Exception
     * @throws \Exception
     */
    protected function request( string $params )
    {
        $result = parent::request( $params );
        if ( $result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS' )
        {
            \QRcode::png( $result->code_url, false, QR_ECLEVEL_H );
        }
        else
        {
            throw new Exception( 'return_code:' . $result->return_code . ',return_msg:' . $result->return_msg );
        }
    }

    protected function getTradeType()
    {
        return 'NATIVE';
    }

    protected function getUri()
    {
        return 'pay/unifiedorder';
    }
}
