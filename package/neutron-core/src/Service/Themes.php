<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\CoreTheme;
use Phpfox\Assets\StylesheetCompiler;

class Themes
{

    /**
     * cache prefer themes
     */
    const PREFER_THEME_CACHE = 'core_theme_prefer_themes';

    /**
     * @param string $id
     *
     * @return CoreTheme|null
     */
    public function findById($id)
    {
        return \Phpfox::getModel('core_theme')
            ->findById((string)$id);
    }

    /**
     * Mark a theme to be "default"
     *
     * @param $id
     */
    public function setDefault($id)
    {
        $theme = $this->findById($id);

        if (!$theme) {
            throw new \InvalidArgumentException(_sprintf('Oops! "{0}" is not a valid theme id',
                [$id]));
        }

        \Phpfox::get('db')
            ->update(':core_theme')
            ->values(['is_default' => 0])
            ->execute();

        \Phpfox::get('db')
            ->update(':core_theme')
            ->values([
                'is_default' => 1,
                'is_active'  => 1,
            ])
            ->where('id=?', $id)
            ->execute();

        $this->updateCache();
    }

    /**
     * Active theme by "id"
     *
     * @param string $id
     */
    public function active($id)
    {
        $theme = $this->findById($id);

        if (!$theme) {
            throw new \InvalidArgumentException(_sprintf('Oops! "{0}" is not a valid theme id',
                [$id]));
        }

        \Phpfox::get('db')
            ->update(':core_theme')
            ->values([
                'is_active' => 1,
            ])
            ->where('id=?', $id)
            ->execute();
    }

    /**
     * Active theme by "id"
     *
     * @param string $id
     */
    public function inactive($id)
    {
        $theme = $this->findById($id);

        if (!$theme) {
            throw new \InvalidArgumentException(_sprintf('Oops! "{0}" is not a valid theme id',
                [$id]));
        }

        \Phpfox::get('db')
            ->update(':core_theme')
            ->values([
                'is_active' => 0,
            ])
            ->where('id=?', $id)
            ->where('is_default=?', 0)
            ->execute();
    }

    /**
     * Get default theme entry
     *
     * @return CoreTheme
     */
    public function getDefault()
    {
        $item = \Phpfox::getModel('core_theme')
            ->select()
            ->where('is_default=?', 1)
            ->execute()
            ->first();

        if (!$item) {
            $item = \Phpfox::getModel('core_theme')
                ->select()
                ->where('is_active=?', 1)
                ->execute()
                ->first();
        }

        return $item;
    }

    /**
     * Get prefer themes
     *
     * @return array
     */
    public function preferThemes()
    {
        return _from_local_cache(self::PREFER_THEME_CACHE, function () {
            $theme = $this->getDefault();

            $result = [$theme->getId()];

            $parentId = $theme->getParentId();

            while ($parentId and $parentId != 'default') {

                $theme = $this->findById($parentId);

                if ($theme) {
                    $result[] = $theme->getId();
                    $parentId = $theme->getParentId();
                } else {
                    break;
                }
            }
            $result[] = 'default';

            return array_unique($result);
        });
    }

    /**
     * Update cache
     */
    private function updateCache()
    {
        \Phpfox::get('cache.local')
            ->deleteItem(self::PREFER_THEME_CACHE);

        $this->preferThemes();
    }

    /**
     * Rebuild theme
     *
     * @param string $id
     */
    public function rebuild($id)
    {
        $theme = $this->findById($id);

        if (!$theme) {
            throw new \InvalidArgumentException(_sprintf('Oops! "{0}" is not a valid theme id',
                [$id]));
        }

        $compiler = new StylesheetCompiler();

        $output = $this->getMainCssPath($id);

        if(!is_writeable($output)){
            throw new \InvalidArgumentException(_sprintf('Oops! an not open {0} to write',[$output]));
        }

        $compiler->rebuild($output, $this->getSassVariables($id),
            $this->getSassPaths($id));
    }

    public function getSassPaths($id)
    {
        $theme = $this->findById($id);

        $result = [$this->getSassPath($theme->getId())];

        $parentId = $theme->getParentId();

        while ($parentId and $parentId != 'default') {
            $theme = $this->findById($parentId);
            if ($theme) {
                $result[] = $this->getSassPath($theme->getId());
                $parentId = $theme->getParentId();
            } else {
                break;
            }
        }
        $result[] = $this->getSassPath('default');

        return array_unique($result);
    }

    /**
     * @param string $id
     *
     * @return string
     */
    public function getMainCssPath($id)
    {
        return sprintf(PHPFOX_DIR . '/static/theme-%s/css/main.css', $id);
    }

    private function getSassPath($id)
    {
        return PHPFOX_DIR . '/static/theme-' . $id;
    }

    /**
     * @param string $id
     *
     * @return array
     */
    public function getSassVariables($id)
    {
        $item = \Phpfox::get('db')
            ->select('*')
            ->from(':core_theme_setting')
            ->where('theme_id=?', (string)$id)
            ->execute()
            ->first();

        if (!$item) {
            return [];
        }

        if (empty($item['settings'])) {
            return [];
        }

        return (array)json_decode($item['settings'], true);
    }
}