<?php
namespace Neutron\Core\Form\Admin\I18nLocale;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class FilterI18nLocale extends Form{

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

                
        // element `locale_id`
        $this->addElement(array (
          'name' => 'locale_id',
          'factory' => 'select',
          'label' => _text('Locale',null),
          'options' => _service('core.locale')->getLocaleIdOptions(),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
        // element `name`
        $this->addElement(array (
          'name' => 'name',
          'factory' => 'text',
          'label' => _text('Name',null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
        // element `native_name`
        $this->addElement(array (
          'name' => 'native_name',
          'factory' => 'text',
          'label' => _text('Native Name',null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
        // element `code_6391`
        $this->addElement(array (
          'name' => 'code_6391',
          'factory' => 'text',
          'label' => _text('Code 6391',null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
        // element `direction_id`
        $this->addElement(array (
          'name' => 'direction_id',
          'factory' => 'select',
          'label' => _text('Direction',null),
          'options' => _service('core.locale')->getDirectionIdOptions(),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
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
          'attributes' => 
          array (
            'class' => 'form-control',
          ),
        ));

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
