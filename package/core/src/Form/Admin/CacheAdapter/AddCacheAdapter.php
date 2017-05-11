<?php

namespace Neutron\Core\Form\Admin\CacheAdapter;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddCacheAdapter extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Add Cache Adapter', 'admin.core_cache'));
        $this->setInfo(_text('[Add Cache Adapter Info]', 'admin.core_cache'));
        $this->setAction(_url('#'));

        /** start elements **/

        // skip element `adapter_id` #identity

        // element `driver_id`
        $this->addElement([
            'name'       => 'driver_id',
            'factory'    => 'radio',
            'label'      => _text('Driver Id', 'admin.core_cache'),
            'note'       => _text('[Driver Id Note]', 'admin.core_cache'),
            'value'     => 'files',
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'options'    => _service('core.cache')->getDriverIdOptions(),
            'required'   => true,
        ]);
        // skip element `params` #skips

        /** end elements **/
        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Continue'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => _url('admin.core.cache'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
