<?php

namespace Neutron\Core\Controller;


use Phpfox\Db\DbAdapterInterface;
use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class AdminThemeController extends ActionController
{
    public function actionIndex()
    {
        // list of themes
        /** @var DbAdapterInterface $db */
        $db = \Phpfox::get('db');

        $themes = $db->select('*')
            ->from(':core_package')
            ->where('package_type>=?', 32)
            ->execute()->all();

        return new ViewModel('core.admin-theme.index', [
            'items' => $themes,
        ]);
    }
}