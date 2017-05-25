<?php

namespace Neutron\Core\Service;


use Phpfox\Support\FilterInterface;

class FilterI18nMessageService implements FilterInterface
{
    public function filter($criteria)
    {
        $select = _model('i18n_message')->select();



        if ($criteria->isString('package_id')) {
            $select->where('package_id=?', $criteria->get('package_id'));
        }

        if ($criteria->isArray('package_id')) {
            $select->where('package_id in ?', $criteria->getArray('package_id'));
        }

        if ($criteria->isString('domain_id')) {
            $select->where('domain_id=?', $criteria->getString('domain_id'));
        }

        if ($criteria->isString('domain_id')) {
            $select->where('domain_id=?', $criteria->getString('domain_id'));
        }

        if ($criteria->isString('q')) {
            $select->where('message_name like ? or message_value like ? or domain_id like ?',
                $criteria->quoteContain('q'));
        }

        if ($criteria->isString('locale_id')) {
            $select->where('locale_id=?', $criteria->getString('locale_id'));
        }

        $select->order('message_name', 1);

        return $select;
    }
}