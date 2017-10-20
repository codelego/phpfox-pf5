<?php

namespace Neutron\Events\Form;


class AddLayoutActionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $form = new AddLayoutAction();
        $this->assertNotNull($form->getElement('action_id'));
        $this->assertNotNull($form->getElement('parent_action_id'));
        $this->assertNotNull($form->getElement('action_name'));
        $this->assertNotNull($form->getElement('package_id'));
        $this->assertNotNull($form->getElement('is_admin'));
        $this->assertNotNull($form->getElement('description'));
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
