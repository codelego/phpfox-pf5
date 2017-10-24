<?php
/**
 * @author  OvalSky
 * @license phpfox.com
 */

namespace Neutron\Report\Form\Admin\ReportItem;


use Phpfox\Form\Form;

class DeleteReportItem extends Form
{
    /** id=249 */
    public function initialize()
    {

        $this->setTitle(_text('Are You Sure?', ''));
        $this->setInfo(_text('Delete Report Item [Info]', '_report'));
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
            'href'       => _url('admin.report.manage'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}