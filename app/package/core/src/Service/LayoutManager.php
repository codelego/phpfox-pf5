<?php

namespace Neutron\Core\Service;

use Neutron\Core\Model\LayoutBlock;
use Neutron\Core\Model\LayoutContainer;
use Neutron\Core\Model\LayoutGrid;
use Neutron\Core\Model\LayoutLocation;
use Neutron\Core\Model\LayoutPage;
use Phpfox\Model\ModelInterface;
use Phpfox\View\Container;
use Phpfox\View\LayoutContent;
use Phpfox\View\LoaderInterface;

class LayoutManager implements LoaderInterface
{
    /**
     * @param string $themeId
     *
     * @return array
     */
    public function findAcceptableThemeId($themeId)
    {
        $result = [$themeId];
        $limit = 5;

        do {
            $row = _get('db')
                ->select('parent_id')
                ->from(':layout_theme')
                ->where('theme_id=?', $themeId)
                ->first();

            if ($row and $row['parent_id']) {
                $result[] = $themeId = $row['parent_id'];
            }

        } while (!empty($row) and --$limit > 0);

        $result[] = 'default';

        return array_unique($result);
    }

    /**
     * @param string $actionId
     *
     * @return array
     */
    public function findAcceptableActionId($actionId)
    {
        $result = [$actionId];
        $limit = 5;

        do {
            $row = _get('db')
                ->select('parent_action_id')
                ->from(':layout_action')
                ->where('action_id=?', $actionId)
                ->first();

            if ($row and $row['parent_action_id']) {
                $result[] = $actionId = $row['parent_action_id'];
            }

        } while (!empty($row) and --$limit > 0);

        $result[] = 'default';

        return array_unique($result);
    }

    /**
     * @param string $actionId
     * @param string $themeId
     *
     * @return int
     */
    public function findPageIdForEdit($actionId, $themeId)
    {
        /** @var LayoutPage $layoutPage */
        $layoutPage = _model('layout_page')
            ->select()
            ->where('theme_id=?', $themeId)
            ->where('action_id =?', $actionId)
            ->first();

        if ($layoutPage) {
            return $layoutPage->getId();
        }

        return 0;
    }

    /**
     * @param string $actionId
     * @param string $themeId
     *
     * @return int|null
     */
    public function findPageIdForRender($actionId, $themeId)
    {
        $actionIdList = $this->findAcceptableActionId($actionId);
        $themeIdList = $this->findAcceptableThemeId($themeId);

        foreach ($themeIdList as $themeId) {
            $temp = [];
            /** @var LayoutPage[] $rows */
            $rows = _model('layout_page')
                ->select()
                ->where('is_active=?', 1)
                ->where('theme_id=?', $themeId)
                ->where('action_id IN ?', $actionIdList)
                ->all();

            array_walk($rows, function (LayoutPage $page) use (&$temp) {
                $temp[$page->getActionId()] = $page->getId();
            });

            foreach ($actionIdList as $actionId) {
                if (isset($temp[$actionId]) and $temp[$actionId]) {
                    return $temp[$actionId];
                }
            }
        }

        /** @var LayoutPage $alternate */
        $alternate = _model('layout_page')
            ->select()
            ->where('theme_id=?', 'default')
            ->where('action_id=?', 'default')
            ->first();

        return $alternate->getId();
    }

