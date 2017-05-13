<?php

namespace Neutron\Core\Form\Admin\AclRole;

use Phpfox\Form\Form;

class AddAclRole extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Add Acl Role', ''));
        $this->setInfo(_text('[Add Acl Role Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `role_id` **/
        $this->addElement([
            'name'     => 'role_id',
            'factory'  => 'text',
            'label'    => _text('Role Id', null),
            'info'     => '[Role Id Info]',
            'required' => '1',
        ]);

        /** element `inherit_id` **/
        $this->addElement([
            'name'     => 'inherit_id',
            'factory'  => 'text',
            'label'    => _text('Inherit Id', null),
            'info'     => '[Inherit Id Info]',
            'value'    => '0',
            'required' => '1',
        ]);

        /** element `title` **/
        $this->addElement([
            'name'     => 'title',
            'factory'  => 'text',
            'label'    => _text('Title', null),
            'info'     => '[Title Info]',
            'required' => '1',
        ]);

        /** element `item_count` **/
        $this->addElement([
            'name'     => 'item_count',
            'factory'  => 'text',
            'label'    => _text('Item Count', null),
            'info'     => '[Item Count Info]',
            'value'    => '0',
            'required' => '1',
        ]);

        /** element `is_special` **/
        $this->addElement([
            'name'     => 'is_special',
            'factory'  => 'yesno',
            'label'    => _text('Is Special', null),
            'info'     => '[Is Special Info]',
            'value'    => '0',
            'required' => '1',
        ]);

        /** element `is_super` **/
        $this->addElement([
            'name'     => 'is_super',
            'factory'  => 'yesno',
            'label'    => _text('Is Super', null),
            'info'     => '[Is Super Info]',
            'value'    => '0',
            'required' => '1',
        ]);

        /** element `is_admin` **/
        $this->addElement([
            'name'     => 'is_admin',
            'factory'  => 'yesno',
            'label'    => _text('Is Admin', null),
            'info'     => '[Is Admin Info]',
            'value'    => '0',
            'required' => '1',
        ]);

        /** element `is_moderator` **/
        $this->addElement([
            'name'     => 'is_moderator',
            'factory'  => 'yesno',
            'label'    => _text('Is Moderator', null),
            'info'     => '[Is Moderator Info]',
            'value'    => '0',
            'required' => '1',
        ]);

        /** element `is_staff` **/
        $this->addElement([
            'name'     => 'is_staff',
            'factory'  => 'yesno',
            'label'    => _text('Is Staff', null),
            'info'     => '[Is Staff Info]',
            'value'    => '0',
            'required' => '1',
        ]);

        /** element `is_registered` **/
        $this->addElement([
            'name'     => 'is_registered',
            'factory'  => 'yesno',
            'label'    => _text('Is Registered', null),
            'info'     => '[Is Registered Info]',
            'value'    => '0',
            'required' => '1',
        ]);

        /** element `is_banned` **/
        $this->addElement([
            'name'     => 'is_banned',
            'factory'  => 'yesno',
            'label'    => _text('Is Banned', null),
            'info'     => '[Is Banned Info]',
            'value'    => '0',
            'required' => '1',
        ]);

        /** element `is_guest` **/
        $this->addElement([
            'name'     => 'is_guest',
            'factory'  => 'yesno',
            'label'    => _text('Is Guest', null),
            'info'     => '[Is Guest Info]',
            'value'    => '0',
            'required' => '1',
        ]);
        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Submit'),
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
