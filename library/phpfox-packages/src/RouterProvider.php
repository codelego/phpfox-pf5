<?php

namespace Phpfox\Package;


use Phpfox\Routing\RouterProviderInterface;

class RouterProvider implements RouterProviderInterface
{
    public function loadConfigs()
    {
        $result = ['chains' => [], 'routes' => [], 'phrases' => []];

        $paths = _get('package.loader')->getPaths();

        foreach ($paths as $path) {
            if (!file_exists($filename = PHPFOX_DIR . $path . '/config/router.php')) {
                continue;
            }

            /** @noinspection PhpIncludeInspection */
            $data = include $filename;

            if (!is_array($data)) {
                continue;
            }

            if (isset($data['chains']) and is_array($data['chains'])) {
                foreach ($data['chains'] as $value) {
                    $result['chains'][] = $value;
                }
            }

            if (isset($data['routes']) and is_array($data['routes'])) {
                foreach ($data['routes'] as $name => $value) {
                    $children = null;
                    if (isset($value['children'])) {
                        $children = $value['children'];
                    }
                    unset($value['children']);
                    $result['routes'][$name] = $value;

                    if (is_array($children)) {
                        foreach ($children as $k => $v) {
                            $result['routes'][$name . '.' . $k] = $v;
                        }
                    }
                }
            }

            if (isset($data['phrases']) and is_array($data['phrases'])) {
                foreach ($data['phrases'] as $name => $value) {
                    $result['phrases'][$name] = $value;
                }
            }
        }

        return $result;
    }
}