<?php

namespace Neutron\Core\Form\Admin\ProfileType;

use Phpfox\Form\Form;

class AddProfileType extends Form
{

    /** id=740 */
    public function initialize()
    {

        $this->setTitle(_text('Add Profile Type', ''));
        $this->setInfo(_text('[Add Profile Type Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `item_type` id=2541 **/
        $this->addElement(['name'        => 'item_type',
                           'factory'     => 'text',
                           'label'       => _text('Item Type', null),
                           'placeholder' => _text('Item Type', null),
                           'info'        => _text('Item Type [Info]', null),
                           'required'    => true,
        ]);

        /** element `catalog_id` id=2542 **/
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
