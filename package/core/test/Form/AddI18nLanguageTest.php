<?php

namespace Neutron\Core\Form;


class AddI18nLanguageTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new AdminAddI18nLanguage();
        $this->assertNotNull($form->getElement('language_id'));
        $this->assertNotNull($form->getElement('name'));
        $this->assertNotNull($form->getElement('native_name'));
        $this->assertNotNull($form->getElement('code_6391'));
        $this->assertNotNull($form->getElement('direction_id'));
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
