<?php
namespace Neutron\Event\Form\Admin\EventLevel;

use Phpfox\Form\Form;

class DeleteEventLevel extends Form {

    /** id=782 */
    public function initialize(){

        $this->setTitle(_text('Are You Sure?',''));
        $this->setInfo(_text('Delete Event Level [Form Info]',''));
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
