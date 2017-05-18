<?php

namespace Neutron\Core\Form\Admin\LogDriver;


use Phpfox\Form\Form;

class EditFilesSettings extends Form
{

    protected function initialize()
    {
        $this->setTitle(_text('Edit Log Settings', '_core.logs'));
        $this->setInfo(_text('[Edit Site Settings Info]', '_core'));

        /** end elements */

        $this->addElement([
            'name'     => 'level',
            'factory'  => 'radio',
            'value'    => 'error',
            'label'    => _text('Log Level', '_core'),
            'info'     => _text('[Log Level Info]', '_core.logs'),
            'options'  => _get('core.log')->getLogLevelOptions(),
            'required' => true,
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Submit'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => _url('admin.core.log'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }

    protected function afterGetData(&$data)
    {
        $data['title'] = 'Files Logger';
    }
}