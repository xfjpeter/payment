<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/13
 * | ---------------------------------------------------------------------------------------------------
 * | Desc:
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\alipay;

use johnxu\tool\Config;
use johnxu\tool\Http;

class Fire
{
    /**
     * @param array $params
     *
     * @return mixed
     * @throws \johnxu\payment\Exception
     */
    public function pay( array $params )
    {
        $params['method'] = $this->getMethod();
        if ( method_exists( $this, 'getProductCode' ) )
        {
            $params['biz_content'] = json_encode(
                array_merge(
                    json_decode( $params['biz_content'], true ),
                    array( 'product_code' => $this->getProductCode() )
                ),
                JSON_UNESCAPED_UNICODE
            );
        }
        if ( method_exists( $this, 'getPayeeType' ) )
        {
            $bizContent = json_decode( $params['biz_content'], true );
            if ( !isset( $bizContent['payee_type'] ) )
            {
                $bizContent['payee_type'] = $this->getPayeeType();
            }
            $params['biz_content'] = json_encode( $bizContent, JSON_UNESCAPED_UNICODE );
        }

        $params = Support::signature( $params );

        return $this->request( $params );
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    protected function request( array $params )
    {
        $uri = Config::getInstance()->get( 'alipay.uri' );

        $uri .= '?' . http_build_query( $params );

		return $uri;
		// 直接返回 url 地址，在 laravel 中 header 无效
        // @header( 'Location:' . $uri );
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws \Exception
     */
    protected function httpRequest( $params )
    {
        $uri      = Config::getInstance()->get( 'alipay.uri' );
        $response = Http::getInstance()->request( $uri, http_build_query( $params ), 'post' );
        $data     = mb_convert_encoding( $response->get( 'data' ), 'utf-8', 'gbk' );

        return json_decode( $data );
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws \johnxu\payment\Exception
     */
    public function run( array $params )
    {
        $params['method'] = $this->getMethod();

        $params = Support::signature( $params );

        $uri = Config::getInstance()->get( 'alipay.uri' );

        $response = Http::getInstance()->request( $uri, http_build_query( $params ), 'post' );

        $data = mb_convert_encoding( $response->get( 'data' ), 'utf-8', 'gbk' );

        return json_decode( $data );
    }
}
