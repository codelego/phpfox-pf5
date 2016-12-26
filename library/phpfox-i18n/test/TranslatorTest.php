<?php

namespace Phpfox\I18n;


class TranslatorTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $t = new Translator();

        $this->assertEquals('en', $t->getLocale());

        $t->setLocale('vi');

        $this->assertEquals('vi', $t->getLocale());
    }

    public function testBase2()
    {
        $t = new Translator();

        $t->setLocale('en');

        $md = new MessageDomain('en', '');

        $md->setMessages([
            'key1'                 => 'message 1',
            'key2'                 => 'message 2',
            'there are {0} photos' => [
                'there is one photo',
                'there are {0} photos',
            ],
        ]);

        $t->messages['en/'] = $md;

        $this->assertEquals('message 1', $t->trans('key1', null, null, null));
        $this->assertEquals('message 2', $t->trans('key2', null, null, null));
        $this->assertEquals('key3', $t->trans('key3', null, null, null));
        $this->assertEquals('there are 0 photos',
            $t->choice('there are {0} photos', 0, null, null, [0]));
        $this->assertEquals('there is one photo',
            $t->choice('there are {0} photos', 1, null, null, null));
        $this->assertEquals('there are {0} photos',
            $t->choice('there are {0} photos', 2, null, null, null));
        $this->assertEquals('there are {0} photos __',
            $t->choice('there are {0} photos __', 3, null, null, null));
    }

    public function testBase3()
    {
        $t = new Translator();

        $t->setLocale('en');

        $md = new MessageDomain('en', 'a');

        $md->setMessages([
            'key1'                 => 'message 1 {0}',
            'key2'                 => 'message 2 {0} {1}',
            'there are {0} photos' => [
                'there is one photo',
                'there are {0} photos',
            ],
        ]);

        $t->messages['en/a'] = $md;

        $this->assertEquals('message 1 param1',
            $t->trans('key1', 'a', null, ['param1']));
        $this->assertEquals('message 2 param1 param2',
            $t->trans('key2', 'a', null, ['param1', 'param2']));
        $this->assertEquals('message 2 param2 param1',
            $t->trans('key2', 'a', null, ['param2', 'param1']));
        $this->assertEquals('key3', $t->trans('key3', 'a', null, null));
        $this->assertEquals('there are 0 photos',
            $t->choice('there are {0} photos', 0, 'a', null, [0]));
        $this->assertEquals('there is one photo',
            $t->choice('there is one photo', 1, 'a', null, [1]));
        $this->assertEquals('there are 4 photos',
            $t->choice('there are 4 photos', 4, 'a', null, [4]));
        $this->assertEquals('there are 4 photos',
            $t->choice('there are {0} photos', 3, 'a', null, [4]));

        $this->assertEquals('there are 4 photos __',
            $t->choice('there are {0} photos __', 3, 'a', null, [4]));
    }

    public function testBase4()
    {
        $t = new Translator();

        $t->setLocale('en');

        $md = new MessageDomain('en', 'a');

        $md->setMessages([
            'key1'                 => 'message 1 {0}',
            'key2'                 => 'message 2 {0} {1}',
            'there are {0} photos' => [
                'there is one photo',
                'there are {0} photos',
            ],
        ]);

        $t->messages['en/a'] = $md;

        $this->assertEquals('message 1 param1',
            $t->trans('key1', 'a', null, ['param1']));
        $this->assertEquals('message 2 param1 param2',
            $t->trans('key2', 'a', null, ['param1', 'param2']));
        $this->assertEquals('message 2 param2 param1',
            $t->trans('key2', 'a', null, ['param2', 'param1']));
        $this->assertEquals('key3', $t->trans('key3', 'a', null, null));
        $this->assertEquals('there are 0 photos',
            $t->choice('there are {0} photos', 4, 'a', null, [0]));
        $this->assertEquals('there is one photo',
            $t->choice('there is one photo', 1, 'a', null, [4]));
        $this->assertEquals('there are 4 photos',
            $t->choice('there are {0} photos', 4, 'a', null, [4]));
        $this->assertEquals('there are 4 photos',
            $t->choice('there are {0} photos', 4, 'a', null, [4]));

        $this->assertEquals('there are 4 photos __',
            $t->choice('there are {0} photos __', 4, 'a', null, [4]));
    }
}
