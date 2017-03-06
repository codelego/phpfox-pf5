<?php

namespace Phpfox\Action;

class AjaxController extends ActionController
{
    protected function initialize()
    {
        \Phpfox::get('response')
            ->setPrototype('response.ajax');
    }
}