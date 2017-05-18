<?php

namespace Phpfox\Support;

class AjaxController extends ActionController
{
    protected function initialize()
    {
        _get('response')
            ->setPrototype('response.ajax');
    }
}