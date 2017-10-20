<?php
namespace Neutron\Quiz\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditQuizSettings extends Form {

    /** id=788 */
    public function initialize(){

        $this->setTitle(_text('Edit Quiz Settings', '_quiz'));
        $this->setInfo(_text('Edit Quiz Settings [Info]', '_quiz'));
        $this->setMethod('post');         $this->setEncType('');         $this->setAction(_url('#'));

        /** start elements **/

        
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
