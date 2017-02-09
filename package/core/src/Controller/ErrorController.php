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

        $vm = new ViewModel();

        $message = '';

        if($lastException instanceof \Exception){
            $message = $lastException->getTraceAsString();
        }

        $vm->assign(['lastException' => $message]);

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

        return $vm;
    }
}