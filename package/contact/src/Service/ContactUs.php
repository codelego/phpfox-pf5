<?php

namespace Neutron\Contact\Service;

use Neutron\Contact\Model\Department;

class ContactUs
{
    /**
     * @param string $id
     *
     * @return Department
     */
    public function findDepartmentById($id)
    {
        return _model('contact_department')
            ->findById((int)$id);
    }

    public function getDefaultDepartmentId()
    {
        $entry = _model('contact_department')
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
        return _try('shared.cache', ['core', 'contact', 'departments'], 0, function () {
            return $this->_getActiveDepartmentOptions();
        });
    }

    /**
     * @return array
     */
    public function _getActiveDepartmentOptions()
    {
        return array_map(function (Department $item) {
            return ['value' => $item->getId(), 'label' => $item->getTitle()];
        }, _model('contact_department')
            ->select()
            ->where('is_active=?', 1)
            ->execute()
            ->all());
    }
}