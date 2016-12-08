<?php

namespace Phpfox\Authentication;


interface AuthFactoryInterface
{
    /**
     * @param string $id
     *
     * @return AuthInterface
     */
    public function factory($id);
}