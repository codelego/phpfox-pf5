<?php
namespace Neutron\Core\Form\Admin\CorePackage;

use Phpfox\Form\Form;

class FilterCorePackage extends Form{

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

                // skip element `id` #identity
        
        // element `type_id`
        $this->addElement(array (
          'name' => 'type_id',
          'factory' => 'text',
          'label' => _text('Type',null),
          'maxlength' => 255,
        ));
        // skip element `is_required` #skips
        
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
        
        // element `theme_id`
        $this->addElement(array (
          'name' => 'theme_id',
          'factory' => 'text',
          'label' => _text('Theme',null),
          'maxlength' => 255,
        ));
        
        // element `priority`
        $this->addElement(array (
          'name' => 'priority',
          'factory' => 'text',
          'label' => _text('Priority',null),
          'maxlength' => 255,
        ));
        
        // element `title`
        $this->addElement(array (
          'name' => 'title',
          'factory' => 'text',
          'label' => _text('Title',null),
          'maxlength' => 255,
        ));
        
        // element `version`
        $this->addElement(array (
          'name' => 'version',
          'factory' => 'text',
          'label' => _text('Version',null),
          'maxlength' => 255,
        ));
        
        // element `latest_version`
        $this->addElement(array (
          'name' => 'latest_version',
          'factory' => 'text',
          'label' => _text('Latest Version',null),
          'maxlength' => 255,
        ));
        
        // element `author`
        $this->addElement(array (
          'name' => 'author',
          'factory' => 'text',
          'label' => _text('Author',null),
          'maxlength' => 255,
        ));
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'text',
          'label' => _text('Description',null),
          'maxlength' => 255,
        ));
        
        // element `apps_icon`
        $this->addElement(array (
          'name' => 'apps_icon',
          'factory' => 'text',
          'label' => _text('Apps Icon',null),
          'maxlength' => 255,
        ));
        
        // element `name`
        $this->addElement(array (
          'name' => 'name',
          'factory' => 'text',
          'label' => _text('Name',null),
          'maxlength' => 255,
        ));
        
        // element `path`
        $this->addElement(array (
          'name' => 'path',
          'factory' => 'text',
          'label' => _text('Path',null),
          'maxlength' => 255,
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
