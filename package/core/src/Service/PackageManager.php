<?php

namespace Neutron\Core\Service;

use Neutron\Core\Model\CorePackage;

class PackageManager
{
    /**
     * Find a package entry by "identityl"
     *
     * @param int $identity
     *
     * @return CorePackage
     */
    public function findById($identity)
    {
        return _model('core_package')
            ->findById((int)$identity);
    }

    /**
     * @param string $name
     *
     * @return CorePackage
     */
    public function findByName($name)
    {
        return _model('core_package')
            ->select()
            ->where('name=?', (string)$name)
            ->first();
    }

    /**
     * @return array return [value, label] array to select, radio
     */
    public function getPackageIdOptions()
    {
        return _load(null, '_core_package_id_options', 0, function () {
            return array_map(function (CorePackage $v) {
                return [
                    'label' => $v->getTitle(),
                    'value' => $v->getName(),
                ];
            }, _model('core_package')->select()->all());
        });
    }
}