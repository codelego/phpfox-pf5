<?php

$pattern = '#^layout(?:/(?P<retain>.+))?$#u';
$subject =  'layout';

preg_match($pattern, $subject, $matches);

var_dump($matches);
