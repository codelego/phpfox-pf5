<?php
namespace Neutron\Core\Form\Admin\LayoutTheme;

use Phpfox\Form\Form;

class EditLayoutTheme extends Form{

    public function initialize(){

        $this->setTitle(_text('Edit Layout Theme',''));
        $this->setInfo(_text('[Edit Layout Theme Info]',''));
        $this->setAction(_url('#'));
        
        /** start elements **/

        
        // element `theme_id`
        $this->addElement(array (
          'name' => 'theme_id',
          'factory' => 'text',
          'label' => _text('Theme Id',null),
          'note' => _text('[Theme Id Note]', null),
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
        // skip element `parent_id` #skips
        // skip element `is_default` #skips
        
        // element `is_active`
        $this->addElement(array (
          'name' => 'is_active',
          'factory' => 'yesno',
          'label' => _text('Is Active',null),
          'note' => _text('[Is Active Note]', null),
          'value' => '0',
          'required' => true,
        ));
        
        // element `is_editing`
        $this->addElement(array (
          'name' => 'is_editing',
          'factory' => 'yesno',
          'label' => _text('Is Editing',null),
          'note' => _text('[Is Editing Note]', null),
          'value' => '0',
          'required' => true,
        ));
        
        // element `is_admin`
        $this->addElement(array (
          'name' => 'is_admin',
          'factory' => 'yesno',
          'label' => _text('Is Admin',null),
          'note' => _text('[Is Admin Note]', null),
          'value' => '0',
          'required' => true,
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
