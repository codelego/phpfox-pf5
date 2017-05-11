<?php
namespace Neutron\Core\Form\Admin\I18nCurrency;

use Phpfox\Form\Form;

class AddI18nCurrency extends Form {

    public function initialize(){

        $this->setTitle(_text('Add Currency',''));
        $this->setInfo(_text('[Add Currency Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
/** element `currency_id` **/
$this->addElement(array ( 'name' => 'currency_id', 'factory' => 'text', 'label' => _text('Currency Id',null), 'note' => _text('[Currency Id Note]', null), 'maxlength' => 255, 'required' => true, ));        
        
/** element `symbol` **/
$this->addElement(array ( 'name' => 'symbol', 'factory' => 'text', 'label' => _text('Symbol',null), 'note' => _text('[Symbol Note]', null), 'maxlength' => 255, 'required' => true, ));        
        
/** element `name` **/
$this->addElement(array ( 'name' => 'name', 'factory' => 'text', 'label' => _text('Name',null), 'note' => _text('[Name Note]', null), 'maxlength' => 255, 'required' => true, ));        
        
/** element `sort_order` **/
$this->addElement(array ( 'name' => 'sort_order', 'factory' => 'text', 'label' => _text('Sort Order',null), 'note' => _text('[Sort Order Note]', null), 'value' => '0', 'maxlength' => 255, 'required' => true, ));        
        
/** element `is_active` **/
$this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active',null), 'note' => _text('[Is Active Note]', null), 'value' => '0', 'required' => true, ));        
        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Submit'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
            ]);
    }
}
