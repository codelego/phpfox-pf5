<?php

namespace Neutron\Core\Form\Admin\MailAdapter;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class SelectMailDriver extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Add Mail Adapter', ''));
        $this->setInfo(_text('[Add Mail Adapter Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/

        // skip element `adapter_id` #identity

        // element `driver_id`
        $this->addElement([
            'name'       => 'driver_id',
            'factory'    => 'radio',
            'label'      => _text('Driver Id', null),
            'note'       => _text('[Driver Id Note]', null),
            'options'    => _service('core.mails')->getDriverIdOptions(),
            'required'   => true,
        ]);
        // skip element `params` #skips

        /** end elements **/
    }


    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'name'       => 'save',
                'label'      => _text('Submit'),
                'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
            ]),
            new ButtonField([
                'name'       => 'cancel',
                'href'       => '#',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel'],
            ]),
        ];
        /** end buttons **/
    }
}
