<?php

include __DIR__ . '/constants.php';
include __DIR__ . '/functions.php';

function spl_autoload($class_name)
{

    $data = [
        'Phpfox\\Framework' => [
            'library/phpfox-framework/src/',
            'library/phpfox-framework/test',
        ],
    ];

}

spl_autoload_register('spl_autoload');