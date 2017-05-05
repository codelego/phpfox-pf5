<?php

namespace Neutron\Events\Form;


class EditEventTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new EditEvent();
        $this->assertNotNull($form->getElement('is_featured'));
        $this->assertNotNull($form->getElement('is_sponsor'));
        $this->assertNotNull($form->getElement('privacy_id'));
        $this->assertNotNull($form->getElement('location_id'));
        $this->assertNotNull($form->getElement('photo_id'));
        $this->assertNotNull($form->getElement('start_at'));
        $this->assertNotNull($form->getElement('end_at'));
        $this->assertNotNull($form->getElement('title'));
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
