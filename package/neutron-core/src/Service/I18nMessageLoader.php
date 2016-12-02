<?php
namespace Neutron\Core\Service;

use Phpfox\I18n\I18nMessageLoaderInterface;

class I18nMessageLoader implements I18nMessageLoaderInterface
{
    public function load($locale, $domain)
    {
        $result = [];
        $stmt = \Phpfox::getDb()
            ->select('is_json, var_name, text_value, lang, domain')
            ->from(':core_phrase')
            ->where('lang in ?', ['', $locale])
            ->where('domain=?', (string)$domain)
            ->order('lang', 1)
            ->execute();

        foreach ($stmt->fetch() as $row) {
            if ($row['is_json']) {
                $result[$row['var_name']]
                    = array_values(json_decode($row['text_value'], 1));
            } else {
                $result[$row['var_name']] = [$row['text_value']];
            }
        }
        return $result;
    }
}