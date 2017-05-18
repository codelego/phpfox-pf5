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

    public function getTypeIdOptions()
    {
        return [
            ['value' => 'app', 'label' => 'App'],
            ['value' => 'library', 'label' => 'Library'],
            ['value' => 'theme', 'label' => 'Theme'],
        ];
    }

    public function getAuthorIdOptions()
    {
        return array_map(function ($item) {
            return ['label' => $item['author'], 'value' => $item['author']];
        }, _model('core_package')->select('distinct author')->setPrototype(null)->all());
    }

    /**
     * @return array
     */
    public function getIds()
    {
        return array_map(function (CorePackage $corePackage) {
            return $corePackage->getName();
        }, _model('core_package')
            ->select('name')
            ->where('is_active=?', 1)
            ->all());
    }

    /**
     * @return array return [value, label] array to select, radio
     */
    public function getPackageIdOptions()
    {
        return _get_cached_value('shared.cache', '_core_package_id_options', 0, function () {
            return array_map(function (CorePackage $v) {
                return [
                    'label' => $v->getTitle(),
                    'value' => $v->getName(),
                ];
            }, _model('core_package')->select()->order('title',1)->all());
        });
    }
}