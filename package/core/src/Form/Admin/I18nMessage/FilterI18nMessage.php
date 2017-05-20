<?php
namespace Neutron\Core\Form\Admin\I18nMessage;

use Phpfox\Form\Form;

class FilterI18nMessage extends Form {

    /** id=392 */
    public function initialize(){

        $this->setMethod('get');

        /** start elements **/

        
        
            /** element `q` id=1531 **/
            $this->addElement(array ( 'name' => 'q', 'factory' => 'text', 'placeholder' => _text('Keywords',null), ));        
        
            /** element `package_id` id=835 **/
            $this->addElement(array ( 'name' => 'package_id', 'factory' => 'select', 'placeholder' => _text('Package',null), 'value' => 'core', 'options' => _get('core.packages')->getPackageIdOptions(), ));        
        
            /** element `locale_id` id=836 **/
            $this->addElement(array ( 'name' => 'locale_id', 'factory' => 'select', 'placeholder' => _text('Locale',null), 'options' => _get('core.i18n')->getDirectionIdOptions(), ));        
        
            /** element `domain_id` id=837 **/
            $this->addElement(array ( 'name' => 'domain_id', 'factory' => 'text', 'placeholder' => _text('Domain',null), ));        
        /** end elements **/

        $this->addButton([
            'name'       => 'search',
            'factory'=>'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);
    }
}
