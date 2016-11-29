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

        if (!strpos($path, 'package.php')) {
            continue;
        }
        $paths[] = $path;
    }

}

foreach ($paths as $path) {
    if (!file_exists($path)) {
        continue;
    }

    $merged = _array_merge_recursive_new($merged, include $path);

}

ksort($merged);

$filename = __DIR__. '/config/service.init.php';

file_put_contents($filename, '<?php return ' . var_export($merged, true) . ';');

chmod($filename, 0777);


echo "Done", PHP_EOL;