<?php

namespace Phpfox\Package;


use Phpfox\Support\Parameters;

interface PackageLoaderInterface
{
    /**
     * @return array
     */
    public function getPaths();

    /**
     * @return Parameters
     */
    public function getAutoloadParameters();

    /**
     * @return Parameters
     */
    public function getRouteParameters();

    /**
     * @return array
     */
    public function getPackageParameters();

    /**
     * @param string $id
     *
     * @return array
     */
    public function getPackageInfo($id);

    /**
     * @return Parameters
     */
    public function getModelParameters();

    /**
     * @return Parameters
     */
    public function getActionParameters();
}