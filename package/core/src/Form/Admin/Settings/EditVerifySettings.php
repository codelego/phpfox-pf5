<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditVerifySettings extends Form
{

    /** id=672 */
    public function initialize()
    {

        $this->setTitle(_text('Edit Verify Settings', '_core.verify_settings'));
        $this->setInfo(_text('[Edit Site Settings Info]', '_core'));
        $this->setMethod('post');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__default_verify_id` id=1931 **/
        $this->addElement([
            'name'    => 'core__default_verify_id',
            'factory' => 'select',
            'label'   => _text('Default Verify', '_core.verify_settings'),
            'info'    => _text('[Default Verify Id Info]', '_core.verify_settings'),
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
            'href'       => _url('#'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
