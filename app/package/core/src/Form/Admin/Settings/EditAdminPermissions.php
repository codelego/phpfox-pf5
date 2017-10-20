<?php

namespace Neutron\Core\Form\Admin\Settings;


class EditAdminPermissions extends EditPermissionSettings
{

    /** id=696 */
    public function initialize()
    {

        $this->setTitle(_text('Edit Admin Permissions', '_core.permissions'));
        $this->setInfo(_text('[Edit Admin Permissions Info]', '_core.permissions'));
        $this->setAction(_url('#'));

        if(!_get('acl')->checkByLevel($this->levelId, $this->itemType, 'core.access_admin'))
        {
            return false;
        }

        /** start elements **/


        /** element `core__access_admin` id=2294 **/
        $this->addElement([
            'name'        => 'core__access_admin',
            'factory'     => 'yesno',
            'label'       => _text('Access Admin', '_core.permissions'),
            'placeholder' => _text('Access Admin', '_core.permissions'),
            'info'        => _text('Access Admin [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_package` id=2295 **/
        $this->addElement([
            'name'        => 'core__access_package',
            'factory'     => 'yesno',
            'label'       => _text('Access Package', '_core.permissions'),
            'placeholder' => _text('Access Package', '_core.permissions'),
            'info'        => _text('Access Package [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__install_package` id=2296 **/
        $this->addElement([
            'name'        => 'core__install_package',
            'factory'     => 'yesno',
            'label'       => _text('Install Package', '_core.permissions'),
            'placeholder' => _text('Install Package', '_core.permissions'),
            'info'        => _text('Install Package [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__toggle_package` id=2375 **/
        $this->addElement([
            'name'        => 'core__toggle_package',
            'factory'     => 'yesno',
            'label'       => _text('Toggle Package', '_core.permissions'),
            'placeholder' => _text('Toggle Package', '_core.permissions'),
            'info'        => _text('Toggle Package [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_layout_editor` id=2297 **/
        $this->addElement([
            'name'        => 'core__access_layout_editor',
            'factory'     => 'yesno',
            'label'       => _text('Access Layout Editor', '_core.permissions'),
            'placeholder' => _text('Access Layout Editor', '_core.permissions'),
            'info'        => _text('Access Layout Editor [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__edit_layout` id=2376 **/
        $this->addElement([
            'name'        => 'core__edit_layout',
            'factory'     => 'yesno',
            'label'       => _text('Edit Layout', '_core.permissions'),
            'placeholder' => _text('Edit Layout', '_core.permissions'),
            'info'        => _text('Edit Layout [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_menu_editor` id=2298 **/
        $this->addElement([
            'name'        => 'core__access_menu_editor',
            'factory'     => 'yesno',
            'label'       => _text('Access Menu Editor', '_core.permissions'),
            'placeholder' => _text('Access Menu Editor', '_core.permissions'),
            'info'        => _text('Access Menu Editor [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__edit_menu` id=2377 **/
        $this->addElement([
            'name'        => 'core__edit_menu',
            'factory'     => 'yesno',
            'label'       => _text('Edit Menu', '_core.permissions'),
            'placeholder' => _text('Edit Menu', '_core.permissions'),
            'info'        => _text('Edit Menu [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `_user__access_login_setting` id=2307 **/
        $this->addElement([
            'name'        => '_user__access_login_setting',
            'factory'     => 'yesno',
            'label'       => _text('Access Login Setting', '_core.permissions'),
            'placeholder' => _text('Access Login Setting', '_core.permissions'),
            'info'        => _text('Access Login Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `_user__edit_login_setting` id=2378 **/
        $this->addElement([
            'name'        => '_user__edit_login_setting',
            'factory'     => 'yesno',
            'label'       => _text('Edit Login Setting', '_core.permissions'),
            'placeholder' => _text('Edit Login Setting', '_core.permissions'),
            'info'        => _text('Edit Login Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_health_status` id=2313 **/
        $this->addElement([
            'name'        => 'core__access_health_status',
            'factory'     => 'yesno',
            'label'       => _text('Access Health Status', '_core.permissions'),
            'placeholder' => _text('Access Health Status', '_core.permissions'),
            'info'        => _text('Access Health Status [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_license_setting` id=2303 **/
        $this->addElement([
            'name'        => 'core__access_license_setting',
            'factory'     => 'yesno',
            'label'       => _text('Access License Setting', '_core.permissions'),
            'placeholder' => _text('Access License Setting', '_core.permissions'),
            'info'        => _text('Access License Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__edit_license_setting` id=2379 **/
        $this->addElement([
            'name'        => 'core__edit_license_setting',
            'factory'     => 'yesno',
            'label'       => _text('Edit License Setting', '_core.permissions'),
            'placeholder' => _text('Edit License Setting', '_core.permissions'),
            'info'        => _text('Edit License Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_i18n_setting` id=2302 **/
        $this->addElement([
            'name'        => 'core__access_i18n_setting',
            'factory'     => 'yesno',
            'label'       => _text('Access I18n Setting', '_core.permissions'),
            'placeholder' => _text('Access I18n Setting', '_core.permissions'),
            'info'        => _text('Access I18n Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__edit_i18n_setting` id=2380 **/
        $this->addElement([
            'name'        => 'core__edit_i18n_setting',
            'factory'     => 'yesno',
            'label'       => _text('Edit I18n Setting', '_core.permissions'),
            'placeholder' => _text('Edit I18n Setting', '_core.permissions'),
            'info'        => _text('Edit I18n Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_sms_setting` id=2305 **/
        $this->addElement([
            'name'        => 'core__access_sms_setting',
            'factory'     => 'yesno',
            'label'       => _text('Access Sms Setting', '_core.permissions'),
            'placeholder' => _text('Access Sms Setting', '_core.permissions'),
            'info'        => _text('Access Sms Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__edit_sms_setting` id=2381 **/
        $this->addElement([
            'name'        => 'core__edit_sms_setting',
            'factory'     => 'yesno',
            'label'       => _text('Edit Sms Setting', '_core.permissions'),
            'placeholder' => _text('Edit Sms Setting', '_core.permissions'),
            'info'        => _text('Edit Sms Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `_user__access_regitration_setting` id=2308 **/
        $this->addElement([
            'name'        => '_user__access_regitration_setting',
            'factory'     => 'yesno',
            'label'       => _text('Access Regitration Setting', '_core.permissions'),
            'placeholder' => _text('Access Regitration Setting', '_core.permissions'),
            'info'        => _text('Access Regitration Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `_user__edit_regitration_setting` id=2382 **/
        $this->addElement([
            'name'        => '_user__edit_regitration_setting',
            'factory'     => 'yesno',
            'label'       => _text('Edit Regitration Setting', '_core.permissions'),
            'placeholder' => _text('Edit Regitration Setting', '_core.permissions'),
            'info'        => _text('Edit Regitration Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_storage_setting` id=2310 **/
        $this->addElement([
            'name'        => 'core__access_storage_setting',
            'factory'     => 'yesno',
            'label'       => _text('Access Storage Setting', '_core.permissions'),
            'placeholder' => _text('Access Storage Setting', '_core.permissions'),
            'info'        => _text('Access Storage Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__edit_storage_setting` id=2383 **/
        $this->addElement([
            'name'        => 'core__edit_storage_setting',
            'factory'     => 'yesno',
            'label'       => _text('Edit Storage Setting', '_core.permissions'),
            'placeholder' => _text('Edit Storage Setting', '_core.permissions'),
            'info'        => _text('Edit Storage Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_general_setting` id=2300 **/
        $this->addElement([
            'name'        => 'core__access_general_setting',
            'factory'     => 'yesno',
            'label'       => _text('Access General Setting', '_core.permissions'),
            'placeholder' => _text('Access General Setting', '_core.permissions'),
            'info'        => _text('Access General Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__edit_general_setting` id=2384 **/
        $this->addElement([
            'name'        => 'core__edit_general_setting',
            'factory'     => 'yesno',
            'label'       => _text('Edit General Setting', '_core.permissions'),
            'placeholder' => _text('Edit General Setting', '_core.permissions'),
            'info'        => _text('Edit General Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_statistic_status` id=2312 **/
        $this->addElement([
            'name'        => 'core__access_statistic_status',
            'factory'     => 'yesno',
            'label'       => _text('Access Statistic Status', '_core.permissions'),
            'placeholder' => _text('Access Statistic Status', '_core.permissions'),
            'info'        => _text('Access Statistic Status [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_seo_setting` id=2301 **/
        $this->addElement([
            'name'        => 'core__access_seo_setting',
            'factory'     => 'yesno',
            'label'       => _text('Access Seo Setting', '_core.permissions'),
            'placeholder' => _text('Access Seo Setting', '_core.permissions'),
            'info'        => _text('Access Seo Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__edit_seo_setting` id=2385 **/
        $this->addElement([
            'name'        => 'core__edit_seo_setting',
            'factory'     => 'yesno',
            'label'       => _text('Edit Seo Setting', '_core.permissions'),
            'placeholder' => _text('Edit Seo Setting', '_core.permissions'),
            'info'        => _text('Edit Seo Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_theme_editor` id=2299 **/
        $this->addElement([
            'name'        => 'core__access_theme_editor',
            'factory'     => 'yesno',
            'label'       => _text('Access Theme Editor', '_core.permissions'),
            'placeholder' => _text('Access Theme Editor', '_core.permissions'),
            'info'        => _text('Access Theme Editor [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__edit_theme` id=2386 **/
        $this->addElement([
            'name'        => 'core__edit_theme',
            'factory'     => 'yesno',
            'label'       => _text('Edit Theme', '_core.permissions'),
            'placeholder' => _text('Edit Theme', '_core.permissions'),
            'info'        => _text('Edit Theme [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_cache_setting` id=2304 **/
        $this->addElement([
            'name'        => 'core__access_cache_setting',
            'factory'     => 'yesno',
            'label'       => _text('Access Cache Setting', '_core.permissions'),
            'placeholder' => _text('Access Cache Setting', '_core.permissions'),
            'info'        => _text('Access Cache Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__edit_cache_setting` id=2387 **/
        $this->addElement([
            'name'        => 'core__edit_cache_setting',
            'factory'     => 'yesno',
            'label'       => _text('Edit Cache Setting', '_core.permissions'),
            'placeholder' => _text('Edit Cache Setting', '_core.permissions'),
            'info'        => _text('Edit Cache Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_session_setting` id=2306 **/
        $this->addElement([
            'name'        => 'core__access_session_setting',
            'factory'     => 'yesno',
            'label'       => _text('Access Session Setting', '_core.permissions'),
            'placeholder' => _text('Access Session Setting', '_core.permissions'),
            'info'        => _text('Access Session Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__adit_session_setting` id=2388 **/
        $this->addElement([
            'name'        => 'core__adit_session_setting',
            'factory'     => 'yesno',
            'label'       => _text('Adit Session Setting', '_core.permissions'),
            'placeholder' => _text('Adit Session Setting', '_core.permissions'),
            'info'        => _text('Adit Session Setting [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `_user__edit_user_level` id=2389 **/
        $this->addElement([
            'name'        => '_user__edit_user_level',
            'factory'     => 'yesno',
            'label'       => _text('Edit User Level', '_core.permissions'),
            'placeholder' => _text('Edit User Level', '_core.permissions'),
            'info'        => _text('Edit User Level [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `_user__access_user_level` id=2309 **/
        $this->addElement([
            'name'        => '_user__access_user_level',
            'factory'     => 'yesno',
            'label'       => _text('Access User Level', '_core.permissions'),
            'placeholder' => _text('Access User Level', '_core.permissions'),
            'info'        => _text('Access User Level [Info]', '_core.permissions'),
            'required'    => true,
        ]);

        /** element `core__access_system_status` id=2311 **/
        $this->addElement([
            'name'        => 'core__access_system_status',
            'factory'     => 'yesno',
            'label'       => _text('Access System Status', '_core.permissions'),
            'placeholder' => _text('Access System Status', '_core.permissions'),
            'info'        => _text('Access System Status [Info]', '_core.permissions'),
            'required'    => true,
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
