<?php

namespace Neutron\Core\Controller;

use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class IndexController extends ActionController
{
    public function actionIndex()
    {
        $vm = new ViewModel();

        $vm->setTemplate('core/index/index');

        return $vm;
    }
}