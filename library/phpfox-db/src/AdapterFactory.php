<?php

namespace Phpfox\Db;


class AdapterFactory
{
    /**
     * @param string $class reversed param
     * @param string $key   configure name under db options.
     *
     * @return AdapterInterface
     */
    public function factory($class = null, $key = null)
    {
        if (!$class) {
            ;
        }

        if (!$key) {
            $key = 'default';
        }

        $adapters = \Phpfox::config('db.adapters');
        $drivers = \Phpfox::config('db.drivers');
        $adapter = $adapters[$key];
        $constructor = $drivers[$adapter['driver']];
        return new $constructor($adapter);
    }
}