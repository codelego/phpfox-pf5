<?php

namespace Phpfox\Auth;

interface AuthAwareInterface
{

    public function read();


    public function write($id, $token);
}