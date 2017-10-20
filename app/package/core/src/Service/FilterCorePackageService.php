<?php

namespace Neutron\Core\Service;


use Phpfox\Kernel\FilterInterface;

class FilterCorePackageService implements FilterInterface
{
    /**
     * @param \Phpfox\Kernel\FilterCriteria $criteria
     *
     * @return \Phpfox\Db\SqlSelect
     */
    public function filter($criteria)
    {
        $select = \Phpfox::model('core_package')->select();

        if ($criteria->is('type_id', 'string')) {
            $select->where('type_id=?', $criteria->get('type_id', 'string'));
        }

        return $select;
    }
}