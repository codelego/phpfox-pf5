<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\SiteSettingValue;

class SettingManager
{
    /**
     * @param string $key
     * @param string $value
     *
     * @return boolean
     * @throws \InvalidArgumentException
     */
    public function updateValue($key, $value)
    {
        $group = null;
        $name = null;

        if (strpos($key, '.')) {
            list($group, $name) = explode('.', $key);
        } elseif (strpos($key, '__')) {
            list($group, $name) = explode('__', $key);
        }

        if (empty($name) or empty($group)) {
            throw new \InvalidArgumentException("Invalid parameters");
        }

        /** @var SiteSettingValue $entry */
        $entry = _model('site_setting_value')
            ->select()
            ->where('group_id=?', (string)$group)
            ->where('name=?', (string)$name)
            ->first();

        if (!$entry) {
            throw new \InvalidArgumentException("Invalid parameters");
        }

        $entry->setValueActual(json_encode($value));
        $entry->save();

        return true;
    }
}