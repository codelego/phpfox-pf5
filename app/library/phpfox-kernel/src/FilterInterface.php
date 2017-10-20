<?php

namespace Phpfox\Kernel;


interface FilterInterface
{

    /**
     * @param FilterCriteria $criteria
     *
     * @return mixed
     */
    public function filter($criteria);
}