<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/13
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: Face
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\wxpay\pay;

use johnxu\payment\Exception;
use johnxu\payment\wxpay\Fire;

class Face extends Fire
{
    /**
     * @param array $params
     *
     * @return mixed
     * @throws \Exception
     */
    public function pay(array $params)
    {
        if (isset($params['notify_url'])) {
            unset($params['notify_url']);
        }
        if (isset($params['return_url'])) {
            unset($params['return_url']);
        }

        return parent::pay($params);
    }

    protected function getUri()
    {
        return 'pay/micropay';
    }
}
