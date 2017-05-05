<?php

namespace Neutron\Report\Service;

use Neutron\Report\Model\Report;
use Neutron\Report\Model\ReportCategory;

class ReportManager
{

    /**
     * @param mixed $id
     *
     * @return Report
     */
    public function findReportById($id)
    {
        return _model('report')
            ->findById(intval($id));
    }

    /**
     * @param $id
     *
     * @return ReportCategory
     */
    public function findCategoryById($id)
    {
        return _model('report_category')
            ->findById((int)$id);
    }

    /**
     * @param array $data
     *
     * @return ReportManager
     */
    public function addReport($data)
    {
        $item = _model('report')
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
        $result = _model('report')
            ->deleteById(intval($reportId));

        return $result->isValid();
    }

    /**
     * @return array
     */
    public function getActiveCategoryOptions()
    {
        return _load(null, ['report', 'getActiveCategoryOptions'], 0, function () {
            return $this->_getActiveCategoryOptions();
        });
    }

    public function _getActiveCategoryOptions()
    {
        return array_map(function (ReportCategory $item) {
            return ['label' => $item->getName(), 'value' => $item->getId()];
        }, _model('report_category')->select()
            ->where('is_active=1')->execute()->all());
    }
}