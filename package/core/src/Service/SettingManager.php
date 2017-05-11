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

    /**
     * @param array $groups
     *
     * @return array
     */
    public function getForEdit($groups)
    {

        $result = [];
        foreach ($groups as $group => $names) {
            /** @var SiteSettingValue[] $entries */
            $entries = _model('site_setting_value')
                ->select()
                ->where('group_id=?', (string)$group)
                ->where('name in ?', $names)
                ->all();

            foreach ($entries as $entry) {
                $result[$group . '__' . $entry->getName()] = json_decode($entry->getValueActual(), true);
            }
        }
        return $result;
    }

    /**
     * @param array $groups
     *
     * @return bool
     */
    public function updateGroupValues($groups)
    {
        foreach ($groups as $group => $values) {
            $keys = array_keys($values);

            /** @var SiteSettingValue[] $entries */
            $entries = _model('site_setting_value')
                ->select()
                ->where('group_id=?', (string)$group)
                ->where('name in ?', $keys)
                ->all();

            foreach ($entries as $entry) {
                $key = $entry->getName();
                $entry->setValueActual(json_encode($values[$key]));
                $entry->save();
            }
        }
        return true;
    }
}