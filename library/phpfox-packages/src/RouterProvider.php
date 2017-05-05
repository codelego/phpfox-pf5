<?php

namespace Phpfox\Package;


use Phpfox\Routing\RouterProviderInterface;

class RouterProvider implements RouterProviderInterface
{
    public function loadConfigs()
    {
        $result = ['chains' => [], 'routes' => [], 'phrases' => []];

        $paths = _service('package.loader')->loadEnablePaths();

        foreach ($paths as $path) {
            $data = include PHPFOX_DIR . $path . '/config/router.php';
            if (isset($data['chains'])) {
                foreach ($data['chains'] as $value) {
                    $result['chains'][] = $value;
                }
            }

            if (isset($data['routes'])) {
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

            if (isset($data['phrases'])) {
                foreach ($data['phrases'] as $name => $value) {
                    $result['phrases'][$name] = $value;
                }
            }
        }

        return $result;
    }
}