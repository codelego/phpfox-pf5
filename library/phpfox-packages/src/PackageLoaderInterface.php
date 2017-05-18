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
     * @param string $packageId
     *
     * @return array
     */
    public function getPackageInfo($packageId);

    /**
     * @return Parameters
     */
    public function getModelParameters();

    /**
     * @return Parameters
     */
    public function getActionParameters();

    /**
     * @return Parameters
     */
    public function getEventParameters();

    /**
     * @return Parameters
     */
    public function getViewParameters();

    /**
     * @param string $adapterId
     *
     * @return Parameters
     */
    public function getStorageParameter($adapterId);

    /**
     * @param string $adapterId
     *
     * @return Parameters
     */
    public function getMailParameter($adapterId);

    /**
     * @param string $cacheId
     *
     * @return Parameters
     */
    public function getCacheParameter($cacheId);

    /**
     * This method get log container parameters, the result must contain loggers as arrays of each logger
     *
     * loggers=> [[driver=>string, params=>[]], ...]
     *
     * @param string $logId
     *
     * @return Parameters
     */
    public function getLogParameter($logId);

    /**
     * @param string $adapterId
     *
     * @return Parameters
     */
    public function getSessionParameter($adapterId);

    /**
     * @param int $roleId
     *
     * @return Parameters
     */
    public function getPermissionParameter($roleId);


    /**
     * @param string $menu
     *
     * @return Parameters
     */
    public function getNavigationParameter($menu);
}