<?php

namespace Phpfox\I18n;


class I18nLocaleTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $locale = new I18nLocale('en');

        $this->assertSame('Yes', $locale->trans('Yes', '', null));
        $this->assertSame('No', $locale->trans('No', '', null));
        $this->assertNotSame('summary_packages_message',
            $locale->trans('summary_packages_message', '_core.package', null));

        $this->assertSame('$ 1,344.24', $locale->formatCurrency('1344.2409', 'USD', null, null));
        $this->assertSame('€ 1,344.24', $locale->formatCurrency('1344.2403', 'EUR', null, null));
    }
}
