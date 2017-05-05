<?php

namespace Neutron\Core\Service;


class I18nLanguage
{
    /**
     * @return array
     */
    public function getActiveOptions()
    {

        $rows = _get('db')->select('*')
            ->from(':i18n_language')
            ->where('is_active=1')
            ->execute()
            ->all();

        $result = [];

        foreach ($rows as $r) {
            $result[$r['name']] = [
                'value' => $r['id'],
                'label' => empty($r['native_name']) ? $r['name']
                    : $r['native_name'],
            ];
        }

        ksort($result);

        return array_values($result);
    }
}