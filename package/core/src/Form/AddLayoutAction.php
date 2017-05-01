<?php
namespace Neutron\Core\Form;

use Phpfox\Form\Form;

class AddLayoutAction extends Form{
    public function initialize(){
    $this->addElement(array (
  'factory' => 'text',
  'name' => 'action_id',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
  'label' => _text('Action Id'),
  'required' => true,
));
        $this->addElement(array (
  'factory' => 'text',
  'name' => 'parent_action_id',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
  'label' => _text('Parent Action Id'),
  'required' => false,
));
        $this->addElement(array (
  'factory' => 'text',
  'name' => 'action_name',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_TITLE_LENGTH,
    'class' => 'form-control',
  ),
  'label' => _text('Action Name'),
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
  'factory' => 'textarea',
  'name' => 'description',
  'attributes' => 
  array (
    'maxlength' => PHPFOX_DESC_LENGTH,
    'class' => 'form-control',
    'rows' => PHPFOX_DESC_ROWS,
  ),
  'label' => _text('Description'),
  'required' => true,
));
    }
}
