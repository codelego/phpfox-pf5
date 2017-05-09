<?php
namespace Neutron\Report\Form\Admin\ReportItem;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddReportItem extends Form{

    public function initialize(){

        $this->setTitle(_text('Add Report Item',''));
        $this->setInfo(_text('[Add Report Item Info]',''));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `item_id` #identity
        
        // element `category_id`
        $this->addElement(array (
          'name' => 'category_id',
          'factory' => 'text',
          'label' => _text('Category',null),
          'note' => _text('[Category Note]', null),
          'value' => '0',
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `message`
        $this->addElement(array (
          'name' => 'message',
          'factory' => 'textarea',
          'label' => _text('Message',null),
          'note' => _text('[Message Note]', null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        // skip element `user_id` #skips
        
        // element `about_id`
        $this->addElement(array (
          'name' => 'about_id',
          'factory' => 'text',
          'label' => _text('About',null),
          'note' => _text('[About Note]', null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `about_type`
        $this->addElement(array (
          'name' => 'about_type',
          'factory' => 'text',
          'label' => _text('About Type',null),
          'note' => _text('[About Type Note]', null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        // skip element `created_at` #skips

        /** end elements **/
    }


    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Submit'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
            new ButtonField([
                'type'       => 'button',
                'name'       => 'cancel',
                'href'       => '#',
                'data-cmd'   => 'form.cancel',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel'],
            ]),
        ];
        /** end buttons **/
    }
}
