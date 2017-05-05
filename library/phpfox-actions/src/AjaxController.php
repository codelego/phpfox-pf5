<?php

namespace Phpfox\Action;

class AjaxController extends ActionController
{
    protected function initialize()
    {
        _service('response')
            ->setPrototype('response.ajax');
    }
}