<?php

namespace Neutron\Core\Service;


use Phpfox\Support\FilterInterface;

class FilterCorePackage implements FilterInterface
{
    /**
     * @param \Phpfox\Support\FilterCriteria $criteria
     *
     * @return \Phpfox\Db\SqlSelect
     */
    public function filter($criteria)
    {
        $select = _model('core_package')->select();

        $select->filter($criteria, [
            'q:contain'        => 'title like ?',
            'type_id:string'   => 'type_id=?',
            'author_id:string' => 'author_id=?',
        ]);

        return $select;
    }
}