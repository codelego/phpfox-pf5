<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\SettingValue;

class SettingManager
{
    /**
     * @return array
     */
    public function getLogLevelOptions()
    {
        return [
            ['value' => 'emergency', 'label' => 'Emergency'],
            ['value' => 'alert', 'label' => 'Alert'],
            ['value' => 'critical', 'label' => 'Critical'],
            ['value' => 'error', 'label' => 'Error'],
            ['value' => 'warning', 'label' => 'Warning'],
            ['value' => 'notice', 'label' => 'Notice'],
            ['value' => 'info', 'label' => 'Info'],
            ['value' => 'debug', 'label' => 'Debug'],
        ];
    }

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

        /** @var SettingValue $entry */
        $entry = \Phpfox::model('setting_value')
            ->select()
            ->where('domain_id=?', (string)$group)
            ->where('name=?', (string)$name)
            ->first();

        if (!$entry) {
            trigger_error('There are no setting to save ' . $key, E_USER_WARNING);
            return false;
        }

        $entry->setValueActual(json_encode($value));
        $entry->save();

        \Phpfox::trigger('onSettingsChanged');

        return true;
    }

    /**
     * @param array $domains
     *
     * @return array
     */
    public function getForEdit($domains)
    {

        $result = [];
        foreach ($domains as $domain => $names) {
            /** @var SettingValue[] $entries */
            $entries = \Phpfox::model('setting_value')
                ->select()
                ->where('domain_id=?', (string)$domain)
                ->where('name in ?', $names)
                ->all();

            foreach ($entries as $entry) {
                $result[$domain . '__' . $entry->getName()] = json_decode($entry->getValueActual(), true);
            }
        }
        return $result;
    }

    /**
     * @param array $domains
     *
     * @return bool
     */
    public function updateValues($domains)
    {
        foreach ($domains as $domain => $values) {
            $keys = array_keys($values);

            /** @var SettingValue[] $entries */
            $entries = \Phpfox::model('setting_value')
                ->select()
                ->where('domain_id=?', (string)$domain)
                ->where('name in ?', $keys)
                ->all();

            foreach ($entries as $entry) {
                $key = $entry->getName();
                $entry->setValueActual(json_encode($values[$key]));
                $entry->save();
            }
        }


        \Phpfox::trigger('onSettingsChanged');

        return true;
    }

    public function updateSettingRevision()
    {
        /** @var SettingValue $entries */
        $entry = \Phpfox::model('setting_value')
            ->select()
            ->where('domain_id=?', 'core')
            ->where('name=?', 'setting_version')
            ->first();

        $value = time();

        if (!$entry) {
            $entry = \Phpfox::model('setting_value')
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
    }
}