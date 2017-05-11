<?php
namespace Neutron\Core\Form\Admin\I18nMessage;

use Phpfox\Form\Form;

class FilterI18nMessage extends Form{

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

                // skip element `message_id` #identity
        
        // element `package_id`
        $this->addElement(array (
          'name' => 'package_id',
          'factory' => 'select',
          'label' => _text('Package',null),
          'options' => _service('core.packages')->getPackageIdOptions(),
          'maxlength' => 255,
        ));
        
        // element `locale_id`
        $this->addElement(array (
          'name' => 'locale_id',
          'factory' => 'select',
          'label' => _text('Locale',null),
          'options' => _service('core.i18n')->getLocaleIdOptions(),
          'maxlength' => 255,
        ));
        
        // element `domain_id`
        $this->addElement(array (
          'name' => 'domain_id',
          'factory' => 'text',
          'label' => _text('Domain',null),
          'maxlength' => 255,
        ));
        
        // element `message_name`
        $this->addElement(array (
          'name' => 'message_name',
          'factory' => 'text',
          'label' => _text('Message Name',null),
          'maxlength' => 255,
        ));
        
        // element `message_value`
        $this->addElement(array (
          'name' => 'message_value',
          'factory' => 'text',
          'label' => _text('Message Value',null),
          'maxlength' => 255,
        ));
        // skip element `is_json` #skips
        // skip element `is_updated` #skips

        $this->addButton([
            'name'       => 'search',
            'factory'=>'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);

        /** end elements **/
    }
}
