<?php

namespace Neutron\Core\Controller;

use Phpfox\Support\ActionController;
use Phpfox\View\ViewModel;

class IndexController extends ActionController
{
    public function actionIndex()
    {
        return new ViewModel([], 'core/index/index');
    }

    public function actionOffline()
    {

    }
}