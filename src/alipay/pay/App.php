<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: App payment
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\alipay\pay;

use johnxu\payment\alipay\Fire;

class App extends Fire
{
    protected function request( array $params )
    {
        return http_build_query( $params );
    }

    protected function getProductCode(): string
    {
        return 'QUICK_MSECURITY_PAY';
    }

    protected function getMethod(): string
    {
        return 'alipay.trade.app.pay';
    }
}
