<?php
namespace Neutron\Marketplace\Form\Admin\MarketplaceCategory;

use Phpfox\Form\Form;

class AddMarketplaceCategory extends Form {

    /** id=81 */
    public function initialize(){

        $this->setTitle(_text('Add Marketplace Category',''));
        $this->setInfo(_text('Add Marketplace Category [Form Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `is_active` id=3399 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active',null), 'placeholder' => _text('Is Active',null), 'info' => _text('Is Active [Info]', null), 'value' => '1', 'required' => true, ));        
        
            /** element `name` id=3400 **/
            $this->addElement(array ( 'name' => 'name', 'factory' => 'text', 'label' => _text('Name',null), 'placeholder' => _text('Name',null), 'info' => _text('Name [Info]', null), 'required' => true, ));        
        
            /** element `description` id=3401 **/
            $this->addElement(array ( 'name' => 'description', 'factory' => 'textarea', 'label' => _text('Description',null), 'placeholder' => _text('Description',null), 'info' => _text('Description [Info]', null), ));        
        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Submit'),
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
