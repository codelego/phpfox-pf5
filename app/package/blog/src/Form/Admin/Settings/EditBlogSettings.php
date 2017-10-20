<?php

namespace Neutron\Blog\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditBlogSettings extends Form
{

    /** id=662 */
    public function initialize()
    {

        $this->setTitle(_text('Edit Blog Settings', '_blog.settings'));
        $this->setInfo(_text('Edit Site Settings [Info]', '_core'));
        $this->setMethod('post');
        $this->setAction(_url('#'));

        /** start elements **/


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
