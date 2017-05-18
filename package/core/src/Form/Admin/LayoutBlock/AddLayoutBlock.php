<?php

namespace Neutron\Core\Form\Admin\LayoutBlock;

use Phpfox\Form\Form;

class AddLayoutBlock extends Form
{
    /**
     * @var int
     */
    protected $locationId;

    /**
     * @var int
     */
    protected $containerId;

    public function initialize()
    {

        $this->setTitle(_text('Add New Block', '_core.layout_block'));
        $this->setInfo(_text('[Add New Block Info]', '_core.layout_block'));
        $this->setAction(_url('#'));

        $this->addElement([
            'factory' => 'hidden',
            'name'    => 'container_id',
            'value'   => $this->containerId,
        ]);

        $this->addElement([
            'factory' => 'hidden',
            'name'    => 'location_id',
            'value'   => $this->locationId,
        ]);

        $this->addElement([
            'factory'  => 'radio',
            'name'     => 'component_id',
            'label'    => _text('Component'),
            'required' => true,
            'options'  => _get('core.layout')->getComponentIdOptions(),
        ]);

        /** elements */

        $this->addButton([
            'name'       => 'save',
            'label'      => _text('Submit'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);


        $this->addButton([
            'name'       => 'cancel',
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel'],
        ]);
    }


    /**
     * @return int
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * @param int $locationId
     */
    public function setLocationId($locationId)
    {
        $this->locationId = $locationId;
    }

    /**
     * @return int
     */
    public function getContainerId()
    {
        return $this->containerId;
    }

    /**
     * @param int $containerId
     */
    public function setContainerId($containerId)
    {
        $this->containerId = $containerId;
    }
}
