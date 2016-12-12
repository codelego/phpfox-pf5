<?php

namespace Neutron\Core\Form;

use Phpfox\Form\Form;

class FilterI18nPhrase extends Form
{
    protected function initialize()
    {
        $this->setAttribute('class', 'form-inline');

        $this->addElements([
            [
                'factory'    => 'text',
                'name'       => 'q',
                'attributes' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Name, Value',
                ],
            ],
            [
                'factory'    => 'choice',
                'name'       => 'domain',
                'attributes' => [
                    'placeholder' => 'domain',
                    'class'       => 'form-control',
                ],
            ],
            [
                'factory'    => 'choice',
                'name'       => 'lang',
                'attributes' => [
                    'class' => 'form-control',
                ],
            ],
            [
                'factory'    => 'button',
                'name'       => '_submit',
                'label'      => 'Search',
                'attributes' => [
                    'type'  => 'submit',
                    'class' => 'btn btn-search',
                ],
            ],
            [
                'factory'    => 'button',
                'name'       => '_reset',
                'label'      => 'Reset',
                'attributes' => [
                    'type'  => 'reset',
                    'class' => 'btn btn-reset',
                ],
            ],
        ]);
    }
}