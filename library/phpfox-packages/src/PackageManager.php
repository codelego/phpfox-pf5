<?php
namespace Phpfox\Package;

class PackageManager
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var bool
     */
    protected $initialized = false;

    /**
     * @return array
     */
    public function all()
    {
        if (!$this->initialized) {
            $this->initialize();
        }

        return $this->data;
    }

    protected function initialize()
    {
        $this->initialized = true;

        $this->data = \Phpfox::get('package.loader')->loadEnablePaths();
    }

    public function get($id)
    {
        if (!$this->initialized) {
            $this->initialize();
        }
        return isset($this->data[$id]) ? $this->data[$id] : null;
    }

    public function has($id)
    {
        if (!$this->initialized) {
            $this->initialize();
        }
        return isset($this->data[$id]);
    }

    public function import($zip)
    {
        if (!$zip) {
            ;
        }
        if (!class_exists('ZipArchive')) {
            throw new \InvalidArgumentException("Oops! ZipArchive extension is required.");
        }

    }

    /**
     * @param $id
     */
    public function export($id)
    {
        if (!class_exists('ZipArchive')) {
            throw new \InvalidArgumentException("Oops! ZipArchive extension is required.");
        }

        $info = \Phpfox::get('package.loader')->loadPackageInfo($id);

        $dir = PHPFOX_DIR . $info['path'];

        /**
         * A. system
         * 1. language_phrase
         * 2. email template
         * 3. navigation
         * 4. permission
         * 5. feed type
         * 6. events
         * 7. action lists
         *
         * Package data.
         * 1. database structure
         * 2. initial data
         *
         */

        $this->archive($dir);
    }


    public function archive($dir)
    {
        if (!is_dir($dir)) {
            throw new \InvalidArgumentException("Oops! Invalid directory '{$dir}'.");
        }
        $info = include $dir . 'config/export/info.php';

        $includePaths = $info['paths'];
        $exportFilename = $info['name'];

        $destinationZipFilename = PHPFOX_DIR . 'data/package/'
            . $exportFilename . '.zip';

        if (file_exists($destinationZipFilename)) {
            if (!@unlink($destinationZipFilename)) {
                throw new \RuntimeException('Archive file "%s" exists!');
            }
        }

        $zip = new \ZipArchive();

        if (false == ($zip->open($destinationZipFilename,
                \ZipArchive::CREATE))
        ) {
            throw new \RuntimeException('Can not create zip archive "%s"',
                $destinationZipFilename);
        }

        $fileCounter = 0;

        foreach ($includePaths as $includePath) {

            $includePath = realpath(PHPFOX_DIR . $includePath);

            if (!$includePath) {
                continue;
            }

            if (is_file($includePath)) {
                $temp = $this->correctPath($includePath);
                if (!$temp) {
                    continue;
                }
                $zip->addFile($includePath, $temp);
                $fileCounter++;
                continue;
            }


            if (!is_dir($includePath)) {
                continue;
            }

            $directory = new \RecursiveDirectoryIterator($includePath,
                \RecursiveDirectoryIterator::SKIP_DOTS);
            $iterator = new \RecursiveIteratorIterator($directory);

            foreach ($iterator as $info) {

                $pathname = $info->getPathName();

                if ($this->isIgnored($pathname)) {
                    continue;
                }

                $temp = $this->correctPath($pathname);

                if (!$temp) {
                    continue;
                }

                if ($info->isDir()) {
                    $zip->addEmptyDir($temp);
                }
                if ($info->isFile()) {
                    $fileCounter++;
                    $zip->addFile($pathname, $temp);
                }
            }
        }

        $zip->close();

        if (0 == $fileCounter) {
            throw new \RuntimeException("Unexpected pathList options, there no files.");
        }

        if (!file_exists($destinationZipFilename)) {
            throw new \RuntimeException(sprintf('Could not create "%s"',
                $destinationZipFilename));
        }

        @chmod($destinationZipFilename, 0777);

        // ready for download, => Upload to store?

        return true;
    }

    /**
     * @param string $pathname
     *
     * @return string
     */
    public function correctPath($pathname)
    {
        return substr($pathname, strlen(PHPFOX_DIR));
    }

    public function isIgnored($filename)
    {
        if (!$filename) {
            ;
        }
        return false;
    }
}