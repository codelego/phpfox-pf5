<?php
namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditCacheSettings extends Form {

    /** id=664 */
    public function initialize(){

        $this->setTitle(_text('Edit Cache Settings', '_core.cache_settings'));
        $this->setInfo(_text('[Edit Site Settings Info]', '_core'));
        $this->setMethod('post');                 $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `core__shared_cache_cache_id` id=2173 **/
            $this->addElement(array ( 'name' => 'core__shared_cache_cache_id', 'factory' => 'select', 'label' => _text('Default Cache','_core.cache_settings'), 'info' => _text('[Default Cache Id Info]', '_core.cache_settings'), 'options' => _get('core.adapter')->getAdapterIdOptions('cache'), 'required' => true, ));        
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
            'href'       => _url('#'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}
