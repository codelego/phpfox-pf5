<?php

namespace Neutron\Core\Service;

use Phpfox\I18n\I18nMessageLoaderInterface;

class I18nMessageLoader implements I18nMessageLoaderInterface
{
    public function load($locale, $domain)
    {
        $result = [];
        $stmt = _get('db')
            ->select('*')
            ->from(':i18n_message')
            ->where('locale_id in ?', ['', $locale])
            ->where('domain_id=?', (string)$domain)
            ->order('locale_id', 1);

        foreach ($stmt->all() as $row) {
//            if ($row['is_json']) {
//                $result[$row['var_name']]
//                    = array_values(json_decode($row['text_value'], 1));
//            } else {
            $result[$row['message_name']] = $row['message_value'];
//            }
        }
        return $result;
    }
}