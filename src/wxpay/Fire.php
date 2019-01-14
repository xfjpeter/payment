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

namespace johnxu\payment\wxpay;

use johnxu\tool\Config;
use johnxu\tool\Http;

/**
 * @method getUri()
 */
class Fire
{
    /**
     * @param array $params
     *
     * @return mixed
     * @throws \Exception
     */
    public function pay( array $params )
    {
        if ( method_exists( $this, 'getTradeType' ) )
        {
            $params['trade_type'] = $this->getTradeType();
        }
        $params = Support::signature( $params );
        // 转换成xml
        $paramsXml = Support::arrayToXml( $params );

        return $this->request( $paramsXml );
    }

    /**
     * @param string $params
     *
     * @return mixed
     * @throws \Exception
     */
    protected function request( string $params )
    {
        $uri      = Config::getInstance()->get( 'wxpay.uri' ) . $this->getUri();
        $response = Http::getInstance()->request( $uri, $params, 'post' );

        $data = $response->get( 'data' );

        return Support::xmlToArray( $data );
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws \Exception
     */
    public function run( array $params )
    {
        $params['method'] = $this->getMethod();

        $params = Support::signature( $params );

        $uri = Config::getInstance()->get( 'wxpay.uri' );

        $response = Http::getInstance()->request( $uri, http_build_query( $params ), 'post' );

        $data = mb_convert_encoding( $response->get( 'data' ), 'utf-8', 'gbk' );

        return json_decode( $data );
    }
}
