<?php
namespace Neutron\Core\Form\Admin\EditCoreAclSettings;

use Phpfox\Form\Form;

class EditCore extends Form {

    public function initialize(){

        $this->setTitle(_text('User Group Settings', 'admin'));
        $this->setInfo(_text('[User Group Settings Note]', 'admin'));
        $this->setEncType('multipart/form-data');
        $this->setAction(_url('#'));

        /** start elements **/

        
        
/** element `core__clear_cache` **/
$this->addElement(array ( 'name' => 'core__clear_cache', 'factory' => 'yesno', 'label' => _text('Clear Cache',null), 'info' => '[Clear Cache Info]', ));        
        
/** element `core__manage_package` **/
$this->addElement(array ( 'name' => 'core__manage_package', 'factory' => 'yesno', 'label' => _text('Manage Package',null), 'info' => '[Manage Package Info]', ));        
        
/** element `core__install_package` **/
$this->addElement(array ( 'name' => 'core__install_package', 'factory' => 'yesno', 'label' => _text('Install Package',null), 'info' => '[Install Package Info]', ));        
        
/** element `core__access_admin` **/
$this->addElement(array ( 'name' => 'core__access_admin', 'factory' => 'yesno', 'label' => _text('Access Admin',null), 'info' => '[Access Admin Info]', ));        
        
/** element `core__manage_layout` **/
$this->addElement(array ( 'name' => 'core__manage_layout', 'factory' => 'yesno', 'label' => _text('Manage Layout',null), 'info' => '[Manage Layout Info]', ));        
        
/** element `core__manage_site_setting` **/
$this->addElement(array ( 'name' => 'core__manage_site_setting', 'factory' => 'yesno', 'label' => _text('Manage Site Setting',null), 'info' => '[Manage Site Setting Info]', ));        
        
/** element `core__manage_acl_setting` **/
$this->addElement(array ( 'name' => 'core__manage_acl_setting', 'factory' => 'yesno', 'label' => _text('Manage Acl Setting',null), 'info' => '[Manage Acl Setting Info]', ));        
        
/** element `core__moderate_content` **/
$this->addElement(array ( 'name' => 'core__moderate_content', 'factory' => 'yesno', 'label' => _text('Moderate Content',null), 'info' => '[Moderate Content Info]', ));        
        
/** element `core__manage_cache` **/
$this->addElement(array ( 'name' => 'core__manage_cache', 'factory' => 'yesno', 'label' => _text('Manage Cache',null), 'info' => '[Manage Cache Info]', ));        
        
/** element `core__clear_log` **/
$this->addElement(array ( 'name' => 'core__clear_log', 'factory' => 'yesno', 'label' => _text('Clear Log',null), 'info' => '[Clear Log Info]', ));        
        
/** element `core__manage_log` **/
$this->addElement(array ( 'name' => 'core__manage_log', 'factory' => 'yesno', 'label' => _text('Manage Log',null), 'info' => '[Manage Log Info]', ));        
        
/** element `core__manage_admin` **/
$this->addElement(array ( 'name' => 'core__manage_admin', 'factory' => 'yesno', 'label' => _text('Manage Admin',null), 'info' => '[Manage Admin Info]', ));        
        
/** element `core__manage_theme` **/
$this->addElement(array ( 'name' => 'core__manage_theme', 'factory' => 'yesno', 'label' => _text('Manage Theme',null), 'info' => '[Manage Theme Info]', ));        
        
/** element `core__manage_acl_role` **/
$this->addElement(array ( 'name' => 'core__manage_acl_role', 'factory' => 'yesno', 'label' => _text('Manage Acl Role',null), 'info' => '[Manage Acl Role Info]', ));        
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