    /**
     * @param string  $pageId
     * @param boolean $activeOnly
     *
     * @return LayoutContent
     */
    public function loadPageDataById($pageId, $activeOnly)
    {
        $page = new LayoutContent($pageId);

        /** @var LayoutContainer[] $layoutContainers */
        $layoutContainers = _model('layout_container')
            ->select()
            ->where('page_id=?', $pageId)
            ->whereIf($activeOnly, 'is_active=?', 1)
            ->order('ordering', 1)
            ->all();

        foreach ($layoutContainers as $layoutContainer) {
            $params = (array)json_decode($layoutContainer->getParams(), true);
            $container = new Container(array_merge($params, [
                'container_id' => $layoutContainer->getId(),
                'type_id'      => $layoutContainer->getTypeId(),
                'grid_id'      => $layoutContainer->getGridId(),
            ]));

            /** @var LayoutGrid $grid */
            $grid = _find('layout_grid', $layoutContainer->getGridId());

            $locationIds = json_decode($grid->getLocations(), true);

            foreach ($locationIds as $locationId => $locationName) {
                $container->addLocation($locationId, [
                    'location_id'    => $locationId,
                    'location_name'  => $locationName,
                    'container_id'   => $layoutContainer->getId(),
                    'container_type' => $layoutContainer->getTypeId(),
                ]);
            }

            /** @var LayoutLocation[] $containerLocations */
            $containerLocations = _model('layout_location')
                ->select()
                ->where('container_id=?', $layoutContainer->getId())
                ->all();

            foreach ($containerLocations as $containerLocation) {
                $params = (array)json_decode($containerLocation->getParams(), true);
                $container->mergeLocation($containerLocation->getLocationId(),
                    $params);
            }

            $selectBlocks = _get('db')
                ->select('blk.*, cmp.component_class, cmp.component_name')
                ->from(':layout_block', 'blk')
                ->join(':layout_component', 'cmp',
                    'cmp.component_id=blk.component_id')
                ->where('blk.container_id=?', $layoutContainer->getId())
                ->whereIf($activeOnly, 'blk.is_active=?', 1)
                ->order('blk.location_id, blk.ordering', 1);


            foreach ($selectBlocks->all() as $block) {
                $container->addBlock($block['location_id'], [
                    'block_id'       => $block['block_id'],
                    'parent_id'      => $block['parent_id'],
                    'location_id'    => $block['location_id'],
                    'container_id'   => $block['container_id'],
                    'ordering'       => $block['ordering'],
                    'container_type' => $layoutContainer->getTypeId(),
                    'block_name'     => $block['component_name'],
                    'block_class'    => $block['component_class'],
                    'is_active'      => $block['is_active'],
                ]);
            }

            $page->addContainer($container);
        }
        return $page;
    }

    /**
     * @param string $actionId
     * @param string $themeId
     *
     * @return LayoutContent
     */
    public function loadForRender($actionId, $themeId)
    {
        $pageId = $this->findPageIdForRender($actionId, $themeId);

        $page = _try('shared.cache', ['layouts', 'loadForRender', $pageId], 0,
            function () use ($pageId) {
                return $this->loadPageDataById($pageId, $activeOnly = true);
            });

        if (!$page instanceof LayoutContent) {
            return new LayoutContent(0);
        }

        return $page;
    }

    /**
     * @param string $actionId
     * @param string $themeId
     *
     * @return LayoutContent
     */
    public function loadForEdit($actionId, $themeId)
    {
        $pageId = $this->findPageIdForEdit($actionId, $themeId);

        if (!$pageId) {
            return null;
        }

        return $this->loadPageDataById($pageId, $activeOnly = false);
    }

