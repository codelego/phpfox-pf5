<?php

namespace Neutron\Core\Form\Admin\AclSettingGroup;

use Phpfox\Form\Form;

class FilterAclPermissions extends Form
{

    public function initialize()
    {

        $this->setMethod('get');

        /** start elements **/


        /** element `q` **/
        $this->addElement([
            'name'        => 'q',
            'factory'     => 'text',
            'placeholder' => _text('Keywords', null),
        ]);

        /** element `group_id` **/
        $this->addElement([
            'name'        => 'form_id',
            'factory'     => 'select',
            'placeholder' => _text('Group', null),
            'options'     => _get('core.roles')->getFormIdOptions(),
        ]);

        /** element `package_id` **/
        $this->addElement([
            'name'        => 'package_id',
            'factory'     => 'select',
            'placeholder' => _text('Package ', null),
            'options'     => _get('core.packages')->getPackageIdOptions(),
        ]);
        /** end elements **/

        $this->addButton([
            'name'       => 'search',
            'factory'    => 'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);
    }
}
