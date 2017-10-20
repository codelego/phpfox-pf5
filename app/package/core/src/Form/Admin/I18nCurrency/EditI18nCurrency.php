<?php

namespace Neutron\Core\Form\Admin\I18nCurrency;

use Phpfox\Form\Form;

class EditI18nCurrency extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Currency', ''));
        $this->setInfo(_text('[Edit Currency Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `currency_id` **/
        $this->addElement(['name' => 'currency_id', 'factory' => 'text', 'label' => _text('Currency Id', null), 'info' => _text('[Currency Id Info]', null), 'required' => '1',]);

        /** element `symbol` **/
        $this->addElement(['name' => 'symbol', 'factory' => 'text', 'label' => _text('Symbol', null), 'info' => _text('[Symbol Info]', null), 'required' => '1',]);

        /** element `name` **/
        $this->addElement(['name' => 'name', 'factory' => 'text', 'label' => _text('Name', null), 'info' => _text('[Name Info]', null), 'required' => '1',]);

        /** element `ordering` **/
        $this->addElement(['name' => 'ordering', 'factory' => 'text', 'label' => _text('Ordering', null), 'info' => _text('[Ordering Info]', null), 'value' => '0', 'required' => '1',]);

        /** element `is_active` **/
        $this->addElement(['name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active', null), 'info' => _text('[Is Active Info]', null), 'value' => '0', 'required' => '1',]);
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
