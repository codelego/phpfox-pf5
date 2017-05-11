<?php
namespace Neutron\Core\Form\Admin\I18nMessage;

use Phpfox\Form\Form;

class AddI18nMessage extends Form{

    public function initialize(){

        $this->setTitle(_text('Add Message','admin.i18n'));
        $this->setInfo(_text('[Add Message Info]','admin.i18n'));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `message_id` #identity
        
        // element `package_id`
        $this->addElement(array (
          'name' => 'package_id',
          'factory' => 'select',
          'label' => _text('Package Id',null),
          'note' => _text('[Package Id Note]', null),
          'value' => 'core',
          'options' => _service('core.packages')->getPackageIdOptions(),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `locale_id`
        $this->addElement(array (
          'name' => 'locale_id',
          'factory' => 'select',
          'label' => _text('Locale Id',null),
          'note' => _text('[Locale Id Note]', null),
          'options' => _service('core.i18n')->getLocaleIdOptions(),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `domain_id`
        $this->addElement(array (
          'name' => 'domain_id',
          'factory' => 'text',
          'label' => _text('Domain Id',null),
          'note' => _text('[Domain Id Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `message_name`
        $this->addElement(array (
          'name' => 'message_name',
          'factory' => 'text',
          'label' => _text('Message Name',null),
          'note' => _text('[Message Name Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `message_value`
        $this->addElement(array (
          'name' => 'message_value',
          'factory' => 'textarea',
          'label' => _text('Message Value',null),
          'note' => _text('[Message Value Note]', null),
          'maxlength' => 255,
          'required' => false,
        ));
        // skip element `is_json` #skips
        // skip element `is_updated` #skips

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
