<?php
namespace Neutron\Core\Controller;

use Phpfox\Db\DbAdapterInterface;
use Phpfox\Mvc\MvcController;
use Phpfox\View\ViewModel;

class AdminPackageController extends MvcController
{
    public function actionIndex()
    {

        /** @var DbAdapterInterface $db */
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