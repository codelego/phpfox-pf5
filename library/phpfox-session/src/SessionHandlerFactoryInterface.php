<?php

namespace Phpfox\Session;


interface SessionHandlerFactoryInterface
{
    /**
     * @return SessionHandlerInterface
     */
    public function factory();
}