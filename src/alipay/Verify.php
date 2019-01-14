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

namespace johnxu\payment\alipay;

use johnxu\payment\Exception;

/**
 * Class Pay
 *
 * @package johnxu\payment\alipay
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
        $this->data = $_POST;

        return $this->validation();
    }

    /**
     * @return bool
     */
    private function validation()
    {
        try
        {
            return Support::verifySignature( $this->data, $this->data['sign'], true, true ) ? $this->data : false;
        }
        catch ( Exception $e )
        {
            return false;
        }
    }
}
