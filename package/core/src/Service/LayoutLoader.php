<?php

namespace Neutron\Core\Service;


use Phpfox\Layout\LayoutBlock;
use Phpfox\Layout\LayoutContainer;
use Phpfox\Layout\LayoutLoaderInterface;
use Phpfox\Layout\LayoutLocation;
use Phpfox\Layout\LayoutPage;
use Phpfox\Model\ModelInterface;

class LayoutLoader implements LayoutLoaderInterface
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
        /** @var \Neutron\Core\Model\LayoutPage $layoutPage */
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

            /** @var \Neutron\Core\Model\LayoutPage[] $rows */
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

        /** @var \Neutron\Core\Model\LayoutPage $alternate */
        $alternate = \Phpfox::with('layout_page')
            ->select()
            ->where('theme_id=?', 'default')
            ->where('action_id=?', 'default')
            ->first();

        return $alternate->getId();
    }

    /**
     * @param string $gridId
     *
     * @return LayoutLocation[]
     */
    public function loadLayoutLocationByGridId($gridId)
    {
        $grid = \Phpfox::with('layout_grid')->findById($gridId);

        $locations = json_decode($grid->getLocations(), true);

        /** @var LayoutLocation[] $result */
        $result = [];

        foreach ($locations as $location) {
            $result[$location]
                = new LayoutLocation($location);
        }

        return $result;
    }

    /**
     * @param string $id         Container Id
     * @param string $gridId     Grid Id
     * @param bool   $activeOnly Active only ?
     *
     * @return LayoutLocation[]
     */
    public function loadLayoutLocation($id, $gridId, $activeOnly = false)
    {

        $layoutLocations = $this->loadLayoutLocationByGridId($gridId);

        /** @var \Neutron\Core\Model\LayoutLocation[] $containerLocations */
        $containerLocations = \Phpfox::with('layout_location')
            ->select()
            ->where('container_id=?', $id)
            ->all();

        foreach ($containerLocations as $containerLocation) {
            $locationId = $containerLocation->getLocationId();

            if (!isset($layoutLocations[$locationId])) {
                continue;
            }
            $layoutLocations[$locationId]->setParams(json_decode($containerLocation->getParams(),
                true));
        }

        $selectBlocks = \Phpfox::get('db')
            ->select('blk.*, cmp.component_class, cmp.component_name')
            ->from(':layout_block', 'blk')
            ->join(':layout_component', 'cmp',
                'cmp.component_id=blk.component_id')
            ->where('blk.container_id=?', $id)
            ->order('blk.location_id, blk.sort_order', 1);

        if ($activeOnly) {
            $selectBlocks->where('blk.is_active=?', 1);
        }

        foreach ($selectBlocks->all() as $block) {
            $locationId = $block['location_id'];
            if (!isset($layoutLocations[$locationId])) {
                continue;
            }

            $layoutLocations[$locationId]->addBlock(new LayoutBlock([
                'element_id'  => $block['block_id'],
                'parent_id'   => $block['parent_id'],
                'location_id' => $block['location_id'],
                'block_id'    => $block['block_id'],
                'block_name'  => $block['component_name'],
                'block_class' => $block['component_class'],
                'is_active'   => $block['is_active'],
            ]));
        }

        return $layoutLocations;
    }

    /**
     * @param string $actionId
     * @param string $themeId
     *
     * @return LayoutPage
     */
    public function loadForRender($actionId, $themeId)
    {
        $pageId = $this->findPageIdForRender($actionId, $themeId);

        /** @var \Neutron\Core\Model\LayoutContainer[] $containers */
        $containers = \Phpfox::with('layout_container')
            ->select()
            ->where('page_id=?', $pageId)
            ->where('is_active=?', 1)
            ->order('sort_order', 1)
            ->all();

        $layoutPage = new LayoutPage($pageId, $actionId, $themeId);

        foreach ($containers as $container) {
            $layoutContainer = new LayoutContainer($container->getId(),
                $container->getTypeId(), $container->getGridId(),
                json_decode($container->getParams(), true));

            /** @var LayoutLocation[] $layoutLocations */
            $layoutLocations
                = $this->loadLayoutLocation($container->getId(),
                $container->getGridId(), true);

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
     * @return LayoutPage
     */
    public function loadForEdit($actionId, $themeId)
    {
        $pageId = $this->findPageIdForEdit($actionId, $themeId);

        if (!$pageId) {
            return null;
        }

        /** @var \Neutron\Core\Model\LayoutContainer[] $containers */
        $containers = \Phpfox::with('layout_container')
            ->select()
            ->where('page_id=?', $pageId)
            ->order('sort_order', 1)
            ->all();

        $layoutPage = new LayoutPage($pageId, $actionId, $themeId);

        foreach ($containers as $container) {
            $layoutContainer = new LayoutContainer($container->getId(),
                $container->getTypeId(), $container->getGridId(),
                json_decode($container->getParams(), true));

            /** @var LayoutLocation[] $layoutLocations */
            $layoutLocations
                = $this->loadLayoutLocation($container->getId(),
                $container->getGridId(), false);

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

            /** @var \Neutron\Core\Model\LayoutPage $page */
            $page = \Phpfox::with('layout_page')->findById($pageId);

            /** @var \Neutron\Core\Model\LayoutPage $newPage */
            $newPage = \Phpfox::with('layout_page')
                ->create(array_merge($page->toArray(), [
                    'page_id'   => null,
                    'action_id' => $actionId,
                    'theme_id'  => $themeId,
                ]));

            $newPage->save();

            /** @var \Neutron\Core\Model\LayoutContainer[] $containers */
            $containers
                = \Phpfox::with('layout_container')
                ->select()
                ->where('page_id=?', $pageId)
                ->all();

            foreach ($containers as $container) {
                /** @var \Neutron\Core\Model\LayoutContainer $newContainer */
                $newContainer = \Phpfox::with('layout_container')
                    ->create(array_merge($container->toArray(), [
                        'container_id' => null,
                        'page_id'      => $newPage->getId(),
                    ]));
                $newContainer->save();

                /** @var \Neutron\Core\Model\LayoutLocation[] $locations */
                $locations = \Phpfox::with('layout_location')
                    ->select()
                    ->where('container_id=?', $container->getId())
                    ->all();

                foreach ($locations as $location) {
                    /** @var \Neutron\Core\Model\LayoutLocation $newLocation */
                    $newLocation = \Phpfox::with('layout_location')
                        ->create(array_merge($location->toArray(), [
                            'container_id' => $newContainer->getId(),
                        ]));
                    $newLocation->save();
                }

                /** @var \Neutron\Core\Model\LayoutBlock[] $blocks */
                $blocks = \Phpfox::with('layout_block')
                    ->select()
                    ->where('container_id=?', $container->getId())
                    ->where('parent_id=?', 0)
                    ->all();

                foreach ($blocks as $block) {
                    /** @var \Neutron\Core\Model\LayoutBlock $block */
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
            _dump($ex);
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
     * @return \Neutron\Core\Model\LayoutPage
     */
    public function findPageById($pageId)
    {
        return \Phpfox::with('layout_page')->findById($pageId);
    }

    public function getComponentIdOptions()
    {
        $select = \Phpfox::with('layout_component')->select();

        return array_map(function (ModelInterface $v) {
            return [
                'label' => $v->__get('package_id') . '.'
                    . $v->__get('component_id'),
                'value' => $v->__get('component_id'),
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