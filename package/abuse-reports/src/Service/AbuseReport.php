<?php

namespace Neutron\AbuseReport\Service;

use Neutron\AbuseReport\Model\AbuseReportCategory;

class AbuseReport
{
    /**
     * @param $id
     *
     * @return AbuseReportCategory
     */
    public function findCategoryById($id)
    {
        return \Phpfox::getModel('abuse_report_category')
            ->findById((int)$id);
    }

    /**
     * @return array
     */
    public function getActiveCategoryOptions()
    {
        return \Phpfox::get('cache.local')
            ->with('AbuseReport.getActiveCategoryOptions', function () {
                return $this->_getActiveCategoryOptions();
            });
    }

    public function _getActiveCategoryOptions()
    {
        return array_map(function (AbuseReportCategory $item) {
            return ['label' => $item->getTitle(), 'value' => $item->getId()];
        }, \Phpfox::getModel('abuse_report_category')->select()
            ->where('is_active=1')->execute()->all());
    }
}