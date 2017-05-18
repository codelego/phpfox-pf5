<?php
namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditSmsSettings extends Form {

    /** id=672 */
    public function initialize(){

        $this->setTitle(_text('Edit Mobile Service Settings', '_core.mbs'));
        $this->setInfo(_text('[Edit Site Settings Info]', '_core'));
        $this->setMethod('post');                 $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `core__default_sms_id` id=2191 **/
            $this->addElement(array ( 'name' => 'core__default_sms_id', 'factory' => 'select', 'label' => _text('Default SMS Service','_core.mbs'), 'info' => _text('[Default SMS Id Info]', '_core.sms'), 'options' => _get('core.adapter')->getAdapterIdOptions('sms'), 'required' => true, ));        
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
            'href'       => _url('admin.core.sms'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}
