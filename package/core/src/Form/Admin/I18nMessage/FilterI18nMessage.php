<?php
namespace Neutron\Core\Form\Admin\I18nMessage;

use Phpfox\Form\ButtonField;
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
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
        // element `locale_id`
        $this->addElement(array (
            'name' => 'locale_id',
            'factory' => 'select',
            'label' => _text('Locale',null),
            'options' => _service('core.language')->getLocaleIdOptions(),
            'attributes' =>
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
        // element `domain_id`
        $this->addElement(array (
          'name' => 'domain_id',
          'factory' => 'text',
          'label' => _text('Domain',null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
        // element `message_name`
        $this->addElement(array (
          'name' => 'message_name',
          'factory' => 'text',
          'label' => _text('Message Name',null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
        // element `message_value`
        $this->addElement(array (
          'name' => 'message_value',
          'factory' => 'text',
          'label' => _text('Message Value',null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        // skip element `is_json` #skips
        // skip element `is_updated` #skips

        /** end elements **/
    }

    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'name'       => 'search',
                'label'      => _text('Search'),
                'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
            ])
        ];
        /** end buttons **/
    }
}
