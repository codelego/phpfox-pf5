<?php

namespace Neutron\Report\Form\Admin\ReportCategory;

use Phpfox\Form\Form;

class EditReportCategory extends Form
{

    /** id=210 */
    public function initialize()
    {

        $this->setTitle(_text('Edit Report Category', '_report'));
        $this->setInfo(_text('Edit Report Category [Info]', '_report'));
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `name` id=3164 **/
        $this->addElement([
            'name'        => 'name',
            'factory'     => 'text',
            'label'       => _text('Category Name', '_report'),
            'placeholder' => _text('Category Name', '_report'),
            'info'        => _text('Category Name [Info]', '_report'),
            'maxlength'   => 100,
            'required'    => true,
        ]);

        /** element `description` id=3165 **/
        $this->addElement([
            'name'        => 'description',
            'factory'     => 'textarea',
            'label'       => _text('Category Description', '_report'),
            'placeholder' => _text('Category Description', '_report'),
            'info'        => _text('Category Description [Info]', '_report'),
        ]);
        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Submit'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        /** element `is_active` id=3163 **/
        $this->addElement([
            'name'     => 'is_active',
            'factory'  => 'yesno',
            'label'    => _text('Is Active', '_report'),
            'info'     => _text('Is Active [Info]', '_report'),
            'value'    => '0',
            'required' => true,
        ]);


        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => _url('admin.report.category'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
