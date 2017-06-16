<?php

namespace Neutron\Core\Service;


use Phpfox\Support\FilterInterface;

class FilterI18nMessageService implements FilterInterface
{
    public function filter($criteria)
    {
        $select = _model('i18n_message')->select();

        if ($criteria->is('package_id','string')) {
            $select->where('package_id=?', $criteria->get('package_id','string'));
        }

        if ($criteria->is('package_id','package_id')) {
            $select->where('package_id in ?', $criteria->get('package_id','string'));
        }

        if ($criteria->is('domain_id','string')) {
            $select->where('domain_id=?', $criteria->get('domain_id','string'));
        }

        if ($criteria->is('domain_id','string')) {
            $select->where('domain_id=?', $criteria->get('domain_id','string'));
        }

        if ($criteria->is('q','string')) {
            $select->where('message_name like ? or message_value like ? or domain_id like ?',
                $criteria->get('q','contain'));
        }

        if ($criteria->is('locale_id','string')) {
            $select->where('locale_id=?', $criteria->get('locale_id','string'));
        }

        $select->order('message_name', 1);

        return $select;
    }
}