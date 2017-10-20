<?php

namespace Neutron\Pages\Form\Admin\Pages;

use Phpfox\Form\Form;

class FilterPages extends Form
{

    /** id=416 */
    public function initialize()
    {

        $this->setMethod('get');

        /** start elements **/


        /** element `q` id=2997 **/
        $this->addElement(['name' => 'q', 'factory' => 'text', 'placeholder' => _text('Keywords', null),]);

        /** element `is_featured` id=2985 **/
        $this->addElement([
            'name'        => 'is_featured',
            'factory'     => 'yesno',
            'placeholder' => _text('Is Featured', null),
            'value'       => '0',
            'decorator'   => 'select',
        ]);

        /** element `type_id` id=2987 **/
        $this->addElement(['name' => 'type_id', 'factory' => 'text', 'placeholder' => _text('Type', null),]);

        /** element `category_id` id=2988 **/
        $this->addElement(['name' => 'category_id', 'factory' => 'text', 'placeholder' => _text('Category', null),]);
        /** end elements **/

        $this->addButton([
            'name'       => 'search',
            'factory'    => 'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);
    }
}
