<?php

namespace Neutron\Core\Form\Admin\ProfileStep;

use Phpfox\Form\Form;

class AddProfileStep extends Form
{

    /** id=764 */
    public function initialize()
    {

        $this->setTitle(_text('Add Profile Step', ''));
        $this->setInfo(_text('[Add Profile Step Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `process_id` id=2556 **/
        $this->addElement(['name'        => 'process_id',
                           'factory'     => 'text',
                           'label'       => _text('Process Id', null),
                           'placeholder' => _text('Process Id', null),
                           'info'        => _text('Process Id [Info]', null),
                           'required'    => true,
        ]);

        /** element `form_name` id=2557 **/
        $this->addElement(['name'        => 'form_name',
                           'factory'     => 'text',
                           'label'       => _text('Form Name', null),
                           'placeholder' => _text('Form Name', null),
                           'info'        => _text('Form Name [Info]', null),
                           'required'    => true,
        ]);

        /** element `step_name` id=2558 **/
        $this->addElement(['name'        => 'step_name',
                           'factory'     => 'text',
                           'label'       => _text('Step Name', null),
                           'placeholder' => _text('Step Name', null),
                           'info'        => _text('Step Name [Info]', null),
                           'required'    => true,
        ]);

        /** element `form_step_name` id=2559 **/
        $this->addElement(['name'        => 'form_step_name',
                           'factory'     => 'text',
                           'label'       => _text('Form Step Name', null),
                           'placeholder' => _text('Form Step Name', null),
                           'info'        => _text('Form Step Name [Info]', null),
                           'required'    => true,
        ]);

        /** element `ordering` id=2560 **/
        $this->addElement(['name'        => 'ordering',
                           'factory'     => 'text',
                           'label'       => _text('Ordering', null),
                           'placeholder' => _text('Ordering', null),
                           'info'        => _text('Ordering [Info]', null),
                           'value'       => '10',
                           'required'    => true,
        ]);

        /** element `package_id` id=2561 **/
        $this->addElement(['name'        => 'package_id',
                           'factory'     => 'text',
                           'label'       => _text('Package Id', null),
                           'placeholder' => _text('Package Id', null),
                           'info'        => _text('Package Id [Info]', null),
                           'required'    => true,
        ]);

        /** element `is_active` id=2562 **/
        $this->addElement(['name'        => 'is_active',
                           'factory'     => 'yesno',
                           'label'       => _text('Is Active', null),
                           'placeholder' => _text('Is Active', null),
                           'info'        => _text('Is Active [Info]', null),
                           'value'       => '1',
                           'required'    => true,
        ]);

        /** element `is_require` id=2563 **/
        $this->addElement(['name'        => 'is_require',
                           'factory'     => 'yesno',
                           'label'       => _text('Is Require', null),
                           'placeholder' => _text('Is Require', null),
                           'info'        => _text('Is Require [Info]', null),
                           'value'       => '0',
                           'required'    => true,
        ]);

        /** element `title` id=2564 **/
        $this->addElement(['name' => 'title', 'factory' => 'text', 'label' => _text('Title', null), 'placeholder' => _text('Title', null), 'info' => _text('Title [Info]', null), 'required' => true,]);

        /** element `description` id=2565 **/
        $this->addElement(['name'        => 'description',
                           'factory'     => 'text',
                           'label'       => _text('Description', null),
                           'placeholder' => _text('Description', null),
                           'info'        => _text('Description [Info]', null),
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
