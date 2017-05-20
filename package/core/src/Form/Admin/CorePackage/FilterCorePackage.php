<?php
namespace Neutron\Core\Form\Admin\CorePackage;

use Phpfox\Form\Form;

class FilterCorePackage extends Form {

    /** id=370 */
    public function initialize(){

        $this->setMethod('get');

        /** start elements **/

        
        
            /** element `q` id=1523 **/
            $this->addElement(array ( 'name' => 'q', 'factory' => 'text', 'placeholder' => _text('Keywords','_core.package'), ));        
        
            /** element `type_id` id=518 **/
            $this->addElement(array ( 'name' => 'type_id', 'factory' => 'select', 'placeholder' => _text('Type','_core.package'), 'options' => _get('core.packages')->getTypeIdOptions(), ));        
        
            /** element `is_required` id=519 **/
            $this->addElement(array ( 'name' => 'is_required', 'factory' => 'yesno', 'placeholder' => _text('Require','_core.package'), 'decorator' => 'select', ));        
        
            /** element `is_active` id=520 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'placeholder' => _text('Is Active','_core.package'), 'decorator' => 'select', ));        
        
            /** element `author` id=526 **/
            $this->addElement(array ( 'name' => 'author', 'factory' => 'select', 'placeholder' => _text('Author','_core.package'), 'options' => _get('core.packages')->getAuthorIdOptions(), ));        
        /** end elements **/

        $this->addButton([
            'name'       => 'search',
            'factory'=>'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);
    }
}
