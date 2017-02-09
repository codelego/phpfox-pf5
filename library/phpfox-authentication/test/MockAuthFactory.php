<?php

namespace Phpfox\Authentication;

class MockAuthFactory implements AuthFactoryInterface
{

    public function factory($id)
    {
        return new MockAuthBaseExample();
    }
}