<?php
namespace Neutron\Marketplace\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditMarketplacePermissions extends Form {

    /** id=810 */
    public function initialize(){

        $this->setTitle(_text('Edit Permissions','_marketplace'));
        $this->setInfo(_text('[Edit Permissions Info]','_marketplace'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `marketplace__add_listing` id=3434 **/
            $this->addElement(array ( 'name' => 'marketplace__add_listing', 'factory' => 'yesno', 'label' => _text('Can Add Listing','_marketplace'), 'placeholder' => _text('Can Add Listing','_marketplace'), 'info' => _text('Can Add Listing [Info]', '_marketplace'), 'required' => true, ));        
        
            /** element `marketplace__edit_listing` id=3435 **/
            $this->addElement(array ( 'name' => 'marketplace__edit_listing', 'factory' => 'yesno', 'label' => _text('Can Edit Listing','_marketplace'), 'placeholder' => _text('Can Edit Listing','_marketplace'), 'info' => _text('Can Edit Listing [Info]', '_marketplace'), 'required' => true, ));        
        
            /** element `marketplace__delete_listing` id=3436 **/
            $this->addElement(array ( 'name' => 'marketplace__delete_listing', 'factory' => 'yesno', 'label' => _text('Can Delete Listing','_marketplace'), 'placeholder' => _text('Can Delete Listing','_marketplace'), 'info' => _text('Can Delete Listing [Info]', '_marketplace'), 'required' => true, ));        
        
            /** element `marketplace__limit_listing` id=3437 **/
            $this->addElement(array ( 'name' => 'marketplace__limit_listing', 'factory' => 'text', 'label' => _text('Limit Listing','_marketplace'), 'placeholder' => _text('Limit Listing','_marketplace'), 'info' => _text('Limit Listing [Info]', '_marketplace'), 'value' => '0', 'required' => true, ));        
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
