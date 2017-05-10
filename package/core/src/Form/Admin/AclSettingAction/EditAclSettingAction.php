<?php
namespace Neutron\Core\Form\Admin\AclSettingAction;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditAclSettingAction extends Form{

    public function initialize(){

        $this->setTitle(_text('Edit Acl Setting Action',''));
        $this->setInfo(_text('[Edit Acl Setting Action Info]',''));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `action_id` #identity
        
        // element `package_id`
        $this->addElement(array (
          'name' => 'package_id',
          'factory' => 'select',
          'label' => _text('Package Id',null),
          'note' => _text('[Package Id Note]', null),
          'value' => 'core',
          'options' => _service('core.packages')->getPackageIdOptions(),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `group_id`
        $this->addElement(array (
          'name' => 'group_id',
          'factory' => 'text',
          'label' => _text('Group Id',null),
          'note' => _text('[Group Id Note]', null),
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
        
        // element `value_actual`
        $this->addElement(array (
          'name' => 'value_actual',
          'factory' => 'text',
          'label' => _text('Value Actual',null),
          'note' => _text('[Value Actual Note]', null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => false,
        ));
        
        // element `sort_order`
        $this->addElement(array (
          'name' => 'sort_order',
          'factory' => 'text',
          'label' => _text('Sort Order',null),
          'note' => _text('[Sort Order Note]', null),
          'value' => '0',
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `type_id`
        $this->addElement(array (
          'name' => 'type_id',
          'factory' => 'text',
          'label' => _text('Type Id',null),
          'note' => _text('[Type Id Note]', null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => false,
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
