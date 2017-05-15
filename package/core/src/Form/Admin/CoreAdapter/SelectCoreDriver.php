<?php

namespace Neutron\Core\Form\Admin\CoreAdapter;

use Phpfox\Form\Form;

class SelectCoreDriver extends Form
{

    protected $driverType;

    /**
     * @return mixed
     */
    public function getDriverType()
    {
        return $this->driverType;
    }

    /**
     * @param mixed $driverType
     */
    public function setDriverType($driverType)
    {
        $this->driverType = $driverType;
    }

    public function initialize()
    {

        $this->setTitle(_text('Select Driver', 'admin'));
        $this->setInfo(_text('[Select Driver Info]', 'admin'));
        $this->setAction(_url('#'));

        /** start elements **/

        /** @var array $options */
        $options = _get('core.adapter')->getDriverIdOptions($this->getDriverType());

        if (!empty($options)) {
            $defaultValue = $options[0]['value'];
        }

        /** element `driver_id` **/
        $this->addElement([
            'name'     => 'driver_id',
            'factory'  => 'radio',
            'options'  => $options,
            'label'    => _text('Driver Id', 'admin.core_cache'),
            'info'     => _text('[Driver Id Info]', 'admin.core_cache'),
            'required' => true,
            'value'    => $defaultValue,
        ]);
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
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
