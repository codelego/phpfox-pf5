<?php

namespace Phpfox\Session;

class MemcacheSession implements SessionInterface
{
    protected $savePath = 'tcp://localhost:11211';

    /**
     * @link http://php.net/manual/en/memcached.sessions.php
     * @link
     * @see  ini_set
     */
    public function register()
    {
        ini_set('session.save_handler', 'memcache');
        ini_set('session.save_path', $this->savePath);

        return true;
    }

    /**
     * @return string
     */
    public function getSavePath()
    {
        return $this->savePath;
    }

    /**
     * @param string $savePath
     */
    public function setSavePath($savePath)
    {
        $this->savePath = $savePath;
    }
}