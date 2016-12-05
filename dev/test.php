<?php

$mem = memory_get_peak_usage();

require_once '../config/bootstrap.php';


$user = Phpfox::findById('user',1);

$start = microtime(true);
for($i =0; $i< 1; ++$i) {
    $token = Phpfox::findById('auth_token', 4);
    $token->setUserId('12');

    $token->save();
}

echo (microtime(true) - $start)*1000, ' ms', PHP_EOL;

echo (memory_get_peak_usage() - $mem)/1048576 , ' kb';

