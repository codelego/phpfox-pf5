<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Model\ProfileQuestion;
use Neutron\Core\Model\ProfileSection;
use Neutron\User\Model\UserCatalog;
use Phpfox\View\ViewModel;

class AdminBasicProfileController extends AdminController
{
    /**
     * @var string
     */
    protected $itemType = 'user';

    /**
     * @var string
     */
    protected $catalogModel = 'user_catalog';


    /**
     * list profile type
     */
    public function actionAttribute()
    {
        $items = _get('core.profile')
            ->getProfileAttributes($this->itemType);

        _get('require_js')
            ->deps('package/core/table-sortable');

        return new ViewModel([
            'items'      => $items,
            'item_type'  => 'user',
            'catalog_id' => 0,
        ], 'core/admin-profile/manage-profile-attribute');
    }

    /**
     * list profile type
     */
    public function actionCatalog()
    {
        $items = _model($this->catalogModel)
            ->select()
            ->order('ordering', 1)
            ->all();

        _get('require_js')
            ->deps('package/core/table-sortable');

        return new ViewModel([
            'items'      => $items,
            'item_type'  => 'user',
            'catalog_id' => 0,
        ], 'core/admin-profile/manage-profile-type');
    }

    public function actionSection()
    {
        $items = _get('core.profile')
            ->getProfileSections($this->itemType);

        _get('require_js')
            ->deps('package/core/table-sortable');

        return new ViewModel([
            'items'      => $items,
            'item_type'  => 'user',
            'catalog_id' => 0,
        ], 'core/admin-profile/manage-profile-section');
    }

    public function actionIndex()
    {
        /** @var ProfileQuestion[] $items */
        $items = _get('core.profile')
            ->getProfileQuestions($this->itemType, 0);

        _get('require_js')
            ->deps('package/core/table-sortable');

        return new ViewModel([
            'items'      => $items,
            'item_type'  => 'user',
            'catalog_id' => 0,
        ], 'core/admin-profile/manage-profile-question');

    }


    public function actionUpdateSectionOrdering()
    {
        /** @var array $ordering */
        $ordering = _get('request')->get('ordering');

        foreach ($ordering as $index => $value) {
            /** @var ProfileSection $entry */
            $entry = _model('profile_section')->findById($value);

            if ($entry) {
                $entry->setOrdering((int)$index + 1);
                $entry->save();
            }
        }
    }

    public function actionUpdateQuestionOrdering()
    {
        /** @var array $ordering */
        $ordering = _get('request')->get('ordering');

        foreach ($ordering as $index => $value) {
            /** @var ProfileQuestion $entry */
            $entry = _model('profile_question')->findById($value);

            if ($entry) {
                $entry->setOrdering((int)$index + 1);
                $entry->save();
            }
        }
    }

    public function actionUpdateCatalogOrdering()
    {
        /** @var array $ordering */
        $ordering = _get('request')->get('ordering');

        foreach ($ordering as $index => $value) {
            /** @var UserCatalog $entry */
            $entry = _model($this->catalogModel)->findById($value);

            if ($entry) {
                $entry->setOrdering((int)$index + 1);
                $entry->save();
            }
        }
    }
}