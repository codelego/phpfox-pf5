<?php

namespace Neutron\Dev\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminManageSiteSettingsProcess;
use Neutron\Dev\Form\Admin\DevAction\EditDevAction;
use Neutron\Dev\Form\Admin\DevActionMeta\FilterDevActionMeta;
use Neutron\Dev\Model\DevAction;
use Neutron\Dev\Model\DevTable;
use Phpfox\Db\SqlSelect;
use Phpfox\View\ViewModel;

class AdminDevController extends AdminController
{

    protected function initialized()
    {
        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.mail'),
                'label' => _text('Rapid Development Tools', 'admin'),
            ]);

        _get('html.title')
            ->set(_text('Rapid Development Tools', 'admin'));

        _get('menu.admin.secondary')
            ->load('_dev');

        _get('menu.admin.buttons')
            ->load('_dev.buttons');
    }

    public function actionEditAction()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'meta_id',
            'model'    => DevAction::class,
            'form'     => EditDevAction::class,
            'redirect' => _url('admin.dev'),
        ]))->process();
    }

    public function actionSettings()
    {
        return (new AdminManageSiteSettingsProcess([
            'setting_group' => 'dev',
        ]))->process();
    }

    public function actionScan()
    {
        _get('dev.code_generator')
            ->scans();
        _redirect('admin.dev');
    }

    public function actionIndex()
    {
        $request = _get('request');
        $filter = new FilterDevActionMeta([]);

        $filter->populate($request->all());

        $filterData = $filter->getData();
        $selected = [];

        _get('registry')
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
                _get('dev.code_generator')->generateFromActionMetaIds($selected);
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
        ], 'dev/admin-dev/manage-dev-action');

    }
}