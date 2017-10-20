<?php

namespace Neutron\Marketplace\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Marketplace\Form\Admin\MarketplaceCategory\AddMarketplaceCategory;
use Neutron\Marketplace\Form\Admin\MarketplaceCategory\DeleteMarketplaceCategory;
use Neutron\Marketplace\Form\Admin\MarketplaceCategory\EditMarketplaceCategory;
use Neutron\Marketplace\Model\MarketplaceCategory;

class AdminCategoryController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')
            ->set(_text('Marketplace'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.marketplace'), 'label' => _text('Marketplace')]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'marketplace');

    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => MarketplaceCategory::class,
            'template' => 'marketplace/admin/manage-category',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => MarketplaceCategory::class,
            'form'     => AddMarketplaceCategory::class,
            'redirect' => _url('admin.marketplace.category'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'category_id',
            'model'    => MarketplaceCategory::class,
            'form'     => EditMarketplaceCategory::class,
            'redirect' => _url('admin.marketplace.category'),
        ]))->process();
    }

    public function actionDelete()
    {

        return (new AdminEditEntryProcess([
            'key'      => 'category_id',
            'model'    => MarketplaceCategory::class,
            'form'     => DeleteMarketplaceCategory::class,
            'redirect' => _url('admin.marketplace.category'),
        ]))->process();
    }
}