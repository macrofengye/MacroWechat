<?php
/**
 * Created by PhpStorm.
 * User: macro
 * Date: 16-10-10
 * Time: 下午1:38
 */

namespace WeChat\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use WeChat\Utils\WeChat\Core\AccessToken;
use Doctrine\Common\Cache\FilesystemCache;

class AccessTokenService implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['access_token'] = function (Container $container) {
            $cache = new FilesystemCache(APP_PATH . '/log/cache');
            return new AccessToken(
                $container['config']['wechat']['app_id'],
                $container['config']['wechat']['secret'],
                $cache
            );
        };
    }
}