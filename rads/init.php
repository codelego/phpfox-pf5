<?php

include '../config/bootstrap.php';


function _rad_view_page($_view, $data)
{

    extract($data, EXTR_OVERWRITE);

    ob_start();

    include $_view;

    $_content_ = ob_get_clean();

    ob_start();

    include 'partial/_template.php';

    echo ob_get_clean();
    exit;
}

function _rad_put_contents($file, $data)
{
    $file =  PHPFOX_DIR  . $file;

    if (file_exists($file)) {
        @unlink($file);
    }

    if (!is_dir($dir = dirname($file)) && !@mkdir($dir, 0777, true)) {
        exit('Can not open ' . $dir . ' to write export');
    }

    file_put_contents($file, $data);

    if (file_exists($file)) {
        @chmod($file, 0777);
    }
}