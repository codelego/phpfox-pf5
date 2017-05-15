<?php

namespace Neutron\Contact\Form\Admin\ContactDepartment;

use Phpfox\Form\Form;

class EditContactDepartment extends Form
{

    /**
     * @var mixed
     */
    private $departmentId;

    public function initialize()
    {

        $this->setTitle(_text('Edit Department', '_contact.department'));
        $this->setInfo(_text('[Edit Department Info]', '_contact.department'));
        $this->setAction(_url('#'));

        /** start elements **/

        /** element `department_id` **/
        $this->addElement([
            'name'    => 'department_id',
            'factory' => 'hidden',
            'value'   => $this->getDepartmentId(),
        ]);

        /** element `name` **/
        $this->addElement([
            'name'     => 'name',
            'factory'  => 'text',
            'label'    => _text('Name', '_contact.department'),
            'required' => true,
        ]);

        /** element `email` **/
        $this->addElement([
            'name'     => 'email',
            'factory'  => 'text',
            'label'    => _text('Contact Email', '_contact.department'),
            'type'     => 'email',
            'required' => true,
        ]);

        /** element `is_active` **/
        $this->addElement([
            'name'     => 'is_active',
            'factory'  => 'yesno',
            'label'    => _text('Is Active', '_contact.department'),
            'info'     => _text('[Is Active Info]', '_contact.department'),
            'value'    => 1,
            'required' => true,
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
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }

    /**
     * @return mixed
     */
    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    /**
     * @param mixed $departmentId
     */
    public function setDepartmentId($departmentId)
    {
        $this->departmentId = $departmentId;
    }
}
