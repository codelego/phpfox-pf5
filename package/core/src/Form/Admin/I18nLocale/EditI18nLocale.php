<?php
namespace Neutron\Core\Form\Admin\I18nLocale;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditI18nLocale extends Form{

    public function initialize(){

        $this->setTitle(_text('Edit Locale',''));
        $this->setInfo(_text('[Edit Locale Info]',''));
        $this->setAction(_url('#'));
        
        /** start elements **/

        
        // element `locale_id`
        $this->addElement(array (
          'name' => 'locale_id',
          'factory' => 'select',
          'label' => _text('Locale Id',null),
          'note' => _text('[Locale Id Note]', null),
          'options' => _service('core.locale')->getLocaleIdOptions(),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `name`
        $this->addElement(array (
          'name' => 'name',
          'factory' => 'text',
          'label' => _text('Name',null),
          'note' => _text('[Name Note]', null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `native_name`
        $this->addElement(array (
          'name' => 'native_name',
          'factory' => 'text',
          'label' => _text('Native Name',null),
          'note' => _text('[Native Name Note]', null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => false,
        ));
        
        // element `code_6391`
        $this->addElement(array (
          'name' => 'code_6391',
          'factory' => 'text',
          'label' => _text('Code 6391',null),
          'note' => _text('[Code 6391 Note]', null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `direction_id`
        $this->addElement(array (
          'name' => 'direction_id',
          'factory' => 'select',
          'label' => _text('Direction Id',null),
          'note' => _text('[Direction Id Note]', null),
          'value' => 'ltr',
          'options' => _service('core.locale')->getDirectionIdOptions(),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `is_active`
        $this->addElement(array (
          'name' => 'is_active',
          'factory' => 'yesno',
          'label' => _text('Is Active',null),
          'note' => _text('[Is Active Note]', null),
          'value' => '1',
          'required' => true,
        ));

        /** end elements **/
    }


    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
            ]),
            new ButtonField([
                'name'       => 'cancel',
                'href'       => '#',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
            ]),
        ];
        /** end buttons **/
    }
}
