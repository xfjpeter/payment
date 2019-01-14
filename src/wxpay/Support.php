<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/13
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: Helper Class
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\wxpay;

use johnxu\tool\Config;

/**
 * Class Support
 *
 * @package johnxu\payment\wxpay
 */
class Support
{
    /**
     * Signature
     *
     * @param array $data
     *
     * @return array
     */
    public static function signature( array $data )
    {
        $stringParam    = self::getParam( $data );
        $key            = Config::getInstance()->get( 'wxpay.key' );
        $stringSignTemp = $stringParam . '&key=' . $key;
        $signType       = Config::getInstance()->get( 'wxpay.sign_type', 'MD5' );
        $data['sign']   = strtoupper( $signType ) == 'MD5' ? md5( $stringSignTemp ) : hash_hmac( 'sha256', $stringSignTemp, $key );
        $data['sign']   = strtoupper( $data['sign'] );

        return $data;
    }

    /**
     * @param array  $data
     * @param string $signature
     *
     * @return bool
     */
    public static function verifySignature( array $data, string $signature )
    {
        $sign = self::signature( $data );

        return boolval( $sign['sign'] == $signature );
    }

    /**
     * @example
     * key1=value1&key2=value2
     *
     * @param array $data
     *
     * @return string
     */
    public static function getParam( array &$data )
    {
        ksort( $data );
        $stringParam = '';
        foreach ( $data as $key => $item )
        {
            if ( $key != 'sign' && $item != '' )
            {
                $stringParam .= "$key=$item&";
            }
        }

        return trim( $stringParam, '&' );
    }

    /**
     * Get random str
     *
     * @param int $length
     *
     * @return string
     */
    public static function getRandStr( int $length = 16 )
    {
        $str    = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $random = '';
        for ( $i = 0; $i < $length; $i++ )
        {
            $random .= $str[mt_rand( 0, strlen( $str ) - 1 )];
        }

        return $random;
    }

    /**
     * Transfer array to xml
     *
     * @param array $arr
     *
     * @return string
     */
    public static function arrayToXml( array $arr ): string
    {
        $xml = '<xml>';
        foreach ( $arr as $key => $item )
        {
            if ( is_numeric( $key ) )
            {
                $xml .= "<{$key}>{$item}</{$key}>";
            }
            else
            {
                $xml .= "<{$key}><![CDATA[{$item}]]></{$key}>";
            }
        }
        $xml .= '</xml>';

        return $xml;
    }

    /**
     * Transfer xml to array
     *
     * @param string $xml
     *
     * @return object
     */
    public static function xmlToArray( string $xml )
    {
        libxml_disable_entity_loader( true );

        return json_decode( json_encode( simplexml_load_string( $xml, 'SimpleXMLElement', LIBXML_NOCDATA ) ) );
    }

    /**
     * Get client ip address
     *
     * @return string
     */
    public static function getClientIp(): string
    {
        $realIp = 'unknown';
        if ( $_SERVER['REMOTE_ADDR'] )
        {
            $realIp = $_SERVER['REMOTE_ADDR'];
        }
        elseif ( getenv( 'REMOTE_ADDR' ) )
        {
            $realIp = getenv( 'REMOTE_ADDR' );
        }

        return $realIp;
    }
}
