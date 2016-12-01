<?php
namespace Neutron\User\Controller;


use Phpfox;
use Phpfox\Mvc\StandardController;

class VerifyController extends StandardController
{
    public function actionIndex()
    {
        return $this->forward('core.error', 'general');
    }
}