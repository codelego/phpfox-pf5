<?php
namespace Phpfox\Event;

interface EventLoaderInterface
{
    /**
     * @return array
     *
     * Get ordered events container
     * ['onApplicationBootstrap'=>['neutron\core\init',....]]
     *
     */
    public function load();
}