<?php

namespace Neutron\Core\Service;

use Neutron\Core\Model\LayoutTheme;
use Neutron\Core\Model\LayoutThemeParams;
use Phpfox\Assets\StylesheetCompiler;
use Phpfox\Model\ModelInterface;

class ThemeManager
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
     * @return LayoutTheme
     */
    public function findById($id)
    {
        return _model('layout_theme')
            ->findById((string)$id);
    }

    public function getThemeIdOptions()
    {
        $select = _model('layout_theme')
            ->select();

        return array_map(function (ModelInterface $v) {
            return [
                'label' => $v->__get('theme_id'),
                'value' => $v->__get('theme_id'),
            ];
        }, $select->all());
    }

    /**
     * @param mixed $id
     *
     * @return LayoutThemeParams
     */
    public function findSettingById($id)
    {
        return _model('layout_theme_params')
            ->findById((int)$id);
    }

    /**
     * @param mixed $id
     *
     * @return LayoutThemeParams
     */
    public function findSettingByThemeId($id)
    {
        return _model('layout_theme_params')
            ->select()
            ->where('theme_id=?', (string)$id)
            ->first();

    }

    /**
     * Mark a theme to be "default"
     *
     * @param $id
     */
    public function setEditing($id)
    {
        $theme = $this->findById($id);

        if (!$theme) {
            throw new \InvalidArgumentException(_sprintf('Oops! "{0}" is not a valid theme id',
                [$id]));
        }

        _get('db')
            ->update(':layout_theme')
            ->values(['is_editing' => 0])
            ->execute();

        _get('db')
            ->update(':layout_theme')
            ->values([
                'is_editing' => 1,
                'is_active'  => 1,
            ])
            ->where('theme_id=?', $id)
            ->execute();

        $this->updateCache();
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

        _get('db')
            ->update(':layout_theme')
            ->values(['is_default' => 0])
            ->execute();

        _get('db')
            ->update(':layout_theme')
            ->values([
                'is_default' => 1,
                'is_active'  => 1,
            ])
            ->where('theme_id=?', $id)
            ->execute();

        $this->updateCache();
    }

    /**
     * Active theme by "id"
     *
     * @param string $id
     */
    public function setActive($id)
    {
        $theme = $this->findById($id);

        if (!$theme) {
            throw new \InvalidArgumentException(_sprintf('Oops! "{0}" is not a valid theme id',
                [$id]));
        }

        _get('db')
            ->update(':layout_theme')
            ->values([
                'is_active' => 1,
            ])
            ->where('theme_id=?', $id)
            ->execute();
    }

    /**
     * Active theme by "id"
     *
     * @param string $id
     */
    public function setInactive($id)
    {
        $theme = $this->findById($id);

        if (!$theme) {
            throw new \InvalidArgumentException(_sprintf('Oops! "{0}" is not a valid theme id',
                [$id]));
        }

        _get('db')
            ->update(':layout_theme', ['is_active' => 0,])
            ->where('theme_id=?', $id)
            ->where('is_default=?', 0)
            ->execute();
    }

    /**
     * Get default theme entry
     *
     * @return LayoutTheme
     */
    public function getDefault()
    {
        $item = _model('layout_theme')
            ->select()
            ->where('is_default=?', 1)
            ->first();

        if (!$item) {
            $item = _model('layout_theme')
                ->select()
                ->where('is_active=?', 1)
                ->first();
        }

        return $item;
    }

    public function _preferThemes()
    {
        $theme = $this->getDefault();

        if (!$theme) {
            return ['default'];
        }

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
        return _load(null, self::PREFER_THEME_CACHE, 0, function () {
            return $this->_preferThemes();
        });
    }

    /**
     * Update cache
     */
    private function updateCache()
    {
        _get('cache.local')
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
        return PHPFOX_THEME_DIR . $id . '/sass';
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
        return _get('cache.local')
            ->load(self::PREFER_THEME_URL_CACHE, 0, function () {
                $theme = $this->getDefault();
                return '/pf5/static/' . 'themes/' . $theme->getId() . '/css';
            });
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

    /**
     * @param string $id
     *
     * @return array
     */
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
     * Get theme settings and sass variables
     *
     * @see table `theme_setting`
     *
     * @param string $id
     *
     * @return array
     */
    public function getSassVariables($id)
    {

        $variables = [];
        $item = _get('db')
            ->select('*')
            ->from(':layout_theme_params')
            ->where('theme_id=?', (string)$id)
            ->first();

        if ($item and $item['params']) {
            $variables = (array)json_decode($item['params'], true);
        }

        $variables['theme-url'] = '../../';
        $variables['static-url'] = '../../../';
        $variables['site-url'] = '../../../../';

        return $variables;
    }
}