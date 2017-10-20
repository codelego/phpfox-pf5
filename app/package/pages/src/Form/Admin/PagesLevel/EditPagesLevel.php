<?php
namespace Neutron\Pages\Form\Admin\PagesLevel;

use Phpfox\Form\Form;

class EditPagesLevel extends Form {

    /** id=774 */
    public function initialize(){

        $this->setTitle(_text('Edit Level','_pages'));
        $this->setInfo(_text('Edit Level [Form Info]','_pages'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `title` id=3012 **/
            $this->addElement(array ( 'name' => 'title', 'factory' => 'text', 'label' => _text('Title','_pages'), 'placeholder' => _text('Title','_pages'), 'info' => _text('Title [Info]', '_pages'), 'required' => true, ));        
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
            'href'       => _url('admin.pages.level'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}
