<?php

namespace Phpfox\Package;

use Phpfox\Support\Parameters;

class PackageLoader implements PackageLoaderInterface
{
    /**
     * @var array
     */
    protected $paths = [];

    /**
     * Super cache time to life
     *
     * @const TTL int
     */
    const TTL = 60;

    /**
     * @const CHECK_KEY string
     */
    const CHECK_KEY = 'setting_version';

    /**
     *
     */
    public function flush()
    {

    }

    public function resolve()
    {
        // compare version or not ?
        $versionId = _load('super.cache', self::CHECK_KEY, 0, function () {
            return 0;
        });

        // latest version
        $latestVersion = _load('shared.cache', 'setting_version', 0, function () {
            return $this->getLatestVersionId();
        });

        if ($versionId < $this->getLatestVersionId()) {
            _get('super.cache')->flush();
        }

        _get('super.cache')->setItem(self::CHECK_KEY, $latestVersion, self::TTL);
    }

    /**
     * @return mixed
     */
    public function getLatestVersionId()
    {
        $value = _get('db')
            ->select('*')
            ->from(':site_setting_value')
            ->where('group_id=?', 'core')
            ->where('name=?', 'setting_version')
            ->first();

        return $value['value_actual'];
    }

    /**
     * @return string
     */
    public function getVersionId()
    {
        return _load('cache.super', 'loader.version_id', self::TTL, function () {
            return 0;
        });
    }

    public function getPaths()
    {
        if (!$this->paths) {
            $this->paths = _load('super.cache', 'loader.paths', self::TTL, function () {
                return $this->_getPaths();
            });
        }
        return $this->paths;
    }

    public function getModelParameters()
    {
        return _load('super.cache', 'loader.models', self::TTL, function () {
            return $this->_getModelParameters();
        });
    }

    public function getAutoloadParameters()
    {
        return _load('super.cache', 'loader.autoload', self::TTL, function () {
            return $this->_getAutoloadParameters();
        });
    }

    public function getRouteParameters()
    {
        return _load('super.cache', 'loader.routes', self::TTL, function () {
            return $this->_getRouteParameters();
        });
    }

    public function getPackageParameters()
    {
        return _load('super.cache', 'loader.parameters', self::TTL, function () {
            return $this->_getPackageParameters();
        });
    }

    public function getEventParameters()
    {
        return _load('super.cache', 'loader.events', self::TTL, function () {
            return $this->_getEventParameters();
        });
    }

    /**
     * @return Parameters
     */
    protected function _getEventParameters()
    {
        $rows = _get('db')
            ->select('*')
            ->from(':core_event')
            ->order('event_name, priority', 1);

        $result = [];
        foreach ($rows->all() as $row) {
            $name = $row['event_name'];
            if (!isset($result[$name])) {
                $result[$name] = [];
            }

            $result[$name][] = $row['listener_name'];
        }
        return new Parameters($result);
    }

    public function getPackageInfo($id)
    {
        // TODO: Implement loadPackageInfo() method.
    }


    /**
     * @return Parameters
     */
    public function getActionParameters()
    {
        return _load('super.cache', 'getActionParameters', self::TTL, function () {
            return $this->_getActionParameters();
        });
    }

    public function _getPaths()
    {
        if (!empty($this->paths)) {
            return $this->paths;
        }

        return array_map(function ($row) {
            return $row['path'];
        }, _get('db')
            ->select('path')
            ->from(':core_package')
            ->where('is_active=?', 1)
            ->order('priority', 1)
            ->all());
    }

    public function _getAutoloadParameters()
    {
        $result = [];

        /**
         * fetch package variables from package.php
         */
        foreach ($this->getPaths() as $path) {
            if (!file_exists($file = PHPFOX_DIR . $path . '/config/autoload.php')) {
                continue;
            }
            /** @noinspection PhpIncludeInspection */
            $array = include $file;
            if (!is_array($array)) {
                continue;
            }
            foreach ($array as $k => $v) {
                if (!isset($result[$k])) {
                    $result[$k] = $v;
                } elseif (is_array($v)) {
                    $result[$k] = array_merge($result[$k], $v);
                } else {
                    $result[$k] = $v;
                }
            }
        }

        return new Parameters($result);
    }

