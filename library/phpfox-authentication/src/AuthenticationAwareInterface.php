<?php

namespace Phpfox\Authentication;

interface AuthenticationAwareInterface
{

    public function read();


    public function write($id, $token);
}