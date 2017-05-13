<?php
namespace Neutron\Core\Form\Admin\AclSettingGroup;

use Phpfox\Form\Form;

class FilterAclSettingGroup extends Form {

    public function initialize(){

        $this->setMethod('get');

        /** start elements **/

        
        
            /** element `q` **/
            $this->addElement(array ( 'name' => 'q', 'factory' => 'text', 'label' => _text('Keywords',null), ));        
        
            /** element `group_id` **/
            $this->addElement(array ( 'name' => 'group_id', 'factory' => 'select', 'label' => _text('Group Id',null), 'options' => _service('core.roles')->getSettingGroupIdOptions(), ));        
        
            /** element `package_id` **/
            $this->addElement(array ( 'name' => 'package_id', 'factory' => 'select', 'label' => _text('Package Id',null), 'options' => _service('core.packages')->getPackageIdOptions(), ));        
        /** end elements **/

        $this->addButton([
            'name'       => 'search',
            'factory'=>'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);
    }
}
