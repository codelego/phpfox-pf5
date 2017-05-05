<?php

namespace Neutron\Core\Form;

use Phpfox\Form\Form;

class EditLayoutAction extends Form
{
    protected $actionId;

    public function initialize()
    {
        $this->addElement([
            'factory' => 'hidden',
            'name'    => 'action_id',
            'value'   => $this->actionId,
        ]);
        $this->addElement([
            'factory'    => 'select',
            'name'       => 'parent_action_id',
            'options'    => _service('layout_loader')->getActionIdOptions([$this->getActionId()]),
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Parent Action'),
            'required'   => false,
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'action_name',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Action Name'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'select',
            'name'       => 'package_id',
            'attributes' =>
                [
                    'class' => 'form-control',
                ],
            'options'    => _service('core.packages')->getPackageIdOptions(),
            'label'      => _text('Package'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'textarea',
            'name'       => 'description',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_DESC_LENGTH,
                    'class'     => 'form-control',
                    'rows'      => PHPFOX_DESC_ROWS,
                ],
            'label'      => _text('Description'),
            'required'   => true,
        ]);
    }

    /**
     * @return mixed
     */
    public function getActionId()
    {
        return $this->actionId;
    }

    /**
     * @param mixed $actionId
     */
    public function setActionId($actionId)
    {
        $this->actionId = $actionId;
    }
}
