<?php

namespace Phpfox\Package;


interface PackageLoaderInterface
{
    /**
     * @return array
     */
    public function getPaths();

    /**
     * @return array
     */
    public function getAutoload();

    /**
     * @return array
     */
    public function getRoutes();

    /**
     * @return array
     */
    public function getParameters();

    /**
     * @param string $id
     *
     * @return array
     */
    public function loadPackageInfo($id);

    /**
     * @return array
     */
    public function getModels();

    /**
     * @return array
     */
    public function getControllers();
}