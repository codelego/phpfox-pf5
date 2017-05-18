<?php

namespace Phpfox\Support;


class RequestFactory
{
    public function &createFromHttp()
    {
        $path = '/';
        $method = 'GET';
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
            $protocol . $host . $baseDir);

        if (false !== ($lPos = strpos($path, 'index.php'))) {
            $path = substr($path, $lPos + 9);
        }

        if (strpos($path, $baseDir) !== false) {
            $path = substr($path, strlen($baseDir));
        }
        $path = trim($path, '/');

        $path = preg_replace('#(/+)#', '/', '/' . ltrim($path, '/'));

        $request = new Request();
        $request->setPath($path);
        $request->setProtocol($protocol);
        $request->setHost($host);
        $request->setMethod($method);
        $request->put($_GET + $_POST);

        return $request;
    }

    /**
     * @return Request
     */
    public function factory()
    {
        return $this->createFromHttp();
    }
}