<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditCacheSettings extends Form
{

    /** id=664 */
    public function initialize()
    {

        $this->setTitle(_text('Edit Cache Settings', '_core.cache'));
        $this->setInfo(_text('Edit Site Settings [Info]', '_core.cache'));
        $this->setMethod('post');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__shared_cache_cache_id` id=2173 **/
        $this->addElement(['name'     => 'core__shared_cache_cache_id',
                           'factory'  => 'select',
                           'label'    => _text('Default Cache', '_core.cache'),
                           'info'     => _text('Default Cache Id [Info]', '_core.cache'),
                           'options'  => \Phpfox::get('core.adapter')->getAdapterIdOptions('cache'),
                           'required' => true,
        ]);
        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => _url('#'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
