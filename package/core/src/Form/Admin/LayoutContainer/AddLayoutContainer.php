<?php

namespace Neutron\Core\Form\Admin\LayoutContainer;

use Phpfox\Form\Form;

class AddLayoutContainer extends Form
{

    /**
     * @var string
     */
    protected $pageId;


    public function initialize()
    {

        $this->setTitle(_text('Add Layout Container', '_core.layout'));
        $this->setInfo(_text('[Add Layout Container Info]', '_core.layout'));
        $this->setAction(_url('#'));

        /** start elements **/


        /** skip element `container_id` #identity **/

        /** element `page_id` **/
        $this->addElement([
            'name'    => 'page_id',
            'factory' => 'hidden',
            'value'   => $this->pageId,
        ]);

        $this->addElement([
            'name'    => 'is_active',
            'factory' => 'hidden',
            'value'   => 1,
        ]);

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

        /** element `ordering` **/
        $this->addElement([
            'name'      => 'ordering',
            'factory'   => 'text',
            'label'     => _text('Ordering', '_core.layout'),
            'value'     => 1,
            'maxlength' => 3,
            'required'  => true,
        ]);
        /** skip element `params` #skips **/
        /** end elements **/

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
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * @param string $pageId
     */
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;
    }
}
