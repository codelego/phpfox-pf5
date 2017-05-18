<?php

namespace Phpfox\Form;


class FormFacadesRenderTest extends \PHPUnit_Framework_TestCase
{
    public function testRenderCheckbox()
    {
        $checkbox = new CheckboxField([
            'options' => [
                ['value' => 1, 'label' => 'field1'],
                ['value' => 2, 'label' => 'field2'],
            ],
        ]);
        $facades = new FormFacades();
        $this->assertNotFalse(strpos($facades->render($checkbox),
            '<input type="checkbox"'));
    }

    public function testRenderButton()
    {
        $checkbox = new ButtonField([
            'name'  => '_submit',
            'value' => 'delete',
            'label' => 'Delete',

        ]);
        $facades = new FormFacades();
        $this->assertNotFalse(strpos($facades->render($checkbox),
            '</button>'));
    }

    public function testRenderButton2()
    {
        $checkbox = new ButtonField([
            'name'  => '_submit',
            'value' => 'delete',
            'label' => 'Delete',
            'href'  => '../test.html',

        ]);
        $facades = new FormFacades();
        $this->assertNotFalse(strpos($facades->render($checkbox),
            '</a>'));
    }

    public function testRenderInput()
    {
        $checkbox = new InputTextField([
            'name'  => 'username',
            'value' => '',
            'label' => 'Username',

        ]);
        $facades = new FormFacades();
        $this->assertNotFalse(strpos($facades->render($checkbox),
            'type="text" '));
    }

    public function testSelectRender()
    {
        $checkbox = new ChoiceField([
            'render' => 'select',
            'name'   => 'category_id',
            'value'  => '',
            'label'  => 'Category',

        ]);
        $facades = new FormFacades();
        $this->assertNotFalse(strpos($facades->render($checkbox),
            '</select>'));
    }


    public function testBase6()
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

        $facades = new FormFacades();

        $this->assertNotFalse(strpos($facades->render($form),
            'name="username"'));
        $this->assertNotFalse(strpos($facades->render($form),
            'name="password"'));
    }
}
