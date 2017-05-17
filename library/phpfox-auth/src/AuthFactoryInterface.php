<?php

namespace Phpfox\Auth;


interface AuthFactoryInterface
{
    /**
     * @param string $id
     *
     * @return AuthInterface
     */
    public function factory($id);
}