    /**
     * Clone a parent page to child page with all its children
     *
     * @param string $actionId
     * @param string $themeId
     *
     * @return int  Get new page id
     */
    public function clonePage($actionId, $themeId)
    {
        // find container map
        $pageId = $this->findPageIdForRender($actionId, $themeId);

        $db = _get('db');

        $db->begin();

        try {
            /** @var LayoutPage $page */
            $page = _model('layout_page')->findById($pageId);

            /** @var LayoutPage $newPage */
            $newPage = _model('layout_page')
                ->create(array_merge($page->toArray(), [
                    'page_id'   => null,
                    'action_id' => $actionId,
                    'theme_id'  => $themeId,
                ]));

            $newPage->save();

            /** @var LayoutContainer[] $containers */
            $containers
                = _model('layout_container')
                ->select()
                ->where('page_id=?', $pageId)
                ->all();

            foreach ($containers as $container) {
                /** @var LayoutContainer $newContainer */
                $newContainer = _model('layout_container')
                    ->create(array_merge($container->toArray(), [
                        'container_id' => null,
                        'page_id'      => $newPage->getId(),
                    ]));
                $newContainer->save();

                /** @var LayoutLocation[] $locations */
                $locations = _model('layout_location')
                    ->select()
                    ->where('container_id=?', $container->getId())
                    ->all();

                foreach ($locations as $location) {
                    /** @var LayoutLocation $newLocation */
                    $newLocation = _model('layout_location')
                        ->create(array_merge($location->toArray(), [
                            'container_id' => $newContainer->getId(),
                        ]));
                    $newLocation->save();
                }

                /** @var LayoutBlock[] $blocks */
                $blocks = _model('layout_block')
                    ->select()
                    ->where('container_id=?', $container->getId())
                    ->where('parent_id=?', 0)
                    ->all();

                foreach ($blocks as $block) {
                    /** @var LayoutBlock $block */
                    $newBlock = _model('layout_block')
                        ->create(array_merge($block->toArray(), [
                            'block_id'     => null,
                            'parent_id'    => 0,
                            'container_id' => $newContainer->getId(),
                        ]));
                    $newBlock->save();
                }


            }
            $db->commit();
            return true;
        } catch (\Exception $ex) {
            $db->rollback();
        }
        return false;
    }

    /**
     * Get editing theme id
     *
     * @return string
     */
    public function getEditingThemeId()
    {
        $theme = _model('layout_theme')
            ->select()
            ->where('is_editing=?', 1)
            ->first();

        if (!empty($theme)) {
            return $theme->getId();
        }

        return 'default';
    }

    /**
     * @return array
     */
    public function getGridIdOptions()
    {
        return array_map(function (ModelInterface $v) {
            return [
                'label' => $v->__get('title'),
                'value' => $v->__get('grid_id'),
                'note'  => $v->__get('description'),
            ];
        }, _model('layout_grid')->select()->all());
    }


    /**
     * @return array
     */
    public function getContainerTypeIdOptions()
    {
        return [
            ['value' => 'container', 'label' => 'Container',],
            ['value' => 'container-fluid', 'label' => 'Container Fluid',],
        ];
    }

    /**
     * @param array $excludes
     *
     * @return array
     */
    public function getActionIdOptions($excludes = [])
    {
        $select = _model('layout_action')->select();

        if (!empty($excludes)) {
            $select->where('action_id not in ?', $excludes);
        }

        return array_map(function (ModelInterface $v) {
            return [
                'label' => $v->__get('action_id'),
                'value' => $v->__get('action_id'),
            ];
        }, $select->all());
    }

    /**
     * @param mixed $pageId
     *
     * @return LayoutPage
     */
    public function findPageById($pageId)
    {
        return _model('layout_page')->findById($pageId);
    }

    public function getComponentIdOptions()
    {
        $select = _model('layout_component')
            ->select()
            ->where('is_active=?', 1)
            ->order('package_id,component_name', 1);

        return array_map(function (ModelInterface $v) {
            return [
                'label' => $v->__get('component_name'),
                'value' => $v->__get('component_id'),
                'note'  => $v->__get('description'),
            ];
        }, $select->all());
    }

    /**
     * @param array $containerIdList
     */
    public function deleteContainers($containerIdList)
    {

        if (empty($containerIdList)) {
            return;
        }

        _model('layout_block')
            ->delete()
            ->where('container_id in ?', $containerIdList)
            ->execute();

        _model('layout_location')
            ->delete()
            ->where('container_id in ?', $containerIdList)
            ->execute();

        _model('layout_container')
            ->delete()
            ->where('container_id in ?', $containerIdList)
            ->execute();

    }
}