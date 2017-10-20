<?php

namespace Phpfox\Session;


interface SessionFactoryInterface
{
    /**
     * @return SessionInterface
     */
    public function factory();
}