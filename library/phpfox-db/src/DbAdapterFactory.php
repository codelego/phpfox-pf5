<?php

namespace Phpfox\Db;

class DbAdapterFactory
{
    /**
     * @param string $class reversed param
     * @param string $key   configure name under db options.
     *
     * @return DbAdapterInterface
     */
    public function factory($class = null, $key = null)
    {
        if (!$key) {
            $key = 'default';
        }

        $params = _param('db.adapters', $key);

        if (!$class) {
            $class = _param('db.drivers', $params['driver']);
        }

        return new $class($params);
    }
}