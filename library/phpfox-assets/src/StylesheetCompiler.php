<?php

namespace Phpfox\Assets;


use Leafo\ScssPhp\Compiler;

class StylesheetCompiler
{

    /**
     * @param string $themeId
     * @param array  $variables
     * @param array  $paths
     *
     * @return bool
     */
    public function rebuild($themeId, $variables = [], $paths = [])
    {
        $container = new \ArrayObject();

        $response = _emit('onStylesheetRebuild', $container);
        $source = [
            '@import "user-variables";',
            '@import "variables";',
            '@import "config-variables";',
            '@import "bootstrap/mixins";',
            '@import "mixins";',
        ];

        $source[] = '@import "main";';

        if ($response) {
            foreach ($response as $item) {
                if (is_array($item)) {
                    foreach ($item as $v) {
                        $source[] = sprintf('@import "%s";', $v);
                    }
                } else {
                    if (is_string($item)) {
                        $source[] = sprintf('@import "%s";', $item);
                    }
                }
            }
        }

        $content = $this->compile($source, $variables, $paths);

        $outputFilename = sprintf(PHPFOX_DIR . '/static/theme-%s/css/main.css',
            $themeId);

        $dir = dirname($outputFilename);

        if (!is_dir($dir)) {
            if (!@mkdir($dir, 0755, 1)) {
                throw new \RuntimeException("Can not write to $dir");
            }
            @chmod($dir, 0755);
        }

        $fp = fopen($outputFilename, 'w');

        if (!$fp) {
            throw new \InvalidArgumentException("Oops! Could not write to file [$outputFilename]");
        }

        fwrite($fp, $content);
        fclose($fp);

        @chmod($outputFilename, 0777); // change correct permissions.

        return true;
    }

    /**
     * @param string $source
     * @param array  $variables
     * @param array  $paths
     *
     * @return string
     */
    public function compile($source, $variables, $paths)
    {
        try {

            $paths[] = PHPFOX_DIR . 'static/base/sass';
            $paths[] = PHPFOX_DIR;

            $compiler = new Compiler();

            if (!empty($variables)) {
                $compiler->setVariables($variables);
            }

            if (!empty($paths)) {
                $compiler->setImportPaths($paths);
            }

            if (is_array($source)) {
                $source = implode(PHP_EOL, $source);
            }

            $compiler->setFormatter('Leafo\ScssPhp\Formatter\Compressed');

            $compiler->setIgnoreErrors(false);

            return $compiler->compile($source);

        } catch (\Exception $ex) {
            throw new \InvalidArgumentException($ex->getMessage());
        }
    }
}