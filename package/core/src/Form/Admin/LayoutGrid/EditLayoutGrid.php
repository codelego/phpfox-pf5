<?php
namespace Neutron\Core\Form\Admin\LayoutGrid;

use Phpfox\Form\Form;

class EditLayoutGrid extends Form{

    public function initialize(){

        $this->setTitle(_text('Edit Layout Grid',''));
        $this->setInfo(_text('[Edit Layout Grid Info]',''));
        $this->setAction(_url('#'));
        
        /** start elements **/

        
        // element `grid_id`
        $this->addElement(array (
          'name' => 'grid_id',
          'factory' => 'text',
          'label' => _text('Grid Id',null),
          'note' => _text('[Grid Id Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `title`
        $this->addElement(array (
          'name' => 'title',
          'factory' => 'text',
          'label' => _text('Title',null),
          'note' => _text('[Title Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `sort_order`
        $this->addElement(array (
          'name' => 'sort_order',
          'factory' => 'text',
          'label' => _text('Sort Order',null),
          'note' => _text('[Sort Order Note]', null),
          'value' => '1',
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'textarea',
          'label' => _text('Description',null),
          'note' => _text('[Description Note]', null),
          'maxlength' => 255,
          'required' => false,
        ));
        
        // element `locations`
        $this->addElement(array (
          'name' => 'locations',
          'factory' => 'textarea',
          'label' => _text('Locations',null),
          'note' => _text('[Locations Note]', null),
          'maxlength' => 255,
          'required' => false,
        ));

        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);

         $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}
