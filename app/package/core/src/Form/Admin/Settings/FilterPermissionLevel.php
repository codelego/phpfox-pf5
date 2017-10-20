<?php

namespace Neutron\Core\Form\Admin\Settings;

use Neutron\Core\Model\AclForm;
use Phpfox\Form\Form;

class FilterPermissionLevel extends Form
{
    protected $model;

    /**
     * @return array
     */
    public function getLevelIdOptions()
    {
        return array_map(function ($v) {
            return [
                'value' => $v['level_id'],
                'label' => $v['title'],
                'note'  => $v['description'],
            ];
        }, \Phpfox::model($this->model)
            ->select()
            ->order('inherit_id', 1)
            ->setPrototype(null)
            ->all());
    }

    public function getFormIdOptions()
    {
        $select = \Phpfox::model('acl_form')
            ->select()
            ->where('accept_type=?', $this->model)
            ->orWhere('accept_type=?', '*')
            ->order('ordering', 1);

        return array_map(function (AclForm $aclForm) {
            return ['value' => $aclForm->getId(), 'label' => $aclForm->getTitle()];
        }, $select->all());
    }

    protected function initialize()
    {
        $this->setMethod('get');
        $this->setTitle('Select Levels');

        /** start elements **/

        /** element `domain_id` **/
        $levelOptions = $this->getLevelIdOptions();
        $levelValue = $levelOptions[0]['value'];

        $this->addElement([
            'name'     => 'level_id',
            'factory'  => 'select',
            'required' => true,
            'label'    => _text('Levels', null),
            'options'  => $levelOptions,
            'value'    => $levelValue,
            'onchange' => 'this.form.submit()',
        ]);

        /** element `domain_id` **/
        $formOptions = $this->getFormIdOptions();
        $formValue = $formOptions[0]['value'];

        $this->addElement([
            'name'     => 'form_id',
            'factory'  => 'select',
            'required' => true,
            'label'    => _text('Domain', null),
            'options'  => $formOptions,
            'value'    => $formValue,
            'onchange' => 'this.form.submit()',
        ]);
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }
}