    public function _getRouteParameters()
    {
        $result = ['chains' => [], 'routes' => [], 'phrases' => []];
        foreach ($this->_getPaths() as $path) {
            if (!file_exists($filename = PHPFOX_DIR . $path . '/config/router.php')) {
                continue;
            }

            /** @noinspection PhpIncludeInspection */
            $data = include $filename;

            if (!is_array($data)) {
                continue;
            }

            if (isset($data['chains']) and is_array($data['chains'])) {
                foreach ($data['chains'] as $value) {
                    $result['chains'][] = $value;
                }
            }

            if (isset($data['routes']) and is_array($data['routes'])) {
                foreach ($data['routes'] as $name => $value) {
                    $children = null;
                    if (isset($value['children'])) {
                        $children = $value['children'];
                    }
                    unset($value['children']);
                    $result['routes'][$name] = $value;

                    if (is_array($children)) {
                        foreach ($children as $k => $v) {
                            $result['routes'][$name . '.' . $k] = $v;
                        }
                    }
                }
            }

            if (isset($data['phrases']) and is_array($data['phrases'])) {
                foreach ($data['phrases'] as $name => $value) {
                    $result['phrases'][$name] = $value;
                }
            }
        }
        return new Parameters($result);
    }

    /**
     * @return Parameters
     */
    public function _getActionParameters()
    {
        $result = [];
        foreach ($this->getPaths() as $path) {
            if (!file_exists($filename = PHPFOX_DIR . $path . '/config/controller.php')) {
                continue;
            }
            if (!is_array($data = include $filename)) {
                continue;
            }

            foreach ($data as $k => $v) {
                $result[$k] = $v;
            }
        }
        return new Parameters($result);
    }

    /**
     * @return Parameters
     */
    public function _getModelParameters()
    {
        $result = [];
        /**
         * fetch package variables from package.php
         */
        foreach ($this->_getPaths() as $path) {
            if (!file_exists($filename = PHPFOX_DIR . $path . '/config/model.php')) {
                continue;
            }

            /** @noinspection PhpIncludeInspection */
            $data = include $filename;

            if (!is_array($data)) {
                continue;
            }

            foreach ($data as $name => $value) {
                $result[$name] = $value;
            }
        }
        return new Parameters($result);
    }

    public function _getPackageParameters()
    {
        $result = [];

        /** @noinspection PhpIncludeInspection */
        $result['db.adapters']['default'] = include PHPFOX_DATABASE_FILE;

        foreach ($this->getPaths() as $path) {
            if (!file_exists($file = PHPFOX_DIR . $path . '/config/package.php')) {
                continue;
            }
            /** @noinspection PhpIncludeInspection */
            $array = include $file;

            if (!is_array($array)) {
                continue;
            }
            foreach ($array as $k => $v) {
                if (!isset($result[$k])) {
                    $result[$k] = $v;
                } elseif (is_array($v)) {
                    $result[$k] = array_merge($result[$k], $v);
                } else {
                    $result[$k] = $v;
                }
            }
        }

        /**
         * fetch setting variables from table ':site_setting_value'
         */
        $rows = _get('db')
            ->select('*')
            ->from(':site_setting_value')
            ->where('is_active=1')
            ->order('ordering', 1)
            ->all();


        foreach ($rows as $row) {
            $name = $row['name'];
            $group = $row['group_id'];
            $key = $group . '.' . $name;
            if (!isset($result[$group])) {
                $result[$group] = [];
            }
            $result[$group][$name] = $result[$key] = json_decode($row['value_actual'], true);
        }

        return $result;
    }
}