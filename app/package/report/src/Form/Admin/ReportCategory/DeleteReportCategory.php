<?php

namespace Neutron\Report\Form\Admin\ReportCategory;

use Phpfox\Form\Form;

class DeleteReportCategory extends Form
{

    /** id=320 */
    public function initialize()
    {

        $this->setTitle(_text('Are You Sure?', ''));
        $this->setInfo(_text('Delete Report Category [Info]', '_report'));
        $this->setAction(_url('#'));

        /** start elements **/

        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Delete'),
            'attributes' => ['class' => 'btn btn-danger', 'type' => 'submit',],
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
