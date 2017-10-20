<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditLogSettings extends Form
{

    /** id=668 */
    public function initialize()
    {

        $this->setTitle(_text('Edit Log Settings', '_core.logs'));
        $this->setInfo(_text('Edit Site Settings [Info]', '_core'));
        $this->setMethod('post');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__log_level` id=2185 **/
        $this->addElement(['name'     => 'core__log_level',
                           'factory'  => 'select',
                           'label'    => _text('Log Level', '_core.logs'),
                           'info'     => _text('Log Level [Info]', '_core.logs'),
                           'options'  => \Phpfox::get('core.setting')->getLogLevelOptions(),
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
            'href'       => _url('admin.core.log'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
