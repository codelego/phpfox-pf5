<?php /** lock */

namespace Neutron\Core\Form\Admin\CorePackage;

use Phpfox\Form\Form;

class FilterCorePackage extends Form
{

    public function initialize()
    {

        $this->setMethod('get');

        $this->addElement([
            'factory'    => 'text',
            'name'       => 'q',
            'label'      => _text('Search', 'admin'),
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => _text('Search', 'admin'),
            ],
        ]);

        /** start elements **/

        // skip element `id` #identity

        // element `type_id`
        $this->addElement([
            'name'    => 'type_id',
            'factory' => 'select',
            'label'   => _text('Type', '_core.package'),
            'options' => _get('core.packages')->getTypeIdOptions(),
        ]);
        // skip element `is_required` #skips

        // element `is_active`
        $this->addElement([
            'name'      => 'is_active',
            'factory'   => 'yesno',
            'decorator' => 'select',
            'label'     => _text('Is Active', null),
        ]);

        // element `author`
        $this->addElement([
            'name'    => 'author',
            'factory' => 'select',
            'label'   => _text('Author', null),
            'options' => _get('core.packages')->getAuthorIdOptions(),
        ]);

        $this->addButton([
            'name'       => 'search',
            'factory'    => 'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        /** end elements **/
    }
}
