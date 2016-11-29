<?php

namespace Phpfox\Mvc;


interface ViewLoaderInterface
{
    /**
     * @param string $name
     *
     * @return string|null
     */
    public function load($name);

}