<?php

include '../config/bootstrap.php';

function _rad_view_page($_view, $data)
{

    extract($data, EXTR_OVERWRITE);

    ob_start();

    include $_view;

    $_content_  = ob_get_clean();

    ob_start();

    include 'partial/_template.php';

    echo ob_get_clean(); exit;
}