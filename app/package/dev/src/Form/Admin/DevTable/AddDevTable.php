<?php

namespace Neutron\Dev\Form\Admin\DevTable;

use Phpfox\Form\Form;

class AddDevTable extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Add Dev Table', ''));
        $this->setInfo(_text('[Add Dev Table Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `table_name` **/
        $this->addElement([
            'name'     => 'table_name',
            'factory'  => 'text',
            'label'    => _text('Table Name', null),
            'info'     => _text('[Table Name Info]', null),
            'required' => '1',
        ]);

        /** element `package_id` **/
        $this->addElement([
            'name'     => 'package_id',
            'factory'  => 'select',
            'label'    => _text('Package Id', null),
            'info'     => _text('[Package Id Info]', null),
            'value'    => 'undefined',
            'options'  => \Phpfox::get('core.packages')->getPackageIdOptions(),
            'required' => '1',
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
            'href'       => _url('admin.dev.table'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
