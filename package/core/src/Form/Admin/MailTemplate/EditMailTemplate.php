<?php
namespace Neutron\Core\Form\Admin\MailTemplate;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditMailTemplate extends Form{

    public function initialize(){

        $this->setTitle(_text('Edit Mail Template','admin.core_mail'));
        $this->setInfo(_text('[Edit Mail Template Info]','admin.core_mail'));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `id` #identity
        
        // element `language_id`
        $this->addElement(array (
            'name' => 'language_id',
            'factory' => 'select',
            'label' => _text('Language Id','admin.core_mail'),
            'note' => _text('[Language Id Note]', 'admin.core_mail'),
            'options' => _service('core.i18n')->getLocaleIdOptions(),
            'attributes' =>
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
            'required' => true,
        ));
        
        // element `code`
        $this->addElement(array (
          'name' => 'code',
          'factory' => 'text',
          'label' => _text('Code','admin.core_mail'),
          'note' => _text('[Code Note]', 'admin.core_mail'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `package_id`
        $this->addElement(array (
          'name' => 'package_id',
          'factory' => 'select',
          'label' => _text('Package Id','admin.core_mail'),
          'note' => _text('[Package Id Note]', 'admin.core_mail'),
          'options' => _service('core.packages')->getPackageIdOptions(),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `vars`
        $this->addElement(array (
          'name' => 'vars',
          'factory' => 'textarea',
          'label' => _text('Vars','admin.core_mail'),
          'note' => _text('[Vars Note]', 'admin.core_mail'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
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
