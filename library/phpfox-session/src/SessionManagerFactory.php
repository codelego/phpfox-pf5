<?php

namespace Phpfox\Session;


class SessionManagerFactory
{
    public function factory($class = null, $options = null)
    {
        if (!$options) {
            $options = \Phpfox::getConfig('session.adapter');
        }

        if (!$class) {
            $class = \Phpfox::getConfig('session.drivers', $options['driver']);
        }

        if ($class == 'files') {
            return new SessionManager([
                'handler' => 'files',
            ]);
        }

        return new SessionManager([
            'handler'  => new $class(),
            'lifetime' => 86400,
        ]);
    }
}