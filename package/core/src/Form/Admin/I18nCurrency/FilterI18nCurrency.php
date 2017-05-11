<?php
namespace Neutron\Core\Form\Admin\I18nCurrency;

use Phpfox\Form\Form;

class FilterI18nCurrency extends Form{

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

                
        // element `currency_id`
        $this->addElement(array (
          'name' => 'currency_id',
          'factory' => 'text',
          'label' => _text('Currency',null),
          'maxlength' => 255,
        ));
        
        // element `symbol`
        $this->addElement(array (
          'name' => 'symbol',
          'factory' => 'text',
          'label' => _text('Symbol',null),
          'maxlength' => 255,
        ));
        
        // element `name`
        $this->addElement(array (
          'name' => 'name',
          'factory' => 'text',
          'label' => _text('Name',null),
          'maxlength' => 255,
        ));
        
        // element `sort_order`
        $this->addElement(array (
          'name' => 'sort_order',
          'factory' => 'text',
          'label' => _text('Sort Order',null),
          'maxlength' => 255,
        ));
        
        // element `is_active`
        $this->addElement(array (
          'name' => 'is_active',
          'factory' => 'select',
          'label' => _text('Is Active',null),
          'options' => 
          array (
            0 => 
            array (
              'value' => 1,
              'label' => 'Yes',
            ),
            1 => 
            array (
              'value' => 0,
              'label' => 'No',
            ),
          ),
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
