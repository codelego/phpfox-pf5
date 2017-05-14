<?php

namespace Phpfox\Action;

class AjaxController extends ActionController
{
    protected function initialize()
    {
        _get('response')
            ->setPrototype('response.ajax');
    }
}