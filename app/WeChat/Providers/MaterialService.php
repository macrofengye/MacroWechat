<?php
namespace WeChat\Providers;

use WeChat\Utils\WeChat\Material\Material;
use WeChat\Utils\WeChat\Material\Temporary;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class MaterialService.
 */
class MaterialService implements ServiceProviderInterface
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
        $pimple['material'] = function ($pimple) {
            return new Material($pimple['access_token']);
        };

        $temporary = function ($pimple) {
            return new Temporary($pimple['access_token']);
        };

        $pimple['material_temporary'] = $temporary;
        $pimple['material.temporary'] = $temporary;
    }
}
