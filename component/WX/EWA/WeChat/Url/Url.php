<?php

namespace MComponent\WX\EWA\WeChat\Url;
use MComponent\WX\EWA\WeChat\Core\AccessToken;
use MComponent\WX\EWA\WeChat\Core\Http;

/**
 * 链接.
 */
class Url
{
    /**
     * Http对象
     *
     * @var Http
     */
    protected $http;

    const API_SHORT_URL = 'https://api.weixin.qq.com/cgi-bin/shorturl';

    /**
     * constructor
     *
     * @param AccessToken $token
     */
    public function __construct(AccessToken $token)
    {
        $this->http = new Http($token);
    }

    /**
     * 转短链接.
     *
     * @param string $url
     *
     * @return string
     */
    public function short($url)
    {
        $params = array(
            'action' => 'long2short',
            'long_url' => $url,
        );

        $response = $this->http->jsonPost(self::API_SHORT_URL, $params);

        return $response['short_url'];
    }

    /**
     * 获取当前URL.
     *
     * @return string
     */
    public static function current()
    {
        $protocol = (!empty($_SERVER['HTTPS'])
            && $_SERVER['HTTPS'] !== 'off'
            || $_SERVER['SERVER_PORT'] === 443) ? 'https://' : 'http://';

        if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
            $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
        } else {
            $host = $_SERVER['HTTP_HOST'];
        }

        return $protocol . $host . $_SERVER['REQUEST_URI'];
    }
}
