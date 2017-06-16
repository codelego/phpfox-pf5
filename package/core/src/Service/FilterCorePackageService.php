<?php

namespace Neutron\Core\Service;


use Phpfox\Support\FilterInterface;

class FilterCorePackageService implements FilterInterface
{
    /**
     * @param \Phpfox\Support\FilterCriteria $criteria
     *
     * @return \Phpfox\Db\SqlSelect
     */
    public function filter($criteria)
    {
        $select = _model('core_package')->select();

        if ($criteria->is('type_id', 'string')) {
            $select->where('type_id=?', $criteria->get('type_id', 'string'));
        }

        return $select;
    }
}