<?php
namespace Neutron\Blog\Form\Admin\BlogCategory;

use Phpfox\Form\Form;

class EditBlogCategory extends Form {

    /** id=138 */
    public function initialize(){

        $this->setTitle(_text('Edit Blog Category','_blog'));
        $this->setInfo(_text('Edit Blog Category [Form Info]','_blog'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `is_active` id=3204 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active','_blog'), 'placeholder' => _text('Is Active','_blog'), 'info' => _text('Is Active [Info]', '_blog'), 'value' => '1', 'required' => true, ));        
        
            /** element `name` id=3205 **/
            $this->addElement(array ( 'name' => 'name', 'factory' => 'text', 'label' => _text('Name','_blog'), 'placeholder' => _text('Name','_blog'), 'info' => _text('Name [Info]', '_blog'), 'required' => true, ));        
        
            /** element `description` id=3206 **/
            $this->addElement(array ( 'name' => 'description', 'factory' => 'textarea', 'label' => _text('Description','_blog'), 'placeholder' => _text('Description','_blog'), 'info' => _text('Description [Info]', '_blog'), ));        
        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => _url('admin.blog.category'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}
