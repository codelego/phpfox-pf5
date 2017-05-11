<?php

namespace Neutron\Core\Form\Admin\LogAdapter;

use Phpfox\Form\Form;

class SelectLogDriver extends Form
{

    /**
     * @var string
     */
    protected $containerId = 'main.log';

    public function initialize()
    {

        $this->setTitle(_text('Add Log Adapter', 'core.admin_log'));
        $this->setInfo(_text('[Add Log Adapter Info]', 'core.admin_log'));
        $this->setAction(_url('#'));
        $this->setMethod('get');

        /** start elements **/

        // skip element `adapter_id` #identity

        // element `container_id`
        $this->addElement([
            'name'     => 'container_id',
            'factory'  => 'hidden',
            'value'    => $this->getContainerId(),
            'required' => true,
        ]);

        // element `driver_id`
        $this->addElement([
            'name'       => 'driver_id',
            'factory'    => 'radio',
            'value'      => 'files',
            'label'      => _text('Driver Id', 'core.admin_log'),
            'note'       => _text('[Driver Id Note]', 'core.admin_log'),
            'options'    => _service('core.log')->getDriverIdOptions(),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);
        // skip element `params` #skips

        /** end elements **/
        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Continue'),
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

    /**
     * @return string
     */
    public function getContainerId()
    {
        return $this->containerId;
    }

    /**
     * @param string $containerId
     */
    public function setContainerId($containerId)
    {
        $this->containerId = $containerId;
    }
}
