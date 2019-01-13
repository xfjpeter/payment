<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: 口碑商品交易查询接口
 * | ---------------------------------------------------------------------------------------------------
 * | Doc：https://docs.open.alipay.com/api_1/koubei.trade.itemorder.query/
 * | ---------------------------------------------------------------------------------------------------
 */

require '../../../vendor/autoload.php';

use johnxu\tool\Config;
use johnxu\payment\Payment;

$config = require '../../config.php';

try
{
    $alipay  = Payment::getInstance( $config )->query( 'alipay' );
    $payment = $alipay->koubei( array(
        'order_no' => '5c3a0958c34a0', // 口碑订单号
    ) );

    echo '<pre>';
    print_r( $payment );
    echo '</pre>';
}
catch ( \johnxu\payment\Exception $e )
{
}



/**
 * 返回错误信息
 * stdClass Object
 * (
 * [alipay_trade_fastpay_refund_query_response] => stdClass Object
 * (
 * [code] => 40004
 * [msg] => Business Failed
 * [sub_code] => ACQ.INVALID_PARAMETER
 * [sub_msg] => 参数无效：支付宝订单号和外部订单号不能同时为空
 * )
 *
 * [sign] => OmBoDxiSsB1hEsNq8Soay6yXD08nz8yl0wFdojmi4M/YYdrp6yHs1J1B2pI+5EftKA1jAA0ok23XSOUlxacCCflesjxpeCu5x+fWcCpWLnfLR+hdHVM2arbuQwkI3RveHq/d30dR4muXKImdb0B7evtHIA3vJCvaOOd+RbgutKjyAG1DdrA4kDIeHiCeWZ42DWWrjmvA5oHEZvYDPddLe7Lc1ollOWhfPg/qqbGDO2b2n0KywfJvWYb/a4WB/Qtf7tUOQdQsDPttvvoWBIgxv6t+GoOd4dMTN8mGyddlJioP2VEO/qo3BQToxzz9iwok1Odk6FsCQuQJ9OC72yoeqw==
 * )
 */

/**
 * 查询成功且没有退款信息
 * stdClass Object
 * (
 * [alipay_trade_fastpay_refund_query_response] => stdClass Object
 * (
 * [code] => 10000
 * [msg] => Success
 * )
 *
 * [sign] => lcjjaeciT9Q16wcfoRHPTb2t84UUt4QczCAfZoTv+nhVwm8awu9HHa6Sl46Ov19+vVT/F0+L3AuxXtr4cI5ceEUy5EL8v7C/jiUaMyl8q3Q+MJW3ZRlEfb/pszz1KWohYE/J15nrCTLD4McQ6hvFM0mue5KpqCSJx7m5q3j5jIdBkR4wAuIlK7gJOUDO6CfEZnbLiHhJDnU3FWd/vHJIrWCHgR6WXAdBmvqDKXN80KVNmHtoa0HMDC+S1VSK06WX2iy96IVxYyEjgUglEy5R6wO+mfzn1mgi2X4WRILbAra/IQhMAkxhzqmZ0PLUnRMDFpxtjKSWuTzEsiwmlOsciA==
 * )
 */


