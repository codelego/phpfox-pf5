<?php
namespace Neutron\User\Controller;


use Phpfox;
use Phpfox\Mvc\MvcController;

class VerifyController extends MvcController
{
    public function actionIndex()
    {
        return $this->forward('core.error', 'general');
    }
}