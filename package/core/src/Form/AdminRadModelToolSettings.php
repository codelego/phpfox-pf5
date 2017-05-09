<?php

namespace Neutron\Core\Form;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AdminRadModelToolSettings extends Form
{
    /**
     * @return array
     */
    protected function getTableIdOptions()
    {
        return array_map(function ($item) {
            $v = str_replace(PHPFOX_TABLE_PREFIX, '', $item);
            return ['value' => $v, 'label' => $v];
        }, _service('db')->tables());
    }

    protected function getPackageIdOptions()
    {
        return array_map(function ($item) {
            return ['value' => $item['name'], 'label' => $item['title']];
        }, _service('db')
            ->select('*')
            ->from(':core_package')
            ->order('name', 1)
            ->all());
    }

    protected function initialize()
    {
        $this->setTitle(_text('Convert Database To Model, Form, ...', 'admin'));
        $this->setAction(_url('#'));

        $this->addElement([
            'factory'    => 'select',
            'name'       => 'package_id',
            'inline'     => true,
            'attributes' =>
                [
                    'size'  => 5,
                    'class' => 'form-control',
                ],
            'value'      => 'core',
            'options'    => $this->getPackageIdOptions(),
            'label'      => _text('Select Package'),
            'required'   => true,
        ]);

        $this->addElement([
            'factory'    => 'multi_select',
            'name'       => 'tables',
            'inline'     => true,
            'attributes' =>
                [
                    'size'  => 5,
                    'class' => 'form-control',
                ],
            'value'      => 'core',
            'options'    => $this->getTableIdOptions(),
            'label'      => _text('Select Tables'),
            'required'   => true,
        ]);

        $this->addElement([
            'name'       => 'text_domain',
            'label'      => 'Text Domain',
            'factory'    => 'text',
            'value'      => '',
            'attributes' => [
                'class' => 'form-control',
            ],
            'required'   => false,
        ]);

        $this->addElement([
            'factory'    => 'multi_checkbox',
            'name'       => 'cmds',
            'attributes' =>
                [
                    'size'  => 3,
                    'class' => 'form-control',
                ],
            'value'      => ['form_admin_add', 'form_admin_edit', 'form_admin_filter'],
            'options'    => [
                ['value' => 'form_admin_add', 'label' => 'Generate Form Admin Creation'],
                ['value' => 'form_admin_edit', 'label' => 'Generate Form Admin Editing'],
                ['value' => 'form_admin_delete', 'label' => 'Generate Form Admin Delete'],
                ['value' => 'form_admin_filter', 'label' => 'Generate Form AdminFilter'],
                ['value' => 'model', 'label' => 'Generate Model Class'],
            ],
            'label'      => _text('Generate Code'),
            'required'   => true,
        ]);
    }

    public function getButtons()
    {
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Process'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
        ];
    }
}