<?php

namespace Phpfox\Command;


class UpdatePackageInformation implements CommandInterface
{
    public function execute($params)
    {
        $id = @$params['id'];

        if (!$id) {
            return false;
        }

        $dir = realpath(PHPFOX_PACKAGE_DIR . '/' . $id);

        if (!$dir or !is_dir($dir)) {
            return false;
        }

        /**
         * check outer then generate.
         */

        $prefix = @$params['prefix'];
        $viewPrefix = @$params['view_prefix'];
        $controllerPrefix = @$params['controller_prefix'];
        $namespace = $params['namespace'];
        if (!$viewPrefix) {
            $viewPrefix = $prefix;
        }
        if (!$controllerPrefix) {
            $controllerPrefix = $prefix;
        }

        $info['view_map'] = $this->scanViews($viewPrefix, $dir);

        $info['controller_map']
            = $this->scanControllers($namespace, $controllerPrefix, $dir);


        var_export($info);

        return true;

    }

    private function scanViews($prefix, $scanDir)
    {
        $view_map = [];
        $extension = '.phtml';
        $packageDir = realpath(PHPFOX_PACKAGE_DIR);

        $array = [
            $prefix  => $scanDir . '/view',
            'layout' => $scanDir . '/layout',
        ];

        foreach ($array as $prefix => $directory) {
            $directory = realpath($directory);
            if (!$directory || !is_dir($directory)) {
                continue;
            }
            $startCharacter = strlen($directory);
            $directoryIterator
                = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory,
                \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::SELF_FIRST,
                \RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
            );

            foreach ($directoryIterator as $path => $entry) {
                if ($entry->isDir()) {
                    continue;
                }

                $path = $entry->getPath() . '/' . $entry->getFilename();

                if (!strpos($path, $extension)) {
                    continue;
                }
                $prepare = str_replace($extension, '',
                    substr($path, $startCharacter + 1));

                $key = str_replace(['//', '/', '\\', '@.'],
                    ['.', '.', '.', '@'], _deflect($prefix . DS . $prepare));

                $value = str_replace($extension, '',
                    trim(str_replace($packageDir, '', $path), DS));

                $view_map[$key] = $value;
            }
        }

        return $view_map;
    }

    private function scanControllers($namespace, $prefix, $scanDir)
    {
        $map = [];
        $prefix = preg_replace('/[\W\-\_]+/', '', $prefix);
        $extension = 'Controller.php';
        $replaceDir = realpath($scanDir . '/src/Controller');
        $namespace = trim($namespace, '\\') . '\\';

        $array = [
            $prefix => $scanDir . '/src/Controller',
        ];

        foreach ($array as $prefix => $directory) {
            $directory = realpath($directory);
            if (!$directory || !is_dir($directory)) {
                continue;
            }
            $startCharacter = strlen($directory);
            $directoryIterator
                = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory,
                \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::SELF_FIRST,
                \RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
            );

            foreach ($directoryIterator as $path => $entry) {
                if ($entry->isDir()) {
                    continue;
                }

                $path = $entry->getPath() . '/' . $entry->getFilename();

                if (!strpos($path, $extension)) {
                    continue;
                }
                $prepare = str_replace($extension, '',
                    substr($path, $startCharacter + 1));

                $key = str_replace(['//', '/', '\\', '@.'],
                    ['.', '.', '.', '@'], _deflect($prefix . DS . $prepare));

                $value = $namespace . str_replace('.php', '',
                        trim(str_replace($replaceDir, '', $path), DS));

                $map[$key] = $value;
            }
        }

        return $map;
    }

}