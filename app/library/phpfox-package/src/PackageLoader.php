<?php

namespace Phpfox\Package;

use Phpfox\Kernel\Parameters;

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
     * PackageLoader constructor.
     */
    public function __construct()
    {
        if (PHPFOX_ENV == 'development') {
            \Phpfox::get('super.cache')->flush();
        }
    }

    public function resolve()
    {
        // compare version or not ?
        $versionId = \Phpfox::_try('super.cache', self::CHECK_KEY, 0, function () {
            return 0;
        });

        // latest version
        $latestVersion = \Phpfox::_try('shared.cache', 'setting_version', 0, function () {
            return $this->getLatestVersionId();
        });

        if ($versionId < $this->getLatestVersionId()) {
            \Phpfox::get('super.cache')->flush();
        }

        \Phpfox::get('super.cache')->set(self::CHECK_KEY, $latestVersion, self::TTL);
    }

    /**
     * @return array
     */
    public function getActivePackageIds()
    {
        return \Phpfox::_try('super.cache', 'loader.active_package_id', self::TTL, function () {
            return $this->_getActivePackageIds();
        });
    }

    /**
     * @return array
     */
    public function _getActivePackageIds()
    {
        return array_map(function ($item) {
            return $item['name'];
        }, \Phpfox::get('db')
            ->select()
            ->from(':core_package')
            ->where('is_active=?', 1)
            ->order('priority', 1)
            ->all());
    }

    /**
     * @return mixed
     */
    public function getLatestVersionId()
    {
        $value = \Phpfox::get('db')
            ->select('*')
            ->from(':setting_value')
            ->where('domain_id=?', 'core')
            ->where('name=?', 'setting_version')
            ->first();

        return $value['value_actual'];
    }

    /**
     * @return string
     */
    public function getVersionId()
    {
        return \Phpfox::_try('super.cache', 'loader.version_id', self::TTL, function () {
            return 0;
        });
    }

    public function getPaths()
    {
        if (!$this->paths) {
            $this->paths = \Phpfox::_try('super.cache', 'loader.paths', self::TTL, function () {
                return $this->_getPaths();
            });
        }
        return $this->paths;
    }

    public function getModelParameters()
    {
        return \Phpfox::_try('super.cache', 'loader.models', self::TTL, function () {
            return $this->_getModelParameters();
        });
    }

    public function getAutoloadParameters()
    {
        return \Phpfox::_try('super.cache', 'loader.autoload', self::TTL, function () {
            return $this->_getAutoloadParameters();
        });
    }

    public function getRouteParameters()
    {
        return \Phpfox::_try('super.cache', 'loader.routes', self::TTL, function () {
            return $this->_getRouteParameters();
        });
    }

    public function getPackageParameters()
    {
        return \Phpfox::_try('super.cache', 'loader.parameters', self::TTL, function () {
            return $this->_getPackageParameters();
        });
    }

    public function getEventParameters()
    {
        return \Phpfox::_try('super.cache', 'loader.events', self::TTL, function () {
            return $this->_getEventParameters();
        });
    }

    public function getViewParameters()
    {
        return \Phpfox::_try('super.cache', 'loader.views', self::TTL, function () {
            return $this->_getViewParameters();
        });
    }

    /**
     * @return Parameters
     */
    public function getActionParameters()
    {
        return \Phpfox::_try('super.cache', 'getActionParameters', self::TTL, function () {
            return $this->_getActionParameters();
        });
    }


    /**
     * @return Parameters
     */
    protected function _getEventParameters()
    {
        $rows = \Phpfox::get('db')
            ->select('*')
            ->from(':core_event')
            ->where('package_id in ?', $this->getActivePackageIds())
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

    public function getPackageInfo($packageId)
    {
        // TODO: Implement loadPackageInfo() method.
    }

    /**
     * @return Parameters
     */
    protected function _getViewParameters()
    {
        $result = [];
        foreach ($this->getPaths() as $path) {
            if (!file_exists($file = PHPFOX_APP_DIR . $path . '/config/view.php')) {
                continue;
            }
            $array = load_config($file);

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

    /**
     * @return array
     */
    public function _getPaths()
    {
        if (!empty($this->paths)) {
            return $this->paths;
        }

        return array_map(function ($row) {
            return $row['path'];
        }, \Phpfox::get('db')
            ->select('path')
            ->from(':core_package')
            ->where('is_active=?', 1)
            ->order('priority', 1)
            ->all());
    }

    /**
     * @return Parameters
     */
    public function _getAutoloadParameters()
    {
        $result = [];

        /**
         * fetch package variables from package.php
         */
        foreach ($this->getPaths() as $path) {
            if (!file_exists($file = PHPFOX_APP_DIR . $path . '/config/autoload.php')) {
                continue;
            }
            $array = load_config($file);
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

    /**
     * @return Parameters
     */
    public function _getRouteParameters()
    {
        $result = ['chains' => [], 'routes' => [], 'phrases' => []];
        foreach ($this->_getPaths() as $path) {
            if (!file_exists($filename = PHPFOX_APP_DIR . $path . '/config/router.php')) {
                continue;
            }

            $data = load_config($filename);

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
            if (!file_exists($filename = PHPFOX_APP_DIR . $path . '/config/controller.php')) {
                continue;
            }
            if (!is_array($data = load_config($filename))) {
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
            if (!file_exists($filename = PHPFOX_APP_DIR . $path . '/config/model.php')) {
                continue;
            }
            $data = load_config($filename);

            if (!is_array($data)) {
                continue;
            }

            foreach ($data as $name => $value) {
                $result[$name] = $value;
            }
        }
        return new Parameters($result);
    }

    /**
     * @return array
     */
    public function _getPackageParameters()
    {
        $result = [];


        /** @noinspection PhpIncludeInspection */
        $result['db.adapters']['default'] = load_config(PHPFOX_DATABASE_FILE);

        foreach ($this->getPaths() as $path) {
            if (!file_exists($file = PHPFOX_APP_DIR . $path . '/config/package.php')) {
                continue;
            }
            $array = load_config($file);

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
         * fetch setting variables from table ':setting_value'
         */
        $rows = \Phpfox::get('db')
            ->select('*')
            ->from(':setting_value')
            ->where('is_active=1')
            ->order('ordering', 1)
            ->all();


        foreach ($rows as $row) {
            $result[$row['domain_id'] . '.' . $row['name']] = json_decode($row['value_actual'], true);
        }

        return $result;
    }


    public function getCaptchaParameter($containerId)
    {
        return \Phpfox::_try('super.cache', ['captcha_parameter', $containerId], 0, function () use ($containerId) {
            return $this->_getDefaultAdapterByContainerId($containerId, 'captcha', 'recaptcha', 'captcha_drivers');
        });
    }


    public function getStorageParameter($adapterId)
    {
        return \Phpfox::_try('super.cache', ['storage_parameter', $adapterId], 0, function () use ($adapterId) {
            return $this->_getStorageParameter($adapterId);
        });
    }

    /**
     * @param string $id
     *
     * @return Parameters
     */
    public function _getStorageParameter($id)
    {
        $row = [];
        if (!$id or $id == 'default' or $id == 'fallback') {
            $id = \Phpfox::param('core.default_storage_id');
        }

        if ($id) {
            $row = \Phpfox::get('db')
                ->select('*')
                ->from(':storage_adapter')
                ->where('adapter_id=?', (string)$id)
                ->first();
        }

        if (empty($row)) {
            $row = \Phpfox::get('db')
                ->select('*')
                ->from(':storage_adapter')
                ->where('is_active=1')
                ->first();
        }

        return new Parameters([
            'driver' => $row['driver_id'],
            'params' => (array)json_decode($row['params'], true),
        ]);

    }

    public function getMailParameter($adapterId)
    {
        return \Phpfox::_try('super.cache', ['mail_parameter', $adapterId], 0, function () use ($adapterId) {
            return $this->_getDefaultAdapterByContainerId($adapterId, 'mailer', 'system', 'mail_drivers');
        });
    }

    /**
     * @param mixed  $containerId
     * @param string $driverType
     * @param string $default
     * @param string $map
     *
     * @return Parameters
     */
    public function _getDefaultAdapterByContainerId($containerId, $driverType, $default, $map)
    {
        $row = \Phpfox::get('db')
            ->select('*')
            ->from(':core_adapter')
            ->where('container_id=?', $containerId)
            ->where('driver_type=?', $driverType)
            ->order('is_default, is_active, is_required', -1)
            ->first();

        if (!$row) {
            $row = ['driver_id' => $default, 'params' => '[]'];
        }

        $params = (array)json_decode($row['params'], true);
        $params['class'] = \Phpfox::param($map, $row['driver_id']);
        $params['driver'] = $row['driver_id'];

        return new Parameters($params);
    }

    public function getCacheParameter($containerId)
    {
        return \Phpfox::_try('super.cache', ['cache_parameter', $containerId], 0, function () use ($containerId) {
            return $this->_getDefaultAdapterByContainerId($containerId, 'cache', 'files', 'cache_drivers');
        });
    }

    public function getLogParameter($logId)
    {
        return \Phpfox::_try('super.cache', ['log_parameter', $logId], 0, function () use ($logId) {
            return $this->_getLogParameter($logId);
        });

    }

    /**
     * @param string $containerId
     *
     * @return Parameters
     */
    public function _getLogParameter($containerId)
    {
        $loggers = array_map(function ($row) {
            $params = (array)json_decode($row['params'], true);
            $params['class'] = \Phpfox::param('log_drivers', $row['driver_id']);
            $params['driver'] = $row['driver_id'];
            return $params;
        },
            // get active adapters
            \Phpfox::get('db')
                ->select('*')
                ->from(':core_adapter')
                ->where('container_id=?', $containerId)
                ->where('driver_type=?', 'log')
                ->where('is_active=?', 1)
                ->order('is_required', -1)
                ->all());

        return new Parameters(['loggers' => $loggers]);
    }

    public function getSessionParameter($containerId)
    {
        return \Phpfox::_try('super.cache', ['session_parameter', $containerId], 0, function () use ($containerId) {
            return $this->_getDefaultAdapterByContainerId($containerId, 'session', 'files', 'session_drivers');
        });
    }


    /**
     * @param string $menu
     *
     * @return Parameters
     */
    public function _getNavigationParameter($menu)
    {
        $result = new Parameters();
        $items = \Phpfox::get('db')
            ->select('*')
            ->from(':core_menu_item')
            ->where('menu_id=?', trim($menu))
            ->where('package_id in ?', \Phpfox::get('core.packages')->getIds())
            ->where('is_active=?', 1)
            ->order('ordering', 1)
            ->all();

        array_walk($items, function ($row) use ($result) {
            $result->set($row['name'], [
                'id'         => $row['id'],
                'params'     => (array)json_decode($row['params'], 1),
                'label'      => $row['label'],
                'ordering'   => $row['ordering'],
                'name'       => $row['name'],
                'parent'     => $row['parent_name'],
                'extra'      => (array)json_decode($row['extra'], 1),
                'href'       => $row['href'],
                'permission' => $row['permission'],
                'enable'     => $row['is_active'],
                'route'      => $row['route'],
                'event'      => $row['is_active'],
                'custom'     => $row['is_custom'],
                'type'       => $row['item_type'],
            ]);
        });

        return $result;
    }

    /**
     * @param string $menu
     * @param mixed  $partial
     *
     * @return Parameters
     */
    public function _getNavigationPartialParameters($menu, $partial)
    {
        $scans = is_string($partial) ? [$partial] : $partial;
        $result = new Parameters();

        $level = 0;
        do {
            $items = \Phpfox::get('db')
                ->select('*')
                ->from(':core_menu_item')
                ->where('menu_id=?', trim($menu))
                ->where('package_id in ?', \Phpfox::get('core.packages')->getIds())
                ->where('parent_name in ?', $scans)
                ->where('is_active=?', 1)
                ->order('ordering', 1)
                ->all();

            // reset parent_item to 0.

            $scans = [];
            array_walk($items, function ($row) use ($result, &$scans, $level) {
                $result->set($row['name'], [
                    'id'         => $row['id'],
                    'params'     => (array)json_decode($row['params'], 1),
                    'label'      => $row['label'],
                    'ordering'   => $row['ordering'],
                    'name'       => $row['name'],
                    'route'      => $row['route'],
                    'parent'     => $level == 0 ? '' : $row['parent_name'],
                    'extra'      => (array)json_decode($row['extra'], 1),
                    'href'       => $row['href'],
                    'permission' => $row['permission'],
                    'active'     => $row['is_active'],
                    'event'      => $row['is_active'],
                    'custom'     => $row['is_custom'],
                    'type'       => $row['item_type'],
                ]);
            });

        } while (!empty($scans) and ++$level < 4);

        return $result;
    }

    public function getNavigationParameter($menu, $partial = null)
    {
        if ($partial) {
            return $this->_getNavigationPartialParameters($menu, $partial);
        } else {
            return $this->_getNavigationParameter($menu);
        }
    }
}