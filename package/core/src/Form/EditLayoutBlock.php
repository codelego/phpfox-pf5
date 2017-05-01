<?php
namespace Neutron\Core\Form;

use Phpfox\Form\Form;

class EditLayoutBlock extends Form{
    public function initialize(){
    $this->addElement(array (
  'factory' => 'text',
  'name' => 'container_id',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
  'label' => _text('Container Id'),
  'required' => true,
));
        $this->addElement(array (
  'factory' => 'text',
  'name' => 'location_id',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
  'label' => _text('Location Id'),
  'required' => true,
));
        $this->addElement(array (
  'factory' => 'text',
  'name' => 'component_id',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
  'label' => _text('Component Id'),
  'required' => true,
));
        $this->addElement(array (
  'factory' => 'text',
  'name' => 'sort_order',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
  'label' => _text('Sort Order'),
  'required' => true,
));
        $this->addElement(array (
  'factory' => 'yesno',
  'name' => 'is_active',
  'label' => _text('Is Active'),
  'required' => true,
  'value' => 1,
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
));
        $this->addElement(array (
  'factory' => 'textarea',
  'name' => 'block_params',
  'label' => _text('Block Params'),
  'required' => true,
  'value' => 1,
  'attributes' => 
  array (
    'maxlength' => PHPFOX_DESC_LENGTH,
    'class' => 'form-control',
  ),
));
    }
}
