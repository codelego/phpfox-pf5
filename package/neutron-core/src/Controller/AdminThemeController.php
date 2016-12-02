<?php

namespace Neutron\Core\Controller;


use Phpfox\Db\AdapterInterface;
use Phpfox\Mvc\StandardController;
use Phpfox\View\ViewModel;

class AdminThemeController extends StandardController
{
    public function actionIndex()
    {
        // list of themes
        /** @var AdapterInterface $db */
        $db = \Phpfox::get('db');

        $themes = $db->select('*')
            ->from(':core_package')
            ->where('package_type=?','10')
            ->execute()->fetch();

        return new ViewModel('core.admin-theme.index', [
            'items' => $themes,
        ]);
    }
}