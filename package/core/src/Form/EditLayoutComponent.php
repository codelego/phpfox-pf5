<?php
namespace Neutron\Core\Form;

use Phpfox\Form\Form;

class EditLayoutComponent extends Form{
    public function initialize(){
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
  'name' => 'component_name',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
  'label' => _text('Component Name'),
  'required' => true,
));
        $this->addElement(array (
  'factory' => 'text',
  'name' => 'component_class',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
  'label' => _text('Component Class'),
  'required' => false,
));
        $this->addElement(array (
  'factory' => 'text',
  'name' => 'form_name',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
  'label' => _text('Form Name'),
  'required' => true,
));
        $this->addElement(array (
  'factory' => 'text',
  'name' => 'package_id',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
  'label' => _text('Package Id'),
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
  'factory' => 'text',
  'name' => 'sort_order',
  'label' => _text('Sort Order'),
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
  'name' => 'description',
  'label' => _text('Description'),
  'required' => false,
  'value' => 1,
  'attributes' => 
  array (
    'maxlength' => PHPFOX_DESC_LENGTH,
    'class' => 'form-control',
    'rows' => PHPFOX_DESC_ROWS,
  ),
));
    }
}
