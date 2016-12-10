<?php

$mem = memory_get_peak_usage();

require_once '../config/bootstrap.php';


$model = Phpfox::findById('pages',1);

var_dump($model);
