<?php

namespace Phpfox\Form;


class FormTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $form = new Form();

        $username = new Element([
            'name'     => 'username',
            'type'     => 'input',
            'render'   => 'text',
            'value'    => 'example username',
            'required' => 1,
        ]);

        $form->addElement($username);

        $this->assertEquals($username, $form->getElement('username'));

    }

    public function testBase2()
    {
        $form = new Form();
        $username = new InputTextField([
            'name'     => 'username',
            'type'     => 'input',
            'render'   => 'text',
            'value'    => 'example username',
            'required' => 1,
        ]);
        $password = new InputTextField([
            'name'     => 'password',
            'type'     => 'password',
            'render'   => 'text',
            'value'    => '',
            'required' => 1,
        ]);

        $form->addElements([$username, $password,]);

        $this->assertEquals($username, $form->getElement('username'));
        $this->assertEquals($password, $form->getElement('password'));

        $this->assertEquals([
            'username' => $username,
            'password' => $password,
        ], $form->getElements());
    }

    public function testBase3()
    {
        $form = new Form();

        $this->assertNotFalse(strpos($form->open(), '<form '));
        $this->assertNotFalse(strpos($form->close(), '</form>'));
    }

    public function testBase4()
    {
        $form = new Form();
        $username = new InputTextField([
            'name'     => 'username',
            'type'     => 'input',
            'render'   => 'text',
            'value'    => 'example username',
            'required' => 1,
        ]);
        $password = new InputTextField([
            'name'     => 'password',
            'type'     => 'password',
            'render'   => 'text',
            'value'    => '',
            'required' => 1,
        ]);

        $data = [
            'username' => 'jack.london',
            'password' => 'jack123',
        ];

        $form->addElements([$username, $password]);
        $form->populate($data);

        $this->assertEquals($data, $form->getData());
    }

    public function testBase5()
    {
        $form = new Form();

        $data = [
            'username' => 'jack.london',
            'password' => 'jack123',
        ];

        $form->addElements([
            [
                'factory'  => 'text',
                'name'     => 'username',
                'type'     => 'input',
                'render'   => 'text',
                'value'    => 'example username',
                'required' => 1,
            ],
            [
                'factory'  => 'text',
                'name'     => 'password',
                'type'     => 'password',
                'render'   => 'text',
                'value'    => '',
                'required' => 1,
            ],
        ]);
        $form->populate($data);

        $this->assertEquals($data, $form->getData());
    }

}
