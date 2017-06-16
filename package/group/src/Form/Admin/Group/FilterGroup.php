<?php

namespace Neutron\Group\Form\Admin\Group;

use Phpfox\Form\Form;

class FilterGroup extends Form
{

    /** id=384 */
    public function initialize()
    {

        $this->setMethod('get');

        /** start elements **/


        /** element `q` id=3145 **/
        $this->addElement(['name' => 'q', 'factory' => 'text', 'placeholder' => _text('Keywords', null),]);

        /** element `category_id` id=3129 **/
        $this->addElement([
            'name'        => 'category_id',
            'factory'     => 'text',
            'placeholder' => _text('Category', null),
            'value'       => '0',
        ]);

        /** element `is_approval` id=3132 **/
        $this->addElement([
            'name'        => 'is_approval',
            'factory'     => 'yesno',
            'placeholder' => _text('Is Approval', null),
            'value'       => '0',
            'decorator'   => 'select',
        ]);

        /** element `is_featured` id=3133 **/
        $this->addElement([
            'name'        => 'is_featured',
            'factory'     => 'yesno',
            'placeholder' => _text('Is Featured', null),
            'value'       => '0',
            'decorator'   => 'select',
        ]);

        /** element `is_sponsor` id=3134 **/
        $this->addElement([
            'name'        => 'is_sponsor',
            'factory'     => 'yesno',
            'placeholder' => _text('Is Sponsor', null),
            'value'       => '0',
            'decorator'   => 'select',
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
