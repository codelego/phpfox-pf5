<?php

namespace Neutron\Core\Form;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AdminRadFormGlobalSetting extends Form
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

    public function getGroupIdOptions()
    {
        return array_map(function ($item) {
            return ['value' => $item['group_id'], 'label' => $item['group_id']];
        }, _service('db')
            ->select('*')
            ->from(':site_setting_group')
            ->order('title', 1)
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
            'options'    => $this->getGroupIdOptions(),
            'label'      => _text('Select Group Settings'),
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
            'value'      => ['test_case'],
            'options'    => [
                ['value' => 'model', 'label' => 'Model Table Class'],
                ['value' => 'model_config', 'label' => 'Model Configuration'],
                ['value' => 'test_case', 'label' => 'Include Test Case'],
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