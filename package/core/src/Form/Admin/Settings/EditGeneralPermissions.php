<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditGeneralPermissions extends Form
{

    /** id=676 */
    public function initialize()
    {

        $this->setTitle(_text('User Group Settings', 'admin'));
        $this->setInfo(_text('[User Group Settings Note]', 'admin'));
        $this->setEncType('multipart/form-data');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__clear_cache` id=1932 **/
        $this->addElement([
            'name'    => 'core__clear_cache',
            'factory' => 'yesno',
            'label'   => _text('Clear Cache', 'admin.core_acl'),
            'info'    => _text('[Clear Cache Info]', 'admin.core_acl'),
        ]);

        /** element `core__manage_package` id=1933 **/
        $this->addElement([
            'name'    => 'core__manage_package',
            'factory' => 'yesno',
            'label'   => _text('Manage Package', 'admin.core_acl'),
            'info'    => _text('[Manage Package Info]', 'admin.core_acl'),
        ]);

        /** element `core__install_package` id=1934 **/
        $this->addElement([
            'name'    => 'core__install_package',
            'factory' => 'yesno',
            'label'   => _text('Install Package', 'admin.core_acl'),
            'info'    => _text('[Install Package Info]', 'admin.core_acl'),
        ]);

        /** element `core__access_admin` id=1935 **/
        $this->addElement([
            'name'    => 'core__access_admin',
            'factory' => 'yesno',
            'label'   => _text('Access Admin', 'admin.core_acl'),
            'info'    => _text('[Access Admin Info]', 'admin.core_acl'),
        ]);

        /** element `core__manage_layout` id=1936 **/
        $this->addElement([
            'name'    => 'core__manage_layout',
            'factory' => 'yesno',
            'label'   => _text('Manage Layout', 'admin.core_acl'),
            'info'    => _text('[Manage Layout Info]', 'admin.core_acl'),
        ]);

        /** element `core__manage_site_setting` id=1937 **/
        $this->addElement([
            'name'    => 'core__manage_site_setting',
            'factory' => 'yesno',
            'label'   => _text('Manage Site Setting', 'admin.core_acl'),
            'info'    => _text('[Manage Site Setting Info]', 'admin.core_acl'),
        ]);

        /** element `core__manage_acl_setting` id=1938 **/
        $this->addElement([
            'name'    => 'core__manage_acl_setting',
            'factory' => 'yesno',
            'label'   => _text('Manage Acl Setting', 'admin.core_acl'),
            'info'    => _text('[Manage Acl Setting Info]', 'admin.core_acl'),
        ]);

        /** element `core__moderate_content` id=1939 **/
        $this->addElement([
            'name'    => 'core__moderate_content',
            'factory' => 'yesno',
            'label'   => _text('Moderate Content', 'admin.core_acl'),
            'info'    => _text('[Moderate Content Info]', 'admin.core_acl'),
        ]);

        /** element `core__manage_cache` id=1940 **/
        $this->addElement([
            'name'    => 'core__manage_cache',
            'factory' => 'yesno',
            'label'   => _text('Manage Cache', 'admin.core_acl'),
            'info'    => _text('[Manage Cache Info]', 'admin.core_acl'),
        ]);

        /** element `core__clear_log` id=1941 **/
        $this->addElement([
            'name'    => 'core__clear_log',
            'factory' => 'yesno',
            'label'   => _text('Clear Log', 'admin.core_acl'),
            'info'    => _text('[Clear Log Info]', 'admin.core_acl'),
        ]);

        /** element `core__manage_log` id=1942 **/
        $this->addElement([
            'name'    => 'core__manage_log',
            'factory' => 'yesno',
            'label'   => _text('Manage Log', 'admin.core_acl'),
            'info'    => _text('[Manage Log Info]', 'admin.core_acl'),
        ]);

        /** element `core__manage_admin` id=1943 **/
        $this->addElement([
            'name'    => 'core__manage_admin',
            'factory' => 'yesno',
            'label'   => _text('Manage Admin', 'admin.core_acl'),
            'info'    => _text('[Manage Admin Info]', 'admin.core_acl'),
        ]);

        /** element `core__manage_theme` id=1944 **/
        $this->addElement([
            'name'    => 'core__manage_theme',
            'factory' => 'yesno',
            'label'   => _text('Manage Theme', 'admin.core_acl'),
            'info'    => _text('[Manage Theme Info]', 'admin.core_acl'),
        ]);

        /** element `core__manage_acl_role` id=1945 **/
        $this->addElement([
            'name'    => 'core__manage_acl_role',
            'factory' => 'yesno',
            'label'   => _text('Manage Acl Role', 'admin.core_acl'),
            'info'    => _text('[Manage Acl Role Info]', 'admin.core_acl'),
        ]);
        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
