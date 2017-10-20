<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditLicenseSettings extends Form
{

    /** id=667 */
    public function initialize()
    {

        $this->setTitle(_text('Edit License Settings', '_core.license_settings'));
        $this->setInfo(_text('Edit Site Settings [Info]', '_core'));
        $this->setMethod('post');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__license_key` id=1947 **/
        $this->addElement(['name'    => 'core__license_key',
                           'factory' => 'text',
                           'label'   => _text('License Key', '_core.license_settings'),
                           'info'    => _text('License Key [Info]', '_core.license_settings'),
        ]);

        /** element `core__license_email` id=1948 **/
        $this->addElement(['name'    => 'core__license_email',
                           'factory' => 'text',
                           'label'   => _text('License Email', '_core.license_settings'),
                           'info'    => _text('License Email [Info]', '_core.license_settings'),
        ]);

        /** element `core__license_package` id=1949 **/
        $this->addElement(['name'    => 'core__license_package',
                           'factory' => 'text',
                           'label'   => _text('License Package', '_core.license_settings'),
                           'info'    => _text('License Package [Info]', '_core.license_settings'),
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
