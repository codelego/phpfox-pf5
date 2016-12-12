<?php

namespace Phpfox\Package;


interface PackageLoaderInterface
{
    /**
     * @return array
     */
    public function loadEnablePaths();

    /**
     * @return array
     */
    public function loadAutoloadConfigs();

    /**
     * @return array
     */
    public function loadRouterConfigs();

    /**
     * @return array
     */
    public function loadPackageConfigs();

    /**
     * @param string $id
     *
     * @return array
     */
    public function loadPackageInfo($id);
}