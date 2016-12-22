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
                foreach ($data['chains'] as $key => $values) {
                    if (!isset($result['chains'][$key])) {
                        $result['chains'][$key] = [];
                    }
                    if (isset($values['route'])) {
                        $result['chains'][$key][] = $values;
                    } else {
                        foreach ($values as $value) {
                            $result['chains'][$key][] = $value;
                        }
                    }
                }
            }

            if (isset($data['routes'])) {
                foreach ($data['routes'] as $name => $value) {
                    $result['routes'][$name] = $value;
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
            $data = include PHPFOX_DIR . $path . '/config/models.php';

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