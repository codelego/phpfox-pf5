<?php
namespace Neutron\Pages\Form\Admin\PagesCategory;

use Phpfox\Form\Form;

class DeletePagesCategory extends Form {

    /** id=307 */
    public function initialize(){

        $this->setTitle(_text('Are You Sure?',''));
        $this->setInfo(_text('Delete Pages Category [Form Info]','_pages'));
        $this->setAction(_url('#'));

        /** start elements **/

        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Delete'),
            'attributes' => ['class' => 'btn btn-danger','type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => _url('admin.pages.category'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
            ]);
    }
}
