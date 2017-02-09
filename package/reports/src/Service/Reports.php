<?php

namespace Neutron\AbuseReport\Service;

use Neutron\AbuseReport\Model\Category;
use Neutron\AbuseReport\Model\Report;

class Reports
{

    /**
     * @param mixed $id
     *
     * @return Report
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
     * @return Report
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