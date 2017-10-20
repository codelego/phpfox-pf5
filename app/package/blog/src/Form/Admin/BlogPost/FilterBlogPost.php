<?php

namespace Neutron\Blog\Form\Admin\BlogPost;

use Phpfox\Form\Form;

class FilterBlogPost extends Form
{

    /** id=359 */
    public function initialize()
    {

        $this->setMethod('get');

        /** start elements **/


        /** element `q` id=2906 **/
        $this->addElement([
            'name'        => 'q',
            'factory'     => 'text',
            'placeholder' => _text('Keywords', '_blog'),
        ]);

        /** element `category_id` id=2893 **/
        $this->addElement([
            'name'        => 'category_id',
            'factory'     => 'text',
            'placeholder' => _text('Category', '_blog'),
            'value'       => '0',
        ]);

        /** element `created_at` id=2894 **/
        $this->addElement([
            'name'        => 'created_at',
            'factory'     => 'text',
            'placeholder' => _text('Created At', '_blog'),
        ]);

        /** element `is_approved` id=2903 **/
        $this->addElement([
            'name'        => 'is_approved',
            'factory'     => 'yesno',
            'placeholder' => _text('Is Approved', '_blog'),
            'value'       => '0',
            'decorator'   => 'select',
        ]);

        /** element `is_featured` id=2904 **/
        $this->addElement([
            'name'        => 'is_featured',
            'factory'     => 'yesno',
            'placeholder' => _text('Is Featured', '_blog'),
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
