<?php
namespace Neutron\Core\Controller;

use Phpfox\Db\AdapterInterface;
use Phpfox\Mvc\StandardController;
use Phpfox\View\ViewModel;

class AdminPackageController extends StandardController
{
    public function actionIndex()
    {

        /** @var AdapterInterface $db */
        $db = \Phpfox::get('db');

        $packages = $db->select('*')
            ->from(':core_package')
            ->order('is_core, package_type', 1)
            ->execute()
            ->fetch();

        return new ViewModel('core.admin-package.index', [
            'items'=>$packages,
        ]);
    }
}