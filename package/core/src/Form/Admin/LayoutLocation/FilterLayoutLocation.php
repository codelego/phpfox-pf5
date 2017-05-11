<?php
namespace Neutron\Core\Form\Admin\LayoutLocation;

use Phpfox\Form\Form;

class FilterLayoutLocation extends Form{

    public function initialize(){

        $this->setMethod('get');

        $this->addElement([
            'factory'    => 'text',
            'name'       => 'q',
            'label' => _text('Search', 'admin'),
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => _text('Search', 'admin'),
            ],
        ]);
        
        /** start elements **/

                
        // element `container_id`
        $this->addElement(array (
          'name' => 'container_id',
          'factory' => 'text',
          'label' => _text('Container',null),
          'maxlength' => 255,
        ));
        
        // element `location_id`
        $this->addElement(array (
          'name' => 'location_id',
          'factory' => 'text',
          'label' => _text('Location',null),
          'maxlength' => 255,
        ));
        // skip element `params` #skips

        $this->addButton([
            'name'       => 'search',
            'factory'=>'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);

        /** end elements **/
    }
}
