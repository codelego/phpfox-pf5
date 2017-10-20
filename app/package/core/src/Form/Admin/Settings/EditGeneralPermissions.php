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


        /** element `core__storage_limit` id=2214 **/
        $this->addElement([
            'name'     => 'core__storage_limit',
            'factory'  => 'select',
            'label'    => _text('Storage Limit', '_core.general_acl'),
            'info'     => _text('Storage Limit [Info]', '_core.general_acl'),
            'options'  => \Phpfox::get('core.storage')->getStorageLimitOptions(),
            'required' => true,
        ]);

        /** element `user__edit_username` id=2217 **/
        $this->addElement([
            'name'     => 'user__edit_username',
            'factory'  => 'yesno',
            'label'    => _text('Edit Username', '_core.general_acl'),
            'info'     => _text('Edit Username [Info]', '_core.general_acl'),
            'required' => true,
        ]);

        /** element `user__limit_edit_username` id=2220 **/
        $this->addElement([
            'name'     => 'user__limit_edit_username',
            'factory'  => 'text',
            'label'    => _text('Limit Edit Username', '_core.general_acl'),
            'info'     => _text('Limit Edit Username [Info]', '_core.general_acl'),
            'value'    => '10',
            'required' => true,
        ]);

        /** element `user__block_others` id=2216 **/
        $this->addElement([
            'name'     => 'user__block_others',
            'factory'  => 'yesno',
            'label'    => _text('Block Others', '_core.general_acl'),
            'info'     => _text('Block Others [Info]', '_core.general_acl'),
            'required' => true,
        ]);

        /** element `user__delete_account` id=2215 **/
        $this->addElement([
            'name'     => 'user__delete_account',
            'factory'  => 'yesno',
            'label'    => _text('Delete Account', '_core.general_acl'),
            'info'     => _text('Delete Account [Info]', '_core.general_acl'),
            'required' => true,
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
