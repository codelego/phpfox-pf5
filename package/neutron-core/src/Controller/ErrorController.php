<?php

namespace Neutron\Core\Controller;

use Phpfox\Mvc\MvcController;
use Phpfox\View\ViewModel;

class ErrorController extends MvcController
{
    public function actionIndex()
    {
        return new ViewModel('core.error.index');
    }

    public function action404()
    {
        return new ViewModel('core.error.404');
    }


    public function action500()
    {
        return new ViewModel('core.error.500');
    }
}