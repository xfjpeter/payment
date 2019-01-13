<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: Wap payment
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\alipay\pay;

use johnxu\payment\alipay\Fire;

class Wap extends Fire
{
    protected function getProductCode(): string
    {
        return 'QUICK_WAP_WAY';
    }

    protected function getMethod(): string
    {
        return 'alipay.trade.wap.pay';
    }
}
