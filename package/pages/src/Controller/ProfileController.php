<?php

namespace Neutron\Pages\Controller;

use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class ProfileController extends ActionController
{
    public function actionIndex()
    {
        return new ViewModel();
    }
}