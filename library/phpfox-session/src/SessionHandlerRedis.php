<?php

namespace Phpfox\Session;

/**
 * Class RedisSessionStorage
 *
 * @link    https://www.digitalocean.com/community/tutorials/how-to-set-up-a-redis-server-as-a-session-handler-for-php-on-ubuntu-14-04
 *
 * @package Phpfox\Session
 */
class SessionHandlerRedis implements SessionHandlerInterface
{
    /**
     * @link https://www.digitalocean.com/community/tutorials/how-to-set-up-a-redis-server-as-a-session-handler-for-php-on-ubuntu-14-04
     *       <quote>
     *       session.save_handler = redis <br/>
     * session.save_path =
     *       "tcp://10.133.14.9:6379?auth=complex_password"
     *       </quote>
     */
    public function register()
    {
        if (!extension_loaded('redis')) {
            throw new \InvalidArgumentException("Redis is required.");
        }
        ini_set('session.save_handler', 'redis');
        ini_set('session.save_path', 'tcp://127.0.0.1:6379');
    }
}