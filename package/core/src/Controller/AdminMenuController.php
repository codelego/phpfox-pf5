<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\CoreMenuItem\AddCoreMenuItem;
use Neutron\Core\Form\Admin\CoreMenuItem\EditCoreMenuItem;
use Neutron\Core\Model\CoreMenuItem;
use Phpfox\Navigation\Navigation;
use Phpfox\View\ViewModel;

class AdminMenuController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Menus', '_core'));

        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.menu'),
                'label' => _text('Menus', '_core'),
            ]);

        _get('menu.admin.secondary')->load('admin', 'appearance');
    }

    public function actionIndex()
    {
        $items = _model('core_menu')
            ->select()
            ->where('is_admin=?', 0)
            ->where('package_id in ?', _get('package.loader')->getActivePackageIds())
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-menu/manage-menu');
    }

    public function actionUpdateOrdering()
    {
        $request = _get('request');
        $ordering = $request->get('ordering');
        $keys = array_map(function ($v) {
            return (int)substr($v, 1);
        }, array_keys($ordering));

        if (empty($keys)) {
            return '';
        }

        /** @var CoreMenuItem[] $items */
        $items = _model('core_menu_item')
            ->select()
            ->where('id in ?', $keys)
            ->all();

        foreach ($items as $item) {
            $value = $ordering['_' . $item->getId()];
            $item->setOrdering($value['ordering']);
            $item->setParentName($value['parent']);
            $item->save();
        }
        _trigger('onSettingChanges');
    }

    public function actionEditItem()
    {
        $request = _get('request');
        $itemId = $request->get('item_id');

        /** @var CoreMenuItem $menuItem */
        $menuItem = _model('core_menu_item')
            ->findById($itemId);

        $form = new EditCoreMenuItem();

        if ($request->isGet()) {
            $form->populate($menuItem);
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $menuItem->fromArray($form->getData());
            $menuItem->save();

            _redirect('admin.core.menu', ['action' => 'edit', 'menu_id' => $menuItem->getMenuId()]);
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionAddItem()
    {
        $form = new AddCoreMenuItem([]);
        $request = _get('request');
        $menuId = $request->get('menu_id');

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();
            $data['name'] = substr(_keyize($data['label']), 0, 32) . '_' . mt_rand(1, 100);
            $entry = new CoreMenuItem($data);

            $entry->fromArray([
                'menu_id'     => $menuId,
                'ordering'    => 100,
                'parent_name' => '',
                'params'      => '[]',
                'extra'       => '[]',
            ]);
            $entry->save();
            _redirect('admin.core.menu', ['action' => 'edit', 'menu_id' => $menuId]);
        }

        return new ViewModel(['form' => $form], 'layout/form-edit');
    }

    public function actionDeleteItem()
    {
        $request = _get('request');
        $itemId = $request->get('item_id');

        /** @var CoreMenuItem $menuItem */
        $menuItem = _model('core_menu_item')
            ->findById($itemId);

        if (!$menuItem) {
            exit(1);
        }

        $hasChildren = _model('core_menu_item')
                ->select()
                ->where('menu_id=?', $menuItem->getMenuId())
                ->where('parent_name=?', $menuItem->getName())
                ->count() > 0;

        if ($hasChildren) {
            exit(1);
        }

        if ($menuItem->isCustom()) {
            $menuItem->delete();
        } else {
            $menuItem->setActive(0);
            $menuItem->save();
        }

        exit(1);
    }


    public function actionEdit()
    {

        $request = _get('request');
        $menuId = $request->get('menu_id');
        $data = [];
        $items = _get('db')
            ->select('*')
            ->from(':core_menu_item')
            ->where('menu_id=?', trim($menuId))
            ->order('ordering', 1)
            ->all();

        array_walk($items, function ($row) use (&$data) {
            $data[$row['name']] = [
                'id'         => $row['id'],
                'params'     => (array)json_decode($row['params'], 1),
                'label'      => $row['label'],
                'ordering'   => $row['ordering'],
                'name'       => $row['name'],
                'parent'     => $row['parent_name'],
                'extra'      => (array)json_decode($row['extra'], 1),
                'href'       => $row['href'],
                'permission' => $row['permission'],
                'enable'     => $row['is_active'],
                'event'      => $row['is_active'],
                'custom'     => $row['is_custom'],
                'type'       => $row['item_type'],
                'route'      => $row['route'],
            ];
        });

        $navigation = new Navigation();
        $navigation->setData($data);

        $menuContent = $navigation->render('edit');

        _get('require_js')
            ->deps('package/core/menu-editor');

        _get('menu.admin.buttons')->clear()->add([
            'label' => _text('Add Item', '_core.menu'),
            'href'  => _url('admin.core.menu', ['action' => 'add-item', 'menu_id' => $menuId]),
            'extra' => ['class' => 'btn btn-danger', 'data-cmd' => 'modal'],
        ]);

        return new ViewModel([
            'menuContent' => $menuContent,
        ], 'core/admin-menu/edit-menu');
    }
}