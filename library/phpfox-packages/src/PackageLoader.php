<?php

namespace Phpfox\Package;


class PackageLoader
{

    /**
     * @var array
     */
    protected $paths;

    public function getPaths()
    {
        if (!empty($this->paths)) {
            return $this->paths;
        }

        return array_map(function ($v) {
            return $v['path'];
        }, _get('db')
            ->select('path')
            ->from(':core_package')
            ->where('is_active=?', 1)
            ->order('priority', 1)
            ->all());
    }

    public function getAutoload()
    {
        $based = [];
        /**
         * fetch package variables from package.php
         */
        foreach ($this->getPaths() as $path) {
            _array_merge_recursive_from_file($based,
                $path . '/config/autoload.php');
        }

        return $based;
    }

    public function getRoutes()
    {
        $result = ['chains' => [], 'routes' => [], 'phrases' => []];
        foreach ($this->getPaths() as $path) {
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
        foreach ($this->getPaths() as $path) {
            $data = include PHPFOX_DIR . $path . '/config/model.php';

            foreach ($data as $name => $value) {
                $based[$name] = $value;
            }
        }
        return $based;
    }

    public function getParameters()
    {
        $based = [];
        /**
         * fetch package variables from package.php
         */
        foreach ($this->getPaths() as $path) {
            _array_merge_recursive_from_file($based,
                $path . '/config/package.php');
        }

        /**
         * fetch setting variables from table ':site_setting_value'
         */
        $rows = _get('db')
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