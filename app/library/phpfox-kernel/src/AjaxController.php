<?php

namespace Phpfox\Kernel;

class AjaxController extends ActionController
{
    protected function initialize()
    {
        \Phpfox::get('response')
            ->setPrototype('response.ajax');
    }
}