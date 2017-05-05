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
                'render'     => 'select',
                'attributes' => [
                    'placeholder' => 'domain',
                    'class'       => 'form-control',
                ],
                'options'    => [
                    ['value' => '', 'label' => 'default'],
                ],
            ],
            [
                'factory'    => 'choice',
                'name'       => 'lang',
                'render'     => 'select',
                'attributes' => [
                    'class' => 'form-control',
                ],
                'options'    => _get('core.i18n_language')
                    ->getActiveOptions(),
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