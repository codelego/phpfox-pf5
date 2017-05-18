<?php

namespace Neutron\Core\Controller;

use Phpfox\Support\ActionController;
use Phpfox\View\ViewModel;

class ErrorController extends ActionController
{
    public function actionIndex()
    {
        $lastException = _get('dispatcher')
            ->getLastException();

        $message = '';

        if ($lastException instanceof \Exception) {
            $message = $lastException->getTraceAsString();
        }

        return new ViewModel([
            'lastException' => $message,
        ], 'core/error/index');
    }

    public function action404()
    {
        return new ViewModel([], 'core/error/404');
    }


    public function action500()
    {
        return new ViewModel([], 'core/error/500');
    }
}