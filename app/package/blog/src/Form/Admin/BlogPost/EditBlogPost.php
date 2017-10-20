<?php
namespace Neutron\Blog\Form;

use Phpfox\Form\Form;

class EditBlogPost extends Form {

    /** id=139 */
    public function initialize(){

        $this->setTitle(_text('Edit Blog Post',''));
        $this->setInfo(_text('Edit Blog Post [Form Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `title` id=2850 **/
            $this->addElement(array ( 'name' => 'title', 'factory' => 'textarea', 'label' => _text('Title',null), 'placeholder' => _text('Title',null), 'info' => _text('Title [Info]', null), 'required' => true, ));        
        
            /** element `content` id=2851 **/
            $this->addElement(array ( 'name' => 'content', 'factory' => 'textarea', 'label' => _text('Content',null), 'placeholder' => _text('Content',null), 'info' => _text('Content [Info]', null), 'required' => true, ));        
        
            /** element `description` id=2853 **/
            $this->addElement(array ( 'name' => 'description', 'factory' => 'textarea', 'label' => _text('Description',null), 'placeholder' => _text('Description',null), 'info' => _text('Description [Info]', null), 'required' => true, ));        
        
            /** element `category_id` id=2855 **/
            $this->addElement(array ( 'name' => 'category_id', 'factory' => 'text', 'label' => _text('Category Id',null), 'placeholder' => _text('Category Id',null), 'info' => _text('Category Id [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `publish_at` id=2860 **/
            $this->addElement(array ( 'name' => 'publish_at', 'factory' => 'text', 'label' => _text('Publish At',null), 'placeholder' => _text('Publish At',null), 'info' => _text('Publish At [Info]', null), 'required' => true, ));        
        
            /** element `privacy_id` id=2863 **/
            $this->addElement(array ( 'name' => 'privacy_id', 'factory' => 'text', 'label' => _text('Privacy Id',null), 'placeholder' => _text('Privacy Id',null), 'info' => _text('Privacy Id [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `status_id` id=2864 **/
            $this->addElement(array ( 'name' => 'status_id', 'factory' => 'text', 'label' => _text('Status Id',null), 'placeholder' => _text('Status Id',null), 'info' => _text('Status Id [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `is_approved` id=2865 **/
            $this->addElement(array ( 'name' => 'is_approved', 'factory' => 'yesno', 'label' => _text('Is Approved',null), 'placeholder' => _text('Is Approved',null), 'info' => _text('Is Approved [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `is_featured` id=2866 **/
            $this->addElement(array ( 'name' => 'is_featured', 'factory' => 'yesno', 'label' => _text('Is Featured',null), 'placeholder' => _text('Is Featured',null), 'info' => _text('Is Featured [Info]', null), 'value' => '0', 'required' => true, ));        
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
            'href'       => _url('#'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}
