<?php

namespace Phpfox\Package;


class PackageLoader implements PackageLoaderInterface
{

    /**
     * @var array
     */
    protected $paths;

    public function loadEnablePaths()
    {
        if (!empty($this->paths)) {
            return $this->paths;
        }

        $rows = _service('db')
            ->select('path')
            ->from(':core_package')
            ->where('is_active=?', 1)
            ->order('priority', 1)
            ->execute()
            ->all();

        return $this->paths = array_map(function ($v) {
            return $v['path'];
        }, $rows);
    }

    public function loadAutoloadConfigs()
    {
        $based = [];
        /**
         * fetch package variables from package.php
         */
        foreach ($this->loadEnablePaths() as $path) {
            _array_merge_recursive_from_file($based,
                $path . '/config/autoload.php');
        }

        return $based;
    }

    public function loadRouterConfigs()
    {
        $result = ['chains' => [], 'routes' => [], 'phrases' => []];
        foreach ($this->loadEnablePaths() as $path) {
            $data = include PHPFOX_DIR . $path . '/config/router.php';
            if (isset($data['chains'])) {
                foreach ($data['chains'] as $value) {
                    $result['chains'][] = $value;
                }
            }

            if (isset($data['routes'])) {
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

            if (isset($data['phrases'])) {
                foreach ($data['phrases'] as $name => $value) {
                    $result['phrases'][$name] = $value;
                }
            }
        }

        return $result;
    }

    public function loadModelConfigs()
    {
        $based = [];
        /**
         * fetch package variables from package.php
         */
        foreach ($this->loadEnablePaths() as $path) {
            $data = include PHPFOX_DIR . $path . '/config/model.php';

            foreach ($data as $name => $value) {
                $based[$name] = $value;
            }
        }
        return $based;
    }

    public function loadPackageConfigs()
    {
        $based = [];
        /**
         * fetch package variables from package.php
         */
        foreach ($this->loadEnablePaths() as $path) {
            _array_merge_recursive_from_file($based,
                $path . '/config/package.php');
        }

        /**
         * fetch setting variables from table ':site_setting_value'
         */
        $rows = _service('db')
            ->select('*')
            ->from(':site_setting_value')
            ->all();


        foreach ($rows as $row) {
            $name = $row['name'];
            $group = $row['group_id'];
            $key = $group . '.' . $name;

            if (!isset($based[$group])) {
                $based[$group] = [];
            }
            $based[$group][$name] = $based[$key] = json_decode($row['value_actual'], true);
        }

        return $based;
    }


    public function loadPackageInfo($id)
    {

    }

}