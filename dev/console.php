<?php

include '../config/bootstrap.php';


$result  = preg_match("#^pages/(?P<name>[^/]++)(?:/(?P<any>.+))?$#u", 'pages/2');

var_dump($result);

