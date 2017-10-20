<?php

namespace Phpfox\Kernel;

class AjaxController extends ActionController
{
    protected function initialize()
    {
        _get('response')
            ->setPrototype('response.ajax');
    }
}