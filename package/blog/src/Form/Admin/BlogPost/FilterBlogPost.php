<?php
namespace Neutron\Blog\Form\Admin\BlogPost;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class FilterBlogPost extends Form{

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

                // skip element `blog_id` #identity
        
        // element `title`
        $this->addElement(array (
          'name' => 'title',
          'factory' => 'text',
          'label' => _text('Title','admin.core_layout'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
        // element `content`
        $this->addElement(array (
          'name' => 'content',
          'factory' => 'text',
          'label' => _text('Content','admin.core_layout'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        // skip element `parent_type` #skips
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'text',
          'label' => _text('Description','admin.core_layout'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        // skip element `parent_id` #skips
        
        // element `category_id`
        $this->addElement(array (
          'name' => 'category_id',
          'factory' => 'text',
          'label' => _text('Category','admin.core_layout'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
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
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        // skip element `view_count` #skips
        // skip element `comment_count` #skips
        
        // element `privacy_id`
        $this->addElement(array (
          'name' => 'privacy_id',
          'factory' => 'text',
          'label' => _text('Privacy','admin.core_layout'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
        // element `status_id`
        $this->addElement(array (
          'name' => 'status_id',
          'factory' => 'text',
          'label' => _text('Status','admin.core_layout'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
        // element `is_approved`
        $this->addElement(array (
          'name' => 'is_approved',
          'factory' => 'select',
          'label' => _text('Is Approved','admin.core_layout'),
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
          'attributes' => 
          array (
            'class' => 'form-control',
          ),
        ));
        
        // element `is_featured`
        $this->addElement(array (
          'name' => 'is_featured',
          'factory' => 'select',
          'label' => _text('Is Featured','admin.core_layout'),
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
          'attributes' => 
          array (
            'class' => 'form-control',
          ),
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
                'name'       => 'search',
                'label'      => _text('Search'),
                'attributes' => ['class' => 'btn btn-primary'],
            ])
        ];
        /** end buttons **/
    }
}
