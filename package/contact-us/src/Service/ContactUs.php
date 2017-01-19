<?php

namespace Neutron\ContactUs\Service;

use Neutron\ContactUs\Model\ContactDepartment;

class ContactUs
{
    /**
     * @param $id
     *
     * @return ContactDepartment
     */
    public function findDepartmentById($id)
    {
        return \Phpfox::getModel('contact_department')
            ->findById((int)$id);
    }

    public function getDefaultDepartmentId()
    {
        $entry = \Phpfox::getModel('contact_department')
            ->select()
            ->where('is_active=?', 1)
            ->order('is_default', -1)
            ->limit(1)
            ->execute()
            ->first();

        if ($entry) {
            return $entry->getId();
        }

        return 0;
    }

    /**
     * @return array
     */
    public function getActiveDepartmentOptions()
    {
        return \Phpfox::get('cache.local')
            ->with('core.contact_us.active_departments', function () {
                return $this->_getActiveDepartmentOptions();
            });
    }

    /**
     * @return array
     */
    public function _getActiveDepartmentOptions()
    {
        return array_map(function (ContactDepartment $item) {
            return ['value' => $item->getId(), 'label' => $item->getTitle()];
        }, \Phpfox::getModel('contact_department')
            ->select()
            ->where('is_active=?', 1)
            ->execute()
            ->all());
    }
}