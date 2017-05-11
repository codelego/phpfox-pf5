<?php

namespace Neutron\Core\Form\Admin\Settings;


use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class CoreMailSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Mail Settings', 'core_mail'));
        $this->setInfo(_text('[Mail Settings Note]', 'admin'));

        $this->addElement([
            'name'       => 'core__default_mailer_id',
            'factory'    => 'select',
            'label'      => _text('Default Adapter', 'core_mail'),
            'info'       => _text('[Default Adapter Info]', 'core_mail'),
            'attributes' => ['class' => 'form-control'],
            'options'    => _service('core.mails')->getDriverIdOptions(),
            'required'   => true,
        ]);

        $this->addElement([
            'name'       => 'core_mail__queue_enable',
            'factory'    => 'radio',
            'label'      => _text('Use Queue', 'core_mail'),
            'info'       => _text('[Use Queue Info]', 'core_mail'),
            'attributes' => ['class' => 'form-control'],
            'options'    => [
                ['value' => 1, 'label' => 'Yes, Use queue to improve site performance.',],
                ['value' => 0, 'label' => 'No, send mail immediately',],
            ],
            'value'      => 0,
            'required'   => true,
        ]);

        $this->addElement([
            'name'       => 'core_mail__queue_limit',
            'factory'    => 'select',
            'label'      => _text('Queue Limit', 'core_mail'),
            'info'       => _text('[Queue Limit Info]', 'core_mail'),
            'attributes' => ['class' => 'form-control'],
            'options'    => [
                ['value' => 10, 'label' => '10 items'],
                ['value' => 20, 'label' => '20 items'],
                ['value' => 50, 'label' => '50 items'],
                ['value' => 100, 'label' => '100 items'],
                ['value' => 200, 'label' => '200 items'],
                ['value' => 500, 'label' => '500 items'],
                ['value' => 1000, 'label' => '1,000 items'],
            ],
            'value'      => 20,
            'required'   => true,
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}