<?php
include __DIR__ . '/config/bootstrap.php';
$cache = \Phpfox::get('cache');
$cache->getItem('tutu');
