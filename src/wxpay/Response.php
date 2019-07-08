<?php

namespace johnxu\payment\wxpay;

class Response
{
    public function send()
    {
        echo Support::arrayToXml(['return_code' => 'SUCCESS', 'return_msg' => 'OK']);
        exit();
    }
}
