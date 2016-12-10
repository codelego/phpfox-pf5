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

        $rows = \Phpfox::get('db')
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
                $path . '/config/autoload.config.php');
        }

        return $based;
    }

    public function loadRouterConfigs()
    {
        $based = [];
        /**
         * fetch package variables from package.php
         */
        foreach ($this->loadEnablePaths() as $path) {
            _array_merge_recursive_from_file($based,
                $path . '/config/router.config.php');
        }

        return $based;
    }

    public function loadControllerConfigs()
    {
        $based = [];
        /**
         * fetch package variables from package.php
         */
        foreach ($this->loadEnablePaths() as $path) {
            _array_merge_from_file($based,
                $path . '/config/controller.config.php');
        }

        return $based;
    }

    public function loadModelConfigs()
    {
        $based = [];
        /**
         * fetch package variables from package.php
         */
        foreach ($this->loadEnablePaths() as $path) {
            _array_merge_from_file($based,
                $path . '/config/models.config.php');
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
                $path . '/config/package.config.php');
        }

        /**
         * fetch setting variables from table ':core_setting'
         */
        $rows = \Phpfox::get('db')
            ->select('group_id, var_name, value_actual, is_active, priority')
            ->from(':core_setting')
            ->where('is_active=?', 1)
            ->order('priority', 1)
            ->execute()
            ->all();


        foreach ($rows as $row) {
            $key = $row['var_name'];
            $group = $row['group_id'];
            if (!$group) {
                $group = 'global';
            }

            if (!isset($settingVariables[$group])) {
                $settingVariables[$group] = [];
            }

            $val = json_decode($row['value_actual'], true);
            if (isset($val['val'])) {
                $val = $val['val'];
            } else {
                continue;
            }

            $based[$group][$key] = $val;
        }

        return $based;
    }


    public function loadPackageInfo($id)
    {

    }

}