<?php

namespace Neutron\Core\Form\Admin\LayoutContainer;

use Phpfox\Form\Form;

class EditLayoutContainer extends Form
{

    /**
     * @var string
     */
    protected $pageId;

    public function initialize()
    {

        $this->setTitle(_text('Edit Container', '_core.layout'));
        $this->setInfo(_text('[Edit Container Info]', '_core.layout'));
        $this->setAction(_url('#'));

        /** start elements **/

        // skip element `container_id` #identity

        // element `page_id`
        $this->addElement([
            'name'    => 'page_id',
            'factory' => 'hidden',
            'value'   => $this->getPageId(),
        ]);

        // element `grid_id`
        /** element `grid_id` **/
        $this->addElement([
            'name'     => 'grid_id',
            'factory'  => 'select',
            'label'    => _text('Grid Id', '_core.layout'),
            'value'    => 'simple',
            'options'  => _get('layout_loader')->getGridIdOptions(),
            'required' => true,
        ]);

        /** element `type_id` **/
        $this->addElement([
            'name'     => 'type_id',
            'factory'  => 'radio',
            'label'    => _text('Container Type', '_core.layout'),
            'value'    => 'container',
            'required' => true,
            'options'  => _get('layout_loader')->getContainerTypeIdOptions(),
        ]);

        // element `is_active`
        $this->addElement([
            'name'     => 'is_active',
            'factory'  => 'yesno',
            'label'    => _text('Is Active', '_core.layout'),
            'info'     => _text('[Is Active Info]', '_core.layout'),
            'value'    => '0',
            'required' => true,
        ]);

        // element `ordering`
        $this->addElement([
            'name'      => 'ordering',
            'factory'   => 'text',
            'label'     => _text('Ordering', '_core.layout'),
            'info'      => _text('[Ordering Info]', '_core.layout'),
            'value'     => '1',
            'maxlength' => 255,
            'required'  => true,
        ]);
        // skip element `params` #skips

        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
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
     * @param string $pageId
     */
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;
    }

    /**
     * @return string
     */
    public function getPageId()
    {
        return $this->pageId;
    }
}
