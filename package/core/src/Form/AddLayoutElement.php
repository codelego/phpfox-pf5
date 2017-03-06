<?php
namespace Neutron\Core\Form;

use Phpfox\Form\Form;

class AddLayoutElement extends Form{
    public function initialize(){
    $this->addElement(array (
  'factory' => 'text',
  'name' => 'page_id',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
  'label' => _text('Page Id'),
  'required' => true,
));
        $this->addElement(array (
  'factory' => 'text',
  'name' => 'theme_id',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
  'label' => _text('Theme Id'),
  'required' => true,
));
        $this->addElement(array (
  'factory' => 'text',
  'name' => 'block_id',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
  'label' => _text('Block Id'),
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
  'factory' => 'text',
  'name' => 'params',
  'label' => _text('Params'),
  'required' => true,
  'value' => 1,
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
));
    }
}
