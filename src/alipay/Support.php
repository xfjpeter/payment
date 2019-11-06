<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>.
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.johnxu.net.
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 2019/1/10
 * | ---------------------------------------------------------------------------------------------------
 * | Desc: Support Class
 * | ---------------------------------------------------------------------------------------------------
 */

namespace johnxu\payment\alipay;

use johnxu\tool\Config;
use johnxu\payment\Exception;

class Support
{
    /**
     * Signature
     *
     * @param array $data
     *
     * @return array
     * @throws Exception
     */
    public static function signature( array $data )
    {
        $config = Config::getInstance();
        if ( !$privateKey = $config->has( 'alipay.user_private_key' ) )
        {
            throw new Exception( 'User private key not exist.' );
        }
        $stringParam = self::getParams( $data );

        $signType     = $config->get( 'alipay.sign_type', 'RSA2' );
        $privateKeyId = openssl_pkey_get_private( self::getPrivateKey( $privateKey ) );
        if ( !$privateKeyId )
        {
            throw new Exception( 'User private key is error.' );
        }
        openssl_sign( $stringParam, $signature, $privateKeyId, $signType == 'RSA2' ? OPENSSL_ALGO_SHA256 : OPENSSL_ALGO_SHA1 );
        $data['sign'] = base64_encode( $signature );

        return $data;
    }

    /**
     * Verify signature
     *
     * @param array   $data
     * @param string  $signature
     * @param boolean $platform
     * @param boolean $signType
     *
     * @return int
     * @throws Exception
     */
    public static function verifySignature( array $data, string $signature, $platform = false, $signType = false )
    {
        $config    = Config::getInstance();
        $publicKey = $platform ? $config->has( 'alipay.platform_public_key' ) : $config->has( 'alipay.user_public_key' );
        if ( !$publicKey )
        {
            throw new Exception( 'User public key not exist.' );
        }
        $stringParam = self::getParams( $data, $signType );
        $signType    = $config->get( 'alipay.sign_type', 'RSA2' );

        return (bool) openssl_verify( $stringParam, base64_decode( $signature ), self::getPublicKey( $publicKey ),
            $signType == 'RSA2' ? OPENSSL_ALGO_SHA256 : OPENSSL_ALGO_SHA1 );
    }

    /**
     * http build param
     *
     * @param array $params
     *
     * @return string
     */
    public static function buildParams( array $params )
    {
        $str = '';
        foreach ( $params as $key => $value )
        {
            $str .= "{$key}={$value}&";
        }

        return trim( $str, '&' );
    }

    /**
     * Formatter Public Key
     *
     * @param string $param File Path Or Public Key String
     *
     * @return string
     */
    public static function getPublicKey( string $param ): string
    {
        if ( is_file( $param ) )
        {
            $param = file_get_contents( $param );
        }
        $replaceTpl = array(
            "-----BEGIN PUBLIC KEY-----",
            "-----END PUBLIC KEY-----",
            "\r",
            "\n",
            "\r\n"
        );
        // 替换掉所有的模板内容
        $publicKey = str_replace( $replaceTpl, '', $param );
        // 拼接成public_key格式
        $publicKey = $replaceTpl[0] . PHP_EOL . wordwrap( $publicKey, 64, "\n", true ) . PHP_EOL . $replaceTpl[1];

        return $publicKey;
    }

    /**
     * Formatter Private Key
     *
     * @param string $param File Path Or Private Key String
     *
     * @return mixed|string
     */
    public static function getPrivateKey( string $param )
    {
        if ( is_file( $param ) )
        {
            $param = file_get_contents( $param );
        }
        $replaceTpl = array(
            "-----BEGIN RSA PRIVATE KEY-----",
            "-----END RSA PRIVATE KEY-----",
            "\r",
            "\n",
            "\r\n"
        );
        $privateKey = str_replace( $replaceTpl, '', $param );
        $privateKey = $replaceTpl[0] . PHP_EOL . wordwrap( $privateKey, 64, "\n", true ) . PHP_EOL . $replaceTpl[1];

        return $privateKey;
    }

    /**
     * Get timestamp
     *
     * @param string $formatter
     *
     * @return false|string
     */
    public static function getTimestamp( string $formatter = 'Y-m-d H:i:s' )
    {
        return date( $formatter );
    }

    /**
     * @param array   $arr
     * @param boolean $signType
     *
     * @return string
     */
    private static function getParams( array & $arr, bool $signType = false )
    {
        ksort( $arr );
        $stringParam = '';
        if ( $signType && isset( $arr['sign_type'] ) )
        {
            unset( $arr['sign_type'] );
        }
        foreach ( $arr as $key => $item )
        {
            if ( $key != 'sign' && $item != '' )
            {
                $stringParam .= "$key=$item&";
            }
        }

        return trim( $stringParam, '&' );
    }
}
