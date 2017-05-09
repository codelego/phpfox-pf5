<?php
namespace Neutron\User\Form\Admin\User;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditUser extends Form{

    public function initialize(){

        $this->setTitle(_text('Edit User',''));
        $this->setInfo(_text('[Edit User Info]',''));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `user_id` #skips
        
        // element `role_id`
        $this->addElement(array (
          'name' => 'role_id',
          'factory' => 'text',
          'label' => _text('Role',null),
          'note' => _text('[Role Note]', null),
          'value' => '0',
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `user_photo_id`
        $this->addElement(array (
          'name' => 'user_photo_id',
          'factory' => 'text',
          'label' => _text('User Photo',null),
          'note' => _text('[User Photo Note]', null),
          'value' => '0',
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `gender_id`
        $this->addElement(array (
          'name' => 'gender_id',
          'factory' => 'text',
          'label' => _text('Gender',null),
          'note' => _text('[Gender Note]', null),
          'value' => '0',
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `status_id`
        $this->addElement(array (
          'name' => 'status_id',
          'factory' => 'text',
          'label' => _text('Status',null),
          'note' => _text('[Status Note]', null),
          'value' => '0',
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `view_id`
        $this->addElement(array (
          'name' => 'view_id',
          'factory' => 'text',
          'label' => _text('View',null),
          'note' => _text('[View Note]', null),
          'value' => '0',
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `username`
        $this->addElement(array (
          'name' => 'username',
          'factory' => 'text',
          'label' => _text('Username',null),
          'note' => _text('[Username Note]', null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => false,
        ));
        
        // element `fullname`
        $this->addElement(array (
          'name' => 'fullname',
          'factory' => 'text',
          'label' => _text('Fullname',null),
          'note' => _text('[Fullname Note]', null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => false,
        ));
        
        // element `email`
        $this->addElement(array (
          'name' => 'email',
          'factory' => 'text',
          'label' => _text('Email',null),
          'note' => _text('[Email Note]', null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => false,
        ));
        
        // element `locale_id`
        $this->addElement(array (
          'name' => 'locale_id',
          'factory' => 'text',
          'label' => _text('Locale',null),
          'note' => _text('[Locale Note]', null),
          'value' => 'en_US',
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `timezone`
        $this->addElement(array (
          'name' => 'timezone',
          'factory' => 'text',
          'label' => _text('Timezone',null),
          'note' => _text('[Timezone Note]', null),
          'value' => 'GMT+7',
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        // skip element `created_at` #skips

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
