<?php

$dirs = [
    __DIR__ . '/library/',
];
$paths = [];
$merged = [];

function _array_merge_recursive_new($base, $array)
{
    foreach ($array as $k => $v) {
        if (!isset($base[$k])) {
            $base[$k] = $v;
        } elseif (is_array($v)) {
            $base[$k] = array_merge($base[$k], $v);
        } else {
            $base[$k] = $v;
        }
    }
    return $base;
}

foreach ($dirs as $libraryDir) {
    $directoryIterator
        = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($libraryDir,
        RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST,
        RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
    );

    foreach ($directoryIterator as $path => $entry) {
        if ($entry->isDir()) {
            continue;
        }

        $path = $entry->getPath() . '/' . $entry->getFilename();

        if (!strpos($path, 'package.config.php')) {
            continue;
        }

        $new =  str_replace('package.config.php','package.php', $path);

        $cmd =  "mv {$path} {$new}";
        exec($cmd);
    }
}
