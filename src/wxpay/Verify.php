<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/11
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: Alipay
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\wxpay;

use johnxu\payment\Exception;

/**
 * Class Pay
 *
 * @package johnxu\payment\wxpay
 */
class Verify
{
    private $data;

    /**
     * return verify
     *
     * @return bool
     */
    public function return()
    {
        $this->data = $_GET;

        return $this->validation();
    }

    /**
     * notify verify
     *
     * @return bool
     */
    public function notify()
    {
        $this->data = file_get_contents( 'php://input' );

        return $this->validation();
    }

    /**
     * @return bool|object
     */
    private function validation()
    {
        $this->data = Support::xmlToArray( $this->data );

        return Support::verifySignature( (array) $this->data, $this->data->sign ) ? $this->data : false;
    }
}
