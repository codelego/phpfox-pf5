<?php
namespace Neutron\Core\Form\Admin\LayoutComponent;

use Phpfox\Form\Form;

class FilterLayoutComponent extends Form {

    /** id=397 */
    public function initialize(){

        $this->setMethod('get');

        /** start elements **/

        
        
            /** element `q` id=1535 **/
            $this->addElement(array ( 'name' => 'q', 'factory' => 'text', 'placeholder' => _text('Keywords','_core.component'), ));        
        
            /** element `package_id` id=978 **/
            $this->addElement(array ( 'name' => 'package_id', 'factory' => 'select', 'placeholder' => _text('Package','_core.component'), 'options' => _get('core.packages')->getPackageIdOptions(), ));        
        /** end elements **/

        $this->addButton([
            'name'       => 'search',
            'factory'=>'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);
    }
}
