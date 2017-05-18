<?php

namespace Neutron\Pages\Controller;

use Phpfox\Support\ActionController;
use Phpfox\View\ViewModel;

class ProfileController extends ActionController
{
    public function actionIndex()
    {
        return new ViewModel();
    }
}