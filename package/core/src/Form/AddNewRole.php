<?php

namespace Neutron\Core\Form;


use Neutron\Core\Model\AclRole;
use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddNewRole extends Form
{
    protected function initialize()
    {
        $roles = _model('acl_role')
            ->select()
            ->where('inherit_id=?', 0)
            ->execute()
            ->all();

        $roleOptions = array_map(function (AclRole $v) {
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
                'name'       => 'name',
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

    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'name'       => 'save',
                'label'      => _text('Submit'),
                'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
            ]),
            new ButtonField([
                'name'       => 'cancel',
                'href'       => '#',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd'=>'form.cancel'],
            ]),
        ];
        /** end buttons **/
    }
}