<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\RapidDev\RadModelToolSettings;
use Phpfox\Form\Form;
use Phpfox\RapidDev\FormAdminAddGenerator;
use Phpfox\RapidDev\FormAdminEditGenerator;
use Phpfox\RapidDev\FormAdminFilterGenerator;
use Phpfox\RapidDev\ModelGenerator;
use Phpfox\View\ViewModel;

class AdminRadController extends AdminController
{

    protected function initialized()
    {
        _service('breadcrumb')
            ->set([
                'href'  => _url('admin.core.mail'),
                'label' => _text('Rapid Development Tools', 'admin'),
            ]);

        _service('html.title')
            ->set(_text('Rapid Development Tools', 'admin'));

        _service('menu.admin.secondary')
            ->load('admin.core.rad');
    }

    public function actionIndex()
    {
        $methodMaps = [
            'form_admin_add'    => 'generateFormAdminAdd',
            'form_admin_edit'   => 'generateFormAdminEdit',
            'form_admin_delete' => 'generateFormAdminDelete',
            'form_admin_filter' => 'generateFormAdminFilter',
            'model'             => 'generateModel',
        ];
        $req = _service('request');

        $form = new RadModelToolSettings([]);

        if ($req->isGet()) {

        }
        if ($req->isPost() and $form->isValid($req->all())) {
            $data = $form->getData();
            $packageId = $data['package_id'];
            $tables = $data['tables'];
            $cmds = $data['cmds'];
            $textDomain = $data['text_domain'];

            foreach ($tables as $table) {
                foreach ($cmds as $cmd) {
                    if (method_exists($this, $method = $methodMaps[$cmd])) {
                        $this->{$method}($form, $packageId, $table, $textDomain);
                    }
                }
            }

        }


        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    /**
     * @param Form   $form
     * @param string $packageId
     * @param string $tableName
     * @param string $textDomain
     */
    public function generateFormAdminAdd(Form $form, $packageId, $tableName, $textDomain = null)
    {
        if ($form) {
            ;
        }
        $formGenerator = new FormAdminAddGenerator([
            'packageId'  => $packageId,
            'tableName'  => $tableName,
            'textDomain' => $textDomain,
        ]);

        $formGenerator->process();
    }

    /**
     * @param Form   $form
     * @param string $packageId
     * @param string $tableName
     * @param string $textDomain
     */
    public function generateFormAdminFilter(Form $form, $packageId, $tableName, $textDomain = null)
    {
        if ($form) {
            ;
        }
        $formGenerator = new FormAdminFilterGenerator([
            'packageId'  => $packageId,
            'tableName'  => $tableName,
            'textDomain' => $textDomain,
            'noLabel'    => false,
            'noNote'     => true,
            'noRequire'  => true,
            'noInfo'     => true,
            'noWrap'     => false,
            'noTextarea' => true,
            'noRadio'    => true,
            'shortLabel' => true,
            'skips'      => [
                'content',
                'title',
                'name',
                'description',
                'message_value',
                'message_id',
            ],
        ]);

        $formGenerator->process();
    }

    /**
     * @param Form   $form
     * @param string $packageId
     * @param string $tableName
     * @param string $textDomain
     */
    public function generateFormAdminEdit(Form $form, $packageId, $tableName, $textDomain)
    {
        if ($form) {
            ;
        }
        $formGenerator = new FormAdminEditGenerator([
            'packageId'  => $packageId,
            'tableName'  => $tableName,
            'textDomain' => $textDomain,
        ]);

        $formGenerator->process();
    }


    /**
     * @param Form $form
     * @param      $tableName
     * @param      $packageId
     *
     * @return bool
     */
    protected function generateModel(Form $form, $packageId, $tableName, $textDomain = null)
    {
        $generator = new ModelGenerator([
            'packageId'  => $packageId,
            'tableName'  => $tableName,
            'textDomain' => $textDomain,
        ]);

        $result = $generator->process();

        $form->addElement([
            'factory'    => 'textarea',
            'name'       => 'model_config',
            'value'      => $result['configCode'],
            'label'      => 'Model Config',
            'info'       => 'put this code to `' . ($result['configPath']) . '`',
            'attributes' => [
                'class'    => 'form-control',
                'readonly' => true,
                'onclick'  => 'this.select()',
                'rows'     => 7,
            ],
        ]);
        return true;
    }


    public function actionAddFormUserSettings()
    {

    }
}