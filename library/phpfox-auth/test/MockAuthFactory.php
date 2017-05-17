<?php

namespace Phpfox\Auth;

class MockAuthFactory implements AuthFactoryInterface
{

    public function factory($id)
    {
        return new MockAuthBaseExample();
    }
}