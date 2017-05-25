<?php

namespace Phpfox\Support;


interface FilterInterface
{

    /**
     * @param FilterCriteria $criteria
     *
     * @return mixed
     */
    public function filter($criteria);
}