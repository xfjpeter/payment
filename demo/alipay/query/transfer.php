<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: 查询转账订单接口
 * | ---------------------------------------------------------------------------------------------------
 * | Document：https://docs.open.alipay.com/api_28/alipay.fund.trans.order.query/
 * | ---------------------------------------------------------------------------------------------------
 */

require '../../../vendor/autoload.php';

use johnxu\tool\Config;
use johnxu\payment\Payment;

$config = require '../../config.php';

try
{
    $alipay = Payment::getInstance( $config )->query( 'alipay' );

    $payment = $alipay->transfer( array(
        'out_biz_no' => '5c3a122c4f3d6',
        'order_id'   => '',
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
 * [alipay_fund_trans_order_query_response] => stdClass Object
 * (
 * [code] => 40004
 * [msg] => Business Failed
 * [sub_code] => INVALID_PARAMETER
 * [sub_msg] => 参数有误。参数out_biz_no与order_id不能同时为空
 * )
 *
 * [sign] => KABL5t2PHU3gBHyDNwjk+E9MsYr9f6bvi3rVI1f9Fz/h1RG/Zh6fqtV9soAH+pjYkcaJGYI80NpB3W6pOkKJuOzPGErhvJ5mS+fFUkSH9ozVHgLFrLiQqsMY2XLVRWTBlKHPb1jpGclU7xtQJJ4+4J5tS6RIWvhJzPTV7yUXKUDwAyNO7ddebeAEap//eI/ox/xqhA29x6uRA0dQ4eewRpLiQC+7yxFwBMaUxwSej4rB+Frm+Fkeug+jeY1KcTvXkemX2FAWlXBaiErbmfoBe9G0KwRZrzXBdEEk6bYPywF/pGntxqsApCvu25R/Pi5NZe9cAwnr7fa44guQ/iPaxQ==
 * )
 */

/**
 * 查询成功
 * stdClass Object
 * (
 * [alipay_fund_trans_order_query_response] => stdClass Object
 * (
 * [code] => 10000
 * [msg] => Success
 * [order_fee] => 0.00
 * [order_id] => 20190113110070001502950000164366
 * [out_biz_no] => 5c3a122c4f3d6
 * [pay_date] => 2019-01-13 00:13:32
 * [status] => SUCCESS
 * )
 *
 * [sign] => abcQF4nMs66hH2W8obgZ9CcSq42akHNqJb1bstv4fw8kcmmdM6G3ugzToQKE4/NfSNN5hrDHUuemW7PLoYIswZP6QXXo2Gq+QVT3ZomVgTpdER1wDtpnqXst/n7jrsP882fpPa0vaHr/f+BUrvxOm4RRHKdzy7+X6li+cIJYz14lO45d1yxMMTbcbkrydbQaqBfx136DpuGp+Tvt96X5U61E6ywe3szNzJDUowdS4BoWMo8e/xl++J61Uu90BgP7NuhG47fdqknvnFD8fILgj8g3GKG3hoVuTgWejFiXvkbmC0asf2HUPuDrDpeNPryuPuZvi4X/gavHUJp5+fd1EQ==
 * )
 */


