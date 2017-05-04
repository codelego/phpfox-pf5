<?php

namespace Neutron\Core\Form;

use Phpfox\Form\Button;
use Phpfox\Form\Form;

class AddLayoutBlock extends Form
{
    public function initialize()
    {
        $this->addElement([
            'factory'    => 'radio',
            'name'       => 'component_id',
            'attributes' => ['class' => 'form-control',],
            'label'      => _text('Component'),
            'required'   => true,
            'options'    => \Phpfox::get('layout_loader')->getComponentIdOptions(),
        ]);
    }

    public function getButtons()
    {
        return [
            new Button([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
        ];
    }

    /**
     * @return string
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * @param string $locationId
     */
    public function setLocationId($locationId)
    {
        $this->locationId = $locationId;
    }

    /**
     * @return string
     */
    public function getComponentId()
    {
        return $this->componentId;
    }

    /**
     * @param string $componentId
     */
    public function setComponentId($componentId)
    {
        $this->componentId = $componentId;
    }
}
