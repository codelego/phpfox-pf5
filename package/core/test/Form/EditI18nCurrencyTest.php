<?php

namespace Neutron\Core\Form;


class EditI18nCurrencyTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new AdminEditI18nCurrency();
        $this->assertNotNull($form->getElement('currency_id'));
        $this->assertNotNull($form->getElement('symbol'));
        $this->assertNotNull($form->getElement('name'));
        $this->assertNotNull($form->getElement('sort_order'));
        $this->assertNotNull($form->getElement('is_default'));
        $this->assertNotNull($form->getElement('is_active'));
    }

    public function getButtons()
    {
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'cancel',
                'href'       => '#',
                'data-cmd'   => 'form.cancel',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn link'],
            ]),
        ];
    }
}
