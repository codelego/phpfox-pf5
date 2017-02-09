<?php

namespace Phpfox\Assets;


use Leafo\ScssPhp\Compiler;

class StylesheetCompiler
{
    /**
     * @return string
     */
    public function getInitial()
    {
        $initial = [
            '@import "user-variables";',
            '@import "variables";',
            '@import "config-variables";',
            '@import "bootstrap/mixins";',
            '@import "mixins";',
        ];

        return implode(PHP_EOL, $initial);
    }

    /**
     * Rebuild sass
     *
     * @param string $source
     * @param string $destination Output filename
     * @param array  $variables   Sass variable array
     * @param array  $paths       Import paths
     *
     * @return bool
     *
     * todo improve chmod method
     */
    public function rebuild($source, $destination, $variables, $paths)
    {
        if (!_ensure_directory(dirname($destination))) {
            throw new \RuntimeException("Oops! Could not write to `$destination`");
        }

        if (file_exists($destination) and !is_writeable($destination)) {
            throw new \InvalidArgumentException("Oops! Could not write to file `$destination`");
        }


        $source = $this->getInitial() . PHP_EOL . $source;

        $content = $this->compile($source, $variables, $paths);

        $fp = fopen($destination, 'w');

        if (!$fp) {
            throw new \InvalidArgumentException("Oops! Could not write to file [$destination]");
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
            $compiler = new Compiler();

            if (!empty($variables)) {
                $compiler->setVariables($variables);
            }

            if (!empty($paths)) {
                $compiler->setImportPaths($paths);
            }

            $compiler->setFormatter('Leafo\ScssPhp\Formatter\Compressed');

            $compiler->setIgnoreErrors(false);

            $compiler->getVariables();

            return $compiler->compile($source);

        } catch (\Exception $ex) {
            throw new \InvalidArgumentException($ex->getMessage());
        }
    }
}