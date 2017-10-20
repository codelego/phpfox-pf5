<?php

namespace Neutron\Core\Form\Admin\CorePackage;

use Phpfox\Form\Form;

// lock
class FilterCorePackage extends Form
{

    /** id=370 */
    public function initialize()
    {
        $this->setMethod('get');

        /** start elements **/

        /** element `q` id=1523 **/
        $this->addElement(['name' => 'q', 'factory' => 'text', 'placeholder' => _text('Keywords', '_core.package'),]);

        /** element `type_id` id=518 **/
        $this->addElement([
            'name'        => 'type_id',
            'factory'     => 'select',
            'placeholder' => _text('Type', '_core.package'),
            'options'     => _get('core.packages')->getTypeIdOptions(),
        ]);

        /** element `author` id=526 **/
        $this->addElement([
            'name'        => 'author',
            'factory'     => 'select',
            'placeholder' => _text('Author', '_core.package'),
            'options'     => _get('core.packages')->getAuthorIdOptions(),
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
