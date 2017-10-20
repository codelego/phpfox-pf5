<?php

namespace Neutron\Blog\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditBlogPermissions extends Form
{

    /** id=807 */
    public function initialize()
    {

        $this->setTitle(_text('Edit Permissions', '_blog'));
        $this->setInfo(_text('[Edit Permissions Info]', '_blog'));
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `blog__add_post` id=3421 **/
        $this->addElement(['name'        => 'blog__add_post',
                           'factory'     => 'yesno',
                           'label'       => _text('Can Add Post', '_blog'),
                           'placeholder' => _text('Can Add Post', '_blog'),
                           'info'        => _text('Can Add Post [Info]', '_blog'),
                           'value'       => '1',
                           'required'    => true,
        ]);

        /** element `blog__edit_post` id=3422 **/
        $this->addElement(['name'        => 'blog__edit_post',
                           'factory'     => 'yesno',
                           'label'       => _text('Can Edit Post', '_blog'),
                           'placeholder' => _text('Can Edit Post', '_blog'),
                           'info'        => _text('Can Edit Post [Info]', '_blog'),
                           'value'       => '1',
                           'required'    => true,
        ]);

        /** element `blog__delete_post` id=3423 **/
        $this->addElement(['name'        => 'blog__delete_post',
                           'factory'     => 'yesno',
                           'label'       => _text('Can Delete Post', '_blog'),
                           'placeholder' => _text('Can Delete Post', '_blog'),
                           'info'        => _text('Can Delete Post [Info]', '_blog'),
                           'value'       => '1',
                           'required'    => true,
        ]);

        /** element `blog__limit_post` id=3424 **/
        $this->addElement(['name'        => 'blog__limit_post',
                           'factory'     => 'text',
                           'label'       => _text('Limit Post', '_blog'),
                           'placeholder' => _text('Limit Post', '_blog'),
                           'info'        => _text('Limit Post [Info]', '_blog'),
                           'value'       => '100',
                           'required'    => true,
        ]);

        /** element `blog__approval` id=3425 **/
        $this->addElement(['name'        => 'blog__approval',
                           'factory'     => 'yesno',
                           'label'       => _text('Approval Process', '_blog'),
                           'placeholder' => _text('Approval Process', '_blog'),
                           'info'        => _text('Approval Process [Info]', '_blog'),
                           'value'       => '0',
                           'required'    => true,
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
