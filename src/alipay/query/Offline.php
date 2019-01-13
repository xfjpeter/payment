<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/13
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: Offline query
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\alipay\query;

use johnxu\payment\alipay\Fire;

class Offline extends Fire
{
    protected function getMethod(): string
    {
        return 'alipay.trade.query';
    }
}
