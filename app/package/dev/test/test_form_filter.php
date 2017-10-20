<?php

namespace Neutron\Core\Form\Admin\AclRole;

use Phpfox\Form\Form;

class FilterAclRole extends Form
{

    public function initialize()
    {

        /** start attributes **/

        $this->setTitle(_text('Filter Acl Role', ''));
        $this->setInfo(_text('[Filter Acl Role Info]', ''));
        $this->setAction(_url('#'));

        /** end attributes **/


        /** start elements **/


        /** skip element `level_id` #identity **/

        /** element `inherit_id` **/
        $this->addElement([
            'name'      => 'inherit_id',
            'factory'   => 'text',
            'label'     => _text('Inherit Id', null),
            'value'     => '0',
            'maxlength' => 255,
        ]);

        /** element `title` **/
        $this->addElement([
            'name'      => 'title',
            'factory'   => 'text',
            'label'     => _text('Title', null),
            'maxlength' => 255,
        ]);
        /** skip element `item_count` #skips **/

        /** element `is_special` **/
        $this->addElement([
            'name'    => 'is_special',
            'factory' => 'select',
            'label'   => _text('Is Special', null),
            'value'   => '0',
            'options' => [['value' => 1, 'label' => 'Yes',], ['value' => 0, 'label' => 'No',],],
        ]);

        /** element `is_super` **/
        $this->addElement([
            'name'    => 'is_super',
            'factory' => 'select',
            'label'   => _text('Is Super', null),
            'value'   => '0',
            'options' => [['value' => 1, 'label' => 'Yes',], ['value' => 0, 'label' => 'No',],],
        ]);

        /** element `is_admin` **/
        $this->addElement([
            'name'    => 'is_admin',
            'factory' => 'select',
            'label'   => _text('Is Admin', null),
            'value'   => '0',
            'options' => [['value' => 1, 'label' => 'Yes',], ['value' => 0, 'label' => 'No',],],
        ]);

        /** element `is_moderator` **/
        $this->addElement([
            'name'    => 'is_moderator',
            'factory' => 'select',
            'label'   => _text('Is Moderator', null),
            'value'   => '0',
            'options' => [['value' => 1, 'label' => 'Yes',], ['value' => 0, 'label' => 'No',],],
        ]);

        /** element `is_staff` **/
        $this->addElement([
            'name'    => 'is_staff',
            'factory' => 'select',
            'label'   => _text('Is Staff', null),
            'value'   => '0',
            'options' => [['value' => 1, 'label' => 'Yes',], ['value' => 0, 'label' => 'No',],],
        ]);

        /** element `is_registered` **/
        $this->addElement([
            'name'    => 'is_registered',
            'factory' => 'select',
            'label'   => _text('Is Registered', null),
            'value'   => '0',
            'options' => [['value' => 1, 'label' => 'Yes',], ['value' => 0, 'label' => 'No',],],
        ]);

        /** element `is_banned` **/
        $this->addElement([
            'name'    => 'is_banned',
            'factory' => 'select',
            'label'   => _text('Is Banned', null),
            'value'   => '0',
            'options' => [['value' => 1, 'label' => 'Yes',], ['value' => 0, 'label' => 'No',],],
        ]);

        /** element `is_guest` **/
        $this->addElement([
            'name'    => 'is_guest',
            'factory' => 'select',
            'label'   => _text('Is Guest', null),
            'value'   => '0',
            'options' => [['value' => 1, 'label' => 'Yes',], ['value' => 0, 'label' => 'No',],],
        ]);
        /** end elements **/

        /** start buttons **/

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
        /** end buttons **/
    }
}
