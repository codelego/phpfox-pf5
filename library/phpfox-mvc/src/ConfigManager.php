<?php

namespace Phpfox\Mvc;

/**
 * Class StandConfig
 *
 * @package Phpfox\Config
 */
class ConfigManager implements ConfigManagerInterface
{
    /**
     * @var ConfigManager
     */
    static private $singleton;

    protected $data = [];

    public static function instance()
    {
        if (null == self::$singleton) {
            self::$singleton = new static();
            self::$singleton->initialize();
        }
        return self::$singleton;
    }

    public function initialize()
    {
        $this->extend(include PHPFOX_DIR . '/config/bootstrap.config.php');
        $this->extend(include PHPFOX_DIR . '/config/db.config.php');
    }

    public function extend($data)
    {
        $this->data = _array_merge_recursive_new($this->data, $data);
        return $this;
    }

    /**
     * Fix to load modular configuration
     *
     * @return $this
     */
    public function loadModularConfig()
    {
        $result = service('db')->sqlSelect()->from(':core_package')->select('*')
            ->where('is_active=?', 1)->order('is_core', 1)->order('priority', 1)
            ->execute();

        $result = $result->fetch();
        $data = [];
        foreach ($result as $row) {
            $configFilename = PHPFOX_DIR . '/' . $row->path
                . '/config/module.config.php';
            $data = _array_merge_recursive_new($data, include $configFilename);
        }

        $autoloader = service('autoloader');
        foreach ($data['psr4'] as $k => $vs) {
            foreach ($vs as $v) {
                $autoloader->addPsr4($k, PHPFOX_DIR . DS . $v);
            }
        }

        $this->extend($data);

        // fix events continuous
        $temp = $this->data['events'];
        $events = [];

        foreach ($temp as $k => $items) {
            foreach ($items as $item) {
                if (!isset($events[$item])) {
                    $events[$item] = [];
                }
                $events[$item][] = $k;
            }
        }
        $this->data['events'] = $events;

        file_put_contents(PHPFOX_DIR . '/config/all.config.php',
            '<?php ' . var_export($this->data, true) . ';');
        events()->trigger('onApplicationConfigChanged', $this);

        return $this;
    }

    public function get($key, $item = null)
    {
        if (!isset($this->data[$key])) {
            return null;
        }

        if (null !== $item and !isset($this->data[$key][$item])) {
            return null;
        }

        if (null !== $item) {
            return $this->data[$key][$item];
        }

        return $this->data[$key];
    }


    public function set($key, $data)
    {
        $this->data[$key] = $data;
        return $this;
    }

}