<?php

namespace Neutron\Core\Form\Admin\LayoutLocation;

use Phpfox\Form\Form;

class AddLayoutLocation extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Add Layout Location', ''));
        $this->setInfo(_text('[Add Layout Location Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `container_id` **/
        $this->addElement([
            'name'      => 'container_id',
            'factory'   => 'text',
            'label'     => _text('Container Id', null),
            'note'      => _text('[Container Id Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `location_id` **/
        $this->addElement([
            'name'      => 'location_id',
            'factory'   => 'text',
            'label'     => _text('Location Id', null),
            'note'      => _text('[Location Id Note]', null),
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
