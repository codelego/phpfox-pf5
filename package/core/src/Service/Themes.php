<?php

namespace Neutron\Core\Service;

use Neutron\Core\Model\CoreTheme;
use Phpfox\Assets\StylesheetCompiler;

class Themes
{

    /**
     * Cache prefer themes
     */
    const PREFER_THEME_CACHE = 'core_theme_prefer_themes';

    /**
     * Cache theme url
     */
    const PREFER_THEME_URL_CACHE = 'core_theme_url';

    /**
     * @param string $id
     *
     * @return CoreTheme
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

    public function _preferThemes()
    {
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
    }

    /**
     * Get prefer themes
     *
     * @return array
     */
    public function preferThemes()
    {
        return \Phpfox::get('cache.local')
            ->with(self::PREFER_THEME_CACHE, function () {
                return $this->_preferThemes();
            }, 0);
    }

    /**
     * Update cache
     */
    private function updateCache()
    {
        \Phpfox::get('cache.local')
            ->deleteItems([
                self::PREFER_THEME_CACHE,
                self::PREFER_THEME_URL_CACHE,
            ]);
    }

    /**
     * Rebuild theme
     *
     * @param string $id
     */
    public function rebuildMain($id)
    {
        $theme = $this->findById($id);

        if (!$theme) {
            throw new \InvalidArgumentException(_sprintf('Oops! "{0}" is not a valid theme id',
                [$id]));
        }

        $compiler = new StylesheetCompiler();

        // rebuild main css

        $output = $this->getCssFilename($id, 'main.css');

        $variables = $this->getSassVariables($id);
        $paths = $this->getImportPaths($id);

        $source = $this->getMainSource();

        $compiler->rebuild($source, $output, $variables, $paths);
    }

    public function rebuildFiles($id)
    {
        $theme = $this->findById($id);

        if (!$theme) {
            throw new \InvalidArgumentException(_sprintf('Oops! "{0}" is not a valid theme id',
                [$id]));
        }

        $variables = $this->getSassVariables($id);
        $paths = $this->getImportPaths($id);

        // rebuild files

        $compiler = new StylesheetCompiler();

        $map = $this->getRebuildFiles($id);

        foreach ($map as $input => $output) {
            $source = file_get_contents($input);
            $compiler->rebuild($source, $output, $variables, $paths);
        }

    }

    public function getImportPaths($id)
    {
        $theme = $this->findById($id);

        $paths = [$this->getSassPath($theme->getId())];

        $parentId = $theme->getParentId();

        while ($parentId and $parentId != 'default') {
            $theme = $this->findById($parentId);
            if ($theme) {
                $paths[] = $this->getSassPath($theme->getId());
                $parentId = $theme->getParentId();
            } else {
                break;
            }
        }
        $paths[] = $this->getSassPath('default');

        $paths[] = PHPFOX_DIR . 'static/base/sass';
        $paths[] = PHPFOX_DIR;


        return array_unique($paths);
    }

    /**
     * Get real path of theme id location
     *
     * @param string $id
     *
     * @return string
     */
    private function getSassPath($id)
    {
        return PHPFOX_THEME_DIR . $id;
    }

    /**
     * @param string $id
     * @param string $filename
     *
     * @return string
     */
    public function getCssFilename($id, $filename)
    {
        return PHPFOX_THEME_DIR . $id . '/css/' . $filename;
    }

    /**
     * @return string
     */
    public function getCssBaseUrl()
    {
        return \Phpfox::get('cache.local')
            ->with(self::PREFER_THEME_URL_CACHE, function () {
                $theme = $this->getDefault();
                return '/pf5/static/' . 'themes/' . $theme->getId() . '/css';
            }, 0);
    }

    /**
     * @return string
     */
    public function getMainSource()
    {
        $container = new \ArrayObject();

        $response = _emit('onRebuildMain', $container);

        $source[] = '@import "main";';

        if ($response) {
            foreach ($response as $item) {
                if (is_array($item)) {
                    foreach ($item as $v) {
                        $source[] = sprintf('@import "%s";', $v);
                    }
                } else {
                    if (is_string($item)) {
                        $source[] = sprintf('@import "%s";', $item);
                    }
                }
            }
        }

        return implode(PHP_EOL, $source);
    }

    public function getRebuildFiles($id)
    {
        $response = _emit('onRebuildFiles');

        $result = [];

        foreach ($response as $items) {
            if (empty($items)) {
                continue;
            }
            foreach ($items as $input => $output) {
                $result[$input] = $this->getCssFilename($id, $output);
            }
        }

        return $result;
    }

    /**
     * @param string $id
     *
     * @return array
     */
    public function getSassVariables($id)
    {

        $variables = [];
        $item = \Phpfox::get('db')
            ->select('*')
            ->from(':core_theme_setting')
            ->where('theme_id=?', (string)$id)
            ->execute()
            ->first();

        if ($item && $item['settings']) {
            $variables = (array)json_decode($item['settings'], true);
        }

        $variables['theme-url'] = '../../';
        $variables['static-url'] = '../../../';
        $variables['site-url'] = '../../../../';

        return $variables;
    }
}