<?php

namespace {

    use Phpfox\Mvc\App as Application;
    use Phpfox\Mvc\ConfigContainer;
    use Phpfox\Mvc\EventManager;

    // usage global namespace.
    class Phpfox extends Application
    {
    }

    function _merge_library_config($dirs = [])
    {
        $dirs[] = PHPFOX_DIR . '/library/';
        $paths = [];
        $merged = [];

        foreach ($dirs as $libraryDir) {
            $directoryIterator
                = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($libraryDir,
                RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST,
                RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
            );

            foreach ($directoryIterator as $path => $entry) {
                if ($entry->isDir()) {
                    continue;
                }

                $path = $entry->getPath() . '/' . $entry->getFilename();

                if (!strpos($path, 'package.php')) {
                    continue;
                }
                $paths[] = $path;
            }

        }

        foreach ($paths as $path) {
            if (!file_exists($path)) {
                continue;
            }

            $merged = _array_merge_recursive_new($merged, include $path);

        }

        ksort($merged);

        $autoloadPsr4 = $merged['autoload.psr4'];
        unset($merged['autoload.psr4']);
        $filename = PHPFOX_DIR . '/config/psr4.init.php';
        file_put_contents($filename,
            '<?php return ' . var_export($autoloadPsr4, true) . ';');


        $filename = PHPFOX_DIR . '/config/service.init.php';
        file_put_contents($filename,
            '<?php return ' . var_export($merged, true) . ';');

        chmod($filename, 0777);
    }

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

    /**
     * @param $base
     * @param $array
     *
     * @return mixed
     */
    function _array_merge_recursive_new(&$base, $array)
    {
        if (is_array($array)) {
            foreach ($array as $k => $v) {
                if (!isset($base[$k])) {
                    $base[$k] = $v;
                } elseif (is_array($v)) {
                    $base[$k] = array_merge($base[$k], $v);
                } else {
                    $base[$k] = $v;
                }
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
        \Phpfox::get('configs');
    }

    /**
     * @param string $key
     * @param string $item
     *
     * @return mixed|null
     */
    function config($key, $item = null)
    {
        return \Phpfox::get('configs')->get($key, $item);
    }


    function service($id)
    {

    }

    /**
     * @return EventManager
     */
    function &events()
    {
        return \Phpfox::get('events');
    }

    if (true) {
        $data = include PHPFOX_DIR . '/config/service.init.php';
        $data['db.adapters']['default'] = include PHPFOX_DIR
            . '/config/db.init.php';

        \Phpfox::init();
        $configs = \Phpfox::get('configs');

        $configs->merge($data);

        /** @var \Phpfox\Mysqli\MysqliAdapter $db */

        $db = \Phpfox::get('db');

        /** @var \Phpfox\Mvc\ConfigContainer $configs */


        $rows = $db->select()->select('*')->from(':core_package')
            ->where('is_active=?', 1)->order('priority', 1)->execute()->fetch();

        foreach ($rows as $row) {
            $configs->merge(include PHPFOX_DIR . '/' . $row['path']
                . '/config/package.php');
        }
    }

}
