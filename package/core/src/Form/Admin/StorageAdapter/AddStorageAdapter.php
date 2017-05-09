<?php

namespace Neutron\Core\Form\Admin\StorageAdapter;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddStorageAdapter extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Add Storage Adapter', 'admin.core_layout'));
        $this->setInfo(_text('[Add Storage Adapter Info]', 'admin.core_layout'));
        $this->setAction(_url('#'));

        /** start elements **/

        // skip element `adapter_id` #identity


        // element `driver_id`
        $this->addElement([
            'name'       => 'driver_id',
            'factory'    => 'radio',
            'label'      => _text('Driver Id', 'admin.core_layout'),
            'info'       => _text('[Driver Id Info]', 'admin.core_layout'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'value'      => 'local',
            'options'    => _service('core.storage')->getDriverIdOptions(),
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
                'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
            ]),
            new ButtonField([
                'name'       => 'cancel',
                'href'       => '#',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd'=>'form.cancel'],
            ]),
        ];
        /** end buttons **/
    }
}
