<?php

namespace Neutron\Core\Form;


class AddI18nTimezoneTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new AdminAddI18nTimezone();
        $this->assertNotNull($form->getElement('timezone_id'));
        $this->assertNotNull($form->getElement('timezone_location'));
        $this->assertNotNull($form->getElement('is_active'));
        $this->assertNotNull($form->getElement('sort_order'));
        $this->assertNotNull($form->getElement('timezone_code'));
        $this->assertNotNull($form->getElement('timezone_offset'));
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
