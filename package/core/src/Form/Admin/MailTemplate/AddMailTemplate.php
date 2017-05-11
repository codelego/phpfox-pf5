<?php
namespace Neutron\Core\Form\Admin\MailTemplate;

use Phpfox\Form\Form;

class AddMailTemplate extends Form{

    public function initialize(){

        $this->setTitle(_text('Add Mail Template','admin.core_mail'));
        $this->setInfo(_text('[Add Mail Template Info]','admin.core_mail'));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `id` #identity
        
        // element `language_id`
        $this->addElement(array (
          'name' => 'language_id',
          'factory' => 'text',
          'label' => _text('Language Id',null),
          'note' => _text('[Language Id Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `code`
        $this->addElement(array (
          'name' => 'code',
          'factory' => 'text',
          'label' => _text('Code',null),
          'note' => _text('[Code Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `package_id`
        $this->addElement(array (
          'name' => 'package_id',
          'factory' => 'select',
          'label' => _text('Package Id',null),
          'note' => _text('[Package Id Note]', null),
          'options' => _service('core.packages')->getPackageIdOptions(),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `vars`
        $this->addElement(array (
          'name' => 'vars',
          'factory' => 'textarea',
          'label' => _text('Vars',null),
          'note' => _text('[Vars Note]', null),
          'maxlength' => 255,
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
