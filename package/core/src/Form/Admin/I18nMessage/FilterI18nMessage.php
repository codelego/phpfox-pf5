<?php

namespace Neutron\Core\Form\Admin\I18nMessage;

use Phpfox\Form\Form;

class FilterI18nMessage extends Form
{

    public function initialize()
    {

        $this->setMethod('get');

        /** start elements **/


        /** element `q` **/
        $this->addElement(['name' => 'q', 'factory' => 'text', 'label' => _text('Keywords', null),]);

        /** element `package_id` **/
        $this->addElement([
            'name'    => 'package_id',
            'factory' => 'select',
            'label'   => _text('Package Id', null),
            'value'   => 'core',
            'options' => _service('core.packages')->getPackageIdOptions(),
        ]);

        /** element `locale_id` **/
        $this->addElement([
            'name'    => 'locale_id',
            'factory' => 'select',
            'label'   => _text('Locale Id', null),
            'options' => _service('core.i18n')->getDirectionIdOptions(),
        ]);

        /** element `domain_id` **/
        $this->addElement(['name' => 'domain_id', 'factory' => 'text', 'label' => _text('Domain Id', null),]);
        /** end elements **/

        $this->addButton([
            'name'       => 'search',
            'factory'    => 'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);
    }
}
