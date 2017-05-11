<?php

namespace Neutron\Core\Form\Admin\AclRole;

use Phpfox\Form\Form;

class EditAclRole extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Acl Role', ''));
        $this->setInfo(_text('[Edit Acl Role Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/


        /** skip element `role_id` #identity **/

        /** element `inherit_id` **/
        $this->addElement([
            'name'      => 'inherit_id',
            'factory'   => 'text',
            'label'     => _text('Inherit Id', null),
            'note'      => _text('[Inherit Id Note]', null),
            'value'     => '0',
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `title` **/
        $this->addElement([
            'name'      => 'title',
            'factory'   => 'text',
            'label'     => _text('Title', null),
            'note'      => _text('[Title Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);
        /** skip element `item_count` #skips **/

        /** element `is_special` **/
        $this->addElement([
            'name'     => 'is_special',
            'factory'  => 'yesno',
            'label'    => _text('Is Special', null),
            'note'     => _text('[Is Special Note]', null),
            'value'    => '0',
            'required' => true,
        ]);

        /** element `is_super` **/
        $this->addElement([
            'name'     => 'is_super',
            'factory'  => 'yesno',
            'label'    => _text('Is Super', null),
            'note'     => _text('[Is Super Note]', null),
            'value'    => '0',
            'required' => true,
        ]);

        /** element `is_admin` **/
        $this->addElement([
            'name'     => 'is_admin',
            'factory'  => 'yesno',
            'label'    => _text('Is Admin', null),
            'note'     => _text('[Is Admin Note]', null),
            'value'    => '0',
            'required' => true,
        ]);

        /** element `is_moderator` **/
        $this->addElement([
            'name'     => 'is_moderator',
            'factory'  => 'yesno',
            'label'    => _text('Is Moderator', null),
            'note'     => _text('[Is Moderator Note]', null),
            'value'    => '0',
            'required' => true,
        ]);

        /** element `is_staff` **/
        $this->addElement([
            'name'     => 'is_staff',
            'factory'  => 'yesno',
            'label'    => _text('Is Staff', null),
            'note'     => _text('[Is Staff Note]', null),
            'value'    => '0',
            'required' => true,
        ]);

        /** element `is_registered` **/
        $this->addElement([
            'name'     => 'is_registered',
            'factory'  => 'yesno',
            'label'    => _text('Is Registered', null),
            'note'     => _text('[Is Registered Note]', null),
            'value'    => '0',
            'required' => true,
        ]);

        /** element `is_banned` **/
        $this->addElement([
            'name'     => 'is_banned',
            'factory'  => 'yesno',
            'label'    => _text('Is Banned', null),
            'note'     => _text('[Is Banned Note]', null),
            'value'    => '0',
            'required' => true,
        ]);

        /** element `is_guest` **/
        $this->addElement([
            'name'     => 'is_guest',
            'factory'  => 'yesno',
            'label'    => _text('Is Guest', null),
            'note'     => _text('[Is Guest Note]', null),
            'value'    => '0',
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
