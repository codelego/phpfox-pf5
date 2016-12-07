<?php

namespace Phpfox\Form;


class RenderFacadesTest extends \PHPUnit_Framework_TestCase
{
    public function testGeneral()
    {
        $form = new Form();

        $form->setRender('form_bootstrap');
        $form->addElement(new Text([
            'name'       => 'email',
            'required'   => true,
            'params'     => [],
            'value'      => '123',
            'attributes' => [
                'type'  => 'email',
                'class' => 'form form-control',
            ],
        ]));

        $form->addElement(new Text([
            'name'       => 'text',
            'required'   => true,
            'params'     => [],
            'value'      => '123',
            'attributes' => [
                'type'  => 'password',
                'class' => 'form-control',
            ],
        ]));

        $form->addElement(new Text([
            'name'       => 'value_id',
            'required'   => true,
            'params'     => [],
            'value'      => '123',
            'attributes' => [
                'type'  => 'hidden',
                'class' => 'form-control',
            ],
        ]));

        $form->addElement(new Hidden([
            'name'       => 'value_id',
            'required'   => true,
            'params'     => [],
            'value'      => '123',
            'attributes' => [
                'type'  => 'hidden',
                'class' => 'form-control',
            ],
        ]));

        $form->addElement(new Button([
            'name'       => 'value_id',
            'required'   => true,
            'params'     => [],
            'value'      => '123',
            'attributes' => [
                'type'  => 'submit',
                'class' => 'btn btn-primary',
            ],
        ]));

        echo \Phpfox::get('form.render')->render($form);
    }
}
