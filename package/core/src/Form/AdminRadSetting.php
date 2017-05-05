<?php

namespace Neutron\Core\Form;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AdminRadSetting extends Form
{
    /**
     * @return array
     */
    protected function getTableIdOptions()
    {
        return array_map(function ($item) {
            $v = str_replace(PHPFOX_TABLE_PREFIX, '', $item);
            return ['value' => $v, 'label' => $v];
        }, _get('db')->tables());
    }

    protected function getPackageIdOptions()
    {
        return array_map(function ($item) {
            return ['value' => $item['name'], 'label' => $item['title']];
        }, _get('db')
            ->select('*')
            ->from(':core_package')
            ->order('name', 1)
            ->all());
    }

    protected function initialize()
    {
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
            'factory'    => 'multi_checkbox',
            'name'       => 'cmds',
            'attributes' =>
                [
                    'size'  => 3,
                    'class' => 'form-control',
                ],
            'value'      => 'core',
            'options'    => [
                ['value' => 'form_add', 'label' => 'Form Creation'],
                ['value' => 'form_edit', 'label' => 'Form Editing'],
                ['value' => 'model', 'label' => 'Model Table'],
                ['value' => 'model_config', 'label' => 'Model Config'],
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