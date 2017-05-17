<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditStorageSettings extends Form
{

    /** id=671 */
    public function initialize()
    {

        $this->setTitle(_text('Edit Storage Settings', '_core.storage'));
        $this->setInfo(_text('[Edit Site Settings Info]', '_core'));
        $this->setMethod('post');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__default_storage_id` id=2148 **/
        $this->addElement([
            'name'     => 'core__default_storage_id',
            'factory'  => 'select',
            'label'    => _text('Default Storage', '_core.storage'),
            'info'     => _text('[Default Storage Id Info]', '_core.storage'),
            'options'  => _get('core.storage')->getAdapterIdOptions(),
            'required' => true,
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
