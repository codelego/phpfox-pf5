<?php

namespace Neutron\Core\Controller;


use Phpfox\Mvc\MvcController;
use Phpfox\View\ViewModel;

class IndexController extends MvcController
{
    public function actionIndex()
    {
        exit('core.index');
        return new ViewModel('core.index.index');
    }
}