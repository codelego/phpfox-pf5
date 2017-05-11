<?php
namespace Neutron\Core\Form\Admin\CorePackage;

use Phpfox\Form\Form;

class AddCorePackage extends Form{

    public function initialize(){

        $this->setTitle(_text('Add Core Package',''));
        $this->setInfo(_text('[Add Core Package Info]',''));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `id` #identity
        
        // element `type_id`
        $this->addElement(array (
          'name' => 'type_id',
          'factory' => 'text',
          'label' => _text('Type Id',null),
          'note' => _text('[Type Id Note]', null),
          'value' => 'app',
          'maxlength' => 255,
          'required' => true,
        ));
        // skip element `is_required` #skips
        
        // element `is_active`
        $this->addElement(array (
          'name' => 'is_active',
          'factory' => 'yesno',
          'label' => _text('Is Active',null),
          'note' => _text('[Is Active Note]', null),
          'value' => '0',
          'required' => true,
        ));
        
        // element `theme_id`
        $this->addElement(array (
          'name' => 'theme_id',
          'factory' => 'text',
          'label' => _text('Theme Id',null),
          'note' => _text('[Theme Id Note]', null),
          'maxlength' => 255,
          'required' => false,
        ));
        
        // element `priority`
        $this->addElement(array (
          'name' => 'priority',
          'factory' => 'text',
          'label' => _text('Priority',null),
          'note' => _text('[Priority Note]', null),
          'value' => '1',
          'maxlength' => 255,
          'required' => false,
        ));
        
        // element `title`
        $this->addElement(array (
          'name' => 'title',
          'factory' => 'text',
          'label' => _text('Title',null),
          'note' => _text('[Title Note]', null),
          'maxlength' => 255,
          'required' => false,
        ));
        
        // element `version`
        $this->addElement(array (
          'name' => 'version',
          'factory' => 'text',
          'label' => _text('Version',null),
          'note' => _text('[Version Note]', null),
          'value' => '4.0.1',
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `latest_version`
        $this->addElement(array (
          'name' => 'latest_version',
          'factory' => 'text',
          'label' => _text('Latest Version',null),
          'note' => _text('[Latest Version Note]', null),
          'maxlength' => 255,
          'required' => false,
        ));
        
        // element `author`
        $this->addElement(array (
          'name' => 'author',
          'factory' => 'text',
          'label' => _text('Author',null),
          'note' => _text('[Author Note]', null),
          'value' => 'n/a',
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'textarea',
          'label' => _text('Description',null),
          'note' => _text('[Description Note]', null),
          'maxlength' => 255,
          'required' => false,
        ));
        
        // element `apps_icon`
        $this->addElement(array (
          'name' => 'apps_icon',
          'factory' => 'text',
          'label' => _text('Apps Icon',null),
          'note' => _text('[Apps Icon Note]', null),
          'maxlength' => 255,
          'required' => false,
        ));
        
        // element `name`
        $this->addElement(array (
          'name' => 'name',
          'factory' => 'text',
          'label' => _text('Name',null),
          'note' => _text('[Name Note]', null),
          'maxlength' => 255,
          'required' => false,
        ));
        
        // element `path`
        $this->addElement(array (
          'name' => 'path',
          'factory' => 'text',
          'label' => _text('Path',null),
          'note' => _text('[Path Note]', null),
          'maxlength' => 255,
          'required' => false,
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
