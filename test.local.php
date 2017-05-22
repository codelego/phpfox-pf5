<?php

define('PHPFOX_NO_CACHE', 1);
define('PHPFOX_IS_DEV', true);

date_default_timezone_set('Australia/Adelaide');

include __DIR__ . '/config/bootstrap.php';


class StaticExample
{

    static function a()
    {
        static $data;

        if (!$data) {
            $data = ['a', 'b', 'c'];
            echo 'caculate data', PHP_EOL;
        };

        return $data[mt_rand(0,count($data)-1)];
    }
}

echo StaticExample::a(), PHP_EOL;
echo StaticExample::a(), PHP_EOL;