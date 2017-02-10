<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 2/10/17
 * Time: 4:52 AM
 */

namespace Neutron\User\Form;


use Phpfox\Form\FieldInterface;
use Phpfox\Form\FormBootstrapRender;

class UserLoginTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new UserLogin();

        $this->assertTrue($form->getElement('username') instanceof
            FieldInterface);
        $this->assertTrue($form->getElement('password') instanceof
            FieldInterface);

        $this->assertNotEmpty((new FormBootstrapRender())->render($form));
    }
}
