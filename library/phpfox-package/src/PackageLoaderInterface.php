<?php

namespace Phpfox\Package;


interface PackageLoaderInterface
{
    public function loadEnabledPackages();

    /**
     * @param $id
     *
     * @return mixed
     */
    public function loadPackageInfo($id);
}