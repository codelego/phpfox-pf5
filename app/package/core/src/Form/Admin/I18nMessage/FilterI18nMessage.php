<?php

namespace Neutron\Core\Form\Admin\I18nMessage;

use Phpfox\Form\Form;

class FilterI18nMessage extends Form
{

    /** id=392 */
    public function initialize()
    {

        $this->setMethod('get');

        /** start elements **/

        /** element `q` id=1531 **/
        $this->addElement(['name' => 'q', 'factory' => 'text', 'placeholder' => _text('Keywords', null),]);

        /** element `package_id` id=835 **/
        $this->addElement([
            'name'        => 'package_id',
            'factory'     => 'select',
            'placeholder' => _text('Package', null),
            'value'       => 'core',
            'options'     => \Phpfox::get('core.packages')->getAppIdOptions(),
        ]);

        /** element `locale_id` id=836 **/
        $this->addElement([
            'name'        => 'locale_id',
            'factory'     => 'select',
            'placeholder' => _text('Locale', null),
            'options'     => \Phpfox::get('core.i18n')->getLocaleIdOptions(),
        ]);

        /** element `domain_id` id=837 **/
        $this->addElement(['name' => 'domain_id', 'factory' => 'text', 'placeholder' => _text('Domain', null),]);
        /** end elements **/

        $this->addButton([
            'name'       => 'search',
            'factory'    => 'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);
    }
}
