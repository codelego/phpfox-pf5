<?php

namespace Neutron\Core\Controller;

use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class ErrorController extends ActionController
{
    public function actionIndex()
    {
        $lastException = \Phpfox::get('mvc.dispatch')
            ->getLastException();

        $vm
            = new ViewModel(['lastException' => $lastException->getTraceAsString()]);

        $vm->setTemplate('core/error/index');

        return $vm;
    }

    public function action404()
    {
        $vm = new ViewModel();

        $vm->setTemplate('core/error/404');

        return $vm;
    }


    public function action500()
    {
        $vm = new ViewModel();

        $vm->setTemplate('core/error/500');
    }
}