<?php
namespace Neutron\Blog\Form\Admin\BlogPost;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddBlogPost extends Form{

    public function initialize(){

        $this->setTitle(_text('Add Blog Post','admin.core_layout'));
        $this->setInfo(_text('[Add Blog Post Info]','admin.core_layout'));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `blog_id` #identity
        
        // element `title`
        $this->addElement(array (
          'name' => 'title',
          'factory' => 'text',
          'label' => _text('Title','admin.core_layout'),
          'note' => _text('[Title Note]', 'admin.core_layout'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `content`
        $this->addElement(array (
          'name' => 'content',
          'factory' => 'textarea',
          'label' => _text('Content','admin.core_layout'),
          'note' => _text('[Content Note]', 'admin.core_layout'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        // skip element `parent_type` #skips
        
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
          'required' => true,
        ));
        // skip element `parent_id` #skips
        
        // element `category_id`
        $this->addElement(array (
          'name' => 'category_id',
          'factory' => 'text',
          'label' => _text('Category Id','admin.core_layout'),
          'note' => _text('[Category Id Note]', 'admin.core_layout'),
          'value' => '0',
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        // skip element `created_at` #skips
        // skip element `updated_at` #skips
        // skip element `poster_type` #skips
        // skip element `poster_id` #skips
        
        // element `publish_at`
        $this->addElement(array (
          'name' => 'publish_at',
          'factory' => 'text',
          'label' => _text('Publish At','admin.core_layout'),
          'note' => _text('[Publish At Note]', 'admin.core_layout'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        // skip element `view_count` #skips
        // skip element `comment_count` #skips
        
        // element `privacy_id`
        $this->addElement(array (
          'name' => 'privacy_id',
          'factory' => 'text',
          'label' => _text('Privacy Id','admin.core_layout'),
          'note' => _text('[Privacy Id Note]', 'admin.core_layout'),
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
          'label' => _text('Status Id','admin.core_layout'),
          'note' => _text('[Status Id Note]', 'admin.core_layout'),
          'value' => '0',
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `is_approved`
        $this->addElement(array (
          'name' => 'is_approved',
          'factory' => 'yesno',
          'label' => _text('Is Approved','admin.core_layout'),
          'note' => _text('[Is Approved Note]', 'admin.core_layout'),
          'value' => '0',
          'required' => true,
        ));
        
        // element `is_featured`
        $this->addElement(array (
          'name' => 'is_featured',
          'factory' => 'yesno',
          'label' => _text('Is Featured','admin.core_layout'),
          'note' => _text('[Is Featured Note]', 'admin.core_layout'),
          'value' => '0',
          'required' => true,
        ));
        // skip element `user_id` #skips

        /** end elements **/
    }


    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Submit'),
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
