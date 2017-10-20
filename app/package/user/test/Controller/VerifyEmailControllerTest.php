<?php

namespace Neutron\User\Controller;

use Neutron\User\Service\VerifyTokenManager;
use Phpfox\Kernel\Request;

class VerifyEmailControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testActionIndexByEmptyToken()
    {
        Request::factory(['method' => 'get'])->singleton();

        $obj = new VerifyEmailController();

        $this->assertFalse($obj->actionIndex());
    }

    public function testActionIndexByNotFoundToken()
    {
        Request::factory(['method' => 'get', 'token' => 'not found token'])
            ->singleton();

        $obj = new VerifyEmailController();

        $this->assertFalse($obj->actionIndex());
    }

    public function testActionIndexByExpiredToken()
    {
        $token = (new VerifyTokenManager())->addVerifyEmailTokenByUserId(12);
        $token->setExpiresAt(date('Y-m-d H:i:s', time() - 86400));
        $token->save();

        Request::factory(['method' => 'get', 'token' => $token->getId()])
            ->singleton();

        $obj = new VerifyEmailController();

        $this->assertFalse($obj->actionIndex());
    }
}
