<?php

/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/13
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: 企业付款到零钱
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\wxpay\pay;

use johnxu\payment\Exception;
use johnxu\payment\wxpay\Fire;
use johnxu\payment\wxpay\Support;
use johnxu\tool\Config;
use johnxu\tool\Http;

class Transfer extends Fire
{
    /**
     * @param array $params
     *
     * @return mixed
     * @throws \Exception
     */
    public function pay(array $params)
    {
        unset($params['return_url'], $params['notify_url'], $params['mch_id'], $params['appid']);
        $wxConfig = Config::getInstance()->get('wxpay');
        Config::getInstance()->set('wxpay.sign_type', 'MD5');
        $params['mch_appid'] = $wxConfig['app_id'];
        $params['mchid']     = $wxConfig['mch_id'];
        unset($params['sign_type']);

        $params = Support::signature($params);
        // 转换成xml
        $paramsXml = Support::arrayToXml($params);

        $response = Http::getInstance()->request(
            $wxConfig['uri'] . $this->getUri(),
            $paramsXml,
            'post',
            $wxConfig['cert_client'],
            $wxConfig['cert_key']
        );

        $data = $response->get('data');

        $result = Support::xmlToArray($data);

        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            return $result;
        } else {
            throw new Exception($result->err_code_des ?? $result->return_msg);
        }
    }

    protected function getUri()
    {
        return 'mmpaymkttransfers/promotion/transfers';
    }
}
