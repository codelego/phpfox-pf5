<?php
namespace Neutron\Group\Form\Admin\GroupCategory;

use Phpfox\Form\Form;

class DeleteGroupCategory extends Form {

    /** id=275 */
    public function initialize(){

        $this->setTitle(_text('Are You Sure?',''));
        $this->setInfo(_text('Delete Group Category [Form Info]',''));
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
            'href'       => _url('#'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
            ]);
    }
}
