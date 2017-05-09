<?php
namespace Neutron\Blog\Form\Admin\BlogCategory;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditBlogCategory extends Form{

    public function initialize(){

        $this->setTitle(_text('Edit Blog Category','admin.core_layout'));
        $this->setInfo(_text('[Edit Blog Category Info]','admin.core_layout'));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `category_id` #identity
        
        // element `is_active`
        $this->addElement(array (
          'name' => 'is_active',
          'factory' => 'yesno',
          'label' => _text('Is Active','admin.core_layout'),
          'note' => _text('[Is Active Note]', 'admin.core_layout'),
          'value' => '1',
          'required' => true,
        ));
        
        // element `name`
        $this->addElement(array (
          'name' => 'name',
          'factory' => 'text',
          'label' => _text('Name','admin.core_layout'),
          'note' => _text('[Name Note]', 'admin.core_layout'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'textarea',
          'label' => _text('Description','admin.core_layout'),
          'note' => _text('[Description Note]', 'admin.core_layout'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => false,
        ));

        /** end elements **/
    }


    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
            new ButtonField([
                'type'       => 'button',
                'name'       => 'cancel',
                'href'       => '#',
                'data-cmd'   => 'form.cancel',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel'],
            ]),
        ];
        /** end buttons **/
    }
}
