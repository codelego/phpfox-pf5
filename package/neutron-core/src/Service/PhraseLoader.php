<?php
namespace Neutron\Core\Service;

use Phpfox\I18n\LoaderInterface;

class PhraseLoader implements LoaderInterface
{
    public function load($locale, $domain)
    {
        $result = [];

        $rows = \Phpfox::get('db')
            ->select('is_json, var_name, text_value, lang, domain')
            ->from(':core_phrase')->where('lang in ?', ['', $locale])
            ->where('domain in ?', ['', $domain])->order('domain, lang', 1)
            ->execute()->fetch();

        foreach ($rows as $row) {
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