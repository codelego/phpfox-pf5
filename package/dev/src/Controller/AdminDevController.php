<?php

namespace Neutron\Dev\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Form\Admin\RapidDev\RadModelToolSettings;
use Neutron\Core\Process\AdminManageSiteSettingsProcess;
use Neutron\Dev\Form\Admin\DevActionMeta\FilterDevActionMeta;
use Neutron\Dev\Model\DevAction;
use Neutron\Dev\Model\DevTable;
use Phpfox\Db\SqlSelect;
use Phpfox\View\ViewModel;

class AdminDevController extends AdminController
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
            ->load('admin.dev');

        _service('menu.admin.buttons')
            ->load('admin.dev.buttons');
    }

    public function actionSettings()
    {
        return (new AdminManageSiteSettingsProcess([
            'setting_group' => 'dev',
        ]))->process();
    }

    public function actionScan()
    {
        _service('dev.code_generator')
            ->scans();
        _redirect('admin.dev');
    }

    public function actionIndex()
    {
        $request = _service('request');
        $filter = new FilterDevActionMeta([]);

        $filter->populate($request->all());

        $filterData = $filter->getData();
        $selected = [];

        _service('registry')
            ->set('search.filter', $filter);

        if ($request->isGet()) {

        } elseif ($request->isPost()) {

            $actions = $_POST['actions'];
            $selected = $_POST['selected'];

            /** @var DevAction[] $entries */
            $entries = _model('dev_action')
                ->select()
                ->where('meta_id in ?', array_keys($actions))
                ->all();
            foreach ($entries as $entry) {
                $entry->setActionId($actions[$entry->getId()]);
                $entry->save();
            }

            if (!empty($selected)) {
                _service('dev.code_generator')->generateFromActionMetaIds($selected);
            }


        }
        /** @var SqlSelect $select */
        $select = _model('dev_action')
            ->select()
            ->order('table_name, action_type', 1);

        if (!empty($filterData['package_id'])) {
            $select->where('package_id=?', $filterData['package_id']);
        } else {
            $select->where('package_id<>?', 'undefined');
        }

        if ($filterData['table_name']) {
            $select->where('table_name like ?', $filterData['table_name'] . '%');
        }

        if ($filterData['action_type']) {
            $select->where('action_type like ?', $filterData['action_type'] . '%');
        }

        /** @var DevTable[] $items */
        $items = $select->all();

        return new ViewModel([
            'items'    => $items,
            'selected' => $selected,
        ], 'dev/admin-dev/manage-action-meta');

    }

    public function actionMore()
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


    public function actionAddFormUserSettings()
    {

    }
}