<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: Transfer payment
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\alipay\pay;

use johnxu\payment\alipay\Fire;

class Transfer extends Fire
{
    /**
     * @param array $params
     *
     * @return mixed
     * @throws \Exception
     */
    protected function request(array $params)
    {
        return $this->httpRequest($params);
    }

    protected function getMethod(): string
    {
        return 'alipay.fund.trans.toaccount.transfer';
    }

    protected function getPayeeType()
    {
        return 'ALIPAY_LOGONID';
    }
}
