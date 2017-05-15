<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditLicenseSettings extends Form
{

    /** lock */
    public function initialize()
    {

        $this->setTitle(_text('Edit Core License', 'admin.core_license_setting'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));
        $this->setEncType('multipart/form-data');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__license_key` **/
        $this->addElement([
            'name'    => 'core__license_key',
            'factory' => 'text',
            'label'   => _text('License Key', 'admin.core_license_setting'),
            'info'    => _text('[License Key Info]', 'admin.core_license_setting'),
        ]);

        /** element `core__license_email` **/
        $this->addElement([
            'name'    => 'core__license_email',
            'factory' => 'text',
            'label'   => _text('License Email', 'admin.core_license_setting'),
            'info'    => _text('[License Email Info]', 'admin.core_license_setting'),
        ]);

        /** element `core__license_package` **/
        $this->addElement([
            'name'    => 'core__license_package',
            'factory' => 'text',
            'label'   => _text('License Package', 'admin.core_license_setting'),
            'info'    => _text('[License Package Info]', 'admin.core_license_setting'),
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
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
