<?php

namespace Neutron\Report\Service;

use Neutron\Report\Model\Category;
use Neutron\Report\Model\Report;

class ReportManager
{

    /**
     * @param mixed $id
     *
     * @return ReportManager
     */
    public function findReportById($id)
    {
        return \Phpfox::with('report')
            ->findById(intval($id));
    }

    /**
     * @param $id
     *
     * @return Category
     */
    public function findCategoryById($id)
    {
        return \Phpfox::with('report_category')
            ->findById((int)$id);
    }

    /**
     * @param array $data
     *
     * @return ReportManager
     */
    public function addReport($data)
    {
        $item = \Phpfox::with('report')
            ->create($data);

        $item->save();

        return $item;
    }

    /**
     * @param string $reportId
     *
     * @return bool
     */
    public function deleteReport($reportId)
    {
        $result = \Phpfox::with('report')
            ->deleteById(intval($reportId));

        return $result->isValid();
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
        return array_map(function (Category $item) {
            return ['label' => $item->getTitle(), 'value' => $item->getId()];
        }, \Phpfox::with('report_category')->select()
            ->where('is_active=1')->execute()->all());
    }
}