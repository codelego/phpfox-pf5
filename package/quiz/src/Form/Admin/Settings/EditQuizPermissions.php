<?php
namespace Neutron\Quiz\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditQuizPermissions extends Form {

    /** id=813 */
    public function initialize(){

        $this->setTitle(_text('Edit Permissions','_quiz'));
        $this->setInfo(_text('[Edit Permissions Info]','_quiz'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `quiz__add_quiz` id=3453 **/
            $this->addElement(array ( 'name' => 'quiz__add_quiz', 'factory' => 'yesno', 'label' => _text('Can Add Quiz','_quiz'), 'placeholder' => _text('Can Add Quiz','_quiz'), 'info' => _text('Can Add Quiz [Info]', '_quiz'), 'value' => '1', 'required' => true, ));        
        
            /** element `quiz__edit_quiz` id=3454 **/
            $this->addElement(array ( 'name' => 'quiz__edit_quiz', 'factory' => 'yesno', 'label' => _text('Can Edit Quiz','_quiz'), 'placeholder' => _text('Can Edit Quiz','_quiz'), 'info' => _text('Can Edit Quiz [Info]', '_quiz'), 'value' => '1', 'required' => true, ));        
        
            /** element `quiz__delete_quiz` id=3455 **/
            $this->addElement(array ( 'name' => 'quiz__delete_quiz', 'factory' => 'yesno', 'label' => _text('Can Delete Quiz','_quiz'), 'placeholder' => _text('Can Delete Quiz','_quiz'), 'info' => _text('Can Delete Quiz [Info]', '_quiz'), 'value' => '1', 'required' => true, ));        
        
            /** element `quiz__limit_quiz` id=3456 **/
            $this->addElement(array ( 'name' => 'quiz__limit_quiz', 'factory' => 'text', 'label' => _text('Limit Quiz','_quiz'), 'placeholder' => _text('Limit Quiz','_quiz'), 'info' => _text('Limit Quiz [Info]', '_quiz'), 'value' => '0', 'required' => true, ));        
        
            /** element `quiz__limit_question` id=3477 **/
            $this->addElement(array ( 'name' => 'quiz__limit_question', 'factory' => 'text', 'label' => _text('Limit Question','_quiz'), 'placeholder' => _text('Limit Question','_quiz'), 'info' => _text('Limit Question [Info]', '_quiz'), 'value' => '0', 'required' => true, ));        
        
            /** element `quiz__limit_answer` id=3478 **/
            $this->addElement(array ( 'name' => 'quiz__limit_answer', 'factory' => 'text', 'label' => _text('Limit Answer','_quiz'), 'placeholder' => _text('Limit Answer','_quiz'), 'info' => _text('Limit Answer [Info]', '_quiz'), 'value' => '0', 'required' => true, ));        
        
            /** element `quiz__approval` id=3457 **/
            $this->addElement(array ( 'name' => 'quiz__approval', 'factory' => 'yesno', 'label' => _text('Approval Process','_quiz'), 'placeholder' => _text('Approval Process','_quiz'), 'info' => _text('Approval Process [Info]', '_quiz'), 'value' => '0', 'required' => true, ));        
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
