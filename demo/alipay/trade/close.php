<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: 统一收单交易关闭接口
 * | ---------------------------------------------------------------------------------------------------
 * | Document：https://docs.open.alipay.com/api_1/alipay.trade.close/
 * | ---------------------------------------------------------------------------------------------------
 */

require '../../../vendor/autoload.php';

use johnxu\tool\Config;
use johnxu\payment\Payment;

$config = require '../../config.php';

try
{
    $alipay = Payment::getInstance( $config )->trade( 'alipay' );

    $payment = $alipay->close( array(
        'trade_no'     => '',
        'out_trade_no' => '5c3a0958c34a0',
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
 * [alipay_trade_close_response] => stdClass Object
 * (
 * [code] => 40004
 * [msg] => Business Failed
 * [sub_code] => ACQ.TRADE_STATUS_ERROR
 * [sub_msg] => 交易状态不合法
 * [out_trade_no] => 5c3a0958c34a0
 * )
 *
 * [sign] => cuatzEGjxNeygjP9KWQbyS5OJP1eA6rR9Mm5Gt5oqKXTG/sNOp+tOl+GeGLqC6qX72OE6mfoW4Yq/y8VAJ4Wy7sFDoyDRrcSBdDJ8kosn5/f2/JClH72mtQXtGTbpZVMzbXAt5Xwy6NcdMeoC6nSxs40y/04BYcis8om+J90h865z90CU8p1rE8XTmIhFHLotGtfzCuQR7z00xptwFaimHUQrY7s+V5XYVcsx07UdddbzFfRC6Wov7wiEIFPEKOvHEVP7UHnteBEXtBEYEepYZbo5rO1DkF4duhvdN1L1FtEpRKNm8G4iXGXGifcBdrkEV9GvPQIGesBcZicN7bKCw==
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


