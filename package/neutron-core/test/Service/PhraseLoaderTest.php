<?php

namespace Neutron\Core\Service;


class PhraseLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function providePhrase()
    {
        return [
            ['logout', 'Logout'],
            ['module_settings', 'Module Settings'],
        ];
    }

    public function testLoader()
    {
        $loader = new I18nMessageLoader();

        $loader->load('', '');
    }

    /**
     * @dataProvider providePhrase
     *
     * @param $phrase
     * @param $actual
     */
    public function testTranslate($phrase, $actual)
    {
        $this->assertEquals(_text($phrase), $actual);
    }

    public function providePhraseAndContext()
    {
        return [
            ['hook_details', ['nam nguyen'], 'Hook Details nam nguyen'],
            ['hook_details', ['@trung'], 'Hook Details @trung'],
            ['hook_details', ['@trung'], 'Hook Details @trung'],
        ];
    }

    /**
     * @param $phrase
     * @param $context
     * @param $expected
     *
     * @dataProvider providePhraseAndContext
     */
    public function testPhraseAndContext($phrase, $context, $expected)
    {
        $this->assertEquals(_text($phrase, null, null, $context), $expected);
    }
}
