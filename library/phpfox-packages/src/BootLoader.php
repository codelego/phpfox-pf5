<?php

namespace Phpfox\Package;

class BootLoader implements PackageLoaderInterface
{
    /**
     * @var array
     */
    protected $paths;

    public function flush()
    {
        _get('super.cache')->flush();
    }

    public function getPaths()
    {
        return _load('super.cache', 'getPaths', 60, function () {
            return $this->_getPaths();
        });
    }


    public function getModels()
    {
        return _load('super.cache', 'getModels', 60, function () {
            return $this->_getModels();
        });
    }

    public function getAutoload()
    {
        return _load('super.cache', 'loadAutoloadConfigs', 60, function () {
            return $this->_getAutoload();
        });
    }

    public function getRoutes()
    {
        return _load('super.cache', 'loadRouterConfigs', 60, function () {
            return $this->_getRoutes();
        });
    }

    public function getParameters()
    {
        return _load('super.cache', 'loadPackageConfigs', 60, function () {
            return $this->_getParameters();
        });
    }

    public function loadPackageInfo($id)
    {
        // TODO: Implement loadPackageInfo() method.
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

    public function _getAutoload()
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

        return $result;
    }

    public function _getRoutes()
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
        return $result;
    }

    /**
     * @return array
     */
    public function getControllers()
    {
        return _load('super.cache', 'getControllers', 60, function () {
            return $this->_getControllers();
        });
    }

    /**
     * @return array
     */
    public function _getControllers()
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
        return $result;
    }

    public function _getModels()
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
        return $result;
    }

    public function _getParameters()
    {
        $result = [];

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