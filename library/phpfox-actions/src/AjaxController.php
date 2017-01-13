<?php

namespace Phpfox\Action;

class AjaxController extends ActionController
{
    protected function initialize()
    {
        \Phpfox::get('mvc.response')
            ->setPrototype('mvc.response.ajax');
    }
}