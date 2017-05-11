<?php
namespace Neutron\Core\Form\Admin\MailTemplate;

use Phpfox\Form\Form;

class FilterMailTemplate extends Form{

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
        
        // element `language_id`
        $this->addElement(array (
          'name' => 'language_id',
          'factory' => 'text',
          'label' => _text('Language',null),
          'maxlength' => 255,
        ));
        
        // element `code`
        $this->addElement(array (
          'name' => 'code',
          'factory' => 'text',
          'label' => _text('Code',null),
          'maxlength' => 255,
        ));
        
        // element `package_id`
        $this->addElement(array (
          'name' => 'package_id',
          'factory' => 'select',
          'label' => _text('Package',null),
          'options' => _service('core.packages')->getPackageIdOptions(),
          'maxlength' => 255,
        ));
        
        // element `vars`
        $this->addElement(array (
          'name' => 'vars',
          'factory' => 'text',
          'label' => _text('Vars',null),
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
