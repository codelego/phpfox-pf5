<?php
namespace Neutron\Core\Form\Admin\I18nMessage;

use Phpfox\Form\Form;

class EditI18nMessage extends Form {

    public function initialize(){

        $this->setTitle(_text('Edit Message',''));
        $this->setInfo(_text('[Edit Message Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `message_id` **/
            $this->addElement(array ( 'name' => 'message_id', 'factory' => 'text', 'label' => _text('Message Id',null), 'info' => _text('[Message Id Info]', null), 'required' => '1', ));        
        
            /** element `package_id` **/
            $this->addElement(array ( 'name' => 'package_id', 'factory' => 'select', 'label' => _text('Package Id',null), 'info' => _text('[Package Id Info]', null), 'value' => 'core', 'options' => _get('core.packages')->getPackageIdOptions(), 'required' => '1', ));        
        
            /** element `locale_id` **/
            $this->addElement(array ( 'name' => 'locale_id', 'factory' => 'text', 'label' => _text('Locale Id',null), 'info' => _text('[Locale Id Info]', null), 'required' => '1', ));        
        
            /** element `domain_id` **/
            $this->addElement(array ( 'name' => 'domain_id', 'factory' => 'text', 'label' => _text('Domain Id',null), 'info' => _text('[Domain Id Info]', null), 'required' => '1', ));        
        
            /** element `message_name` **/
            $this->addElement(array ( 'name' => 'message_name', 'factory' => 'text', 'label' => _text('Message Name',null), 'info' => _text('[Message Name Info]', null), 'required' => '1', ));        
        
            /** element `message_value` **/
            $this->addElement(array ( 'name' => 'message_value', 'factory' => 'textarea', 'label' => _text('Message Value',null), 'info' => _text('[Message Value Info]', null), ));        
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
