<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\SiteSettingValue;

class SettingManager
{
    public function getPrivateSiteIdOptions()
    {
        return [
            ['value' => '0', 'label' => _text('[Private Site Option No]', '_core.general_settings')],
            ['value' => '1', 'label' => _text('[Private Site Option Yes]', '_core.general_settings')],
        ];
    }

    public function getSiteModeIdOptions()
    {
        return [
            ['value' => '1', 'label' => _text('[Site Offline]', '_core.general_settings')],
            ['value' => '0', 'label' => _text('[Site Online]', '_core.general_settings')],
        ];
    }

    public function getAjaxModeIdOptions()
    {
        return [
            ['value' => '0', 'label' => _text('No, disable ajax mode', '_core.general_settings')],
            ['value' => '1', 'label' => _text('Yes, enable ajax mode', '_core.general_settings')],
        ];
    }

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

        $this->updateSettingRevision();

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

        $this->updateSettingRevision();
        return true;
    }

    public function updateSettingRevision()
    {
        /** @var SiteSettingValue $entries */
        $entry = _model('site_setting_value')
            ->select()
            ->where('group_id=?', 'core')
            ->where('name=?', 'setting_version')
            ->first();

        $value = time();

        if (!$entry) {
            $entry = _model('site_setting_value')
                ->create([
                    'package_id'   => 'core',
                    'form_id'      => 'core_general',
                    'name'         => 'setting_version',
                    'group'        => 'core',
                    'is_active'    => 1,
                    'ordering'     => 101,
                    'value_actual' => '"0"',
                ]);
        }
        $entry->setValueActual(json_encode($value));
        $entry->save();

        // clear super cache
        _get('shared.cache')->flush();
        _get('super.cache')->flush();
    }
}