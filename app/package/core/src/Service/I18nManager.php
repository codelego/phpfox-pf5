<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\I18nCurrency;
use Neutron\Core\Model\I18nLocale;
use Neutron\Core\Model\I18nMessage;
use Neutron\Core\Model\I18nTimezone;

class I18nManager
{
    /**
     * @param array  $domainMessages
     * @param string $packageId
     * @param string $localeId
     */
    public function insertDomainMessages($domainMessages, $packageId, $localeId = '')
    {
        $localeId = (string)$localeId;
        $packageId = (string)$packageId;

        foreach ($domainMessages as $domainId => $messages) {
            if (!$domainId) {
                $domainId = '';
            }

            $expectedNames = array_keys($messages);

            if (empty($expectedNames)) {
                continue;
            }

            /** @var I18nMessage[] $entries */
            $entries = _model('i18n_message')
                ->select()
                ->where('locale_id=?', $localeId)
                ->where('domain_id=?', $domainId)
                ->where('message_name in ?', $expectedNames)
                ->all();

            $currentNames = [];

            array_walk($entries, function (I18nMessage $msg) use (&$currentNames) {
                $currentNames[] = $msg->getMessageName();
            });

            $shouldInsertNames = array_diff($expectedNames, $currentNames);

            foreach ($shouldInsertNames as $messageName) {
                _model('i18n_message')
                    ->insert([
                        'locale_id'     => $localeId,
                        'message_name'  => $messageName,
                        'message_value' => $messages[$messageName],
                        'domain_id'     => $domainId,
                        'package_id'    => $packageId,
                        'is_json'       => 0,
                        'is_updated'    => 0,
                    ]);
            }
        }
    }

    public function getDirectionIdOptions()
    {
        return [
            ['value' => 'ltr', 'label' => 'Left to right'],
            ['value' => 'rtl', 'label' => 'Right to left'],
        ];
    }

    /**
     * @return array
     */
    public function getTimezoneIdOptions()
    {
        $select = _model('i18n_timezone')
            ->select()
            ->where('is_active=?', 1)
            ->order('ordering', 1);
        return array_map(function (I18nTimezone $tz) {
            return [
                'value' => $tz->getTimezoneCode(),
                'label' => sprintf('(%s) %s', $tz->getTimezoneOffset(), $tz->getTimezoneLocation()),
            ];
        }, $select->all());
    }

    /**
     * @return array
     */
    public function getCurrencyIdOptions()
    {
        $select = _model('i18n_currency')
            ->select()
            ->order('ordering', 1);

        return array_map(function (I18nCurrency $entry) {
            return [
                'label' => $entry->getName(),
                'value' => $entry->getId(),
            ];
        }, $select->all());
    }

    /**
     * @return array
     */
    public function getLocaleIdOptions()
    {
        $select = _model('i18n_locale')
            ->select()
            ->where('is_active=1');

        return array_map(function (I18nLocale $item) {
            return ['value' => $item->getId(), 'label' => $item->getNativeName()];
        }, $select->all());
    }
}