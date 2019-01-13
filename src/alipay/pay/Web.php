<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: PC payment
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\alipay\pay;

use johnxu\payment\alipay\Fire;

class Web extends Fire
{
    protected function getProductCode(): string
    {
        return 'FAST_INSTANT_TRADE_PAY';
    }

    protected function getMethod(): string
    {
        return 'alipay.trade.page.pay';
    }
}
