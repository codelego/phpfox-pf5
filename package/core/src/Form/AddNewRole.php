<?php

namespace Neutron\Core\Form;


use Neutron\Core\Model\AuthorizationRole;
use Neutron\Core\Model\CoreRole;
use Phpfox\Form\Form;

class AddNewRole extends Form
{
    protected function initialize()
    {
        $roles = \Phpfox::getModel('core_role')
            ->select()
            ->where('inherit_id=?', 0)
            ->execute()
            ->all();

        $roleOptions = array_map(function (CoreRole $v) {
            return [
                'label' => $v->getName(),
                'value' => $v->getId(),
            ];
        }, $roles);

        array_unshift($roleOptions, [
            'value' => 0,
            'label' => 'Root',
        ]);

        $this->addElements([
            [
                'factory'    => 'text',
                'label'      => _text('Name'),
                'required'   => true,
                'attributes' => [
                    'required'    => true,
                    'class'       => 'form-control',
                    'placeholder' => _text('Role Name', 'admin'),
                ],
            ],
            [
                'name'     => 'inherit_id',
                'label'    => _text('Inherit from', 'admin'),
                'factory'  => 'choice',
                'required' => false,
                'value'    => 0,
                'render'   => 'radio',
                'options'  => $roleOptions,
            ],
        ]);
    }
}