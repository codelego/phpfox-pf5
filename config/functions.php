<?php

namespace {

    use Phpfox\Framework\Config\ConfigContainer;
    use Phpfox\Framework\Event\EventManager;
    use Phpfox\Framework\Service\ServiceManager;

    /**
     * Format a string using $number token
     *
     * <code>
     *  _sprintf('{0} post a {2} on {1}\'s profile', ['Nam', 'Ngon', 'photo']);
     *  // return Nam post a photo on Ngon's profile.</i>
     * </code>
     *
     * @param string $message
     * @param array  $context
     *
     * @return string
     */
    function _sprintf($message, $context)
    {
        $replace = [];
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }
        return strtr($message, $replace);
    }

    /**
     * Covert to ascii
     *
     * @param string $string
     *
     * @return string
     */
    function _asciify($string)
    {
        return $string;
    }

    /**
     * Convert string to lower case and split by dasherize
     *
     * @param string $string
     *
     * @return string
     */
    function _dasherize($string)
    {
        return $string;
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    function _inflect($string)
    {
        return str_replace(' ', '',
            ucwords(str_replace(['.', '-'], ' ', $string)));
    }

    /**
     * @param $string
     *
     * @return string
     */
    function _deflect($string)
    {
        return strtolower(trim(preg_replace('/([a-z0-9])([A-Z])/', '\1-\2',
            $string), '-. '));
    }

    /**
     * Convert a string to camel and down the first string.
     *
     * @param string $string
     *
     * @return string
     */
    function _camelize($string)
    {
        return $string;
    }

    /**
     * Convert a string to title case.
     *
     * @param string $string
     *
     * @return string
     */
    function _titleize($string)
    {
        return $string;
    }

    /**
     * Convert to path string
     *
     * @param $array
     *
     * @return string
     */
    function _pathize($array)
    {
        return preg_replace('//', PATH_SEPARATOR, implode('/', $array));
    }

    /**
     * @param $data
     *
     * @return string
     */
    function _keyize($data)
    {
        if (is_array($data)) {
            $data = implode('_', $data);
        }
        return preg_replace('/(\W)+/', '_', $data);
    }

    /**
     * @param array $data
     *
     * @return string
     */
    function _attrize($data)
    {
        if (!is_array($data)) {
            return (string)$data;
        }
        $result = [];
        foreach ($data as $name => $value) {
            $result[] = sprintf('%s="%s"', $name, $value);
        }
        return implode(' ', $result);
    }

    function _array_merge_recursive_new($base, $array)
    {
        foreach ($array as $k => $v) {
            if (!isset($base[$k])) {
                $base[$k] = $v;
            } elseif (is_array($v)) {
                $base[$k] = array_merge($base[$k], $v);
            } else {
                $base[$k] = $v;
            }
        }
        return $base;
    }

    /**
     * @return string
     */
    function _http_init_info()
    {
        $path = '/';
        $method = null;
        $host = null;
        $baseDir = '/';
        $protocol = 'http://';

        if (isset($_SERVER['SCRIPT_FILENAME'])
            and isset($_SERVER['DOCUMENT_ROOT'])
        ) {
            $baseDir = str_replace($_SERVER['DOCUMENT_ROOT'], '',
                $_SERVER['SCRIPT_FILENAME']);
        }

        $baseDir = str_replace('index.php', '', $baseDir);
        $baseDir = '/' . trim($baseDir, '/') . '/';

        if (isset($_SERVER['SERVER_PROTOCOL'])) {
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true
                ? 'https://' : 'http://';
        }

        if (isset($_SERVER['REDIRECT_URL'])) {
            $path = $_SERVER['REDIRECT_URL'];
        } elseif (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }

        if (isset($_SERVER['REQUEST_METHOD'])) {
            $method = $_SERVER['REQUEST_METHOD'];
        }

        if (isset($_SERVER['HTTP_HOST'])) {
            $host = $_SERVER['HTTP_HOST'];
        }

        if ($method) {
            ;
        }
        defined('PHPFOX_PROTOCOL') or define('PHPFOX_PROTOCOL', $protocol);
        defined('PHPFOX_BASE_DIR') or define('PHPFOX_BASE_DIR', $baseDir);
        defined('PHPFOX_BASE_URL') or define('PHPFOX_BASE_URL',
            $protocol . $protocol . $host . $baseDir);

        if (false !== ($lPos = strpos($path, 'index.php'))) {
            $path = substr($path, $lPos + 9);
        }

        if (strpos($path, $baseDir) !== false) {
            $path = substr($path, strlen($baseDir));
        }
        $path = trim($path, '/');

        if ($path == '') {
            $path = '/';
        }
        return [$path, $host, $method, $protocol];
    }

    /**
     * @return ConfigContainer
     */
    function configs()
    {
        return ConfigContainer::instance();
    }

    /**
     * @param string $key
     * @param string $item
     *
     * @return mixed|null
     */
    function config($key, $item = null)
    {
        return ConfigContainer::instance()->get($key, $item);
    }


    function service($id)
    {
        return ServiceManager::instance()->get($id);
    }

    /**
     * @return ServiceManager
     */
    function services()
    {
        return ServiceManager::instance();
    }

    /**
     * @return EventManager
     */
    function events(){

    }
}