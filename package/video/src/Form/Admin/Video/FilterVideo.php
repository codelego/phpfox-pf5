<?php
namespace Neutron\Video\Form\Admin\Video;

use Phpfox\Form\Form;

class FilterVideo extends Form {

    /** id=445 */
    public function initialize(){

        $this->setMethod('get');

        /** start elements **/

        
        
            /** element `q` id=3328 **/
            $this->addElement(array ( 'name' => 'q', 'factory' => 'text', 'placeholder' => _text('Keywords','_video'), ));        
        
            /** element `is_active` id=3316 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'placeholder' => _text('Is Active','_video'), 'value' => '1', 'decorator' => 'select', ));        
        
            /** element `is_approval` id=3317 **/
            $this->addElement(array ( 'name' => 'is_approval', 'factory' => 'yesno', 'placeholder' => _text('Is Approval','_video'), 'value' => '1', 'decorator' => 'select', ));        
        
            /** element `category_id` id=3318 **/
            $this->addElement(array ( 'name' => 'category_id', 'factory' => 'text', 'placeholder' => _text('Category','_video'), 'value' => '0', ));        
        
            /** element `provider_id` id=3319 **/
            $this->addElement(array ( 'name' => 'provider_id', 'factory' => 'text', 'placeholder' => _text('Provider','_video'), ));        
        /** end elements **/

        $this->addButton([
            'name'       => 'search',
            'factory'=>'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);
    }
}
