<?php

namespace {

    /**
     * @param array|string $array ['core'=> PHPFOX_DIR
     *                            .'/package/neutron-core/view',...]
     * @param string|null  $dir
     *
     * @return array
     */
    function _get_view_map($array, $dir = null)
    {
        $map = [];
        $extension = '.phtml';
        $packageDir = realpath(PHPFOX_PACKAGE_DIR);

        if (null != $dir) {
            $array = [$array => $dir];
        }

        foreach ($array as $prefix => $directory) {
            $directory = realpath(PHPFOX_PACKAGE_DIR . DS . $directory);
            if (!$directory || !is_dir($directory)) {
                continue;
            }
            $startCharacter = strlen($directory);
            $directoryIterator
                = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory,
                RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST,
                RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
            );

            foreach ($directoryIterator as $path => $entry) {
                if ($entry->isDir()) {
                    continue;
                }

                $path = $entry->getPath() . '/' . $entry->getFilename();

                if (!strpos($path, $extension)) {
                    continue;
                }
                $prepare = str_replace($extension, '',
                    substr($path, $startCharacter + 1));

                $key = str_replace(['//', '/', '\\', '@.'],
                    ['.', '.', '.', '@'], _deflect($prefix . DS . $prepare));

                $value = str_replace($extension, '',
                    trim(str_replace($packageDir, '', $path), DS));

                $map[$key] = $value;
            }
        }

        return $map;
    }

    function _file_export($file, $data)
    {
        if (file_exists($file)) {
            @unlink($file);
        }
        file_put_contents($file,
            '<?php return ' . var_export($data, true) . ';');

        chmod($file, 0777);
    }

    /**
     * @param mixed $autoloader
     * @param array $array
     */
    function _autoload_psr4($autoloader, $array)
    {
        foreach ($array as $k => $vs) {
            foreach ($vs as $v) {
                $autoloader->addPsr4($k, PHPFOX_DIR . '/' . $v);
            }
        }
    }

    function _merge_library_config($dirs = [])
    {
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

            $merged = _array_merge_recursive($merged, include $path);

        }

        ksort($merged);

        return $merged;
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

    function _factory($ref)
    {
        if (is_string($ref)) {
            return new $ref;
        }

        $factory = array_shift($ref);

        if (is_string($factory)) {
            return call_user_func_array([
                new $factory(),
                'factory',
            ], $ref);
        }

        $class = array_shift($ref);

        if (empty($ref)) {
            return new $class();
        }

        return (new \ReflectionClass($class))->newInstanceArgs($ref);
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
    function _array_merge_recursive(&$base, $array)
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

    function _url($id, $context = [])
    {
        return \Phpfox::getUrl($id, $context);
    }
}
