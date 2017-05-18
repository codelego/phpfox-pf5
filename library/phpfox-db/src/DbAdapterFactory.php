<?php

namespace Phpfox\Db;

class DbAdapterFactory
{
    /**
     * @param string $driver reversed param
     * @param string $params configure name under db options.
     *
     * @return DbAdapterInterface
     */
    public function factory($driver = null, $params = null)
    {
        if (!$params) {
            /** @noinspection PhpIncludeInspection */
            $params = include PHPFOX_DATABASE_FILE;
        } elseif (is_string($params)) {
            $params = _param('db.adapters', $params);
        }

        if (!$driver) {
            $driver = $params['driver'];
        }

        $class = _param('db_drivers', $driver);

        return new $class($params);
    }
}