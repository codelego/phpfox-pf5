<?php

namespace Phpfox\Assets;


use Leafo\ScssPhp\Compiler;

class StylesheetCompiler
{

    /**
     * @param string $input     input file name
     * @param string $output    output file name
     * @param array  $variables sass variables
     * @param array  $paths     import paths
     *
     * @return bool
     */
    public function rebuildFile($input, $output, $variables, $paths)
    {
        $source = file_get_contents($input);

        return $this->rebuild($source, $output, $variables, $paths);
    }

    /**
     * Rebuild main css
     *
     * @param string $output
     * @param array  $variables
     * @param array  $paths
     *
     * @return bool
     */
    public function rebuildMain($output, $variables = [], $paths = [])
    {
        $container = new \ArrayObject();

        $response = _emit('onRebuildMain', $container);

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

        $source = implode(PHP_EOL, $source);

        return $this->rebuild($source, $output, $variables, $paths);
    }

    /**
     * Rebuild sass
     *
     * @param string $source
     * @param string $output    output filename
     * @param array  $variables sass variable array
     * @param array  $paths     import paths
     *
     * @return bool
     *
     * todo improve chmod method
     */
    public function rebuild($source, $output, $variables, $paths)
    {
        $dir = dirname($output);

        if (!is_dir($dir)) {
            if (!@mkdir($dir, 0755, 1)) {
                throw new \RuntimeException("Can not write to $dir");
            }
            if (!chmod($dir, 0755)) {
                throw new \RuntimeException("Can not write to $dir");
            }
        }

        if (file_exists($output) and !is_writeable($output)) {
            throw new \InvalidArgumentException("Oops! Could not write to file [$output]");
        }

        $initial = [
            '@import "user-variables";',
            '@import "variables";',
            '@import "config-variables";',
            '@import "bootstrap/mixins";',
            '@import "mixins";',
        ];

        $source = implode(PHP_EOL, $initial) . PHP_EOL . $source;

        $content = $this->compile($source, $variables, $paths);

        $fp = fopen($output, 'w');

        if (!$fp) {
            throw new \InvalidArgumentException("Oops! Could not write to file [$output]");
        }

        fwrite($fp, $content);
        fclose($fp);

//        @chmod($output, 0644);

        return true;
    }

    /**
     * @param string $source    sass source
     * @param array  $variables sass variables
     * @param array  $paths     sass import paths
     *
     * @return string
     */
    public function compile($source, $variables, $paths)
    {
        try {

            // push more paths
            $paths[] = PHPFOX_DIR . 'static/base/sass';
            $paths[] = PHPFOX_DIR;

            $compiler = new Compiler();

            if (!empty($variables)) {
                $compiler->setVariables($variables);
            }

            if (!empty($paths)) {
                $compiler->setImportPaths($paths);
            }

            $compiler->setFormatter('Leafo\ScssPhp\Formatter\Compressed');

            $compiler->setIgnoreErrors(false);

            return $compiler->compile($source);

        } catch (\Exception $ex) {
            throw new \InvalidArgumentException($ex->getMessage());
        }
    }
}