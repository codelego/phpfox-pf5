<?php

namespace Neutron\Core\Form\Admin\LayoutContainer;

use Phpfox\Form\Form;

class AddLayoutContainer extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Add Layout Container', ''));
        $this->setInfo(_text('[Add Layout Container Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/


        /** skip element `container_id` #identity **/

        /** element `page_id` **/
        $this->addElement([
            'name'      => 'page_id',
            'factory'   => 'text',
            'label'     => _text('Page Id', null),
            'note'      => _text('[Page Id Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `grid_id` **/
        $this->addElement([
            'name'      => 'grid_id',
            'factory'   => 'text',
            'label'     => _text('Grid Id', null),
            'note'      => _text('[Grid Id Note]', null),
            'value'     => 'simple',
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `type_id` **/
        $this->addElement([
            'name'      => 'type_id',
            'factory'   => 'text',
            'label'     => _text('Type Id', null),
            'note'      => _text('[Type Id Note]', null),
            'value'     => 'container',
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `is_active` **/
        $this->addElement([
            'name'     => 'is_active',
            'factory'  => 'yesno',
            'label'    => _text('Is Active', null),
            'note'     => _text('[Is Active Note]', null),
            'value'    => '0',
            'required' => true,
        ]);

        /** element `sort_order` **/
        $this->addElement([
            'name'      => 'sort_order',
            'factory'   => 'text',
            'label'     => _text('Sort Order', null),
            'note'      => _text('[Sort Order Note]', null),
            'value'     => '1',
            'maxlength' => 255,
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
}
