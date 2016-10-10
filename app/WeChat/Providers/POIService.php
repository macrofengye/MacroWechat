<?php

namespace WeChat\Providers;

use WeChat\Utils\WeChat\POI\POI;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class POIService.
 */
class POIService implements ServiceProviderInterface
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
        $pimple['poi'] = function ($pimple) {
            return new POI($pimple['access_token']);
        };
    }
}
