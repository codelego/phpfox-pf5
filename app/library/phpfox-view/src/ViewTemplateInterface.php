<?php

namespace Phpfox\View;


interface ViewTemplateInterface
{

    /**
     * @param $__name_
     * @param $__vars_
     *
     * @return string
     */
    public function render($__name_, $__vars_);
}