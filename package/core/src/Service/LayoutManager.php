<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\LayoutBlock;
use Neutron\Core\Model\LayoutContainer;
use Neutron\Core\Model\LayoutGrid;
use Neutron\Core\Model\LayoutLocation;
use Neutron\Core\Model\LayoutPage;
use Phpfox\Layout\Container;
use Phpfox\Layout\LoaderInterface;
use Phpfox\Layout\Location;
use Phpfox\Layout\Page;
use Phpfox\Model\ModelInterface;

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
            $row = \Phpfox::get('db')
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
            $row = \Phpfox::get('db')
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
        $layoutPage = \Phpfox::with('layout_page')
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
            $rows = \Phpfox::with('layout_page')
                ->select()
                ->where('is_active=?', 1)
                ->where('theme_id=?', $themeId)
                ->where('action_id IN ?', $actionIdList)
                ->all();

            foreach ($rows as $row) {
                $temp[$row->getActionId()] = $row->getId();
            }
            foreach ($actionIdList as $actionId) {
                if (isset($temp[$actionId]) and $temp[$actionId]) {
                    return $temp[$actionId];
                }
            }
        }

        /** @var LayoutPage $alternate */
        $alternate = \Phpfox::with('layout_page')
            ->select()
            ->where('theme_id=?', 'default')
            ->where('action_id=?', 'default')
            ->first();

        return $alternate->getId();
    }

    /**
     * @param LayoutContainer $container
     * @param bool            $activeOnly Active only ?
     *
     * @return Location[]
     */
    public function loadLayoutLocation($container, $activeOnly = false)
    {

        /** @var LayoutGrid $grid */
        $grid = \Phpfox::findById('layout_grid', $container->getGridId());

        $locationIds = json_decode($grid->getLocations(), true);

        /** @var Location[] $layoutLocations */
        $layoutLocations = [];

        foreach ($locationIds as $locationId) {
            $layoutLocations[$locationId] = new Location([
                'location_id'    => $locationId,
                'container_id'   => $container->getId(),
                'container_type' => $container->getTypeId(),
            ]);
        }

        /** @var LayoutLocation[] $containerLocations */
        $containerLocations = \Phpfox::with('layout_location')
            ->select()
            ->where('container_id=?', $container->getId())
            ->all();

        foreach ($containerLocations as $containerLocation) {
            $locationId = $containerLocation->getLocationId();

            if (!isset($layoutLocations[$locationId])) {
                continue;
            }
            $params = json_decode($containerLocation->getParams(), true);
            if (!empty($params)) {
                $layoutLocations[$locationId]->setParams($params);
            }
        }

        $selectBlocks = \Phpfox::get('db')
            ->select('blk.*, cmp.component_class, cmp.component_name')
            ->from(':layout_block', 'blk')
            ->join(':layout_component', 'cmp',
                'cmp.component_id=blk.component_id')
            ->where('blk.container_id=?', $container->getId())
            ->order('blk.location_id, blk.sort_order', 1);

        if ($activeOnly) {
            $selectBlocks->where('blk.is_active=?', 1);
        }

        foreach ($selectBlocks->all() as $block) {
            $locationId = $block['location_id'];
            if (!isset($layoutLocations[$locationId])) {
                continue;
            }

            $layoutLocations[$locationId]->addBlock([
                'element_id'     => $block['block_id'],
                'parent_id'      => $block['parent_id'],
                'location_id'    => $block['location_id'],
                'container_id'   => $block['container_id'],
                'sort_order'     => $block['sort_order'],
                'container_type' => $container->getTypeId(),
                'block_id'       => $block['block_id'],
                'block_name'     => $block['component_name'],
                'block_class'    => $block['component_class'],
                'is_active'      => $block['is_active'],
            ]);
        }

        return $layoutLocations;
    }

    /**
     * @param string $actionId
     * @param string $themeId
     *
     * @return Page
     */
    public function loadForRender($actionId, $themeId)
    {
        $pageId = $this->findPageIdForRender($actionId, $themeId);

        /** @var LayoutContainer[] $containers */
        $containers = \Phpfox::with('layout_container')
            ->select()
            ->where('page_id=?', $pageId)
            ->where('is_active=?', 1)
            ->order('sort_order', 1)
            ->all();


        $layoutPage = new Page($pageId, $actionId, $themeId);

        foreach ($containers as $container) {
            $params = array_merge(json_decode($container->getParams(), true), [
                'container_id' => $container->getId(),
                'type_id'      => $container->getTypeId(),
                'grid_id'      => $container->getGridId(),
            ]);
            $layoutContainer = new Container($params);

            /** @var Location[] $layoutLocations */
            $layoutLocations = $this->loadLayoutLocation($container, true);

            foreach ($layoutLocations as $layoutLocation) {
                $layoutContainer->addLocation($layoutLocation);
            }

            $layoutPage->addContainer($layoutContainer);
        }

        return $layoutPage;
    }

    /**
     * @param string $actionId
     * @param string $themeId
     *
     * @return Page
     */
    public function loadForEdit($actionId, $themeId)
    {
        $pageId = $this->findPageIdForEdit($actionId, $themeId);

        if (!$pageId) {
            return null;
        }

        /** @var LayoutContainer[] $containers */
        $containers = \Phpfox::with('layout_container')
            ->select()
            ->where('page_id=?', $pageId)
            ->order('sort_order', 1)
            ->all();

        $layoutPage = new Page($pageId, $actionId, $themeId);

        foreach ($containers as $container) {

            $params = array_merge(json_decode($container->getParams(), true), [
                'container_id' => $container->getId(),
                'type_id'      => $container->getTypeId(),
                'grid_id'      => $container->getGridId(),
            ]);
            $layoutContainer = new Container($params);

            /** @var Location[] $layoutLocations */
            $layoutLocations = $this->loadLayoutLocation($container, false);

            foreach ($layoutLocations as $layoutLocation) {
                $layoutContainer->addLocation($layoutLocation);
            }

            $layoutPage->addContainer($layoutContainer);
        }

        return $layoutPage;
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


        $db = \Phpfox::get('db');

        $db->begin();

        try {

            /** @var LayoutPage $page */
            $page = \Phpfox::with('layout_page')->findById($pageId);

            /** @var LayoutPage $newPage */
            $newPage = \Phpfox::with('layout_page')
                ->create(array_merge($page->toArray(), [
                    'page_id'   => null,
                    'action_id' => $actionId,
                    'theme_id'  => $themeId,
                ]));

            $newPage->save();

            /** @var LayoutContainer[] $containers */
            $containers
                = \Phpfox::with('layout_container')
                ->select()
                ->where('page_id=?', $pageId)
                ->all();

            foreach ($containers as $container) {
                /** @var LayoutContainer $newContainer */
                $newContainer = \Phpfox::with('layout_container')
                    ->create(array_merge($container->toArray(), [
                        'container_id' => null,
                        'page_id'      => $newPage->getId(),
                    ]));
                $newContainer->save();

                /** @var LayoutLocation[] $locations */
                $locations = \Phpfox::with('layout_location')
                    ->select()
                    ->where('container_id=?', $container->getId())
                    ->all();

                foreach ($locations as $location) {
                    /** @var LayoutLocation $newLocation */
                    $newLocation = \Phpfox::with('layout_location')
                        ->create(array_merge($location->toArray(), [
                            'container_id' => $newContainer->getId(),
                        ]));
                    $newLocation->save();
                }

                /** @var LayoutBlock[] $blocks */
                $blocks = \Phpfox::with('layout_block')
                    ->select()
                    ->where('container_id=?', $container->getId())
                    ->where('parent_id=?', 0)
                    ->all();

                foreach ($blocks as $block) {
                    /** @var LayoutBlock $block */
                    $newBlock = \Phpfox::with('layout_block')
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
        $theme = \Phpfox::with('layout_theme')
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
        }, \Phpfox::with('layout_grid')->select()->all());
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
     * @return array
     */
    public function getPageIdOptions()
    {
        $select = \Phpfox::with('layout_page')->select();

        return array_map(function (ModelInterface $v) {
            return [
                'label' => $v->__get('page_id'),
                'value' => $v->__get('page_id'),
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
        return \Phpfox::with('layout_page')->findById($pageId);
    }

    public function getComponentIdOptions()
    {
        $select = \Phpfox::with('layout_component')
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

        \Phpfox::with('layout_block')
            ->delete()
            ->where('container_id in ?', $containerIdList)
            ->execute();

        \Phpfox::with('layout_location')
            ->delete()
            ->where('container_id in ?', $containerIdList)
            ->execute();

        \Phpfox::with('layout_container')
            ->delete()
            ->where('container_id in ?', $containerIdList)
            ->execute();

    }
}