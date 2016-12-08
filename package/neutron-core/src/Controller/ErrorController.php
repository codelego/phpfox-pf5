<?php

namespace Neutron\Core\Controller;

use Phpfox\Mvc\MvcController;
use Phpfox\View\ViewModel;

class ErrorController extends MvcController
{
    public function actionIndex()
    {
        $lastException = \Phpfox::get('mvc.dispatch')->getLastException();

        return new ViewModel('core.error.index',
            ['lastException' => $lastException->getTraceAsString()]);
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