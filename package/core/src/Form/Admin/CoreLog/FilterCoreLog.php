<?php
namespace Neutron\Core\Form\Admin\CoreLog;

use Phpfox\Form\Form;

class FilterCoreLog extends Form{

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

                // skip element `id` #identity
        
        // element `ip`
        $this->addElement(array (
          'name' => 'ip',
          'factory' => 'text',
          'label' => _text('Ip',null),
          'maxlength' => 255,
        ));
        
        // element `updated`
        $this->addElement(array (
          'name' => 'updated',
          'factory' => 'text',
          'label' => _text('Updated',null),
          'maxlength' => 255,
        ));
        
        // element `level`
        $this->addElement(array (
          'name' => 'level',
          'factory' => 'text',
          'label' => _text('Level',null),
          'maxlength' => 255,
        ));
        
        // element `message`
        $this->addElement(array (
          'name' => 'message',
          'factory' => 'text',
          'label' => _text('Message',null),
          'maxlength' => 255,
        ));
        
        // element `created`
        $this->addElement(array (
          'name' => 'created',
          'factory' => 'text',
          'label' => _text('Created',null),
          'maxlength' => 255,
        ));

        $this->addButton([
            'name'       => 'search',
            'factory'=>'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);

        /** end elements **/
    }
}
