<?php
namespace Neutron\Report\Form\Admin\ReportItem;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class FilterReportItem extends Form{

    public function initialize(){

        $this->setMethod('get');

        $this->addElement([
            'factory'    => 'text',
            'name'       => 'q',
            'label' => _text('Search', 'admin'),
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => _text('Search', 'admin'),
            ],
        ]);
        
        /** start elements **/

                // skip element `item_id` #identity
        
        // element `category_id`
        $this->addElement(array (
          'name' => 'category_id',
          'factory' => 'text',
          'label' => _text('Category',null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
        // element `message`
        $this->addElement(array (
          'name' => 'message',
          'factory' => 'text',
          'label' => _text('Message',null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        // skip element `user_id` #skips
        
        // element `about_id`
        $this->addElement(array (
          'name' => 'about_id',
          'factory' => 'text',
          'label' => _text('About',null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
        // element `about_type`
        $this->addElement(array (
          'name' => 'about_type',
          'factory' => 'text',
          'label' => _text('About Type',null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
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
                'name'       => 'search',
                'label'      => _text('Search'),
                'attributes' => ['class' => 'btn btn-primary'],
            ])
        ];
        /** end buttons **/
    }
}
