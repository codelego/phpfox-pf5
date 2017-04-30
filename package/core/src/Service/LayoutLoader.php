<?php

namespace Neutron\Core\Service;


use Phpfox\Layout\LayoutElement;
use Phpfox\Layout\LayoutLoaderInterface;
use Phpfox\Layout\LayoutLocation;
use Phpfox\Layout\LayoutPage;

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
                ->from(':theme')
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
     * @param string $pageId
     *
     * @return array
     */
    public function findAcceptablePageId($pageId)
    {
        $result = [$pageId];
        $limit = 5;

        do {
            $row = \Phpfox::get('db')
                ->select('parent_page_id')
                ->from(':layout_page')
                ->where('page_id=?', $pageId)
                ->first();

            if ($row and $row['parent_page_id']) {
                $result[] = $pageId = $row['parent_page_id'];
            }

        } while (!empty($row) and --$limit > 0);

        $result[] = 'default';

        return array_unique($result);
    }

    /**
     * @param string $pageId
     * @param string $themeId
     *
     * @return int|null
     */
    public function findLayoutForRender($pageId, $themeId)
    {
        $pageIdList = $this->findAcceptablePageId($pageId);
        $themeIdList = $this->findAcceptableThemeId($themeId);

        foreach ($themeIdList as $themeId) {
            $temp = [];
            $rows = \Phpfox::get('db')
                ->select()
                ->from(':layout_params')
                ->where('is_active=?', 1)
                ->where('theme_id=?', $themeId)
                ->where('page_id IN ?', $pageIdList)
                ->all();

            foreach ($rows as $row) {
                $temp[$row['page_id']] = $row['layout_id'];
            }

            foreach ($pageIdList as $pageId) {
                if (isset($temp[$pageId]) and $temp[$pageId]) {
                    return $temp[$pageId];
                }
            }
        }

        $alternate = \Phpfox::get('db')
            ->select()
            ->from(':layout_params')
            ->where('theme_id=?', 'default')
            ->where('page_id=?', 'default')
            ->first();

        return $alternate['layout_id'];
    }

    /**
     * @param int $layoutId
     *
     * @return array
     */
    public function loadLayoutParamsByLayoutId($layoutId)
    {
        $layout = \Phpfox::get('db')
            ->select()
            ->from(':layout_params')
            ->where('layout_id=?', $layoutId)
            ->first();

        return $layout;
    }

    /**
     * @param int $layoutId
     *
     * @return array
     */
    public function loadElementForRenderByLayoutId($layoutId)
    {
        return \Phpfox::get('db')
            ->select('ele.*, blk.block_name, blk.block_class')
            ->from(':layout_element', 'ele')
            ->join(':layout_block', 'blk', 'ele.block_id=blk.block_id', null,
                null)
            ->where('ele.is_active=?', 1)
            ->where('ele.layout_id=?', $layoutId)
            ->order('ele.location_id', 1)
            ->order('ele.sort_order', 1)
            ->all();
    }


    /**
     * @param string $pageId
     * @param string $themeId
     *
     * @return LayoutPage
     */
    public function loadForRender($pageId, $themeId)
    {
        $layoutId = $this->findLayoutForRender($pageId, $themeId);

        $locations = \Phpfox::get('db')
            ->select()
            ->from(':layout_location')
            ->where('layout_id=?', $layoutId)
            ->where('is_active=?', 1)
            ->all();

        $layout = \Phpfox::get('db')->select()
            ->from(':layout_params')
            ->where('layout_id=?', $layoutId)
            ->first();

        $layoutParams = (array)json_decode($layout['params']);

        $layoutPage = new LayoutPage($pageId, $layoutParams);

        $elements = $this->loadElementForRenderByLayoutId($layoutId);

        foreach ($locations as $data) {
            $locationId = $data['location_id'];
            $locationParams = json_decode($data['location_params'], 1);
            $location = new LayoutLocation($locationId, $locationParams);
            foreach ($elements as $row) {

                if ($row['location_id'] != $locationId) {
                    continue;
                }

                $params = (array)json_decode($row['params'], 1);
                $location->add(new LayoutElement(array_merge($params, [
                    'element_id'  => $row['element_id'],
                    'parent_id'   => $row['parent_id'],
                    'location_id' => $row['location_id'],
                    'block_id'    => $row['block_id'],
                    'block_name'  => $row['block_name'],
                    'block_class' => $row['block_class'],
                ])));
            }

            $layoutPage->addLocation($location);
        }

        return $layoutPage;
    }

    /**
     * @param string $pageId
     * @param string $themeId
     *
     * @return LayoutLocation[]
     */
    public function loadForEdit($pageId, $themeId)
    {
        $layoutId = $this->findLayoutForRender($pageId, $themeId);

        $locations = \Phpfox::get('db')
            ->select()
            ->from(':layout_location')
            ->where('layout_id=?', $layoutId)
            ->all();

        /** @var LayoutElement[] $elements */
        $elements = \Phpfox::get('db')
            ->select('ele.*, blk.block_name, blk.block_class')
            ->from(':layout_element', 'ele')
            ->join(':layout_block', 'blk', 'ele.block_id=blk.block_id', null,
                null)
            ->where('ele.layout_id=?', $layoutId)
            ->order('ele.location_id', 1)
            ->order('ele.sort_order', 1)
            ->all();;

        /** @var LayoutLocation[] $layoutLocations */
        $layoutLocations = [];

        foreach ($locations as $data) {
            $locationId = $data['location_id'];
            $locationParams = json_decode($data['location_params'], 1);
            $layoutLocation = new LayoutLocation($locationId, $locationParams);
            foreach ($elements as $row) {

                if ($row['location_id'] != $locationId) {
                    continue;
                }

                $params = (array)json_decode($row['params'], 1);
                $layoutLocation->add(new LayoutElement(array_merge($params, [
                    'element_id'  => $row['element_id'],
                    'parent_id'   => $row['parent_id'],
                    'location_id' => $row['location_id'],
                    'is_active'   => $row['is_active'],
                    'sort_order'  => $row['sort_order'],
                    'block_id'    => $row['block_id'],
                    'block_name'  => $row['block_name'],
                    'block_class' => $row['block_class'],
                ])));
            }

            $layoutLocations[] = $layoutLocation;
        }

        return $layoutLocations;
    }
}