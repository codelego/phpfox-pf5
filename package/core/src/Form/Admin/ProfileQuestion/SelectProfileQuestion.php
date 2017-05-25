<?php

namespace Neutron\Core\Form\Admin\ProfileQuestion;


use Phpfox\Form\Form;

class SelectProfileQuestion extends Form
{
    /**
     * @var string
     */
    protected $itemType;

    /**
     * @var string
     */
    protected $processId;


    protected function initialize()
    {
        $this->setTitle(_text('Add Profile Question', ''));
        $this->setInfo(_text('[Add Profile Question Info]', ''));
        $this->setAction(_url('#'));

        $options = _get('core.profile')->getSuggestProfileAttributeOptions($this->itemType, $this->processId);


        $this->addElement([
            'name'    => 'attribute_id',
            'factory' => 'multi_checkbox',
            'label'   => 'Select',
            'require' => false,
            'options' => $options,
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
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }

    /**
     * @return string
     */
    public function getItemType()
    {
        return $this->itemType;
    }

    /**
     * @param string $itemType
     */
    public function setItemType($itemType)
    {
        $this->itemType = $itemType;
    }

    /**
     * @return string
     */
    public function getProcessId()
    {
        return $this->processId;
    }

    /**
     * @param string $processId
     */
    public function setProcessId($processId)
    {
        $this->processId = $processId;
    }
}