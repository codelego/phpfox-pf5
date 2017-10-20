<?php

namespace Neutron\Core\Form\Admin\CoreMenuItem;

use Phpfox\Form\Form;

class AddCoreMenuItem extends Form
{

    /** id=708 */
    public function initialize()
    {

        $this->setTitle(_text('Add Core Menu Item', '_core.menu'));
        $this->setInfo(_text('Add Core Menu Item [Form Info]', '_core.menu'));
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `label` id=2752 **/
        $this->addElement(['name'        => 'label',
                           'factory'     => 'text',
                           'label'       => _text('Label', '_core.menu'),
                           'placeholder' => _text('Label', '_core.menu'),
                           'info'        => _text('Label [Info]', '_core.menu'),
                           'required'    => true,
        ]);

        /** element `href` id=2779 **/
        $this->addElement(['name' => 'href', 'factory' => 'text', 'label' => _text('Href', '_core.menu'), 'placeholder' => _text('Href', '_core.menu'), 'required' => true,]);

        /** element `is_ajax` id=2834 **/
        $this->addElement(['name'        => 'is_ajax',
                           'factory'     => 'yesno',
                           'label'       => _text('Is Ajax', '_core.menu'),
                           'placeholder' => _text('Is Ajax', '_core.menu'),
                           'info'        => _text('Is Ajax [Info]', '_core.menu'),
                           'value'       => '1',
                           'required'    => true,
        ]);

        /** element `is_self` id=2835 **/
        $this->addElement(['name'        => 'is_self',
                           'factory'     => 'yesno',
                           'label'       => _text('Is Self', '_core.menu'),
                           'placeholder' => _text('Is Self', '_core.menu'),
                           'info'        => _text('Is Self [Info]', '_core.menu'),
                           'value'       => '1',
                           'required'    => true,
        ]);

        /** element `package_id` id=2751 **/
        $this->addElement(['name' => 'package_id', 'factory' => 'hidden',]);
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
