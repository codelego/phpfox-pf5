<?php

namespace Neutron\Core\Form\Admin\ProfileType;

use Phpfox\Form\Form;

class EditProfileType extends Form
{

    /** id=743 */
    public function initialize()
    {

        $this->setTitle(_text('Edit Profile Type', ''));
        $this->setInfo(_text('[Edit Profile Type Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `item_type` id=2592 **/
        $this->addElement(['name'        => 'item_type',
                           'factory'     => 'text',
                           'label'       => _text('Item Type', null),
                           'placeholder' => _text('Item Type', null),
                           'info'        => _text('Item Type [Info]', null),
                           'required'    => true,
        ]);

        /** element `catalog_id` id=2593 **/
        $this->addElement(['name'        => 'catalog_id',
                           'factory'     => 'text',
                           'label'       => _text('Catalog Id', null),
                           'placeholder' => _text('Catalog Id', null),
                           'info'        => _text('Catalog Id [Info]', null),
                           'value'       => '0',
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
