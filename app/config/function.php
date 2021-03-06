<?php

namespace {
    function _dump()
    {
        exit(var_export(func_get_args(), true));

    }

    /**
     * Note file must be have .php  extension
     * @param string $file
     *
     * @return array|mixed
     */
    function load_config($file)
    {
        $file = substr($file, 0, strlen($file) - 4);

        if (file_exists($check = $file . '.local.php')) {
            /** @noinspection PhpIncludeInspection */
            return include $check;
        }

        /** @noinspection PhpIncludeInspection */
        return include  $file . '.php';
    }

    /**
     * Generate random string by length
     *
     * @param $length
     *
     * @return string Return alpha numeric string.
     */
    function _random_string($length)
    {
        $result = '';
        $seeks = '0123456789qwertyuiopasdfghjklzxcvbnm';
        $max = strlen($seeks) - 1;
        for ($i = 0; $i < $length; ++$i) {
            $result .= substr($seeks, mt_rand(0, $max), 1);
        }
        return $result;
    }

    /**
     * Check directory then create directory if not found.
     *
     * @param string $directory
     * @param int    $permission
     *
     * @return bool
     */
    function _ensure_directory($directory, $permission = 0755)
    {
        if (!is_dir($directory)) {
            if (!@mkdir($directory, $permission, 1)) {
                return false;
            }
            if (!chmod($directory, $permission)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param string $url
     * @param array  $context
     * @param array  $params
     *
     * @return string
     */
    function _http_build_url($url, $context = [], $params = null)
    {
        if (empty($params)) {
            $query = '';
        } elseif (is_string($params)) {
            $query = '?' . $params;
        } elseif (is_array($params)) {
            $query = '?' . http_build_query($params);
        } else {
            $query = '';
        }

        return _sprintf($url, $context) . $query;
    }

    /**
     * @param array|string $config
     *
     * @return array
     */
    function _view_map($config)
    {
        $map = [];
        $extension = '.phtml';
        foreach ($config as $template => $items) {
            foreach ($items as $name => $folder) {
                $directory = realpath(PHPFOX_APP_DIR . $folder);

                if (!$directory || !is_dir($directory)) {
                    return [];
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

                    $id = $template . ':' . $name . '/' . str_replace(['//', '/', '\\',], ['/', '/', '/'],
                            _deflect($prepare));

                    $map[$id] = str_replace([PHPFOX_APP_DIR, $extension], ['', ''], $path);
                }
            }
        }


        return $map;
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
        if (!is_array($context)) {
            return $message;
        }

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
        return strtolower(trim(preg_replace('/([a-z0-9])([A-Z])/', '\1-\2', $string), '-. '));
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
        return preg_replace('//', DIRECTORY_SEPARATOR, implode('/', $array));
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
        return strtolower(preg_replace('/(\W)+/', '_', $data));
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
     * @param string $key
     * @param array  $params
     *
     * @return string
     */
    function _url($key, $params = [])
    {
        return \Phpfox::get('router')->getUrl($key, $params);
    }

    /**
     * @param string $id
     * @param string $domain
     * @param array  $context
     * @param string $locale
     *
     * @return string
     */
    function _text($id, $domain = null, $context = null, $locale = null)
    {
        return \Phpfox::get('i18n')->get($locale)->trans($id, $domain, $context);
    }


    /**
     * @param $time
     * @param $type
     * @param $locale
     *
     * @return string
     */
    function _date($time, $type = 'medium', $locale = null)
    {
        return \Phpfox::get('i18n')->get($locale)->formatDate($time, $type);
    }

    function _choice($id, $domain = null, $number = null, $context = null, $locale = null)
    {
        return \Phpfox::get('i18n')->get($locale)->choice($id, $domain, $number, $context);
    }

    /**
     * @param string $number
     * @param int    $precision
     * @param string $locale
     *
     * @return string
     */
    function _number($number, $precision = null, $locale = null)
    {
        return \Phpfox::get('i18n')->get($locale)->formatNumber($number, $precision);
    }

    /**
     * @param mixed  $number
     * @param string $code
     * @param int    $precision
     * @param string $symbol
     * @param string $locale
     *
     * @return mixed
     */
    function _currency($number, $code, $precision = null, $symbol = null, $locale)
    {
        return \Phpfox::get('i18n')->get($locale)->formatCurrency($number, $code, $precision, $symbol);
    }

    /**
     * @param bool $flag
     * @param bool $label_yes
     * @param bool $label_false
     *
     * @return string
     */
    function _yesno($flag, $label_yes = false, $label_false = false)
    {
        if ($flag && $label_yes) {
            return '<label class="label label-success">' . _text('Yes')
                . '</label>';
        }

        if (!$flag && $label_false) {
            return '<label class="label label-danger">' . _text('No')
                . '</label>';
        }

        return _text($flag ? 'Yes' : 'No');
    }
}
