<?php

namespace Neutron\Blog\Form\Admin\Settings;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class SiteSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Blog Settings', 'admin.blog'));
        $this->setInfo(_text('[Site Settings Note]', 'admin'));
    }

    public function getButtons()
    {
        /** start buttons **/
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
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