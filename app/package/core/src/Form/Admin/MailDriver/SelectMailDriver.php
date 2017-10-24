<?php

namespace Neutron\Core\Form\Admin\MailDriver;


use Neutron\Core\Form\Admin\CoreAdapter\SelectCoreDriver;

class SelectMailDriver extends SelectCoreDriver
{
    /**
     * @var string
     */
    protected $driverType = 'mail';

    /**
     * @var string
     */
    protected $cancelUrl = 'admin.core.mail';

    /**
     * @return string
     */
    public function getDriverType()
    {
        return $this->driverType;
    }

    /**
     * @param string $driverType
     */
    public function setDriverType($driverType)
    {
        $this->driverType = $driverType;
    }

    public function initialize()
    {

        $this->setTitle(_text('Select Mail Driver', '_core.mail'));
        $this->setAction(_url('#'));

        /** start elements **/

        /** @var array $options */
        $options = \Phpfox::get('core.adapter')->getDriverIdOptions($this->getDriverType());
        $defaultValue = null;

        foreach ($options as $option) {
            if (empty($option['disabled'])) {
                $defaultValue = $option['value'];
                break;
            }
        }

        /** element `driver_id` **/
        $this->addElement([
            'name'     => 'driver_id',
            'factory'  => 'radio',
            'options'  => $options,
            'label'    => _text('Select Mail Driver', '_core.mail'),
            'required' => true,
            'value'    => $defaultValue,
        ]);

        /** end elements **/

        if (!is_null($defaultValue)) {
            $this->addButton([
                'factory'    => 'button',
                'name'       => 'save',
                'label'      => _text('Continue'),
                'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
            ]);
            $this->addButton([
                'factory'    => 'button',
                'name'       => 'cancel',
                'href'       => _url($this->cancelUrl),
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
            ]);

        } else {
            $this->getElement('driver_id')->setParam('info', _text('[Oop! There are no available drivers]', '_core'));
            $this->addButton([
                'factory'    => 'button',
                'name'       => 'cancel',
                'href'       => _url($this->cancelUrl),
                'label'      => _text('Back'),
                'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'go.back',],
            ]);
        }


    }
}